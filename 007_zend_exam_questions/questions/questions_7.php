<?php



$c7q1 = <<<'QQQ'
Q1: True or false? Characters that cannot be encoded in the target XML encoding
scheme generate an error.
QQQ;

$c7a1 =
[
    'True',
    'False; they generate a warning',
    'False; they are fitted into the encoding scheme (converted to question marks)',
    'None of the above'
];

$c7q2 = <<<'QQQ'
Q2: True or false? It is not possible for a server to send a REST response with HTTP
status code 200 if the request failed.
QQQ;

$c7a2 =
[
    'True',
    'False'
];



$c7q3 = <<<'QQQ'
Q3: What will this code output?
        
<pre class="code">
    <&#63;php
    $arr = [
        "fruits" => [
            "apple" => ["taste" => "sweet", "color" => "yellow"],
            "banana" => ["taste" => "sour", "color" => "green"],
            "cherry" => ["taste" => "sweet", "color" => "red"]
        ],
        "vegetables" => "yuck"
    ];
    $str = json_encode($arr);
    $decode = json_decode($str, true, 1);
    echo json_last_error_msg();
    ?>
</pre>
QQQ;

$c7a3 =
[
    'Syntax error; it will not run',
    'Nothing; there is no error msg so the echo statement outputs nothing',
    'Maximum stack depth exceeded',
    'Fatal error, the second parameter to json_decode cannot be "true"',
];



$c7q4 = <<<'QQQ'
Q4: You should set the default time zone for your PHP application. Which of the
following methods can you use to do so? Choose as many as apply.
QQQ;

$c7a4 =
[
    'Using the function set_date_default_timezone()',
    'Editing php.ini',
    'Using the Linux time() command on PHP',
    'Using the PHP ini_set() function, like this:',
    'ini_set(\'date.timezone\', \'Europe/Edinburgh\');',
];


$c7q5 = <<<'QQQ'
Q5: What will this code output?
        
<pre class="code">
    <&#63;php
    $stack = new SplStack();
    $stack->push(5);
    $stack[1] = 4;
    echo $stack->pop();
    ?>
</pre>
QQQ;

$c7a5 =
[   
    '4',
    '5',
    'A fatal error will occur',
];


$c7q6 = <<<'QQQ'
Q6: What is wrong with the following PHP code?
        
<pre class="code">
    <&#63;php
    $client = new SoapClient("http://example.com/login?wsdl");
    $params = array('username'=>'name', 'password'=>'secret');
    // call the login method directly
    $client->login($params);
    ?>
</pre>

QQQ;

$c7a6 =
[   
    'Syntax error; it won’t run at all',
    'The parameters to the login method need to be passed like this: $client->login([$params]);',
    'You can\'t call a method on the SoapClient directly',
    'Nothing is wrong; this will work',
];


$c7q7 = <<<'QQQ'
Q7: What will this code output?
        
<pre class="code">
    &lt;php
    $xmlString = &lt;&lt;&lt;XML
    &lt;root>
    &lt;teams>
    &lt;team>Silverbacks&lt;/team>
    &lt;team>Golden Eyes&lt;/team>
    &lt;/teams>
    &lt;/root>
    XML;
    $xml = new SimpleXMLElement($xmlString);
    $result = $xml->xpath('teams/team[1]');
    echo $result[0];
    ?>
</pre>

QQQ;

$c7a7 =
[   
    'Syntax error; it won\’t run',
    'Silverbacks',
    'Golden Eyes',
    'It will generate a warning because the xpath will fail to evaluate'
];


$c7q8 = <<<'QQQ'
Q8: You can convert a SimpleXML object to DOM with the ______ function.
QQQ;

$c7a8 =
[   
    'dom_import_simplexml()',
    'simple_xml:import_dom()',
    'simple_xml:export_dom()',
    'None of the above',
];


$c7q9 = <<<'QQQ'
Q9: What is the output of this script?
        
<pre class="code">
    <&#63;php
    $xmlString = &lt;&lt;&lt;XML
    &lt;root>
    &lt;teams>
    &lt;team>Silverbacks&lt;/team>
    &lt;team foo="winner">Golden Eyes&lt;/team>
    &lt;/teams>
    &lt;/root>
    XML;
    $domDoc = new DOMDocument();
    $domDoc->loadXML($xmlString);
    $textElement = $domDoc->createElement('team', 'Bearhides');
    $result = $domDoc->xpath('teams/team[2]');
    $result[1]->insertBefore($textElement);
    echo $domDoc->saveXML();
    ?>
</pre>

QQQ;

$c7a9 =
[   
    'This will produce a fatal error',
    'An XML document with a new team at the beginning of the list of teams',
    'An XML document with a new team between the two teams',
    'None of the above',
];


$c7q10 = <<<'QQQ'
Q10: What will the following code output?
        
<pre class="code">
    <&#63;php
    $dateTime = new DateTime();
    $interval = new DateInterval('P1Y2M3D4H5M');
    $dateTime->add($interval);
    echo $dateTime->format(DateTime::COOKIE);
    ?>
</pre>

QQQ;

$c7a10 =
[   
    'This will produce a fatal error',
    'A date one year, two months, three days, four hours, and five minutes in the future',
    'None of the above'
];