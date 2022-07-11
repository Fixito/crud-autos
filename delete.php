<?php
require_once("./pdo.php");
$autos_id = $_GET["autos_id"] ?? '';

if (isset($_POST["delete"])) {
  $sql = "DELETE FROM autos WHERE autos_id = :autos_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    "autos_id" => $_GET["autos_id"]
  ]);
  $_SESSION["success"] = "Enregistrement supprimé";
  header("Location: ./index.php");
  return;
}

$sql = "SELECT autos_id, make FROM autos WHERE  autos_id = :autos_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
  ":autos_id" => $_GET["autos_id"]
]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suppression...</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <p>Confirmer la suppression de : <?= $row["make"] ?></p>
    <form method="POST">
      <input type="hidden" value="<?= $row["autos_id"] ?>">
      <button type="submit" name="delete">Supprimer</button>
      <a href="./index.php">Annuler</a>
    </form>
  </div>
</body>

</html>