<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/PatientDAO.php";
include_once "$url_path/dao/Patient_InsuranceDAO.php";
include_once "$url_path/dao/Filling_ClaimDAO.php";
include_once "$url_path/dao/EmployeeDAO.php";


$patientDAO = new PatientDAO();
$employeeDAO = new EmployeeDAO();
$patient_insuranceDAO = new Patient_Insurance_InsuranceDAO();
$claimDAO = new Filling_ClaimDAO();
$claim = $claimDAO->get($_GET['id']);

// Iniciar Sessão
session_start();

// Verificar existência de Usuário
if (isset($_SESSION['paciente']) || isset($_SESSION['employee'])) {
    if (isset($_SESSION['paciente'])) {
        $patient = $patientDAO->get($_SESSION['paciente']);
        $patient_insurance = $patient_insuranceDAO->find($patient->getId());
    } else {
        $patient_insurance = $patient_insuranceDAO->find($claim->getPatient()->getId());
    }
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ClaimIn</title>
            <link href="/comp/ClaimIn/css/bootstrap.min.css" rel="stylesheet"/>

            <link href="/comp/ClaimIn/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
            <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

            <link href="/comp/ClaimIn/css/Pages.css" rel="stylesheet">
        </head>
        <body>

            <nav id="mainNav" class="navbar navbar-inverse navbar-fixed-top">

                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <?php
                    if (isset($_SESSION['paciente'])) {
                        print "<a class='navbar-brand page-scroll' href='/comp/ClaimIn/View/Patient/logged.php'>ClaimIn</a>";
                    } else {
                        print "<a class='navbar-brand page-scroll' href='/comp/ClaimIn/View/Employee/logged.php'>ClaimIn</a>";
                    }
                    ?>
                </div>

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

                            <?php
                            if (isset($_SESSION['paciente'])) {
                                print "<a href='/comp/ClaimIn/View/Patient/logout.php'>";
                            } else {
                                print "<a href='/comp/ClaimIn/View/Employee/logout.php'>";
                            }
                            ?>

                            <span class="glyphicon glyphicon-log-out"></span> Log Out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <section id="services" class="bg-light-gray">
                <center><h1>CLAIM INFO &nbsp;</h1></center>
                <br />
                <br />
                <div class="container">

                    <div class="row">
    <?php
    if (isset($_SESSION['employee'])) {
        print "<form class='form-horizontal' action='/comp/ClaimIn/View/Filling_Claim/changeStatus.php' method='post' enctype='multipart/form-data'>";
    }
    ?>
                        <label class="control-label col-md-2" for="name">Name</label>
                        <div class="col-md-10">
                            <p> <?php echo $claim->getPatient()->getName(); ?></p>
                        </div>

                        <label class="control-label col-md-2" for="insurance">Insurance</label>
                        <div class="col-md-10">
                            <p><?php echo $patient_insurance->getInsurance()->getId(); ?></p>
                        </div>

                        <label class="control-label col-md-2" for="amount">Amount</label>
                        <div class="col-md-10">
                            <p><?php echo $claim->getAmount(); ?></p>
                        </div>

                        <label class="control-label col-md-2" for="attachment">Attachment</label>
                        <div class="col-md-10">
                            <p><img src="../../attach/<?php echo $claim->getAttachment(); ?>" alt="Insurance Attachment"></p>
                        </div>

    <?php
    if (isset($_SESSION['employee'])) {
    if($claim->getStatus() == 'pending'){
        print "<div class = 'col-md-offset-11 col-md-1'>"
                . "<input type='hidden' name='claim_id' id='claim_id' value='" . $_GET['id'] . "'>"
                . "<br /><br /><input type = 'submit' value = 'Approve' class = 'btn btn-primary' />"
                . "</div>"
                . "</form>";
    }
    }
    ?>
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
            <script src="/scripts/bootstrap.min.js"></script>

            ]
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>


            <script src="/scripts/jqBootstrapValidation.js"></script>
            <script src="/scripts/contact_me.js"></script>


            <script src="/scripts/agency.min.js"></script>
        </body>
    </html>
    <?php
} else {
    header("Location: /comp/ClaimIn/View/Home");
}
?>
