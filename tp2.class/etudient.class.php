<?php
class Etudiant {
    public $nom;
    public $prenom;
    public $photo;
    public $class;
    public $tel;
    public $email;

    public function __construct($nom, $prenom, $photo, $class, $tel, $email) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->photo = $photo;
        $this->class = $class;
        $this->tel = $tel;
        $this->email = $email;
    }

    public function afficher() {
        echo "<div ><br>";
        echo "Nom : " . $this->nom . "<br>Prenom : " . $this->prenom . "<br>";
        echo "Class : " . $this->class . "<br>";
        echo "Telephone : " . $this->tel . "<br>Email : " . $this->email . "<br>";
        if (!empty($this->photo)) {
            echo "<img width='200' height='150' src='" . $this->photo . "' alt='" . $this->nom . " " . $this->prenom . "'>";
        }
        echo "</div><br>";
    }

    public function connexion_db() {
        $conn = new PDO("mysql:host=localhost;dbname=etbass", "root", "");
        return $conn;
    }

    public function ajouter() {
        $cnx = $this->connexion_db();

        $req = $cnx->prepare('INSERT INTO etudiant (nom, prenom, photo, class, tel, email) VALUES (?, ?, ?, ?, ?, ?)');
        $req->execute(array($this->nom, $this->prenom, $this->photo, $this->class, $this->tel, $this->email));
    }

    public function liste_etudiants() {
        $cnx = $this->connexion_db();

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $this->delete($_GET['id']);
        }

        $req = $cnx->prepare('SELECT * FROM etudiant');
        $req->execute();
        $liste = $req->fetchAll();

        echo "<table border='1'>";
        echo "<tr><th>Id</th><th>Nom</th><th>Prenom</th><th>Class</th><th>Photo</th><th>Telephone</th><th>Email</th><th>Action</th></tr>";

        foreach ($liste as $rows) {
            echo "<tr>";
            echo "<td>" . $rows['id'] . "</td>";
            echo "<td>" . $rows['nom'] . "</td>";
            echo "<td>" . $rows['prenom'] . "</td>";
            echo "<td>" . $rows['class'] . "</td>";

            // Displaying the image if $photo is not empty
            echo "<td>";
            if (!empty($rows['photo'])) {
                echo "<img width='100' height='100' src='" . $rows['photo'] . "' alt='" . $rows['nom'] . " " . $rows['prenom'] . "'>";
            }
            echo "</td>";

            echo "<td>" . $rows['tel'] . "</td>";
            echo "<td>" . $rows['email'] . "</td>";
            echo "<td><a href='?action=delete&id=" . $rows['id'] . "'>Delete</a>";
            echo "</tr>";
        }

        echo "</table>";
    }

    public function delete($id) {
        $cnx = $this->connexion_db();
        $req = $cnx->prepare("DELETE FROM etudiant WHERE id=?");
        $req->bindValue(1, $id);
        $req->execute();
    }


    public function modifier($id, $nom, $prenom, $class, $photo, $tel, $email) {
        $cnx = $this->connexion_db();

        $req = $cnx->prepare('UPDATE etudiant SET nom=?, prenom=?, photo=?, class=?, tel=?, email=? WHERE id=?');
        $req->execute(array($nom, $prenom, $photo, $class, $tel, $email, $id));
    }
}

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $class = $_POST['class'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;

        $etudiant = new Etudiant($nom, $prenom, $target_file, $class, $tel, $email);

        $etudiant->ajouter();

    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>