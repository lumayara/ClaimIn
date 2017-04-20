<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/PatientDAO.php";
include_once "$url_path/dao/InsuranceDAO.php";

$patientDAO = new PatientDAO();
$insuranceDAO = new InsuranceDAO();
// Iniciar Sessão
session_start();

// Verificar existência de Usuário
if (isset($_SESSION['paciente'])) {
    $patient = $patientDAO->get($_SESSION['paciente']);
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ClaimIn</title>
            <link href="/comp/ClaimIn/css/bootstrap.css" rel="stylesheet"/>

            <!-- Custom Fonts -->
            <link href="/comp/ClaimIn/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
            <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

            <!-- Theme CSS -->
            <link href="/comp/ClaimIn/css/Pages.css" rel="stylesheet">
        </head>
        <body>

            <!-- Navigation -->
            <nav id="mainNav" class="navbar navbar-inverse navbar-fixed-top">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="/comp/ClaimIn/View/Patient/logged.php">ClaimIn</a>
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
                            <a href="/comp/ClaimIn/View/Patient/logout.php">
                                <span class="glyphicon glyphicon-log-out"></span> Log Out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <!-- /.container-fluid -->
            </nav>

            <section id="services" class="bg-light-gray">
                <div class="container">
                    <h4> Hello <?php echo $patient->getName(); ?>,</h4>
                    <p>
                        Please, select below what you would like to do:
                    </p>
                    <br />
                    <br />
                    <br />
                    <br />


                    <div class="row text-center">
                        <div class="col-md-4">
                            <a href="../Filling_Claim/file.php" class="optionsDoctor">
                                <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-pencil-square-o fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <h4 class="service-heading">File a New Claim</h4>
                        </div>

                        <div class="col-md-4">
                            <a href="../Filling_Claim/list.php" class="optionsDoctor">
                                <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-file-text-o fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                            <h4 class="service-heading">See Filed Claims</h4>
                        </div>

                        <div class="col-md-4">
                            <a href="../Filling_Claim/list.php" class="optionsDoctor">
                                <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                                <h4 class="service-heading">Cancel a Claim</h4>
                        </div>
                    </div>

                </div>

            </section>

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
                                    <a href="#">Terms of Use</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>  
            <script src="/scripts/jquery.min.js"></script>
            <script src="/Scripts/bootstrap.js"></script>

        </body>
    </html>

    <?php
} else {
    header("Location:  /comp/ClaimIn/View/Patient/logged.php");
}
?>



