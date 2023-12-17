
<?php
include_once "etudient.class.php";


?>  

    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudient liste</title>
</head>
<body>
    <form action="liste.php" method="post" enctype="multipart/form-data">
    Nom: <input type="text" name="nom" value=""><br>
    Prenom: <input type="text" name="prenom" value=""><br>
    Class: <input type="text" name="class" value=""><br>
    Tel: <input type="text" name="tel" value=""><br>
    Email: <input type="text" name="email" value=""><br>
    Photo: <input type="file" name="photo" value=""><br>
    <input type="submit" value="Upload Image" id="submitbtn" name="submit">
    <!-- php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> -->
    
</form>
</body>
</html>
