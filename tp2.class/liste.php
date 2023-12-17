<?php
include_once "etudient.class.php";
$etudiant = new Etudiant("", "", "", "", "", "" ); // Create an instance

// Display the list of students

$etudiant->modifier("108","issam", "moutawakil", "di2", "", "0868576566", "issam@gmail.com");
$etudiant->liste_etudiants();


?>
<!-- <img width="100" height="100" src="uploads/logo-osbt-motif_car-pcmghcavnselr5ev43nnifbgmerszu41ahlj9d95go.png" alt="badr moutaouakil"> -->




