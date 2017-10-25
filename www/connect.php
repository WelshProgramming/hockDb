<?php
// file for connect with database
$conn=null;
$conn = mysqli_connect("localhost", "root", "","iceHockey")
or die ('Database not found ' . mysqli_connect_error() );
?>