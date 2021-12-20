<?php

$c1q1 = <<<'QQQ'
Q1: You run the following PHP script:
        
<pre class="code">
    <&#63;php
    for($x = 1; $x <= 2; $x++){
        for($y = 1; $y <= 3; $y++){
            if ($x == $y) continue; 
            print("x = $x  y =  $y");
        }
    }
    ?>
</pre>
What will be the output? Each correct answer represents a complete solution. Choose all that apply.
QQQ;

$c1a1 =
[
    'x = 2 y = 3',
    'x = 2 y = 2',
    'x = 2 y = 1',
    'x = 1 y = 3',
    'x = 1 y = 2',
    'x = 1 y = 1',
];