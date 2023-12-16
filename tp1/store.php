<?php 
//recuperer les datas
extract($_POST);
$name=$_FILES['photo']['name'];
$tmp=$_FILES['photo']['tmp_name'];

$cnx=mysqli_connect("localhost","root","","etbass");
$to="image/$name";
move_uploaded_file($tmp,$to);

$result=mysqli_query($cnx,"insert into etudiant(nom,prenom,photo,class,tel,email) values ('$nom','$prenom','$to','$class','$tel','$email')");

//  print_r($result);

if (!$cnx) {
    echo "my sql ne pas connecion".mysqli_connect_errno();
    
    
}
header("location:list.php");
?>

