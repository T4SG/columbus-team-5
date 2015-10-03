<?php
// require('Connection.php');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "code4good";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$db_selected = mysqli_select_db($conn,'mysql');


$add = mysqli_query($conn, "INSERT INTO students (attendance, firstname, lastname, gpa, hours, id)
VALUES (90,'Jack','Jones',3.2,2,3);");

$add = mysqli_query($conn, "INSERT INTO students (attendance, firstname, lastname, gpa, hours, id)
VALUES (90,'Sara','Bailey',3.9,100,4);");

//execute the SQL query and return records
$result = mysqli_query($conn, "SELECT id, firstname, lastname FROM students");
//var_dump($result);
if (!$result) {
    $message  = 'Invalid query: ' . mysqli_error($conn) . "\n";
    $message .= 'Whole query: ' . $result;
    die($message);
}

// //fetch tha data from the database
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
   echo "ID:".$row['id']." Name:".$row['firstname']." 
   ".$row['lastname']."<br>";
}

// $row=mysqli_fetch_array($result,MYSQLI_NUM);
// printf ("%s (%s)\n",$row[0],$row[1]);


?>