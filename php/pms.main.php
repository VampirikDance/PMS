<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <title>Авторизация</title>
        <link href="../css/reset.css" media="screen" rel="stylesheet">
        <link href="../css/bootstrap.min.css" media="screen" rel="stylesheet">
        <link href="../css/bootstrap-reboot.min.css" media="screen" rel="stylesheet">
        <link href="../css/bootstrap-grid.min.css" media="screen" rel="stylesheet">
    </head> 
    <body>
        <header>
            <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent" style="background-color: #e3f2fd;">
                    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Pricing</a>
                                </li>
                            </ul>
                            <span class="navbar-text">Navbar text with an inline element</span>
                        </div>
                    </nav>
                </div>
                <nav class="navbar navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span><h5>Скрыть</h5></span>
                    </button>
                </nav>
            </div>
        </header>
        <main>
            <table class="table table-borydered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center"><h4>Наименовние</h4></th>
                        <th class="text-center"><h4>Кол-во</h4></th>
                        <th class="text-center"><h4>Цена</h4></th>
                        <th class="text-center"><h4>Кол-во для заказа</h4></th>
                        <th class="text-center"><h4>Остаток</h4></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $link = mysqli_connect(
                            'localhost',  /* Хост */
                            'root',       /* Имя пользователя */
                            '',           /* Пароль */
                            'PMS');   /* База данных */
                        if ($result = mysqli_query($link, 'SELECT * FROM PRODUCTS_GROUPS ORDER BY ID')) {                        
                            while( $row = mysqli_fetch_assoc($result) ){
                                echo '<tr>' .
                                    '<td class="text-center">' . $row['ID'] . '</td>' .
                                    '<td class="text-center">' . $row['NAME'] . '</td>' .
                                    '<td class="text-center">' . $b++ . '</td>' .
                                    '<td class="text-center">' .  '</td>' .
                                    '<td class="text-center">' . '<input class="form-control">' . '</td>' .
                                    '</tr>';
                            }
                            mysqli_free_result($result);
                        }
                        
                        mysqli_close($link);
                    ?>
                </tbody>
            </table>
        </main>
        <footer>

        </footer>
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>