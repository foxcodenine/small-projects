<?php



$c4q1 = <<<'QQQ'
Q1: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $data = "foo:*:1023:1000::/home/foo:/bin/sh";
    list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
    echo $uid; 
    ?>
</pre>
QQQ;

$c4a1 =
['*', 'foo', ' ', ':1023:1000:', 'E_NOTICE', '1023'];

$c4q2 = <<<'QQQ'
Q2: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $input_array = array('a', 'b', 'c', 'd', 'e');
    $arr = var_export(array_chunk($input_array, 2), true);
    echo $arr;
    ?>
</pre>
QQQ;

$c4a2 =
[
    "array ( 0 => array ( 0 => 'a', 1 => 'b', ), 1 => array ( 0 => 'c', 1 => 'd', ), 2 => array ( 0 => 'e', ), )",
    "array ( 0 => array ( 0 => 'a', 1 => 'b', ), 1 => array ( 2 => 'c', 3 => 'd', ), 2 => array ( 4 => 'e', ), )",
    "Warning: Array to string conversion &nbsp; Array"
];



$c4q3 = <<<'QQQ'
Q3: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
    var_export(array_rand($input, 2));
    var_export(array_rand($input));
    ?>
</pre>
QQQ;

$c4a3 =
[
    "Morpheus TrinityTank",
    "array ( 0 => 0, 1 => 1, )1",
    "Morpheus Trinity Tank",
    "array ( 0 => 0, 1 => 3, )array ( 0 => 1 )",
];



$c4q4 = <<<'QQQ'
Q4: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $array1 = array("color" => "red", 2 => 2, 4);
    $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);    
    $result = array_merge($array1, $array2);
    var_export($result);
    ?>
</pre>
QQQ;

$c4a4 =
[
    "array ( 0 => 'a', 1 => 'b', 'color' => 'green', 'shape' => 'trapezoid', 2 => 4, 3 => 4, )",
    "array ( 0 => 'a', 1 => 'b', 'color' => 'red', 'shape' => 'trapezoid', 2 => 4, 3 => 2, 4 => 4, )",
    "array ( 'color' => 'red', 2 => 2, 3 => 4, 0 => 'a', 1 => 'b', 'shape' => 'trapezoid', )",
    "array ( 'color' => 'green', 0 => 2, 1 => 4, 2 => 'a', 3 => 'b', 'shape' => 'trapezoid', 4 => 4, )",
];


$c4q5 = <<<'QQQ'
Q5: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $array1 = array("color" => "red", 2 => 2, 4);
    $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);    
    $result = $array2 + $array1;
    var_export($result);
    ?>
</pre>
QQQ;

$c4a5 =
[   
    "array ( 0 => 'a', 1 => 'b', 'color' => 'green', 'shape' => 'trapezoid', 2 => 4, 3 => 4, )",
    "array ( 0 => 'a', 1 => 'b', 'color' => 'red', 'shape' => 'trapezoid', 2 => 4, 3 => 2, 4 => 4, )",
    "array ( 'color' => 'red', 2 => 2, 3 => 4, 0 => 'a', 1 => 'b', 'shape' => 'trapezoid', )",
    "array ( 'color' => 'green', 0 => 2, 1 => 4, 2 => 'a', 3 => 'b', 'shape' => 'trapezoid', 4 => 4, )",
];


$c4q6 = <<<'QQQ'
Q6: What would you replace /* ??????? */ with to output the following result?
        
<pre class="code">
    <&#63;php
    $fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");
    function funcA(&$item1, $key, $prefix)
    {
        $item1 = "$prefix: $item1";
    }    
    function funcB($item2, $key)
    {
        echo "$key. $item2\n";
    }
    try {
        /* ??????? */
    } catch (Error $e) {
        echo 123;
    }
    ?>
    result: d. lemon a. orange b. banana c. apple
</pre>
QQQ;

$c4a6 =
[   
    "array_walk(\$fruits, 'funcB', 'fruit');",
    "array_walk(\$fruits, 'funcB'); array_walk(\$fruits, 'funcA')",
    "array_walk(\$fruits, 'funcA', 'fruit');",
    "array_walk(\$fruits, 'funcA', 'fruit'); array_walk(\$fruits, 'funcB');",
];