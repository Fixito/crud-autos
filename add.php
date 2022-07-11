<?php
session_start();
require_once("./pdo.php");
$name = $_SESSION["email"] ?? '';
$error = $_SESSION["error"] ??  false;

if (!isset($_SESSION["email"])) {
  die("ACCÈS REFUSÉ");
}

if (isset($_POST["cancel"])) {
  header("Location: ./index.php");
  return;
}

if (isset($_POST["add"])) {
  if (isset($_POST["make"]) && isset($_POST["model"]) && isset($_POST["year"]) && isset($_POST["mileage"])) {
    if (!empty(trim($_POST["make"])) && !empty(trim($_POST["model"])) && !empty(trim($_POST["year"])) && !empty(trim($_POST["mileage"]))) {
      if (!is_numeric($_POST["year"])) {
        $_SESSION["error"] = "L'année doit être numérique";
        header("Location: ./add.php");
        return;
      } else if (!is_numeric($_POST["mileage"])) {
        $_SESSION["error"] = "Le kilométrage doit être numérique";
        header("Location: ./add.php");
        return;
      } else {
        $sql = "INSERT INTO autos(make, model, year, mileage) VALUES(:make, :model,  :year, :mileage)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ":make" => $_POST["make"],
          ":model" => $_POST["model"],
          ":year" => $_POST["year"],
          ":mileage" => $_POST["mileage"],
        ]);
        $_SESSION["success"] = "Enregistrement ajouté";
        header("Location: ./index.php");
        return;
      }
    } else {
      $_SESSION["error"] = "Tous les champs sont requis";
      header("Location: ./add.php");
      return;
    }
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
    <h1>Ajouter une automobile pour <?= $name ?></h1>
    <?php
    if ($error) {
      echo  "<p style='color: red'>$error</p>";
      unset($_SESSION['error']);
    }
    ?>
    <form method="POST">
      <div>
        <label for="make">Marque :</label>
        <input type="text" name="make" id="make">
      </div>
      <div>
        <label for="model">Modèle :</label>
        <input type="text" name="model" id="model">
      </div>
      <div>
        <label for="year">Année :</label>
        <input type="text" name="year" id="year">
      </div>
      <div>
        <label for="mileage">Kilométrage :</label>
        <input type="text" name="mileage" id="mileage">
      </div>
      <button type="submit" name="add">Ajouter</button>
      <button type="submit" name="cancel">Annuler</button>
    </form>
  </div>
</body>

</html>