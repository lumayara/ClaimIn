<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/Filling_ClaimDAO.php";

$claimDAO = new Filling_ClaimDAO();
$claim = $claimDAO->get($_POST['claim_id']);


// Iniciar Sessão
session_start();

// Verificar existência de Usuário
if (isset($_SESSION['employee'])) {
    if($claimDAO->approve($claim)){
        header("Location: /comp/ClaimIn/View/Filling_Claim/list.php");
    }
else{
    header("Location: /comp/ClaimIn/View/Filling_Claim/info.php?id=".$claim->getId());
}
}else {
    header("Location: /comp/ClaimIn/View/Employee/index.html");
}