<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/PatientDAO.php";
include_once "$url_path/dao/InsuranceDAO.php";
include_once "$url_path/dao/Patient_InsuranceDAO.php";

$patient_insuranceDAO = new Patient_Insurance_InsuranceDAO();
$patientDAO = new PatientDAO();
$insuranceDAO = new InsuranceDAO();

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    session_start();
    $patient_id = $_SESSION["paciente"];
    $insurance_id = (isset($_POST['insurance'])) ? $_POST['insurance'] : '';
    $start_date = (isset($_POST['start_date'])) ? $_POST['start_date'] : '';
    $expiration = (isset($_POST['expiration'])) ? $_POST['expiration'] : '';

    
    $id = 0;
    if ((!empty($patient_id)) && (!empty($start_date)) && (!empty($expiration))) {
       
        $patient = $patientDAO->get($patient_id);
        $insurance = $insuranceDAO->get($insurance_id);
        $insertdate = date('Y-m-d', strtotime($start_date));
        $insertexp = date('Y-m-d', strtotime($expiration));

    $patient_insurance = new Patient_Insurance($id, $patient, $insurance, $insertdate, $insertexp);
   // var_dump($patient_insurance);
    if ($patient_insuranceDAO->add($patient_insurance)) {
    header("Location: ../View/Patient/logged.php    ");
    }
 }           

        }
