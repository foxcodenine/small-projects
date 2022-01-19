<?php

$c4q1 = <<<'QQQ'
Q1: Are PHP keys case-sensitive? What will the output of this script be?
        
<pre class="code">
    <&#63;php
    $arr1 = ["A" => "apple", "B" => "banana"];
    $arr2 = ["a" => "aardvark", "b" => "baboon"];
    echo count($arr1 + $arr2); 
    ?>
</pre>
QQQ;

$c4a1 =
    [
        'This produces an error',
        '2',
        '4',
        'None of the above'
    ];

$c4q2 = <<<'QQQ'
Q2: What will this script output?
        
<pre class="code">
    <&#63;php
    $arr = [
        'a' => 'apple',
        'b' => 'banana',
        'c' => 'cherry'
    ];
    $keys = array_keys($arr);
    if (in_array($keys, 'a')) {
        echo "Found";
    }
    ?>
</pre>
QQQ;

$c4a2 =
    [
        'Found',
        'Nothing',
        'Warning: in_array() expects parameter 2 to be array',
        'None of the above'
    ];

$c4q3 = <<<'QQQ'
Q3: What will this script output?
        
<pre class="code">
    <&#63;php
    $birds = ['duck', 'chicken', 'goose'];
    $net = ['dog', 'cat', 'chicken', 'goose', 'hamster'];
    echo count(array_intersect_assoc($net, $birds));
    ?>
</pre>
QQQ;

$c4a3 =
    [
        '0',
        '1',
        '2',
        '3',
        'None of the above'
    ];

$c4q4 = <<<'QQQ'
Q4: What will this script output?
        
<pre class="code">
    <&#63;php
    // Array of available fruits
    $fruits = array("lemons" => 1, "oranges" => 4, "bananas" => 5,
    "apples" => 10);
    $fruitsArrayObject = new ArrayObject($fruits);
    $fruitsArrayObject->setFlags(ArrayObject::ARRAY_AS_PROPS);
    // Try to use array key as property
    var_dump($fruitsArrayObject->lemons);
    ?>
</pre>
QQQ;

$c4a4 =
    [
        'This produces an error',
        'int(1)',
        'string(6) "lemons"',
        'None of the above'
    ];

$c4q5 = <<<'QQQ'
Q5: What will this script output?
        
<pre class="code">
    <&#63;php
    $a = array('one','two');
    $b = array('three','four','five');
    echo count($a + $b);
    ?>
</pre>
QQQ;

$c4a5 =
    [
        'This produces an error',
        '2',
        '3',
        '5'
    ];

$c4q6 = <<<'QQQ'
Q6: What will this script output?
        
<pre class="code">
    <&#63;php
    $a = array('three','four','five');
    $b = array('one','two');
    echo count($a - $b);
    ?>
</pre>
QQQ;

$c4a6 =
    [
        'This produces an error',
        '3',
        '2',
        '1'
    ];

$c4q7 = <<<'QQQ'
Q7: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $source = '12,23,34';
    $arr = str_split($source, 2);
    echo count($arr);
    ?>
</pre>
QQQ;

$c4a7 =
    [
        'This produces an error',
        '2',
        '3',
        '4'
    ];

$c4q8 = <<<'QQQ'
Q8: What will this script output?
        
<pre class="code">
    <&#63;php
    $keys = range(1, 6, 2);
    $arr = array_fill_keys($keys, 'PHP');
    krsort($arr);
    $arr = array_flip($arr);
    echo $arr['PHP'];
    ?>
</pre>
QQQ;

$c4a8 =
    [
        'There is an error in calling krsort()',
        'There is an error in calling array_ flip()',
        'You cannot reference the key \'PHP\' because there is more than one of them in the array',
        '1',
        '5',
        '6',
    ];

$c4q9 = <<<'QQQ'
Q9: What will this script output?
        
<pre class="code">
    <&#63;php
    $array = [
      [1, 2],
      [3, 4],
    ];
    foreach ($array as list($a, $b)) {
      echo "A: $a; B: $b" . PHP_EOL;
    }
    ?>
</pre>
QQQ;

$c4a9 =
    [
        'A: 1; B: 2',
        'A: 3; B: 4',
        'Notice: Undefined offset: 1',
        'Undefined variable $a',
        'None of the above'
    ];

