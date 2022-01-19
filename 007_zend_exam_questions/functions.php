<?php
function markCorrect($i, $correct) {
    if (in_array($i, $correct) && in_array('submitted', $_POST)){
        echo 'correct';
    }    
}

?>