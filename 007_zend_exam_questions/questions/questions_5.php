<?php

$c5q1 = <<<'QQQ'
Q1: Which of these is NOT a valid PHP class name?       
QQQ;

$c5a1 =
[
    'exampleClass',
    'Example_Class',
    'Example_1_Class',
    '1_Example_Class',
    'They are all valid class names'
];

// ---------------------------------------------------------------------

$c5q2 = <<<'QQQ'
Q2: What will the property $name contain after this code is run?       
<pre class="code">
    <&#63;php
    class SleepyHead {
        protected $name = "Dozy";
        public function __serialize() {
            $this->name = "Asleep";
        }
        public function __unserialize() {
            $this->name = "Rested";
        }
    }
    $obj = unserialize(serialize(new SleepyHead()));
    ?>
</pre>
QQQ;

$c5a2 =
[
    'Dozy',
    'Asleep',
    'Rested',
    'This code won’t run'
];

// ---------------------------------------------------------------------

$c5q3 = <<<'QQQ'
Q3: Which of the following statements can we replace the commented line with in
    order for the script to output "Castor" ?      
<pre class="code">
    <&#63;php
    $star = new StdClass;
    // replace this line
    $star->name = "Castor";
    $twin->name = "Pollux";
    echo $star->name; // must be Castor
    ?>
</pre>
QQQ;

$c5a3 =
[
    '$twin = $star;',
    '$twin = clone($star);',
    '$twin &= $star;',
    '$twin = new clone($star);'
];

// ---------------------------------------------------------------------

$c5q4 = <<<'QQQ'
Q4: Let’s say that object A has a property that is an instance of object B. If we clone
    object A, then will PHP also clone B, which is one of its properties?       

QQQ;

$c5a4 =
[
    'Yes',
    'No',
    'You can’t clone objects that contain references to other objects'
];

// ---------------------------------------------------------------------

$c5q5 = <<<'QQQ'
Q5: You cannot declare two functions with the same name. Choose as many as apply.       

QQQ;

$c5a5 =
[
    'True',
    'False; you can declare them in different namespaces',
    'False; you can declare them with different number of parameters in their constructor and PHP will pick the definition that matches your instantiation',
    'False; you can declare them in different scopes',
];

// ---------------------------------------------------------------------

$c5q6 = <<<'QQQ'
Q6: When you call the json_encode function on an object to serialize it, which magic 
    method will PHP call? 
QQQ;

$c5a6 =
[
    '__sleep',
    '__wake',
    '__get',
    '__clone',
    'None of these',
];

// ---------------------------------------------------------------------

$c5q7 = <<<'QQQ'
Q7: True or false: Interfaces can only specify public methods, but your class can
    implement them however you like.       
QQQ;

$c5a7 =
[
    'True',
    'False; interfaces can specify any visibility',
    'False; you cannot change the visibility when you implement at all',
    'False; you can only change the visibility to one that is less visible'
];

// ---------------------------------------------------------------------

$c5q8 = <<<'QQQ'
Q8: What will the output of this code be?       
<pre class="code">
    <&#63;php
    class World {
        public static function hello() {
            echo "Hello " . __CLASS__;
        }
    }
    class Meek extends World {
        public function __call($method, $arguments) {
            echo "I have the world";
        }
    }
    Meek::hello();
    ?>
</pre>
QQQ;

$c5a8 =
[
    'Hello World',
    'I have the world',
    'An error',
    'None of the above'
];

// ---------------------------------------------------------------------

$c5q9 = <<<'QQQ'
Q9: The precedence of functions declared in traits, classes, and inherited methods is
    which of the following?       
QQQ;

$c5a9 =
[
    'Inherited methods ➤ trait methods ➤ class members',
    'Class members ➤ trait methods ➤ inherited methods',
    'Class members ➤ trait methods ➤ inherited methods',
    'Trait methods ➤ class members ➤ inherited methods'
];

// ---------------------------------------------------------------------

$c5q10 = <<<'QQQ'
Q10: True or False: A protected method cannot call private methods, even if they’re
     in the same class.       
QQQ;

$c5a10 =
[
    'True',
    'False'
];

// ---------------------------------------------------------------------