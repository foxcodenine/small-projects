<?php

require '../../vendor/autoload.php';
use Aws\S3\S3Client;  

$key    = $_SERVER['argv'][1];
$secret = $_SERVER['argv'][2];
$region = $_SERVER['argv'][3];
$bucket = $_SERVER['argv'][4];
$user =   $_SERVER['argv'][5];



$s3Client = new S3Client([  
    'version' => 'latest',
    'region' => $region,
    'credentials' => [
        'key' => $key,
        'secret' => $secret
    ]
]);

print_r($_SERVER['argv']);