$c4q10 = <<<'QQQ'
Q10: What will this script output?
        
<pre class="code">
    <&#63;php
    $arr = [1,2,3,4,5];
    $spliced = array_splice($arr, 2, 1);
    $number = array_shift($arr);
    echo $number;
    ?>
</pre>
QQQ;

$c4a10 =
    [
        'This produces an error',
        '1',
        '3',
        '5'
    ];



$c4q11 = <<<'QQQ'
Q11: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $data = "foo:*:1023:1000::/home/foo:/bin/sh";
    list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
    echo $uid; 
    ?>
</pre>
QQQ;

$c4a11 =
['*', 'foo', ' ', ':1023:1000:', 'E_NOTICE', '1023'];

$c4q12 = <<<'QQQ'
Q12: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $input_array = array('a', 'b', 'c', 'd', 'e');
    $arr = var_export(array_chunk($input_array, 2), true);
    echo $arr;
    ?>
</pre>
QQQ;

$c4a12 =
[
    "array ( 0 => array ( 0 => 'a', 1 => 'b', ), 1 => array ( 0 => 'c', 1 => 'd', ), 2 => array ( 0 => 'e', ), )",
    "array ( 0 => array ( 0 => 'a', 1 => 'b', ), 1 => array ( 2 => 'c', 3 => 'd', ), 2 => array ( 4 => 'e', ), )",
    "Warning: Array to string conversion &nbsp; Array"
];



$c4q13 = <<<'QQQ'
Q13: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
    var_export(array_rand($input, 2));
    var_export(array_rand($input));
    ?>
</pre>
QQQ;

$c4a13 =
[
    "Morpheus TrinityTank",
    "array ( 0 => 0, 1 => 1, )1",
    "Morpheus Trinity Tank",
    "array ( 0 => 0, 1 => 3, )array ( 0 => 1 )",
];



$c4q14 = <<<'QQQ'
Q14: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $array1 = array("color" => "red", 2 => 2, 4);
    $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);    
    $result = array_merge($array1, $array2);
    var_export($result);
    ?>
</pre>
QQQ;

$c4a14 =
[
    "array ( 0 => 'a', 1 => 'b', 'color' => 'green', 'shape' => 'trapezoid', 2 => 4, 3 => 4, )",
    "array ( 0 => 'a', 1 => 'b', 'color' => 'red', 'shape' => 'trapezoid', 2 => 4, 3 => 2, 4 => 4, )",
    "array ( 'color' => 'red', 2 => 2, 3 => 4, 0 => 'a', 1 => 'b', 'shape' => 'trapezoid', )",
    "array ( 'color' => 'green', 0 => 2, 1 => 4, 2 => 'a', 3 => 'b', 'shape' => 'trapezoid', 4 => 4, )",
];


$c4q15 = <<<'QQQ'
Q15: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    $array1 = array("color" => "red", 2 => 2, 4);
    $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);    
    $result = $array2 + $array1;
    var_export($result);
    ?>
</pre>
QQQ;

$c4a15 =
[   
    "array ( 0 => 'a', 1 => 'b', 'color' => 'green', 'shape' => 'trapezoid', 2 => 4, 3 => 4, )",
    "array ( 0 => 'a', 1 => 'b', 'color' => 'red', 'shape' => 'trapezoid', 2 => 4, 3 => 2, 4 => 4, )",
    "array ( 'color' => 'red', 2 => 2, 3 => 4, 0 => 'a', 1 => 'b', 'shape' => 'trapezoid', )",
    "array ( 'color' => 'green', 0 => 2, 1 => 4, 2 => 'a', 3 => 'b', 'shape' => 'trapezoid', 4 => 4, )",
];


$c4q16 = <<<'QQQ'
Q16: What would you replace /* ??????? */ with to output the following result?
        
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

$c4a16 =
[   
    "array_walk(\$fruits, 'funcB', 'fruit');",
    "array_walk(\$fruits, 'funcB'); array_walk(\$fruits, 'funcA')",
    "array_walk(\$fruits, 'funcA', 'fruit');",
    "array_walk(\$fruits, 'funcA', 'fruit'); array_walk(\$fruits, 'funcB');",
];