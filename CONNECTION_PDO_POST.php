<?php

require_once "./connectionDB.php"; // require_once


$erros[] = null;

$id = $_GET['id']; // pegar ID do site

if(empty($_POST["firstname"]) || (empty($_POST["lastname"])) || (empty($_POST["email"])) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || (empty($_POST['senha']))){

   $erros[0] . $_POST['firstname'] =  "Please enter your First Name";
   $erros[1] . $_POST["lastname"] =  "please enter your last name" ; 
   $erros[2] . $_POST['email'] = "Please enter your email address";
   $erros[3] . $_POST['senha'] = "Please enter your Password"; 

   echo $erros[0] ."</br>";
   echo $erros[1] ."</br>";
   echo $erros[2] ."</br>";
   echo $erros[3] ."</br>";
    
}else{                  // início else


  $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
  $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
  $message = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $senha = filter_var(md5($_POST['senha'], FILTER_SANITIZE_SPECIAL_CHARS)); // hash MD5()

    try {


      $conn->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
      $conn->setAttribute(PDO::ATTR_TIMEOUT, 1);
    
    
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
      
      $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
      $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
      $stmt->bindValue(':message', $message, PDO::PARAM_STR);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      
      $stmt = $conn->prepare(" INSERT INTO MyGuests (firstname, lastname, email, senha) VALUES (:firstname, :lastname, :email, :senha) ");
      $stmt->execute();
      echo "</br> New record created successfully </br> ";
      die("</br> New record created successfully </br> ");

    } catch(PDOException $e) {
      
        die("</br>" . $e->getMessage() . "</br>" . $e->getCode() ."<br>". $e->getTraceAsString());
        echo(("</br>" . $e->getMessage() . "</br>" . $e->getCode() ."<br>". $e->getTraceAsString()));
      
    }


}  // fim else


/* ########################################################  LOOP WHILE  ##################################################### */

while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

  echo  "<pre>";
       print_r($lista);
  echo  "</pre>";
}
/* ########################################################################################################################### */

while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

  echo  "<pre>";
       print_r($lista);
  echo  "</pre>";
}

$querySQL = "SELECT * FROM tb_usuarios WHERE id = $id "; 

$stmt = $conn->query($querySQL); //PDO Statemet
$stmt = $conn->prepare($querySQL); // Com método prepare()
$stmt->execute();
$conn->commit();
$conn->rollBack();



while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){ //retorno associativo 
echo '<pre>';
        print_r($lista);
        print($lista);
echo '</pre>';
}

while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){ // retorno Associativo

   echo  "<pre>";
        print_r($lista);
   echo  "</pre>";
}

$conn = null;
?>


/* #################################################### UPDATE SET WHERE MYSQL ############################################# */

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

$erros[] = null;

$id = $_GET['id'];

if(empty($_POST["firstname"]) || (empty($_POST["lastname"])) || (empty($_POST["email"])) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || (empty($_POST['senha']))){

   $erros[0] . $_POST['firstname'] =  "Please enter your first name";
   $erros[1] =  "please enter your last name" ; 
   $erros[2] = "Please enter your email address";
   $erros[3] = "Please enter your Password";

   echo $erros[0] ."</br>";
   echo $erros[1] ."</br>";
   echo $erros[2] ."</br>";
   echo $erros[3] ."</br>";
   printf($erros[1]);
    
}else{   // início else
                 
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

  // Prepare statement
  $stmt = $conn->prepare($sql);
  $stmt = $conn->prepare("UPDATE MyGuests SET lastname='Doe' WHERE id=2");

  // execute the query
  $stmt->execute();

  // echo a message to say the UPDATE succeeded
  echo  $stmt->rowCount() . "records UPDATED successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
  echo $sql . "<br>" . $e->getTraceAsString();
}

}
while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

  echo  "<pre>";
       print_r($lista);
       
  echo  "</pre>";

}

$conn = null;
?>



#################################################### LAST INSERTED ID ######################################################

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
  $stmt = $conn->prepare("INSERT INTO MyGuests (id, firstname, lastname, email) VALUES (:id, :firstname, :lastname, :email)");
  $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
  $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  
  // use exec() because no results are returned
  //$conn->exec($sql);
  $stmt->execute();

  // Prepare statement
  $stmt = $conn->prepare("INSERT INTO MyGuests (id, firstname, lastname, email) VALUES (:id, :firstname, :lastname, :email)");

  $sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com')";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $last_id = $conn->lastInsertId();
  echo "New record created successfully. Last inserted ID is: " . $last_id;
  echo $stmt->rowCount() ." Records UPDATED Sucessfully ";
  echo "New record created successfully. Last inserted ID is: " .  $conn->lastInsertId();
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

  echo  "<pre>";
       print_r($lista);
  echo  "</pre>";
}

header("location: produto-lista.php");
$conn = null;
?>



############################################################ DELETE SQL WHERE #############################################################


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
  $conn->exec($sql);
  // Prepare statement
  $stmt = $conn->prepare($sql);
  $stmt = $conn->prepare("DELETE FROM MyGuests WHERE id=3");
  echo "Record deleted successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


while($lista = $stmt->fetchAll(PDO::FETCH_ASSOC)){

  echo  "<pre>";
       print_r($lista);
  echo  "</pre>";
}


$conn = null;
?>


####################################################################### FORMS VALIDATION ######################################################

<?php


// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
  $comment = test_input($_POST["comment"]);
  $gender = test_input($_POST["gender"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
  
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
  }
  
  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
  
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}


?>