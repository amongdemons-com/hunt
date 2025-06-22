<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "../../config.php"; 

$uid = $_SESSION['user_id'];
$mysqli = new mysqli($hostname, $username, $password, $database);
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'db']);
    exit;
}
$stmt = $mysqli->prepare("SELECT username, xp, hp, attack FROM users WHERE id = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$stmt->bind_result($username, $xp, $hp, $attack);
if ($stmt->fetch()) {
    // Save user info in session
    $_SESSION['username'] = $username;
    $_SESSION['xp'] = $xp;
    $_SESSION['hp'] = $hp;
    $_SESSION['attack'] = $attack;

    echo json_encode(['username' => $username, 'xp' => $xp, 'hp' => $hp, 'attack' => $attack]);
} else {
    echo json_encode(['username' => '', 'xp' => 0, 'hp' => 0, 'attack' => 0]);
}
$stmt->close();
$mysqli->close();

?>