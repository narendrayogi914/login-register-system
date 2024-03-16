<?php 

$conn = mysqli_connect( "localhost", "root","","profile" );
if($conn-> connect_error) {
    die("Connection failed: ". $conn -> connect_error);
}
// echo "Connected Successfully";
?>
