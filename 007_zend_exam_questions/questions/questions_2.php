<?php

$c2q1 = <<<'QQQ'
Q1: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    declare(strict_types=1);
    function multiply(float $a, float $b): int {
        return $a * $b;
    }
    $six = multiply(2, 3);
    echo gettype($six);
    ?> 
</pre>
QQQ;

$c2q2 = 'Q2: Some PHP functions, like echo , do not need you to use brackets when calling them. Is this true?';
$c2a2 =
['Yes, because you can call it like this: echo "hello";',
'Yes, because echo is a special case.',
'No, because echo is a language construct and not a function. All PHP functions require
you to use brackets when calling them.',
'No, because all PHP functions require you to use brackets when calling them, except
echo, which only requires brackets when you use more than one argument.'];

$c2q4 = <<<'QQQ'
Q4: What is the output of the following code?
        
<pre class="code">
    <&#63;php
    (function Hello() {
        echo "Hello World!";
    })();
</pre>
QQQ;

$c2a4 = 
['Nothing',
'Hello World',
'An error message and "Hello World"',
'Just an error message'];

$c2q5 = <<<'QQQ'
Q5: What is the output of the following code?

<pre class="code">
    <&#63;php
    declare(strict_types=1);
    function multiply(float $a, float $b): float {
        return (double)$a * (double)$b;
    }
    $six = multiply(2, 3);
    echo gettype($six);
    ?>
</pre>
QQQ;

$c2a5 = 
['int',
'double',
'float',
'This generates a TypeError'];



$c2q6 = <<<'QQQ'
Q6: What is the output of the following code?

<pre class="code">
    <&#63;php
    function complicated($compulsory, ...$extras) {
        echo "I have " . func_get_args() . " arguments";
    }
    complicated(1,2,3,4);
    ?>
</pre>
QQQ;

$c2a6 = 
['1',
'2',
'4',
'This produces a notice error'];



$c2q7 = <<<'QQQ'
Q7: How would you refer to the parameter with the value cat in the following function?

<pre class="code">
    <&#63;php
    function complicated($compulsory, ...$extras, $animal) {
        // I want to reference the variable with the value "cat"
    }
    complicated(1,2,3,"cat");
    ?>
</pre>
QQQ;

$c2a7 = 
['$animal',
'$extras[1]',
'$extras[2]',
'This produces an error'];



$c2q8 = <<<'QQQ'
Q8: What will this code output?

<pre class="code">
    <&#63;php
    if (!is_callable(function(){echo "Hello";})) {
        function sayHello() {
            echo "World!";
        }
    }
    sayHello();
    ?>
</pre>
QQQ;

$c2a8 = 
['Hello',
'World !',
'Hello World!',
'This produces an error'];



$c2q9 = <<<'QQQ'
Q9: What will this code output?

<pre class="code">
    <&#63;php
    namespace A;
    function Hello() { echo __NAMESPACE__; }
    namespace B;
    function Hello() { echo __NAMESPACE__; }
    namespace C;
    \B\Hello();
    ?>
</pre>
QQQ;

$c2a9 = 
['A',
'B',
'C',
'This produces an error; functions cannot be namespaced'];



$c2q10 = <<<'QQQ'
Q10: What will this code output?

<pre class="code">
    <&#63;php
    namespace A;
    $closure = function() { echo __NAMESPACE__; };
    namespace B;
    $closure = function() { echo __NAMESPACE__; };
    namespace C;
    $closure();
    ?>
</pre>
QQQ;

$c2a10 = 
['A',
'B',
'C',
'This produces an error; the closure is not defined in namespace C',
'This produces an error; functions and closures cannot be namespaced'];



$c2q11 = <<<'QQQ'
Q11: What is the output of the following code? (select all that apply).

<pre class="code">
    <&#63;php
    function addValues() {
        $sum = 0;
        for ($i = 1; $i <= func_num_args(); $i++){
            $sum += func_get_arg($i);
        }
        return $sum;
    }
    echo addValues(1,2,3);
    ?>
</pre>
QQQ;

$c2a11 = 
['5',
'6',
'A parser error',
'A warning'];



$c2q12 = <<<'QQQ'
Q12: Take a look at the following code...

<pre class="code">
    <&#63;php
    function myFunction($a){
        $a++;
    }
    $b = 1;
    myFunction($b);
    ?>
</pre>

What code do you need to replace so that $b has the value 2 at the end of the script?
QQQ;

$c2a12 = 
['Line 02: Replace $a with &$a',
'Line 03: Replace $a++ with $a +=2;',
'Line 03: Replace $a++ with $a *=2;',
'Line 06: Replace $b with &$b'];



$c2q13 = <<<'QQQ'
Q13: What is the output of the following code (Ignoring any PHP notices and error messages)?

<pre class="code">
    <&#63;php
    $v1 = 1;
    $v2 = 2;
    $v3 = 3;
    function myFunction(){
        $GLOBALS['v1'] *= 2;
        $v2 *= 2;
        global $v3; $v3 *= 2;
    }
    myFunction();
    echo "$v1$v2$v3";
    ?>
</pre>
QQQ;

$c2a13 = 
['123',
'246',
'226',
'126'];



$c2q14 = <<<'QQQ'
Q14: What is the output of the following code?

<pre class="code">
    <&#63;php
    function func ($x, $x=1, $x=2){
        return $x;
    }
    print func (3);
    ?>
</pre>
QQQ;

$c2a14 = 
['syntax error',
'3 will be printed',
'2 will be printed',
'none of the above'];



$c2q15 = <<<'QQQ'
Q15: What is the output of the following code?

<pre class="code">
    <&#63;php
    $x = function func ($a, $b, $c){
        print "$c|$b|$a\n";
    }
    print $x (1,2,3);
    ?>
</pre>
QQQ;

$c2a15 = 
['syntax error',
'3|2|1',
'1|2|3'];



$c2q16 = <<<'QQQ'
Q16: What is the best way to test if $param is an anonymous function in a method?
QQQ;

$c2a16 = 
['use method_exists($this,$param)',
'use is_callable($param)',
'use the type-hint Closure on the signature',
'use is_executable($param)'];



$c2q17 = <<<'QQQ'
Q17: If a function signature contains three parameters, for which of them may the splat operator be used?
QQQ;

$c2a17 = 
['The first parameter',
'The second parameter',
'The third parameter',
'All three parameters'];



$c2q18 = <<<'QQQ'
Q18: Type Hinting was introduced in which version of PHP?
QQQ;

$c2a18 = 
['PHP 4',
'PHP 5',
'PHP 5.3',
'PHP 7'];



$c2q19 = <<<'QQQ'
Q19: Which type of function call is used in line 8 in the following PHP code?
<pre class="code">
    <&#63;php
    function calc($price, $tax) 
    {
        $total = $price + $tax;
    }
    $pricetag = 15;
    $taxtag = 3;
    calc($pricetag, $taxtag); 
    ?>
</pre>
QQQ;

$c2a19 = 
['Call By Value',
'Call By Reference',
'Default Argument Value',
'Type Hinting'];



$c2q20 = <<<'QQQ'
Q20: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    function calc($price, $tax="")
    {
        $total = $price + ($price * $tax);
        echo "$total"; 
    }
    calc(42); 
</pre>
QQQ;

$c2a20 = 
['Error',
'0',
'42',
'84'];



$c2q21 = <<<'QQQ'
Q21: Which of the following are valid function names?
<pre class="code">
    i) function()
    ii) €()
    iii) .function()
    iv) $function()
