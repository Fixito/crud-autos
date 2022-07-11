<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "automobile_db";

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connexion échouée: " . $e->getMessage();
}
