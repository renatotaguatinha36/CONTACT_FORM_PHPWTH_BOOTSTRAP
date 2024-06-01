<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

/*  SETANDO A ESTRATÉGIA DE ERROS NO PHP                                             */
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);



?>