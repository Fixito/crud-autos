<?php
session_start();
require_once("./pdo.php");
$isConnected = false;
$success = $_SESSION["success"] ?? false;

if (isset($_SESSION["email"])) {
  $isConnected = true;
}

$sql = "SELECT * FROM autos";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <h1>Bienvenue sur la base de données Automobiles</h1>
    <?php
    if ($success) {
      echo "<p style='color: green'>$success</p>";
      unset($_SESSION["success"]);
    }
    ?>
    <?php
    if ($isConnected) {
      if (count($rows) === 0) {
        echo "Pas de lignes trouvées";
      } else {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Marque</th>";
        echo "<th>Modèle</th>";
        echo "<th>Année</th>";
        echo "<th>Kilométrage</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        foreach ($rows as $row) {
          echo "<tr>";
          echo "<td>{$row["make"]}</td>";
          echo "<td>{$row["model"]}</td>";
          echo "<td>{$row["year"]}</td>";
          echo "<td>{$row["mileage"]}</td>";
          echo "<td><a href='./edit.php?autos_id={$row["autos_id"]}'>Éditer</a>/ <a href='./delete.php?autos_id={$row["autos_id"]}'>Supprimer</a></td>";
          echo "</tr>";
        }
        echo "</table>";
      }

      echo "<p><a href='./add.php'>Ajouter Une Nouvelle Entrée</a></p>";
      echo "<a href='./logout.php'>Se Déconnecter</a>";
    } else {
      echo "<a href='./login.php'>Connectez-vous</a>";
      echo "<p>Essayer d'<a href='./add.php'>ajouter des données</a> sans se connecter</p>";
    }
    ?>

  </div>
</body>

</html>