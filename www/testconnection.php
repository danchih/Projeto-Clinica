<?php

try {
    $pdo = new PDO("mysql:host=mysql;port=3306;dbname=laravel", "laravel", "root");
    echo "Conexão bem-sucedida!";
} catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
