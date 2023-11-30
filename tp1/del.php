<?php 
$cnx=mysqli_connect("localhost","root","","etbass");
$id=$_GET['id'];
mysqli_query($cnx,"DELETE FROM etudiant WHERE id=$id ");

header("location:list.php");

?>