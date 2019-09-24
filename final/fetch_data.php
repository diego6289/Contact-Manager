<?php

$connect = new PDO("mysql:host=localhost;dbname=contact_ManagerDB", "root", "diego6289");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET')
{
 $data = array(
  ':FName'   => "%" . $_GET['FName'] . "%",
  ':LName'   => "%" . $_GET['LName'] . "%",
  ':Email'   => "%" . $_GET['Email'] . "%",
  ':HPhone'    => "%" . $_GET['HPhone'] . "%"
 );
 $query = "SELECT * FROM Members WHERE FName LIKE :FName AND LName LIKE :LName AND Email LIKE :Email AND HPhone LIKE :HPhone ORDER BY PersonID DESC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'PersonID'    => $row['PersonID'],   
   'FName'  => $row['FName'],
   'LName'   => $row['LName'],
   'Email'  => $row['Email'],
   'HPhone'   => $row['HPhone']
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")
{
 $data = array(
  ':FName'  => $_POST['FName'],
  ':LName'  => $_POST['LName'],
  ':Email'  => $_POST['Email'],
  ':HPhone'   => $_POST['HPhone']
 );

// Figure out how to keep count of person id values.         
 $query = "INSERT INTO Members (PersonID, FName, LName, Email, HPhone) VALUES (59,:FName, :LName, :Email, :HPhone)";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

//
if($method == 'PUT')
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
  ':PersonID'   => $_PUT['PersonID'],
  ':FName' => $_PUT['FName'],
  ':LName' => $_PUT['LName'],
  ':Email' => $_PUT['Email'],
  ':HPhone'  => $_PUT['HPhone']
 );
 $query = "
 UPDATE Members 
 SET FName = :FName, 
 LName = :LName, 
 Email = :Email,
 HPhone = :HPhone
 WHERE PersonID = :PersonID
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM Members WHERE PersonID = '".$_DELETE["PersonID"]."'";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>
