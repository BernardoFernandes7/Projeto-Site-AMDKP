<?php

header('Content-Type: application/json');
require 'conection.php'; 

try {
   
    $stmt = $dbh->query("SELECT * FROM escolas WHERE ativo = 1");
    $escolas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($escolas as &$escola) {
        
        $escola['ativo'] = 'TRUE'; 
    }

    echo json_encode($escolas);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>