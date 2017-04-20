<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/InsuranceDAO.php";
include_once "$url_path/dao/PatientDAO.php";
include_once "$url_path/dao/Patient_InsuranceDAO.php";

$insuranceDAO = new InsuranceDAO();
$patient_insuranceDAO = new Patient_Insurance_InsuranceDAO();
$patientDAO = new PatientDAO();

session_start();

$patient_id = $_SESSION["paciente"];
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ClaimIn</title>

        <!-- Bootstrap Core CSS -->
        <link href="/comp/ClaimIn/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="/comp/ClaimIn/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

        <!-- Theme CSS -->
        <link href="/comp/ClaimIn/css/Pages.css" rel="stylesheet">

    </head>

    <body id="page-top" class="index">

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
                <ul class="nav navbar-nav ">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>

                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <!-- <li>
                         <a class="page-scroll" href="#team">Team</a>
                     </li>-->
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/comp/ClaimIn/View/Patient/logout.php">
                            <span class="glyphicon glyphicon-pencil"></span> Log out
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!-- /.container-fluid -->
        </nav>
        <section id="about">
            <div class="container">

                <form class="form-horizontal" action="/comp/ClaimIn/controle/addInsurance.php" method="post" role="form">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="insurance">Insurance</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="insurance" name="insurance">
                                        <option value="">-- Select your Insurance --</option>
                                        <?php
                                        $list = $insuranceDAO->listInsurances();
                                        foreach ($list as $row) {
                                            print "<option value=" . $row->getId() . ">" . $row->geClassification() . "</option>";
                                        }
                                        ?>    
                                    </select>
                                </div>
                                </div>

                                <div class="form-group">
                                <label for="start_date" class="control-label col-md-2">Start Date</label>
                                <div class="col-md-10">
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                </div>

                                <div class="form-group">
                                <label for="expiration" class="control-label col-md-2">End Date</label>
                                <div class="col-md-10">
                                    <input type="date" class="form-control" id="expiration" name="expiration" required>
                                </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-2">
                                        <input type="submit" value="Submit" class="btn btn-primary" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <span class="copyright">Copyright &copy; ClaimIn 2016</span>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline social-buttons">
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
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
        <!-- /#wrapper -->

        <!-- jQuery -->
        <!-- jQuery -->
        <script src="/comp/ClaimIn/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="/comp/ClaimIn/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>


    </body>
</html>