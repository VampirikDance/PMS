<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <title>Авторизация</title>
        <link href="../css/reset.css" media="screen" rel="stylesheet">
        <link href="../css/ui.jqgrid.css" media="screen" rel="stylesheet">
        <link href="../css/bootstrap.min.css" media="screen" rel="stylesheet">
        <link href="../css/bootstrap-reboot.min.css" media="screen" rel="stylesheet">
        <link href="../css/bootstrap-grid.min.css" media="screen" rel="stylesheet">
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/i18n/grid.locale-ru.js"></script>
        <script src="../js/jquery.jqGrid.min.js"></script>  
        <script type="text/javascript">
            $(function () {
                $("#list").jqGrid({
                    url: "pms.table.post.php",
                    datatype: "xml",
                    mtype: "GET",
                    colNames: ["ID", "NAME", "COUNTS"],
                    colModel: [
                        { name: "ID", width: 100 },
                        { name: "NAME", width: 100 },
                        { name: "COUNTS", width: 100, align: "right" }
                    ],
                    pager: "#pager",
                    rowNum: 10,
                    rowList: [10, 20, 30],
                    sortname: "ID",
                    sortorder: "asc",
                    viewrecords: true,
                    gridview: true,
                    autoencode: true,
                    caption: "My first grid"
                }); 
            }); 
        </script>
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
            <table id="list"><tr><td></td></tr></table> 
            <div id="pager"></div> 
        </main>
        <footer>

        </footer>
    </body>
</html>