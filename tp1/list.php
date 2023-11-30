<?php 
//recuperer tous les produits de la base de donnees
$cnx=mysqli_connect("localhost","root","","etbass");
if($cnx){
   $result= mysqli_query($cnx," select * from etudiant order by id ");
//    desc mean from the biger numbe to the smaller
//   print_r($result);
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des etudians</title>
</head>
<body>
    <h1>Liste des <?=$result->num_rows?> etudiants </h1>
    <table border="1" width="1000" align="center">
        <tr>
            <th >id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>photo</th>
            <th>class</th>
            <th>tel</th>
            <th>email</th>
        </tr>
<?php while($p=$result->fetch_assoc()){?>
        <tr>
            <td><?=$p['id']?></td>
            <td><?=$p['nom']?></td>
            <td><?=$p['prenom']?></td>
            <td><?=$p['photo']?></td>
            <td><?=$p['class']?></td>
            <td><?=$p['tel']?></td>
            <td><?=$p['email']?></td>
            <td>
                <?php if ($p['note']>=10) {echo "Admin";}else{ echo "Pas admin"; } ?>
                <a href="del.php?id=<?=$p['id']?>">del</a>
                
            </td>
        </tr>
<?php } ?>
<div  align="center"> <button id="navigateBtn">Return</button></div>
 
    </table>
  
    <script>
    document.getElementById("navigateBtn").addEventListener("click", function() {
      window.location.href = "create.php"; 
    });
 </script>
</body>
</html>

