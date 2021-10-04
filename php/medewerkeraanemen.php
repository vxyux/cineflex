<?php 
require "../private/connectioncineflex.php";
session_start();

$voornaam   = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$email      = $_POST['email'];
$wachtwoord   = $_POST['wachtwoord'];

$hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

$sql = "SELECT *
FROM medewerkers mw

LEFT JOIN klanten kt
ON mw.rol = kt.rol

WHERE kt.email = :email OR mw.email = :email";
$stmt = $conn->prepare($sql);
$stmt->execute(array(
    ':email'    => $email
));

$rowCount = $stmt->rowCount();

if($rowcount > 0)
{
    $_SESSION['error'] = "email bestaat al";
    header('location: ../index.php?page=registreren');
}

else if(strlen($wachtwoord) < 6)
{
    $_SESSION['error'] = "Wachtwoord is tekort, moet minimaal 6 karakters hebben";
    header('location: ../index.php?page=registreren');
}

else
{

$sql = "INSERT INTO medewerkers (voornaam, achternaam, email, wachtwoord, rol)
VALUES (:voornaam, :achternaam, :email, :wachtwoord, :rol)";

$stmt = $conn->prepare($sql);
$stmt->execute(array(
    ':voornaam'     => $voornaam,
    ':achternaam'   => $achternaam,
    ':email'        => $email,
    ':wachtwoord'   => $hash,
    ':rol'          => 2
));
header('location: ../index.php?page=medewerkers');
}
?>