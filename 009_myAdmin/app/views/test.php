<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my CMS admin</title>

    <?php // header('Content-Type: application/json'); 
    ?>
</head>

<body>
    <?php

    use app\Model\AwsClass;
    use app\Model\Cat;
    use app\Model\Collection;
    use app\Model\DBConnect;
    use app\Model\DBTables;
    use app\Model\ImageProject;
    use app\Model\MyCript;
    use app\Model\MyHelperClass;
    use app\Model\Project;
    use app\Model\User;

    use Aws\S3\Exception\S3Exception;




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


    // $encript =  MyCript::encrypt($_ENV['AWS_ACCESS_KEY_ID']);
    // $decript =  MyCript::decrypt($encript);
    // echo $encript . '<br>';
    // echo $decript . '<br><br>';

    // $encript =  MyCript::encrypt($_ENV['AWS_SECRET_ACCESS_KEY']);
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

    // header('Content-Type: application/json');

    // $s3Client = AwsClass::getS3Client();
    // $keys = $s3Client->listObjects([
    //     'Bucket' => $_ENV['AWS_S3_BUCKET'],
    //     'Prefix' => 'user30/poject1/images/'
    // ]); 

    // print_r($keys);




    // class Stage extends Collection {
    //     protected static $tableName = 'Stage';
    //     protected static $fieldName = 'sName';
    // }
    // class Locality extends Collection {
    //     protected static $tableName = 'Locality';
    //     protected static $fieldName = 'lName';
    // }
    // class Category extends Collection {
    //     protected static $tableName = 'Category';
    //     protected static $fieldName = 'yName';
    // }

    // echo "\n\nStage\n";
    // $arr = Stage::getList();
    // var_dump($arr);

    // echo "\n\nLocality\n";
    // $arr = Locality::getList();
    // var_dump($arr);

    // echo "\n\nCategory\n";
    // $arr = Category::getList();
    // var_dump($arr);

    // echo '<h3>...hi Digitalocean!</h3>';

    // $client = new Aws\S3\S3Client([
    //     'version' => 'latest',
    //     'region'      => 'us-east-1',
    //     'endpoint' => 'https://fra1.digitaloceanspaces.com',
    //     'credentials' => [
    //         'key'    => 'IW7GNMRIASCNJ7JZR63O',
    //         'secret' => 'BsDhqPSKwDVfLAPl18KrxpOzq3yzrvAGQroGykrIa+o',
    //     ],
    // ]);

    // var_dump($client);



    // $client->createBucket([
    //     'Bucket' => 'test397284m',
    // ]);

    // echo `ls` . '<br>';

    // // $my_file = file_get_contents('cat.png');
    // // echo $my_file; 

    // echo `ls` .'<br><br><br>';

    // // var_dump(is_file('./cat.png'));

    // try {
    //     //     $client->putObject([
    //     //         'Bucket' => 'test397284m',
    //     //         'Key'    => '123.txt',
    //     //         'SourceFile'    => './cat.png',
    //     //         'ACL'           => 'public-read', // make file 'public'
    //     //    ]);

    //     $client->putObject([
    //         'Bucket'         => 'test397284m',
    //         'Body'          => fopen('dog.jpg', 'rb'),
    //         'Key'           => "dog.jpg",
    //         'ACL'           => 'public-read', // make file 'public'
    //     ]);
    // } catch (S3Exception $e) {

    //     $msg = "Error AwsClass uploadImage: <br>" .  $e->getMessage();
    //     error_log($msg);
    //     die($msg);
    // }





    // AwsClass::uploadImage($my_file, 'project');

    // echo `ls`;



    ?>
</body>

</html>