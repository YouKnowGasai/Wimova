<?php
try {
    // On se connecte à MySQL
    $mysqlClient = new PDO('mysql:host=localhost;dbname=wimova_users;charset=utf8', 'root');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer

$data = array();

// On récupère tout le contenu de la table users
$sqlQuery = 'SELECT * FROM users';
$usersStatement = $mysqlClient->prepare($sqlQuery);
$usersStatement->execute();
$users = $usersStatement->fetchAll();

// On stocke les données dans un tableau associatif
foreach ($users as $user) {
    $data[] = array(
        'Nom' => $user['Nom'],
        'Prenom' => $user['Prenom']
    );
}

// On renvoie les données au format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>