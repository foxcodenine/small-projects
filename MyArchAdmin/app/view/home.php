<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my CMS admin</title>

    <?php require_once './app/init.php';  ?>

</head>
<body>
    <?php 
        use app\Controller\Cat;
use app\Utils\MyCript;

$wisky = new Cat('Wisky', 9);
        echo "My cat is called {$wisky->name} and she is {$wisky->age} years old. <br>";         
        echo MyCript::generateKey();
    ?>
</body>
</html>