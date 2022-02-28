<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my CMS admin</title>

    <?php // header('Content-Type: application/json'); ?>
</head>
<body>
<?php

use app\Model\AwsClass;
use app\Model\Cat;
    use app\Model\DBConnect;
use app\Model\ImageProject;
use app\Model\MyCript;
    use app\Model\MyHelperClass;
    use app\Model\Project;
    use app\Model\User;
    use Aws\S3\S3Client;
    use Aws\Exception\AwsException;




    // $s3Client = AwsClass::getS3Client();

    // $buckets = $s3Client->listBuckets();
    //     foreach ($buckets['Buckets'] as $bucket) {
    //     echo $bucket['Name'] . "<br>";
    // }

    // echo base64_encode('chris12aug@yahoo.com');
    // echo base64_decode(base64_encode('chrismariojimmy@yahoo.com'));

        // Y2hyaXMxMmF1Z0B5YWhvby5jb20=   chris12aug@yahoo.com
    // $wisky = new Cat('Wisky', 9);
    // echo "My cat is called {$wisky->name} and she is {$wisky->age} years old. <br>";  
    
    // -----------------------------------------------------------------
    // $str = '<title>Example document: XSS Doc</title>';
    // echo MyCript::stringSanitize($str);

    // $encript =  MyCript::encrypt($_ENV['AWS_REGION']);
    // $decript =  MyCript::decrypt($encript);
    // echo $encript . '<br>';
    // echo $decript . '<br><br>';

    // $encript =  MyCript::encrypt($_ENV['AWS_ACCESS_KEY_ID']);
    // $decript =  MyCript::decrypt($encript);
    // echo $encript . '<br>';
    // echo $decript . '<br><br>';

    // $encript =  MyCript::encrypt($_ENV['AWS_SECRET_ACCESS_KEY']);
    // $decript =  MyCript::decrypt($encript);
    // echo $encript . '<br>';
    // echo $decript . '<br><br>';


    // -----------------------------------------------------------------

    // echo $_ENV['APP_ENV'], 123 . '<br>';
    // echo ($_SERVER['SERVER_NAME']). '<br>';
    // echo ($_SERVER['HTTP_HOST']). '<br>';
    // echo gethostname() . '<br>'; // may output e.g,: sandie
    // echo php_uname('s');

    // -----------------------------------------------------------------
    
    // $test = User::getUserById(55);
    // $test->removeNonactivatedUser();

    // var_dump(Project::formatDateForDisplay());





    
?>
</body>
</html>