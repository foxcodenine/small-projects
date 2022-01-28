<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my CMS admin</title>


</head>
<body>
<?php 
    use app\Controller\Cat;
    use app\Model\DBConnect;
    use app\Utils\MyCript;

    // $wisky = new Cat('Wisky', 9);
    // echo "My cat is called {$wisky->name} and she is {$wisky->age} years old. <br>";  
    
    // -----------------------------------------------------------------

    echo MyCript::generateKey() . '<br>';
    $encript =  MyCript::encrypt($_ENV['DB_PASSWORD_DEV']);
    $decript =  MyCript::decrypt($encript);
    echo $encript . '<br>';
    echo $decript . '<br>';

    // -----------------------------------------------------------------

    // echo $_ENV['APP_ENV'], 123 . '<br>';
    // echo ($_SERVER['SERVER_NAME']). '<br>';
    // echo ($_SERVER['HTTP_HOST']). '<br>';
    // echo gethostname() . '<br>'; // may output e.g,: sandie
    // echo php_uname('s');

        // -----------------------------------------------------------------


    


?>
</body>
</html>