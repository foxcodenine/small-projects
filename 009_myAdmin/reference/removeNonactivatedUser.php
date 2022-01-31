<?php


$user = 'sparrow';
$password = 'umbrella';
$schema = 'project_009_myAdmin';

$userId = 82;
$passHash = '$argon2id$v=19$m=65536,t=2,p=1$oX4P5mygyO8jvVwxPH+Cfg$Ntef74eyjbK1YJLDsyWNBwvYsWY0QCBL1cAoj9ST8+s';

$command = './app/bash/removeNonactivatedUser.sh' . " {$user} {$password} {$schema} {$userId} " . "'\"" . $passHash . "\"'";


function runBackgroundProsess($command, $outputFile = '/dev/null') {
    $processId = shell_exec(sprintf('%s > %s 2>&1 & echo $!', $command, $outputFile ));  
    return $processId;
}

runBackgroundProsess($command);