</pre>
QQQ;

$c2a21 = 
['Only i)',
'Only ii)',
'i) and ii)',
'iii) and iv)'];



$c2q22 = <<<'QQQ'
Q22: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    function a()
    {
        function b()
        {
            echo 'I am b';
    }
        echo 'I am a';
    }
    a();
    a();
    ?>
</pre>
QQQ;

$c2a22 = 
['I am a',
'I am bI am a',
'Error',
'I am a Error'];



$c2q23 = <<<'QQQ'
Q23: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    function a()  
    {
        function b()
        {
            echo 'I am b';
    }
        echo 'I am a';
    }
    b();
    a();
    ?>
</pre>
QQQ;

$c2a23 = 
['I am b',
'I am bI am a',
'Error',
'I am a Error'];



$c2q24 = <<<'QQQ'
Q24: What will be the output of the following PHP code? (select all that apply).
<pre class="code">
    <&#63;php
    $op2 = "blabla";
    function foo($op1)
    {
        echo $op1;
        echo $op2;
    }
    foo("hello");
    ?>
</pre>
QQQ;

$c2a24 = 
['helloblabla',
'Error',
'hello',
'hello$op2',
'E Notice'];



$c2q25 = <<<'QQQ'
Q25: A function in PHP which starts with __ (double underscore) is known as ____
QQQ;

$c2a25 = 
['Magic Function',
'Inbuilt Function',
'Default Function',
'User Defined Function'];



$c2q26 = <<<'QQQ'
Q26: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    function foo($msg)
    {
        echo "$msg";
    }
    $var1 = "foo";
    $var1("will this work");
    ?>
</pre>
QQQ;

