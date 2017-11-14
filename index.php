<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <title>Авторизация</title>
        <link href="css/reset.css" media="screen" rel="stylesheet">
        <link href="css/style.css" media="screen" rel="stylesheet">
        <link href="css/bootstrap.min.css" media="screen" rel="stylesheet">
        <link href="css/bootstrap-reboot.min.css" media="screen" rel="stylesheet">
        <link href="css/bootstrap-grid.min.css" media="screen" rel="stylesheet">
    </head> 
    <body>
        <header>
            <div class="conatainer">
                <div class="row">
                    
                </div>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <div class="offset-sm-4 col-sm-4">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title">Авторизация  <span class="badge badge-danger">P.M.S</span></h4>
                                <form action="/php/pms.main.php">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" id="inputEmail3" placeholder="Имя пользователя">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" id="inputPassword3" placeholder="Пароль">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-0 col-sm-12">
                                            <button type="submit" class="btn btn-danger">Войти</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="container">
                <div class="row">

                </div>
            </div>
        </footer>
    </body>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</html>