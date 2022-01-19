<?php

$c1q1 = <<<'QQQ'
Q1: Which of the following tags should you avoid using to include PHP in HTML?       

QQQ;

$c1a1 =
[
    '<&#63;php',
    '<&#63;',
    '<&#63;=',
    'None of the above; these are all fine'
];

$c1q2 = <<<'QQQ'
Q2: Which of the following are NOT case sensitive in PHP? Choose all that apply.
        
QQQ;

$c1a2 =
[
    'Variable names',
    'Class names',
    'Namespaces',
    'Function names'
];

$c1q3 = <<<'QQQ'
Q3: What will this script output?:
        
<pre class="code">
    <&#63;php
    $a = "Hello";
    $B = " world";
    ECHO $a . $b;
    ?>
</pre>
QQQ;

$c1a3 =
[
    'Nothing; it won’t run',
    'Hello world',
    'Hello',
    'An error message because the variable b is not defined',
    'An error message and the word "Hello"',
];

$c1q4 = <<<'QQQ'
Q4: What will this script output?
        
<pre class="code">
    <&#63;php
    function A() {
            try {
                b();
            } catch (Exception $e) {
                echo "Exception caught in " . __CLASS__;
            }
    }
    function B() {
        C();
    }
    try {
        A();
    } catch (Error $e) {
        echo "Error caught in global scope: " . $e->getMessage();
    }
    ?>
</pre>
QQQ;

$c1a4 =
[
    'Exception caught in A',
    'Error caught in global scope: Call to undefined function C()',
    'Error caught in global scope: Call to undefined function b()',
    'None of the above'
];

$c1q5 = <<<'QQQ'
Q5: What will this script output?
        
<pre class="code">
    <&#63;php
    function A() {
        try {
            b();
        } catch (Exception $e) {
            echo "Exception caught in " . __CLASS__;
        }
    }
    function B() {
        echo 5 / "five";
    }
    try {
        A();
    } catch (Error $e) {
        echo "Error caught in global scope: " . $e->getMessage();
    }
    ?>
</pre>
QQQ;

$c1a5 =
[
    'Error caught in global scope: Call to undefined function C()',
    '1',
    'Error caught in global scope: Call to undefined function b()',
    'None of the above',
];

$c1q6 = <<<'QQQ'
Q6: What will this script output?
        
<pre class="code">
    <&#63;php
    try {
        throw new ChildException;
    } catch (Exception $e) {
        echo "Caught Exception: " . get_class($e);
    } catch (MyException $e) {
        echo "Caught MyException" . get_class($e);
    }
    ?>
</pre>

QQQ;

$c1a6 =
[
    'Caught Exception: ChildException',
    'Caught MyException: ChildException',
    'Caught MyException: MyException',
    'Nothing',
    'An error message related to an uncaught exception'
];

$c1q7 = <<<'QQQ'
Q7: Which of the following settings can be configured at runtime using the <i>ini_set()</i> function?
QQQ;

$c1a7 =
[
    'output_buffering',
    'memory_limit',
    'max_execution_time',
    'extension'
];

$c1q8 = <<<'QQQ'
Q8: What is the output of this script?
        
<pre class="code">
    <&#63;php
    $a = "apples" <=> "bananas";
    $b = $a ?? $c ?? 10;
    echo $b;
    ?>
</pre>
QQQ;

$c1a8 =
[
    '-1',
    '0',
    '1',
    '10',
    'apples'
];

$c1q9 = <<<'QQQ'
Q9: What is the output of this script?
        
<pre class="code">
    <&#63;php
    echo 10 <=> 10 << 1;
    ?>
</pre>
QQQ;

$c1a9 =
[
    '-1',
    '0',
    '1',
    '10',
];

$c1q10 = <<<'QQQ'
Q10: What is the output of this script?
        
<pre class="code">
    <&#63;php
    define('A', 1);
    const B = 2;
    define('C', [A * A, B * B]);
    echo(C[1]);
    ?>
</pre>
QQQ;

$c1a10 =
[
    'This will generate an error because constants can only hold scalar values.',
    'This will generate an error because you cannot use define() to declare an array constant.',
    'This will generate an error because you cannot use expressions or functions when declaring a constant.',
    1,
    2,
    4,
];

$c1q11 = <<<'QQQ'
Q11: You run the following PHP script:
        
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

$c1a11 =
[
    'x = 2 y = 3',
    'x = 2 y = 2',
    'x = 2 y = 1',
    'x = 1 y = 3',
    'x = 1 y = 2',
    'x = 1 y = 1',
];