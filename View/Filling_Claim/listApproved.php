<!DOCTYPE html>
<html>
    <?php
    $url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
    include_once "$url_path/dao/Filling_ClaimDAO.php";
    include_once "$url_path/conexao/ConnectionFactory.php";
    $claimDAO = new Filling_ClaimDAO();

    session_start();
   if (isset($_SESSION['employee'])) {
       
    ?>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ClaimIn</title>
        <link href="/comp/ClaimIn/css/bootstrap.css" rel="stylesheet"/>

        <!-- Custom Fonts -->
        <link href="/comp/ClaimIn/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

        <!-- Theme CSS -->
        <link href="/comp/ClaimIn/css/Pages.css" rel="stylesheet">
    </head>
    <body style="background-color:  #eeeeee">

    <body>

        <div id="container">
            <!-- Navigation -->
            <nav id="mainNav" class="navbar navbar-inverse navbar-fixed-top">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    
                   <a class="navbar-brand page-scroll" href="/comp/ClaimIn/View/Employee/logged.php">ClaimIn</a>
                    
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-inverse navbar-right">  
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-cog fa-fw" aria-hidden="true"></i>&nbsp;<span class="caret"></span></a>  

                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Edit Profile</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="/comp/ClaimIn/View/Employee/logout.php">
                            
                            <span class="glyphicon glyphicon-log-out"></span> Log Out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <!-- /.container-fluid -->
            </nav>
            <div class="container">
                <br />

                <div class="row">

                    <div class="col-lg-12">
                        <h1 class="page-header">Filled Claims</h1>
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->
                <div class="row">
                    
                    <!-- /.col-lg-4 --> 
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Approved Claims
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Locator Number</th>
                                                <th>Registration Date</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Edit</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $list = $claimDAO->listApproved();
                                            
                                            foreach ($list as $claim) {
                                                //print "<tr><td>".$claim['name']."</td><td>".date('d/m/Y H:i', strtotime($claim['start_date']))."</td><td><a href = 'editCompForm.php?id=".$claim['id']."'>Editar</a></td><td><a href = 'listTest.php?id=".$claim['id']."'>"
                                                //     ."Manter Prova</a></td><td><a href = 'removeComp.php?id=".$claim['id']."'>Remover</td></tr>";
                                                print "<tr>"
                                                        . "<td>"
                                                        . $claim->getId()
                                                        . "</td>"
                                                        . "<td>"
                                                        . date('d/m/Y', strtotime($claim->getRegistrationDate()))
                                                        . "</td>"
                                                        . "<td>"
                                                        . $claim->getStatus()
                                                        . "</td>"
                                                        . "<td> $ "
                                                        . $claim->getAmount()
                                                        . "</td>"
                                                        . "<td>"
                                                        . "<a href = '/comp/ClaimIn/View/Filling_Claim/info.php?id=" . $claim->getId() . "'>Open</a>"
                                                        . "</td>"
                                                        ."</tr>";
                                            }
                                                  
                                            
                                            ?> 
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 
                <!-- /#row-->

            </div>
        </div>
        <br />
        <br />
        <br />
        
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <span class="copyright">Copyright &copy; ClaimIn 2016</span>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline quicklinks">
                            <li>
                                <a href="#">Privacy Policy</a>
                    </li>
                    <li>
                    <a href = "#">Terms of Use</a>
                    </li>
                    </ul>
                    </div>
                    </div>
                    </div>
                    </footer>
                    <!--/#wrapper -->

                    <!--jQuery -->
                    <!--jQuery -->
                    <script src = "/comp/ClaimIn/js/jquery.min.js"></script>

                    <!-- Bootstrap Core JavaScript -->
                    <script src="/comp/ClaimIn/js/bootstrap.min.js"></script>

                    <!-- Plugin JavaScript -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

                    <!-- Theme JavaScript -->
                    <script src="/comp/ClaimIn/js/agency.min.js"></script>


                    <script language="JavaScript" type="text/javascript">
                        $(document).ready(function () {
                            $("a.delete").click(function (e) {
                                if (!confirm('Are you sure?')) {
                                    e.preventDefault();
                                    return false;
                                }
                                return true;
                            });
                        });
                    </script>
                    </body>

                    </html>
                    
<?php
} else {
    header("Location:  /comp/ClaimIn/View/Employee/logged.php");
}
?>