$c2a26 = 
['Error',
'$msg',
'0',
'will this work'];



$c2q27 = <<<'QQQ'
Q27: Which of the following PHP functions accepts any number of parameters?

QQQ;

$c2a27 = 
['func_get_argv()',
'func_get_args()',
'get_argv()',
'get_argc()'];



$c2q28 = <<<'QQQ'
Q28: Which one of the following PHP functions can be used to find files?

QQQ;

$c2a28 = 
['glob()',
'file()',
'fold()',
'get_file()'];



$c2q29 = <<<'QQQ'
Q29: Which of the following PHP functions can be used to get the current memory usage?

QQQ;

$c2a29 = 
['get_usage()',
'get_peak_usage()',
'memory_get_usage()',
'memory_get_peak_usage()'];



$c2q30 = <<<'QQQ'
Q30: Which of the following PHP functions can be used for generating unique ids?

QQQ;

$c2a30 = 
['uniqueid()',
'id()',
'md5()',
'mdid()'];



$c2q31 = <<<'QQQ'
Q31: Which one of the following functions can be used to compress a string?
QQQ;

$c2a31 = 
['zip_compress()',
'zip()',
'compress()',
'gzcompress()'];



$c2q32 = <<<'QQQ'
Q32: Which one of the following statments is True?
QQQ;

$c2a32 = 
['The chr() function returns the ASCII value of the first character of a string.',
'The chr() function returns a character from the specified ASCII value.',
];



$c2q33 = <<<'QQQ'
Q33: Which one of the following statements is True?
QQQ;

$c2a33 = 
[
'The ord() function returns a character from the specified ASCII value.',
'The ord() function returns the ASCII value of the first character of a string.',
];


$c2q34 = <<<'QQQ'
Q34: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    $str = "Hello World";
    echo wordwrap($str,5,"&lt;br&gt;\n");  
    ?>
</pre>
QQQ;

$c2a34 = 
['Hello World',
'Hello&lt;br&gt; World',
'Hell&lt;br&gt; o wo&lt;br&gt; rld',
'World'];


$c2q35 = <<<'QQQ'
Q35: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    echo ucwords("i love my country");
    ?>
</pre>
QQQ;

$c2a35 = 
['I love my country',
'i love my Country',
'I love my Country',
'I Love My Country'];


$c2q36 = <<<'QQQ'
Q36: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    echo lcfirst("welcome to Bangladesh");
    ?>
</pre>
QQQ;

$c2a36 = 
['welcome to Bangladesh',
'welcome to bangladesh',
'Welcome to Bangladesh',
'Welcome to bangladesh'];


$c2q37 = <<<'QQQ'
Q37: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    echo lcfirst("welcome to Bangladesh");
    ?>
</pre>
QQQ;

$c2a37 = 
['welcome to Bangladesh',
'welcome to bangladesh',
'Welcome to Bangladesh',
'Welcome to bangladesh'];


$c2q38 = <<<'QQQ'
Q38: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    function A1($x)
    {
        switch($x)
        {
        case 1: 
            //this statement is the same as if($x == 1)
            echo 'Case 1 was executed.';
            break;
        case 2: 
            //this statement is the same as if($x == 2)
            echo 'Case 2 was executed.';
            break;
        case 3: 
            //this statement is the same as if($x == 3)
            echo 'Case 3 was executed.';
            break;
        case 4: 
            //this statement is the same as if($x == 4)
            echo 'Case 4 was executed.';
            break;
        default: 
            //this statement is the same as if $x does not equal the other conditions
            echo 'Default was executed.';
            break;
        }
    }
    A1(9);
    ?>
</pre>
QQQ;

$c2a38 = 
['Case 1 was executed',
'Case 2 was executed',
'Default was executed',
'Case 4 was executed'];


$c2q39 = <<<'QQQ'
Q39: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    function calc($num1, $num2)
    {
        $total = $num1 * $num2; 
    }
    $result = calc(42, 0);
    echo $result; 
    ?>
</pre>
QQQ;

$c2a39 = 
['0',
'42',
'84',
'No Output'];


$c2q40 = <<<'QQQ'
Q40: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    function 2myfunc()
    {
        echo "Hello World";
    }
    2myfunc();
    ?>
</pre>
QQQ;

$c2a40 = 
['Hello World',
'No Output',
'Parse error',
'None of the mentioned'];


$c2q41 = <<<'QQQ'
Q41: How many functions are used by PHP to convert between arrays and variables?
QQQ;

$c2a41 = 
['1',
'2',
'3',
'4'];



