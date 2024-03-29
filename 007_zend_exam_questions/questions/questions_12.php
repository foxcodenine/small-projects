<?php

// ---------------------------------------------------------------------

$c12q1 = <<<'QQQ'
Q1: What will happen when you run this code?      
<pre class="code">
    <&#63;php
    $star = new StdClass;
    class CustomException { }
    throw new CustomException('Error!');
    ?>
</pre>
QQQ;

$c12a1 =
[
    'A fatal error will occur because the exception is not being caught',
    'A fatal error will occur when you try to throw the exception',
    'The script will run without any output because you’re not using getMessage() on the exception',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q2 = <<<'QQQ'
Q2: What will this script output?      
<pre class="code">
    <&#63;php
    function addOne($arg) {
        $arg++;
    }
    $a = 0;
    addOne(&$a);
    echo $a;
    ?>
</pre>
QQQ;

$c12a2 =
[
    'Syntax error; it won’t run at all',
    'It depends on what version of PHP you’re using',
    'A fatal error',
    '1',
];

// ---------------------------------------------------------------------

$c12q3 = <<<'QQQ'
Q3: What will the output of this script be?     
<pre class="code">
    <&#63;php
    $a = function($a) {
        return is_callable($a);
    };
    $b = function($b) use ($a) {
        return $a($b);
    };
    echo $b($a) ? 'True' : 'False';
    ?>
</pre>
QQQ;

$c12a3 =
[
    'Syntax error; it will not run',
    'True',
    'False',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q4 = <<<'QQQ'
Q4: What is the output of this script?     
<pre class="code">
    <&#63;php
    $a = 3;
    echo $a >> 1;
    ?>
</pre>
QQQ;

$c12a4 =
[
    0,
    1,
    2,
    9
];

// ---------------------------------------------------------------------

$c12q5 = <<<'QQQ'
Q5: The recommended production setting for the display_error configuration setting is On.      
QQQ;

$c12a5 =
[
    'True',
    'False'
];

// ---------------------------------------------------------------------

$c12q6 = <<<'QQQ'
Q6: The session_generate_id() function is used to create a session identifier and
    should be called when a person logs in to help mitigate session fixation attacks.      
QQQ;

$c12a6 =
[
    'True',
    'False'
];

// ---------------------------------------------------------------------

$c12q7 = <<<'QQQ'
Q7: When you call the json_encode function on an object to serialize it, which magic
    method will PHP call?      
QQQ;

$c12a7 =
[
    '__sleep',
    '__wake',
    '__get',
    '__clone',
    'None of these'
];

// ---------------------------------------------------------------------

$c12q8 = <<<'QQQ'
Q8: What will this script output?      
<pre class="code">
    <&#63;php
    $emptyArray = [];
    $encode = json_encode($emptyArray, JSON_FORCE_OBJECT);
    $decode = json_decode($encode);
    echo gettype($decode);
    ?>
</pre>
QQQ;

$c12a8 =
[
    'Syntax error; it won\'t run at all',
    'array',
    'object',
    'string',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q9 = <<<'QQQ'
Q9: What is the output of the following script?     
<pre class="code">
    <&#63;php
    $arr1 = [1,2,3];
    $arr2 = array("1" => 2, 0 => "1", 2 => 3 );
    $equal = $arr1 == $arr2 ? 'Equal' : 'Not Equal';
    $identical = $arr1 === $arr2 ? 'Identical' : 'Not Identical';
    echo "The arrays are [$equal] and [$identical]";
    ?>
</pre>
QQQ;

$c12a9 =
[
    'Syntax error; this won\'t run',
    'The arrays are [Equal] and [Identical]',
    'The arrays are [Equal] and [Not Identical]',
    'The arrays are [Not Equal] and [Not Identical]',
    'The arrays are [Not Equal] and [Identical]',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q10 = <<<'QQQ'
Q10: What will the output of this function be?    
<pre class="code">
    <&#63;php
    $number = 1234.5678;
    echo number_format($number, 2, ',', '.') . PHP_EOL;
    ?>
</pre>
QQQ;

$c12a10 =
[
    '1,235',
    '1,234.568',
    '1.234,57',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q11 = <<<'QQQ'
Q11: You should escape strings before passing them into the database with a
    function like addslashes() so that it is not possible to use the SQL injection attack on
    your site.      

QQQ;

$c12a11 =
[
    'True',
    'False'
];

// ---------------------------------------------------------------------

$c12q12 = <<<'QQQ'
Q12: What is the output of this code?      
<pre class="code">
    <&#63;php
    class A
    {
        public $name = '0';
        private $surname = '0';
        public function __isset($property)
        {
            return true;
        }
    }
    $a = new A;
    $empty = empty($a->name);
    $set = isset($a->surname);
    if ($empty === $set) {
          echo "Yes";
        } else {
          echo "No";
        }
    ?>
</pre>
QQQ;

$c12a12 =
[
    'Yes',
    'No',
    'Syntax error; this won’t run'
];

// ---------------------------------------------------------------------

$c12q13 = <<<'QQQ'
Q13: If you do not specify a visibility modifier, PHP chooses private by default so that
    your code is secure.   
QQQ;

$c12a13 =
[
    'Yes',
    'No',
];

// ---------------------------------------------------------------------

$c12q14 = <<<'QQQ'
Q14: You can use the _____________ function to make sure that a variable is suitable
    to display and doesn't contain any spaces.
QQQ;

$c12a14 =
[
    'ctype_alpha',
    'ctype_print',
    'ctype_graph',
    'filter_var'
];

// ---------------------------------------------------------------------

$c12q15 = <<<'QQQ'
Q15: What will this code output?      
<pre class="code">
    <&#63;php
    function bird($message) {
        function nest($string) {
            echo $string;
        }
        nest($message);
    }
    bird('hello');
    echo " ";
    nest('world');
    ?>
</pre>
QQQ;

$c12a15 =
[
    'Syntax error; it won’t run',
    'It will never finish running',
    'It will generate an error because the function nest() does not exist in the global scope',
    'hello world',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q16 = <<<'QQQ'
Q16: What will the code output?      
<pre class="code">
    <&#63;php
    $a = 0;
    $b = $a++;
    $a = $a + 1;
    echo --$a;
    ?>
</pre>
QQQ;

$c12a16 =
[
    'An error will occur',
    '0',
    '1',
    '2'
];
// ---------------------------------------------------------------------

$c12q17 = <<<'QQQ'
Q17: You can use the ________________ function to make sure that a file was actually
    uploaded and is not a different file on your OS.?      
QQQ;

$c12a17 =
[
    'check_file_uploaded()',
    'finfo_file()',
    'is_uploaded_file()',
    'None of the above'
];
// ---------------------------------------------------------------------

$c12q18 = <<<'QQQ'
Q18: What is the output of this PHP code?    
<pre class="code">
    <&#63;php
    echo (isset($a)) ? "A is set" : "A is not set";
    echo " and ";
    echo (empty($b)) ? "B is not set" : "B is set";
    ?>
</pre>
QQQ;

$c12a18 =
[
    'Syntax error',
    'A is not set and B is set',
    'A is not set and B is not set',
    'A is set and B is set',
    'A warning will be produced and it will output "A is not set and B is not set"',
    'It will have a fatal error saying variable not found'
];
// ---------------------------------------------------------------------

$c12q19 = <<<'QQQ'
Q19: Both PUT and POST are idempotent.      
QQQ;

$c12a19 =
[
    'True',
    'False; POST is idempotent but PUT is not',
    'False; PUT is idempotent but POST is not',
    'False; neither are idempotent',
    'False; REST is stateless so nothing is idempotent'
];
// ---------------------------------------------------------------------

$c12q20 = <<<'QQQ'
Q20: You are able to instantiate a class before it is defined, as in this example:      
<pre class="code">
    <&#63;php
    $foo = new ExampleClass();
    echo $foo;
    class ExampleClass {}
    ?>
</pre>
QQQ;

$c12a20 =
[
    'True', 'False'
];

// ---------------------------------------------------------------------

$c12q21 = <<<'QQQ'
Q21: If you’re not using prepared statements and want to escape strings when using
    the MySQL database, you can use the _____________ function.      
QQQ;

$c12a21 =
[
    'mysql_real_escape_string()',
    'real_escape_string()',
    'mysqli_real_escape_string()',
    'addslashes()',
    'mysqli_escape_string()',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q22 = <<<'QQQ'
Q22: What will this script output?     
<pre class="code">
    <&#63;php
    $a = "foo";
    $$a = "bar";
    $a = "Hello world";
    echo ${"foo"};
    ?>
</pre>
QQQ;

$c12a22 =
[
    'Syntax error; this won’t run',
    'foo',
    'bar',
    'Hello world'
];

// ---------------------------------------------------------------------

$c12q23 = <<<'QQQ'
Q23: Considering the following code, what will the output be?      
<pre class="code">
    <&#63;php
    $a = "0.0";
    $b = (int)$a;
    if ( (boolean)$a === (bool)$b) {
    echo "True";
    } else {
    echo "False";
    }
    ?>
</pre>
QQQ;

$c12a23 =
[
    'Syntax error; this won’t run',
    'True',
    'False'
];

// ---------------------------------------------------------------------

$c12q24 = <<<'QQQ'
Q24: What will this script output?      
<pre class="code">
 
    echo "Apples"<=>"bananas" ? 'foo' : 'bar';

</pre>
QQQ;

$c12a24 =
[
    'foo',
    'bar',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q25 = <<<'QQQ'
Q25: This is a tricky question, so go through it carefully and predict the output of the
    code. Remember that the second parameter of md5() causes the hash to be returned in
    RAW binary format instead of as a hex string.      
<pre class="code">
    <&#63;php
    namespace A;
    function md5($value) {
    return \md5($value . ' Extra saltiness');
    }
    echo strlen(md5('Hi', true));
    ?>
</pre>
QQQ;

$c12a25 =
[
    'Syntax error ; this won’t run',
    '16',
    '32',
    'This causes an error because you can’t define a function with the same name as a PHP   function name',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q26 = <<<'QQQ'
Q26: Which of the following types of error will prevent the script from executing?     
QQQ;

$c12a26 =
[
    'Notice',
    'Warning',
    'Syntax error',
    'Fatal error'
];

// ---------------------------------------------------------------------

$c12q27 = <<<'QQQ'
Q27: What is the output from this script?      
<pre class="code">
    <&#63;php
    $a = true;
    $b = false;
    $truth = $a && $b;
    $pravda = $a and $b;
    var_dump($truth == $pravda);
    ?>
</pre>
QQQ;

$c12a27 =
[
    'bool(true)',
    'bool(false)'
];

// ---------------------------------------------------------------------

$c12q28 = <<<'QQQ'
Q28: If you want PHP to display all errors except notices, which setting in php.ini would you use?      
QQQ;

$c12a28 =
[
    'error_reporting= -E_NOTICE',
    'error_reporting=E_ALL - E_NOTICE',
    'error_reporting= ~E_NOTICE',
    'error_reporting= E_ALL & ~E_NOTICE'
];

// ---------------------------------------------------------------------

$c12q29 = <<<'QQQ'
Q29: Private methods are only accessible by the class in which they are defined, so
    this code will output an empty array.      
<pre class="code">
    <&#63;php
    class Mirror {
        private function showMeGorgeous($me) {
            echo $me;
        }
    }
    $refObj = new ReflectionClass('Mirror');
    print_r($refObj->getMethods());
    ?>
</pre>
QQQ;

$c12a29 =
[
    'True',
    'False'
];

// ---------------------------------------------------------------------

$c12q30 = <<<'QQQ'
Q30: Assume that you are running this script from the command line, and not in a
    web-browser. What will the output be?      
<pre class="code">
    <&#63;php
    class SetMissing {
        public function __set($name, $value) {
            $this->$name = filter_var($value, FILTER_SANITIZE_STRING);
        }
    }
    $obj = new SetMissing();
    $obj->example = "&lt;strong>hello&lt;/strong>";
    echo $obj->example . PHP_EOL;
    $obj->example = "&lt;strong>hello&lt;/strong>";
    echo $obj->example;
    ?>
</pre>
QQQ;

$c12a30 =
[
    'hello<br> &nbsp; &nbsp; &nbsp;&nbsp; &lt;strong>hello&lt;/strong>',
    '&lt;strong>hello&lt;/strong><br> &nbsp; &nbsp; &nbsp;&nbsp; &lt;strong>hello&lt;/strong>',
    'hello<br> &nbsp;&nbsp; &nbsp; &nbsp; hello',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q31 = <<<'QQQ'
Q31: If you implement the __sleep() function, you need to make sure that it returns
    an associative array containing the names and values of the instance variables you want
    to be serialized
QQQ;

$c12a31 =
[
    'True',
    'False'
];

// ---------------------------------------------------------------------

$c12q32 = <<<'QQQ'
Q32: What will the output of this code be?      
<pre class="code">
    <&#63;php
    trait Dog {
    public function makeNoise() {
    echo "Woof";
    }
      public function wantWalkies() {
    echo "Yes please!";
    }
    }
    trait Cat {
    public function makeNoise() {
    echo "Purr";
      }
    public function wantWalkies() {
        echo "No thanks!";
    }
    }
    class DomesticPet
    {
    use Dog, Cat {
    Cat::makeNoise insteadof Dog;
    Cat::wantWalkies as kittyWalk;
    Dog::wantWalkies insteadof Cat;
    }
    }
    $obj = new DomesticPet();
    $obj->kittyWalk();
    ?>
</pre>
QQQ;

$c12a32 =
[
    'Yes please!',
    'No thanks!',
    'Woof',
    'Purr',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q33 = <<<'QQQ'
Q33: What is the output of this code?      
<pre class="code">
    <&#63;php
    class A
    {
        public $name = '0';
        private $surname = '0';
        public function __isset($property)
        {
            return true;
        }
    }
    $a = new A;
    $empty = empty($a->name);
    $set = isset($a->surname);
    if ($empty === $set) {
      echo "Yes";
    } else {
      echo "No";
    }
    ?>
</pre>
QQQ;

$c12a33 =
[
    'Syntax error; this won’t run',
    'Yes',
    'No',
    'Fatal error'
];

// ---------------------------------------------------------------------

$c12q34 = <<<'QQQ'
Q34: Are PHP keys case sensitive? What will the output of this script be?      
<pre class="code">
    <&#63;php
    $arr1 = ["A" => "apple", "B" => "banana"];
    $arr2 = ["a" => "aardvark", "b" => "baboon"];
    echo count($arr1 + $arr2);
    ?>
</pre>
QQQ;

$c12a34 =
[
    'They are not case sensitive; this will output 2',
    'They are case sensitive; this will output 4',
    'PHP keys are converted to integers; this outputs 2',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q35 = <<<'QQQ'
Q35: What will this script output?   
<pre class="code">
    <&#63;php
    $a = "0";
    $c = $b = empty($a);
    $d = ++$b + $a;
    echo $d;
    ?>
</pre>
QQQ;

$c12a35 =
[
    '0',
    '1',
    '2',
    'Syntax error; you can’t assign two variables on one line',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q36 = <<<'QQQ'
Q36: What will this code output?      
<pre class="code">
    <&#63;php
    $a = 1.23;
    $b = 4.56;
    $c = (int)$a + (int)$b;
    echo (double)$c;
    ?>
</pre>
QQQ;

$c12a36 =
[
    '5',
    '6',
    '5.79',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q37 = <<<'QQQ'
Q37: What will this script output?      
<pre class="code">
    <&#63;php
    $arr = ["one", "two", 1.5 => "three"];
    echo $arr[1];
    ?>
</pre>
QQQ;

$c12a37 =
[
    'one',
    'two',
    'three',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q38 = <<<'QQQ'
Q38: Interfaces can only specify public methods, but your class can implement them
    however you like.?      
QQQ;

$c12a38 =
[
    'True',
    'False'
];

// ---------------------------------------------------------------------

$c12q39 = <<<'QQQ'
Q39: You can force sessions to be contained exclusively in cookies by using the
_____________ configuration setting.      
QQQ;

$c12a39 =
[
    'session.cookie_secure',
    'session.use_cookies',
    'session.use_trans_sid',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q40 = <<<'QQQ'
Q40: What is the output of this code?      
<pre class="code">
    <&#63;php
    define('PI', 3.14159625);
    define('_PI', "3.1459625");
    $radius = 10;
    if (PI == _PI) {
        $area = (int)PI * $radius ** 2;
        echo $area;
    } else {
        echo "Indiana";
    }
    ?>
</pre>
QQQ;

$c12a40 =
[
    'Indiana',
    '300',
    '900',
    '986.962699801',
    '400',
    '1600'
];

// ---------------------------------------------------------------------

$c12q41 = <<<'QQQ'
Q41: What is the output of this script?      
<pre class="code">
    <&#63;php
    function HelloWorld() {
    echo HELLO;
    }
    const HELLO = "Hello World!";
    HelloWorld();
    ?>
</pre>
QQQ;

$c12a41 =
[
    'Syntax Error',
    'Hello World!',
    'PHP Notice: Use of undefined constant HELLO',
    'None of the above',
];

// ---------------------------------------------------------------------

$c12q42 = <<<'QQQ'
Q42: What will this code output?      
<pre class="code">
    <&#63;php  
    function add(int $a, int $b): integer {
        return $a + $b;
    }
    echo add(5.7, -4.6);
    ?>
</pre>
QQQ;

$c12a42 =
[
    'Syntax error',
    '1',
    '1.1',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q43 = <<<'QQQ'
Q43: What is the output of this script?      
<pre class="code">
    <&#63;php
    $a = 0b0010;
    $b = 0b0001;
    echo gettype($a & $b);
    ?>
</pre>
QQQ;

$c12a43 =
[
    'Syntax error; this won’t run',
    'undefined',
    'integer',
    'double',
    'boolean',
];

// ---------------------------------------------------------------------

$c12q44 = <<<'QQQ'
Q44: What will the output of this code be?      
<pre class="code">
    <&#63;php
    $result = echo print("Hello world!");
    var_dump($result);
    ?>
</pre>
QQQ;

$c12a44 =
[
    'NULL',
    '1NULL',
    'Hello world!NULL',
    'A syntax error'
];

// ---------------------------------------------------------------------

$c12q45 = <<<'QQQ'
Q45: You have invoked PHP on the command line and want to access the arguments
    you passed in your PHP script. Which superglobal will contain these?      
QQQ;

$c12a45 =
[
    '$GLOBALS',
    '$_ARGV',
    '$_SERVER',
    '$_ARGUMENTS'
];

// ---------------------------------------------------------------------

$c12q46 = <<<'QQQ'
Q46: The function gc_collect_cycles() is used to do which of the following?      
QQQ;

$c12a46 =
[
    'There is no such function',
    'Pause the script for a certain number of processor cycles',
    'Initiate garbage collection to free up memory',
    'Flush the opcode cache'
];

// ---------------------------------------------------------------------

$c12q47 = <<<'QQQ'
Q47: What will this code output?      
<pre class="code">
    <&#63;php
    try {
        // generates a notice error (not caught)
        echo $thisVariableIsNotSet;
    } catch (Error $e) {
        echo "Error caught";
    }
    ?>
</pre>
QQQ;

$c12a47 =
[
    'This produces a notice error',
    'This produces a fatal error',
    'Error caught',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q48 = <<<'QQQ'
Q48: What will this code output?      
<pre class="code">
    <&#63;php
    $emotion = "loves";
    $theBeeb = function($name) use ($emotion) {
        echo "$name $emotion Justin";
    };
    $emotion = "adores";
    $theBeeb("Ron");
    ?>
</pre>
QQQ;

$c12a48 =
[
    'Ron loves Justin',
    'Ron adores Justin',
    '$name $emotion Justin',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q49 = <<<'QQQ'
Q49: Assume that the Pluto and Grumpy classes are both declared in the class.
    definitions.php file, which is in the same directory as this script. What will happen
    when you run this script?      
<pre class="code">
    <&#63;php
    $a = function() {
    include('class.definitions.php');
    };
    spl_autoload_register($a);
    // Class Pluto is defined in class.definitions.php
    $planet = new Pluto;
    // Class Grumpy is defined in class.definitions.php
    $dwarf = new Grumpy;
    ?>
</pre>
QQQ;

$c12a49 =
[
    'The script will generate a fatal error because you need to put brackets after the class name',
    'The script will generate an error when you try to include the script a second time',
    'The file will be included once and the script won\'t output anything',
    'The script will fail because you cannot use a variable for spl_autoload_register; only  a string literal',
    'None of the above'
];

// ---------------------------------------------------------------------

$c12q50 = <<<'QQQ'
Q50: Which of the following pieces of information associated with the request cannot
    be easily changed by the client?      
QQQ;

$c12a50 =
[
    'Remote IP address',
    'Session data',
    'Cookie data',
    'User agent',
    'All of these are easily changed by the client'
];


