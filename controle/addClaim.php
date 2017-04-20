<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ClaimIn";
include_once "$url_path/dao/Filling_ClaimDAO.php";
include_once "$url_path/dao/PatientDAO.php";
require "$url_path/PHPMailer/PHPMailerAutoload.php";

$dao = new Filling_ClaimDAO();
$patientDAO = new PatientDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $patient_id = $_SESSION["paciente"];
// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $amount = (isset($_POST['amount'])) ? $_POST['amount'] : '';
    $attachment = (isset($_FILES['attachment'])) ? $_FILES['attachment'] : '';

    $id = 0;

    if ((!empty($amount))) {

        if (!empty($attachment)) {
            // Lista de tipos de arquivos permitidos
            $tiposPermitidos = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'text/pdf');
            // Tamanho máximo (em bytes)
            $tamanhoPermitido = 4000 * 4000; // 500 Kb
            // O nome original do arquivo no computador do usuário
            $arqName = $_FILES['attachment']['name'];
            // O tipo mime do arquivo. Um exemplo pode ser "image/gif"
            $arqType = $_FILES['attachment']['type'];
            // O tamanho, em bytes, do arquivo
            $arqSize = $_FILES['attachment']['size'];
            // O nome temporário do arquivo, como foi guardado no servidor
            $arqTemp = $_FILES['attachment']['tmp_name'];
            // O código de erro associado a este upload de arquivo
            $arqError = $_FILES['attachment']['error'];
            if ($arqError == 0) {
                // Verifica o tipo de arquivo enviado
                if (array_search($arqType, $tiposPermitidos) === false) {
                    echo 'O tipo de arquivo enviado é inválido!';
                    // Verifica o tamanho do arquivo enviado
                } else if ($arqSize > $tamanhoPermitido) {
                    echo 'O tamanho do arquivo enviado é maior que o limite!';
                    // Não houveram erros, move o arquivo
                } else {
                    $pasta = '../attach/';
                    // Pega a extensão do arquivo enviado
                    $extensao = strtolower(end(explode('.', $arqName)));
                    // Define o novo nome do arquivo usando um UNIX TIMESTAMP
                    $nome = time() . '.' . $extensao;
                    // Escapa os caracteres protegidos do MySQL (para o nome do usuário)
                    //$nomeMySQL = mysql_real_escape_string($_POST['nome']);
                    move_uploaded_file($arqTemp, $pasta . $nome);
                }
            }
        } else {
            $nome = NULL;
        }
        $date = date('Y-m-d H:i:s');
        $status = "pending";
        $patient = $patientDAO->get($patient_id);
        // var_dump($date, $status, $amount, $attachment);
        $fillingClaim = new Filling_Claim($id, $patient, $date, $status, floatval($amount), $nome);
//    echo '<script language="javascript">';
//echo 'alert('+$fillingClaim->getAmount()+')';
//echo '</script>';
        if ($dao->add($fillingClaim)) {

            $mail = new PHPMailer;

            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'test92279@gmail.com';          // SMTP username
            $mail->Password = '123Hello'; // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                          // TCP port to connect to

            $mail->setFrom('info@claimin.com', 'ClaimIn');
            $mail->addReplyTo('info@claimin.com', 'ClaimIn');
            $mail->addAddress($patient->getEmail());   // Add a recipient

            $mail->isHTML(true);  // Set email format to HTML

            $mail->Subject = 'New Claim Has Been Added';
            $msg = 'Hi, '.$patient->getName().'. Your Claim of $'.floatval($amount).' was added successfully';
            $mail->Body = $msg;

            //test92279@gmail.com  //123Hello
            //mail('lumayara.ads@gmail.com', 'Claim has been submitted', $msg);
            //echo '<script type="text/javascript">alert("Claim was added sucessfully!");</script>';
            //echo "<script>alert('You are logged out'); window.location.href='../View/Filling_Claim/list.php';</script>";
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                 header("Location: ../View/Filling_Claim/list.php");
            }
           
        }
    } else {
        echo '<script type="text/javascript">alert("Claim was not added!");</script>';
        header("Location: ../View/Filling_Claim/file.php");
    }
}
