<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/EmployeeDAO.php";

$EmployeeDAO = new EmployeeDAO();

// Iniciar Sessão
session_start();

// Verificar existência de Usuário
if (isset($_SESSION['admin'])) {
    $admin = $EmployeeDAO->get($_SESSION['admin']);

    if ($admin) {
        ?>

        <!DOCTYPE html>
        <html>

            <head>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <title>WidIF - Painel de Controle</title>

                <!-- Core CSS - Include with every page -->
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <link href="font-awesome/comp/ClaimIn/css/font-awesome.css" rel="stylesheet">

                <!-- Page-Level Plugin CSS - Dashboard -->
                <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
                <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

                <!-- SB Admin CSS - Include with every page -->
                <link href="css/sb-admin.css" rel="stylesheet">

            </head>

            <body>

                <div id="wrapper">

                    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="painelControle.php"><img src="img/respondeae_small.png" width="200" height="40"></a>
                        </div>
                        <!-- /.navbar-header -->

                        <ul class="nav navbar-top-links navbar-right">                                
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                                    </li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                            <!-- /.dropdown -->
                        </ul>
                        <!-- /.navbar-top-links -->


                    </nav>

                    <div id="page-wrapper">
                        <div class="row">

                            <div class="col-lg-12">
                                <h1 class="page-header"><i class="fa fa-cog fa-fw"></i>Painel de Controle</h1>
                            </div>
                            <!-- /.col-lg-12 -->

                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <i class="fa fa-trophy fa-fw"></i> Gerenciar Competições
                                    </div>
                                    <div class="panel-body">
                                        <p><h4><i class="fa fa-plus fa-fw"></i><a href="addComp.html">Adicionar nova</a></h4></p>
                                        <p><h4><i class="fa fa-list fa-fw"></i><a href="controle/listComp.php">Ver Competições</a></h4></p>
                                    </div>

                                </div>
                            </div>
                            <!-- /.col-lg-4 -->
                            <div class="col-lg-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <i class="fa fa-users fa-fw"></i>Gerenciar Usuários
                                    </div>
                                    <div class="panel-body">
                                        <p><h4><i class="fa fa-plus fa-fw"></i><a href="controle/addUserForm.php">Adicionar novo</a></h4></p>
                                        <p><h4><i class="fa fa-list fa-fw"></i><a href="controle/listUser.php"> Ver Participantes</a></h4></p>
                                    </div>

                                </div>
                            </div>
                            <!-- /.col-lg-4 -->
                            <div class="col-lg-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <i class="fa fa-user fa-fw"></i>Gerenciar Employeees
                                    </div>
                                    <div class="panel-body">
                                        <p><h4><i class="fa fa-plus fa-fw"></i><a href="addAdmin.html">Adicionar novo</a></h4></p>
                                        <p><h4><i class="fa fa-list fa-fw"></i><a href="controle/listaAdmin.php"> Ver Employeees</a></h4></p>
                                    </div>

                                </div>
                            </div>
                            <!-- /.col-lg-4 --> 

                        </div> 
                        <!-- /#row-->


                    </div>
                    <!-- /#page-wrapper -->

                </div>
                <!-- /#wrapper -->

                <!-- Core Scripts - Include with every page -->
                <script src="js/jquery-1.10.2.js"></script>
                <script src="js/bootstrap.min.js"></script>
                <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

                <!-- Page-Level Plugin Scripts - Dashboard -->
                <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
                <script src="js/plugins/morris/morris.js"></script>

                <!-- SB Admin Scripts - Include with every page -->
                <script src="js/sb-admin.js"></script>

                <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
                <script src="js/demo/dashboard-demo.js"></script>

            </body>

        </html>


        <?php
    } else {
        header("Location: loginAdmin.html");
    }
} else {
    header("Location: loginAdmin.html");
}