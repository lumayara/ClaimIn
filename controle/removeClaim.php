<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/Filling_ClaimDAO.php";

$id = $_GET['id'];
$dao = new Filling_ClaimDAO();

if ($dao->remove($id)) {
    // O usuário e a senha digitados foram validados, manda pra página interna
    header("Location: ../View/Filling_Claim/list.php");
    //  echo"$id deu certo";
} else {
    echo '<script type="text/javascript">alert("Claim has not been deleted!");</script>';
    header("Location: ../View/Filling_Claim/list.php");
    //echo"$id nao deu certo";
}

