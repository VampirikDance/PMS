<?php 
// Содержит информацию, необходимую для подключения к базе данных
// MySQL. Мы храним здесь логин, пароль, имя базы.
include("dbconfig.php");
 
// К параметру url добавляются 4 параметра, как описано в colModel.
// Мы должны считать эти параметры, чтобы создать SQL-запрос.
// В настройках таблицы мы указали, что используем GET-метод.
// И мы должны использовать подходящий способ, чтобы считать их.
// В нашем случае это $_GET. Если бы мы указали, что хотим
// использовать POST-метод, то мы бы использовали $_POST.
// Можно использовать $_REQUEST, который содержит переменные 
// с GET и POST одновременно.. 
// Обратитесь к документации для большей информации.
// Получаем номер страницы. Сначала jqGrid ставит его в 1. 
$page = $_GET['page']; 
 
// сколько строк мы хотим иметь в таблице - rowNum параметр 
$limit = $_GET['rows']; 
 
// Колонка для сортировки. Сначала sortname параметр 
// затем index из colModel 
$sidx = $_GET['sidx']; 
 
// Порядок сортировки.
$sord = $_GET['sord']; 
 
// Если колонка сортировки не указана, то будем
// сортировать по первой колонке.
if(!$sidx) $sidx =1; 
 
// Подключаемся к MySQL
$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); 
 
// Выбираем базу данных
mysql_select_db($database) or die("Error connecting to db."); 
 
// Вычисляем количество строк. Это необходимо для постраничной навигации.
$result = mysql_query("SELECT COUNT(*) AS count FROM PRODUCTS_GROUPS"); 
$row = mysql_fetch_array($result,MYSQL_ASSOC); 
$count = $row['count']; 
 
// Вычисляем общее количество страниц.
if( $count > 0 && $limit > 0) { 
              $total_pages = ceil($count/$limit); 
} else { 
              $total_pages = 0; 
} 
 
// Если запрашиваемый номер страницы больше общего количества страниц,
// то устанавливаем номер страницы в максимальный.
if ($page > $total_pages) $page=$total_pages;
 
// Вычисляем начальное смещение строк.
$start = $limit*$page - $limit;
 
// Если начальное смещение отрицательно,
// то устанавливаем его в 0.
// Например, когда пользователь
// выбрал 0 в качестве запрашиваемой страницы.
if($start <0) $start = 0; 
 
// Запрос для получения данных.
$SQL = "SELECT ID,NAME FROM PRODUCTS_GROUPS ORDER BY $sidx $sord LIMIT $start , $limit"; 
$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 
 
// Заголовок с указанием содержимого.
header("Content-type: text/xml;charset=utf-8");
 
$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .=  "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";
 
// Обязательно передайте текстовые данные в CDATA
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    $s .= "<row id='". $row['ID']."'>";            
    $s .= "<cell>". $row['ID']."</cell>";
    $s .= "<cell>". $row['NAME']."</cell>";
    $s .= "<cell>". $row['COUNT']."</cell>";
    $s .= "<cell><![CDATA[". $row['note']."]]></cell>";
    $s .= "</row>";
}
$s .= "</rows>"; 
 
echo $s;
?>