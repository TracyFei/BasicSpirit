<?php 

$conn = mysqli_connect("localhost","Tracy","basic--spirit","test");

if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}

?>