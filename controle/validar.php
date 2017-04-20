<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/PatientDAO.php";
include_once "$url_path/dao/EmployeeDAO.php";

$dao = new PatientDAO();

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $username = (isset($_POST['username'])) ? $_POST['username'] : '';

    $senha = (isset($_POST['password'])) ? $_POST['password'] : '';

 //   $remember = isset($_POST['senha']);
    
 //var_dump($username, $senha, $_POST['paciente']);
    // Iniciar Sessão
    session_start();

    if (isset($_POST['hospital'])) {
        $dao = new HospitalDAO();
        // Resgatar Administrador
        $hospital = $dao->validation($username, $senha);
        // Utiliza uma função pra validar os dados digitados
        if ($hospital) {
            
            // Colocar Usuário na Sessão
            $_SESSION["hospital"] = $hospital->getId();

            // O usuário e a senha digitados foram validados, manda pra página interna
            header("Location: ../painelControle.php");
        } else {

            // O usuário e/ou a senha são inválidos, manda de volta pro form de login
            // Para alterar o endereço da página de login, verifique o arquivo seguranca.php

            header("Location: ../loginAdmin.html");
        }
    }else if (isset($_POST['employee'])) {
        $dao = new EmployeeDAO();
        // Resgatar Administrador
        $employee = $dao->userValidate($username, $senha);
        // Utiliza uma função pra validar os dados digitados
        if ($employee) {
            
            // Colocar Usuário na Sessão
            $_SESSION["employee"] = $employee->getId();

            // O usuário e a senha digitados foram validados, manda pra página interna
            header("Location: ../View/Employee/logged.php");
        } else {

            // O usuário e/ou a senha são inválidos, manda de volta pro form de login
            // Para alterar o endereço da página de login, verifique o arquivo seguranca.php

            header("Location: ../View/Employee/index.html");
        }
    } else if (isset($_POST['paciente'])) {
        //echo '<script type="text/javascript">alert("heeey")</script>';
        $user = $dao->patientValidation($username, $senha);
        if ($user) {
            // Colocar Usuário na Sessão
            $_SESSION["paciente"] = $user->getId();
             $jsonReturn = array(
                                "result" => "Redirect",
                                "url" => "/comp/ClaimIn/View/Patient/logged.php",
                                // Adicionar o vetor de testes
                                "success" => true
             );
            // O usuário e a senha digitados foram validados, manda pra página interna
//            header("Location: alunoTelaInicial.php");
        } else {
             $jsonReturn = array(
                                "message" => "User does not exist",
                                // Adicionar o vetor de testes
                                "success" => false
                            );
        }
    }
    echo json_encode($jsonReturn);
}

