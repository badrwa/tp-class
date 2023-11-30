<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de ecole</title>
</head>
<body>
    <h2>Gestion de ecole</h2>
    <form action="store.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nom" placeholder="Entrer de nom"  required>
        <input type="text" name="prenom" placeholder="Entrer de prenom"  required> 
        <br><br>
        <input type="text" name="class" placeholder="Entrer votre class"  required>
        <input type="text" name="tel" placeholder="Entrer vortre numero" required>
        <br><br>
        <input type="text" name="email" placeholder="Entrer vortre email" required>
        <br><br>
        Image : <input type="file" name="photo" id="" required>
        <br><br>
        
        <button type="submit">Ajouter</button>
        <button id="navigateBtn">Go to</button>
        
    </form>
    <script>
    document.getElementById("navigateBtn").addEventListener("click", function() {
      window.location.href = "list.php"; 
    });
 </script>
</body>
</html>
