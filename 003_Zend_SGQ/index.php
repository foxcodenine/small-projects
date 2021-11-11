
<?php
include './data.php';
include './functions.php';

$chapter = $_POST['c'] ?? $_GET['c'] ?? 1;
$question = $_POST['q'] ?? $_GET['q'] ?? 1;
$next = $question + 1;
$previous = $question - 1; 


if ($previous < 1) $previous = 1;
if ($next > count($data[$chapter])) $next = count($data[$chapter]);




$qqq = $data[$chapter][$question]['question'] ?? null;
$aaa = $data[$chapter][$question]['answers'] ?? [];
$sss = $_POST['selected'] ?? [];
$ccc = $data[$chapter][$question]['correct'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP7 Zend Certification Stydy Guide Question</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <nav class="navbar">
        <div class="row">
        <ul class="navbar__list">
            <?php foreach(range(1, 12) as $i) {
                echo "<li class='navbar__item'><a href='./index.php?c={$i}&q=1'>Chapter {$i}</a></li>";
            }            
            ?>
        </ul>
        </div>
    </nav>


    <div class="title">
        <div class="row">
            <div class="title__box">
            <h1 class="title__text"><?= $titels[$chapter] ?></h1>
            </div>
            
        </div>
    </div>

    <main class="row">

        <div class="question">
            <div class="question__box">
            <?= $qqq?>

            </div>
            
         
        </div>  
        
        <div class="answer">
            
            <form action="./index.php#btn" method="POST">
            <div class="answer__box">

                <?php foreach($aaa as $k => $v):?>
                <div class="answer__selection <?php markCorrect($k, $ccc)?>">
                    <input type="checkbox" class="answer__checkbox" name="selected[]" 
                    value="<?=$k?>" <?php if(in_array($k, $sss)) {echo 'checked';} ?> >
                    <?= $v ?>
                </div>
                <?php endforeach ?>

            </div>

            <input type="hidden" name="c" value="<?= $chapter?>">
            <input type="hidden" name="q" value="<?= $question?>" id="hidden">

            <div class="btn__box u-margen-top-2 u-margen-bottom-8">
            <button class="btn "><a <?= "href='./index.php?c=$chapter&q=$previous'"?> >Previous</a></button>
            <button class="btn btn--check u-margen-left-2" type="submit" value="submitted" name="submitted" id="btn">Check</button>    
            <button class="btn btn--next  u-margen-left-2" ><a <?= "href='./index.php?c=$chapter&q=$next'"?>>Next</a></button>
            </div>    

            </form>
            
           <?php
           
           
           ?>
        </div>
             
        
    </main>
</body>
</html>

