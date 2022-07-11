<?php
session_start();
require_once("./pdo.php");
$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
$message = $_SESSION["message"] ?? false;

if (isset($_POST["email"]) && isset($_POST["pass"])) {
  if (!empty(trim($_POST["email"])) && !empty(trim($_POST["pass"]))) {
    if (hash("md5", "$salt{$_POST["pass"]}") === $stored_hash) {
      unset($_SESSION["email"]);
      $_SESSION["email"] = $_POST["email"];
      header("Location: ./index.php");
      return;
    } else {
      $_SESSION["message"] = "Le mot de passe est incorrect";
      header("Location: ./login.php");
      return;
    }
  } else {
    $_SESSION["message"] = "Le nom d'utilisateur et le mot de passe sont requis";
    header("Location: ./login.php");
    return;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <h1>Se Connecter</h1>
    <?php
    if ($message) {
      echo "<p style='color: red'>$message</p>";
      unset($_SESSION["message"]);
    }
    ?>
    <form method="POST" action="./login.php">
      <div>
        <label for="email">Nom d'Utilisateur</label>
        <input type="text" name="email" id="email">
      </div>
      <div>
        <label for="pass">Mot de Passe</label>
        <input type="password" name="pass" id="pass">
      </div>
      <button type="submit">Se Connecter</button>
      <a href="./index.php">Annuler</a>
    </form>
    <p>Pour un indice sur le mot de passe, regarder dans le code source et trouver l'indice sur le mot de passe dans les commentaires HTML</p>
    <!-- Indice : Le mot de passe est les trois caractères du nom du langage de programmation utilisé dans ce projet (en minuscule) suivi de 123 -->
  </div>
</body>

</html>