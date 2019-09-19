<?php

//fetch_data.php

$connect = new PDO("mysql:host=localhost;dbname=contact_ManagerDB", "root", "diego6289");

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
 $data = array(
  ':FName'   => "%" . $_GET['FName'] . "%",
  ':LName'   => "%" . $_GET['LName'] . "%",
  ':Street'     => "%" . $_GET['Street'] . "%",
  ':City'    => "%" . $_GET['City'] . "%"
 );
 $query = "SELECT * FROM Members WHERE FName LIKE :FName AND LName LIKE :LName AND Street LIKE :Street AND City LIKE :City ORDER BY PersonID DESC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'PersonID'    => $row['PersonID'],   
   'FName'  => $row['FName'],
   'LName'   => $row['LName'],
   'Street'    => $row['Street'],
   'City'   => $row['City']
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")
{
 $data = array(
  ':FName'  => $_POST['FName'],
  ':LName'  => $_POST["LName"],
  ':Street'    => $_POST["Street"],
  ':City'   => $_POST["City"]
 );

 $query = "INSERT INTO Members (FName, LName, Street, City) VALUES (:FName, :LName, :Street, :City)";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == 'PUT')
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
  ':PersonID'   => $_PUT['PersonID'],
  ':FName' => $_PUT['FName'],
  ':LName' => $_PUT['LName'],
  ':Street'   => $_PUT['Street'],
  ':City'  => $_PUT['City']
 );
 $query = "
 UPDATE Members 
 SET FName = :FName, 
 LName = :LName, 
 Street = :Street, 
 City = :City
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
