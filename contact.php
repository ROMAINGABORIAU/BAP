<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
</head>
<body>
    <form action="contact.php" method="post">
        <p>
            <label for="Nom">Votre nom</label>

            <input type="text" id="nom" name="lastname">
        </p>

        <p>
            <label for="Prenom">Votre prénom</label>

            <input type="text" id="prenom" name="firstname">
        </p>

        <p>
            <label for="Mail">Votre mail</label>

            <input type="text" id="mail" name="email">
        </p>
        
        <p>
            <input type="submit" value="Envoyer">
        </p>
    </form>
</body>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        

        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "users";

        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $email = $_POST["email"];

        if (!isset($lastname)){
            die("met ton nom frero");
        }
        if (!isset($firstname)){
            die("met ton prenom frero");
        }
        if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            die("met ton mail frero");
        }

        $mysqli = new mysqli($host, $username, $password, $database);

        if ($mysqli->connect_error) {
            die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
        }

        $statement = $mysqli->prepare("INSERT INTO users (lastname, firstname, email) VALUES(?,?,?)");

        $statement->bind_param('sss',$lastname, $firstname, $email);

        if($statement->execute()){
            print "Salut " . $firstname . "!, votre adresse e-mail est ". $email;
          }else{
            print $mysqli->error; 
          }
    }
?>










</html>