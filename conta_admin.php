<?php
require 'conection.php';
session_start();
header('Content-Type: application/json');


$input = json_decode(file_get_contents('php://input'), true);
$user = $input['username'] ?? '';
$pass = $input['password'] ?? '';


try {
    $check = $dbh->query("SELECT count(*) FROM admin_users")->fetchColumn();
    if ($check == 0) {
        
        $senhaHash = password_hash('amdkp2025', PASSWORD_DEFAULT);
        
        $stmt = $dbh->prepare("INSERT INTO admin_users (username, password) VALUES ('admin', ?)");
        $stmt->execute([$senhaHash]);
    }
} catch (Exception $e) {
    
}


try {
    
    $stmt = $dbh->prepare("SELECT id, password FROM admin_users WHERE username = ?");
    $stmt->execute([$user]);
    $registo = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($registo && password_verify($pass, $registo['password'])) {
        $_SESSION['galeria_auth'] = true; 
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados incorretos']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro de base de dados']);
}
?>