<?php
header('Content-Type: application/json');
$port = getservbyport('3306', 'tcp');
echo $port;
?>
