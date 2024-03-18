<?php
require_once('conexion.php');
session_start();
require "PHPMailer/Exception.php";
require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";
include 'mail.php';
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = $_SESSION['correo_electronico'];
$usuario = $_SESSION['usuario'];

$oMail = new PHPMailer();
$oMail->isSMTP();
$oMail->Host="smtp.gmail.com";
$oMail->Port=587;
$oMail->SMTPSecure="tls";
$oMail->SMTPAuth=true;
$oMail->isHTML(true);
$oMail->Username="pedidosreposterialarosa@gmail.com";
$oMail->Password="nfrr ypot vfon fqbr";
$oMail->setFrom("pedidosreposterialarosa@gmail.com", "Reposteria La Rosa");
$oMail->addAddress($mail);
$oMail->Subject = 'Detalle del pedido de: ' . $usuario; 
$oMail->Body = $mensaje_mail;

 
try {
    $oMail->send();
    echo 'Correo enviado correctamente';
    header("Location: cerrar_sesion.php");
    exit();
} catch (Exception $e) {
    echo 'Error al enviar el correo: ', $oMail->ErrorInfo;
    header("Location: pedidos_realizados.php");
}
?>
