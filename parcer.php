<meta charset="utf-8">
<meta charset="windows-1251">
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

// Данные базы данных Oracle для подключения к ней
	$dbhost = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.7)(PORT = 1521)))(CONNECT_DATA = (SERVICE_NAME = vesta)))"; 
 
// Имя пользователя базы данных Oracle
//$dbusername = "blin";
	$dbusername = "SUPERMAG";

// Пароль пользователя базы данных Oracle
//$dbpass = "AdlMn";
	$dbpass = "qqq";
 
// Подключение к базе данных Oracle
	$dbconnect = oci_connect ($dbusername, $dbpass, $dbhost,'UTF8');
 
// Проверка соединения с базой
	if($dbconnect){
		echo "<p>Соединение установлено.</p>";
	}else{
		die ("<p>Ошибка подключения к серверу баз данных.</p>");
	}

//выборка из SMSTORELOCATIONS
	//выборка id и NAME
	$id_location = oci_parse($dbconnect, 'SELECT ID,NAME FROM SUPERMAG.SMSTORELOCATIONS');
	//выполнение запроса
	oci_execute($id_location);

//выборка из SACARDCLASS
	//выборка id и name
	$id_group = oci_parse($dbconnect, 'SELECT ID,NAME FROM SUPERMAG.SACARDCLASS');
	//выполнение запроса
	oci_execute($id_group);

//выборка из SMGOODS
	//выборка ARTICLE STORELOC AND QUANTITY
	$id_good = oci_parse($dbconnect, 'SELECT ARTICLE,STORELOC,QUANTITY FROM SUPERMAG.SMGOODS');
	//выполнение запроса
	oci_execute($id_good);
	//выборка из SMCARD для SMGOODS
	$id_card = oci_parse($dbconnect, 'SELECT ARTICLE,NAME,IDCLASS FROM SUPERMAG.SMCARD');
	//выполнение запроса
	oci_execute($id_card);

// подключение к localhost базе
	$dblocalconnect = mysqli_connect("localhost", "root", "", "pms");
	
	if ($dblocalconnect) {
		echo "<p>2-ое Соединение установлено</p>";
	} else {
		die ("<p>Не удалось подключиться к MySQL:</p>");
	}
	mysqli_set_charset($dblocalconnect, 'UTF8');

//всавка ARTICLE STORELOC QUANTITY NAME IDCLASS(IDGROUP)
/*while ($row = oci_fetch_array($id_good))
{
  foreach ($row as $key => $val)
  {
    $row['ARTICLE'] = mysqli_real_escape_string($dblocalconnect, $row['ARTICLE']);
    $row['STORELOC'] = mysqli_real_escape_string($dblocalconnect, $row['STORELOC']);
    $row['QUANTITY'] = mysqli_real_escape_string($dblocalconnect, $row['QUANTITY']);
  }
  if (mysqli_num_rows($result = mysqli_query($dblocalconnect, "SELECT ARTICLE,ID_SHOP FROM PRODUCTS WHERE ARTICLE = '".$row['ARTICLE']."' AND ID_SHOP = '".$row['STORELOC']."'"))==0)
  {
    echo ('нету записей');
  }else{
    echo ('хм что то есть');
}  
}
*/
//вставка id в SHOPS
	while ($row = oci_fetch_array($id_location))
	{
	  foreach ($row as $key => $val)
	  {
		$row['ID'] = mysqli_real_escape_string($dblocalconnect, $row['ID']);
		$row['NAME'] = mysqli_real_escape_string($dblocalconnect, $row['NAME']);
	  }
	  if($row['ID']>0){
		  $result = mysqli_query($dblocalconnect, "INSERT INTO `SHOPS` (`ID`,`NAME`) VALUES ('" . $row['ID'] . "','" . $row['NAME'] . "') ON DUPLICATE KEY UPDATE NAME = VALUES(NAME)");
		  if ($result)
			{
				echo ("<p>Добавление прошло успешно</p>");
			} else {
				echo ("<p>Данные не были добавлены</p>");
			}
		}else{
		  echo ("<p>Не корректный ID</p>");
		}
	}

//вставка id и name в products_groups
	while ($row = oci_fetch_array($id_group))
	{
		foreach ($row as $key => $val)
		{
			$row['ID'] = mysqli_real_escape_string($dblocalconnect, $row['ID']);
			$row['NAME'] = mysqli_real_escape_string($dblocalconnect, $row['NAME']);
		}
		$result = mysqli_query($dblocalconnect, "INSERT INTO `PRODUCTS_GROUPS` (`ID`,`NAME`) VALUES ('" . $row['ID'] . "','" . $row['NAME'] . "') ON DUPLICATE KEY UPDATE NAME = VALUES(NAME)");
		if ($result)
		{
			echo ("<p>Добавление прошло успешно</p>");
		}else{
			echo ("<p>Данные не были добавлены</p>");
		}
	}
	
//вставка aricle,name,id_group,barcode в PRODUCTS_CARDS
	while ($row = oci_fetch_array($id_card))
	{
		foreach ($row as $key => $val)
		{
			$row['ARTICLE'] = mysqli_real_escape_string($dblocalconnect, $row['ARTICLE']);
			$row['NAME'] = mysqli_real_escape_string($dblocalconnect, $row['NAME']);
			$row['IDCLASS'] = mysqli_real_escape_string($dblocalconnect, $row['IDCLASS']);
		}
		$row['NAME'] = str_replace("\\", "", $row['NAME']);
		$result = mysqli_query($dblocalconnect, "INSERT INTO `PRODUCTS_CARDS` (`ARTICLE`,`NAME`,`ID_GROUP`,`ID_ADDIT_BARECODE`) VALUES ('" . $row['ARTICLE'] . "','" . $row['NAME'] . "','" . $row['IDCLASS'] . "','1') ON DUPLICATE KEY UPDATE ARTICLE = VALUES(ARTICLE)");
		if ($result)
		{
			echo ("<p>Добавление в CARDS прошло успешно</p>");
		}else{
			echo ("<p>Данные не были добавлены в CARDS</p>");
		}
	}

	oci_close($dbconnect);
?>