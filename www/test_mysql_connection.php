<?php

$host = 'mysql';
$port = 3306;

$connection = @fsockopen($host, $port);

if ($connection) {
    echo "Conexão bem-sucedida com o MySQL em $host:$port\n";
    fclose($connection);
} else {
    echo "Não foi possível conectar ao MySQL em $host:$port\n";
}
