<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

$id = $_GET['id'];

if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

    echo "Please enter your first name";
    echo "and your last name & email address";
    
}else{

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $stmt = $conn->prepare("INSERT INTO MyGuests (id, firstname, lastname, email) VALUES (:id, :firstname, :lastname, :email)");
  $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
  $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  
  $stmt->execute();
  echo "New record created successfully";
} catch(PDOException $e) {
  echo  "</br>" . $e->getMessage() . "</br>" . $e->getCode() .'<br>'. $e->getTraceAsString();
}
$query = 'SELECT * from tb_usuarios';

$stmt = $conn->query($query); //PDO Statemet
$lista = $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno associativo 
echo '<pre>';
        print_r($lista);
echo '</pre>';
}

while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

    print_r($lista);
}

$conn = null;
?>