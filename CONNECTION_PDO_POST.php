<?php

include_once "./connectionDB.php";


$erros[] = null;

$id = $_GET['id']; // pegar ID do site

if(empty($_POST["firstname"]) || (empty($_POST["lastname"])) || (empty($_POST["email"])) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || (empty($_POST['senha']))){

   $erros[0] . $_POST['firstname'] =  "Please enter your first name";
   $erros[1] =  "please enter your last name" ; 
   $erros[2] = "Please enter your email address";
   $erros[3] = "Please enter your Password";

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
  $senha = htmlspecialchars(md5($_POST['email']));
  
    try {
    
    
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
      
      $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
      $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
      $stmt->bindValue(':message', $message, PDO::PARAM_STR);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      
      $stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email, senha) VALUES (:firstname, :lastname, :email, :senha) ");
      $stmt->execute();
      echo "</br>" . "New record created successfully";
    } catch(PDOException $e) {
      echo  "</br>" . $e->getMessage() . "</br>" . $e->getCode() ."<br>". $e->getTraceAsString();
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

$querySQL = "SELECT * FROM tb_usuarios"; 

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