$c2q42 = <<<'QQQ'
Q42: What will be the output of the following PHP code?
<pre class="code">
    <&#63;php
    function array_baz(array &$param)
    {
        $param = 1;
    }
    $var = [];
    array_baz($var);
    var_dump($var);
    array_baz($var);
    ?>
</pre>
QQQ;

$c2a42 = 
['1',
'int(1)int(1)',
'Fatal error',
'array(0) {}',
'int(1) Fatal error',
'11'];



$c2q43 = <<<'QQQ'
Q43: What is the best way to ensure that a user-defined function is always passed an object as its single parameter?
QQQ;

$c2a43 = 
['function myfunction(stdClass $a)',
'function myfunction($a = stdClass)',
'Use is_object() within the function',
'function myfunction(object $a)'];



$c2q44 = <<<'QQQ'
Q44: What would go in place of ?????? below to make this script execute without a fatal error? (select all that apply).
<pre class="code">
    <&#63;php
    $a = 1;
    $b = 0;
    /* ?????? */
    $c = $a / $b;
    ?>
</pre>
QQQ;

$c2a44 = 
['quit();',
'die();',
'stop();',
'__halt_compiler();',
'exit();'];



$c2q45 = <<<'QQQ'
Q45: What is the difference between the include and require language constructs?
QQQ;

$c2a45 = 
['Require constructs can\'t be used with URL filenames',
'Include constructs cause a fatal error if the file doesn\'t exist',
'There is no difference other than the name',
'Include constructs are processed at run time; require constructs are processed at compile time',
'Require constructs cause a fatal error if the file can\'t be read'];




$c2q46 = <<<'QQQ'
Q46: What would you replace ??????? with, below, to make the string Hello, World! be displayed? 
<pre class="code">
    <&#63;php
    function myfunction() {
        /* ??????? */
        echo $string;
    }
    myfunction("Hello, World!");
    ?>
</pre>
QQQ;

$c2a46 = 
['$string = $argv[1];',
'$string = $_ARGV[0];',
'list($string) = func_get_args();',
'$string = get_function_args();'];




$c2q47 = <<<'QQQ'
Q47: What is the output of the following function?
<pre class="code">
    <&#63;php
    function &find_variable(&$one, &$two, &$three) {
        if ($one > 10 && $one < 20) return $one;
        if ($two > 10 && $two < 20) return $two;
        if ($three > 10 && $three < 20) return $three;
    }
    ?>
    $one = 2;
    $two = 20;
    $three = 15;
    $var = &find_variable($one, $two, $three);
    $var++;
    print "1: $one, 2: $two, 3: $three";
</pre>
QQQ;

$c2a47 = 
['1: 2, 2: 20, 3: 15',
'1: 3, 2: 21, 3: 16',
'1: 2, 2: 21, 3: 15',
'1: 3, 2: 20, 3: 15',
'1: 2, 2: 20, 3: 16'];




$c2q48 = <<<'QQQ'
Q48: What will be the output of the following code -
<pre class="code">
    <&#63;php
    function fn (&$var) { 
        $var = $var - ($var/10*5);  return $var;  
    }  
    echo fn(100);
    ?>
</pre>
QQQ;

$c2a48 = 
['100',
'50',
'98',
'Fatal error'];




$c2q49 = <<<'QQQ'
Q49: The function print_r () returns details on

QQQ;

$c2a49 = 
['Status of a variable',
'Status of echo command',
'Status of output stream',
'Status of input stream'];



$c2q50 = <<<'QQQ'
Q50: Under what circumstance is it impossible to assign a default value to a parameter while declaring a function?

QQQ;

$c2a50 = 
['When the parameter is Boolean',
'When the function is being declared as a member of a class',
'When the parameter is being declared as passed by reference',
'When the function contains only one parameter',
'Never'];



$c2q51 = <<<'QQQ'
Q51: What will be the output of the following code -
<pre class="code">
    <&#63;php
    $search  = array('A', 'B', 'C', 'D', 'E');
    $replace = array('B', 'C', 'D', 'E', 'F');
    $subject = 'A';
    echo str_replace($search, $replace, $subject);
    ?>
</pre>
QQQ;

$c2a51 = 
['B',
'A',
'ABCDEF',
'F',
'C',
'Parse error'];



$c2q52 = <<<'QQQ'
Q52: What will be the output of the following code -
<pre class="code">
    <&#63;php
    $letters = array('a', 'p');
    $fruit   = array('apple', 'pear');
    $text    = 'a p';
    $output  = str_replace($letters, $fruit, $text);
    echo $output;
    ?>
</pre>
QQQ;

$c2a52 = 
['a p',
'apple pear',
'apple',
'apearpearle pear',
'pear apple',
'Warning: Array to string conversion'];