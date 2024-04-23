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
  /* set the PDO error mode to exception 

  Comentários de várias linhas em PHP
  
  */
  # comentário de linha
  // Comentários de linha
  
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
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
$querySQL = "SELECT * from tb_usuarios";

$stmt = $conn->query($querySQL); //PDO Statemet



$lista = $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno associativo 
echo '<pre>';
        print_r($lista);
echo '</pre>';
}

while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

   echo  '<pre>';
        print_r($lista);
   echo  '</pre>';
}

$conn = null;
?>


#################################################### UPDATE  MYSQL ##############################################################

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

  // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();

  // echo a message to say the UPDATE succeeded
  echo $stmt->rowCount() . " records UPDATED successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

  echo  '<pre>';
       print_r($lista);
  echo  '</pre>';
}


$conn = null;
?>



#################################################### LAST INSERTED ID #############################################################

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  
  $sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com')";
  // use exec() because no results are returned
  //$conn->exec($sql);

  // Prepare statement
  $stmt = $conn->prepare($sql);

  $last_id = $conn->lastInsertId();
  echo "New record created successfully. Last inserted ID is: " . $last_id;
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

  echo  '<pre>';
       print_r($lista);
  echo  '</pre>';
}



$conn = null;
?>



############################################################ DELETE SQL #############################################################


<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  // sql to delete a record
  $sql = "DELETE FROM MyGuests WHERE id=3";

  // use exec() because no results are returned
  //$conn->exec($sql);
  // Prepare statement
  $stmt = $conn->prepare($sql);
  echo "Record deleted successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

  echo  '<pre>';
       print_r($lista);
  echo  '</pre>';
}


$conn = null;
?>