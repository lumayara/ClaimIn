<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/PatientDAO.php";

$patientDAO = new PatientDAO();

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $name = (isset($_POST['name'])) ? $_POST['name'] : '';
    $birthday = (isset($_POST['birthday'])) ? $_POST['birthday'] : '';
    $gender = (isset($_POST['gender'])) ? $_POST['gender'] : '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $password = (isset($_POST['password'])) ? $_POST['password'] : '';

    $id = 0;

    if ((!empty($name)) && (!empty($gender)) && (!empty($email)) && (!empty($password))) {
        $insertBirth = date('Y-m-d', strtotime($birthday));
        $patient = new Patient($id, $name, $email, $password, $insertBirth, $gender);

        if ($patientDAO->add($patient)) {
            $user = $patientDAO->patientValidation($email, $password);
            $id = $user->getId();
            session_start();
            $_SESSION["paciente"] = $id;
            $jsonReturn = array(
                "result" => "Redirect",
                // Adicionar o vetor de testes
                "success" => true
            );
    }else{
        $jsonReturn = array(
                "message" => "Patient was not saved",
                // Adicionar o vetor de testes
                "success" => false
            );
        }
       
    }
     echo json_encode($jsonReturn); 
}
