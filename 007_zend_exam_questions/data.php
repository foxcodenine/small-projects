<?php

include './questions/questions_1.php';
include './questions/questions_2.php';
include './questions/questions_4.php';
include './questions/questions_5.php';
include './questions/questions_7.php';
include './questions/questions_12.php';

$titels = [
    0,
    'Chapter 1 - PHP Basics',
    'Chapter 2 - Functions',
    'Chapter 3 - Strings and Patterns',
    'Chapter 4 - Arrays',
    'Chapter 5 - Object-Oriented',
    'Chapter 6 - ',
    'Chapter 7 - Data Formats and Types',
    'Chapter 8 -',
    'Chapter 9 -',
    'Chapter 10 -',
    'Chapter 11 -',
    'Chapter 12 - Exercise',
];

$data = [
    1 => [
        1 => [
            'question' => $c1q1,
            'correct'  => [3],
            'answers'  => $c1a1
            ],
        2 => [
            'question' => $c1q2,
            'correct'  => [1,3],
            'answers'  => $c1a2
            ],
        3 => [
            'question' => $c1q3,
            'correct'  => [2],
            'answers'  => $c1a3
            ],
        4 => [
            'question' => $c1q4,
            'correct'  => [1],
            'answers'  => $c1a4
            ],
        5 => [
            'question' => $c1q5,
            'correct'  => [3],
            'answers'  => $c1a5
            ],
        6 => [
            'question' => $c1q6,
            'correct'  => [0],
            'answers'  => $c1a6
            ],
        7 => [
            'question' => $c1q7,
            'correct'  => [1,2],
            'answers'  => $c1a7
            ],
        8 => [
            'question' => $c1q8,
            'correct'  => [0],
            'answers'  => $c1a8
            ],
        9 => [
            'question' => $c1q9,
            'correct'  => [0],
            'answers'  => $c1a9
            ],
        10 => [
            'question' => $c1q10,
            'correct'  => [5],
            'answers'  => $c1a10
            ],
        11 => [
            'question' => $c1q11,
            'correct'  => [0, 2, 3, 4],
            'answers'  => $c1a11
            ],
    ],
    2 => [
        1 => [
            'question' => $c2q1,
            'correct'  => [2],
            'answers'  => [
                'Int', 'Float', 'Fatal error: Uncaught TypeErro'
            ]
            ],
        2 => [
            'question' => $c2q2,
            'correct'  => [2],
            'answers'  => $c2a2
        ],
        3 => [
            'question' => 'Q3: You cannot use empty() as a callback for the usort() function.',
            'correct'  => [0],
            'answers'  => ['True', 'False']
        ],
        4 => [
            'question' => $c2q4,
            'correct'  => [3],
            'answers'  => $c2a4
        ],
        5 => [
            'question' => $c2q5,
            'correct'  => [1],
            'answers'  => $c2a5
        ],
        6 => [
            'question' => $c2q6,
            'correct'  => [3],
            'answers'  => $c2a6
        ],
        7 => [
            'question' => $c2q7,
            'correct'  => [3],
            'answers'  => $c2a7
        ],
        8 => [
            'question' => $c2q8,
            'correct'  => [3],
            'answers'  => $c2a8
        ],
        9 => [
            'question' => $c2q9,
            'correct'  => [1],
            'answers'  => $c2a9
        ],
        10 => [
            'question' => $c2q10,
            'correct'  => [1],
            'answers'  => $c2a10
        ],
        11 => [
            'question' => $c2q11,
            'correct'  => [0, 3],
            'answers'  => $c2a11
        ],
        12 => [
            'question' => $c2q12,
            'correct'  => [0],
            'answers'  => $c2a12
        ],
        13 => [
            'question' => $c2q13,
            'correct'  => [2],
            'answers'  => $c2a13
        ],
        14 => [
            'question' => $c2q14,
            'correct'  => [3],
            'answers'  => $c2a14
        ],
        15 => [
            'question' => $c2q15,
            'correct'  => [0],
            'answers'  => $c2a15
        ],
        16 => [
            'question' => $c2q16,
            'correct'  => [2],
            'answers'  => $c2a16
        ],
        17 => [
            'question' => $c2q17,
            'correct'  => [2],
            'answers'  => $c2a17
        ],
        18 => [
            'question' => $c2q18,
            'correct'  => [1],
            'answers'  => $c2a18
        ],
        19 => [
            'question' => $c2q19,
            'correct'  => [0],
            'answers'  => $c2a19
        ],
        20 => [
            'question' => $c2q20,
            'correct'  => [2],
            'answers'  => $c2a20
        ],
        21 => [
            'question' => $c2q21,
            'correct'  => [1],
            'answers'  => $c2a21
        ],
        22 => [
            'question' => $c2q22,
            'correct'  => [3],
            'answers'  => $c2a22
        ],
        23 => [
            'question' => $c2q23,
            'correct'  => [2],
            'answers'  => $c2a23
        ],
        24 => [
            'question' => $c2q24,
            'correct'  => [2, 4],
            'answers'  => $c2a24
        ],
        25 => [
            'question' => $c2q25,
            'correct'  => [0],
            'answers'  => $c2a25
        ],
        26 => [
            'question' => $c2q26,
            'correct'  => [3],
            'answers'  => $c2a26
        ],
        27 => [
            'question' => $c2q27,
            'correct'  => [1],
            'answers'  => $c2a27
        ],
        28 => [
            'question' => $c2q28,
            'correct'  => [0],
            'answers'  => $c2a28
        ],
        29 => [
            'question' => $c2q29,
            'correct'  => [2],
            'answers'  => $c2a29
        ],
        30 => [
            'question' => $c2q30,
            'correct'  => [0],
            'answers'  => $c2a30
        ],
        31 => [
            'question' => $c2q31,
            'correct'  => [3],
            'answers'  => $c2a31
        ],
        32 => [
            'question' => $c2q32,
            'correct'  => [1],
            'answers'  => $c2a32
        ],
        33 => [
            'question' => $c2q33,
            'correct'  => [1],
            'answers'  => $c2a33
        ],
        33 => [
            'question' => $c2q33,
            'correct'  => [1],
            'answers'  => $c2a33
        ],
        34 => [
            'question' => $c2q34,
            'correct'  => [1],
            'answers'  => $c2a34
        ],
        35 => [
            'question' => $c2q35,
            'correct'  => [3],
            'answers'  => $c2a35
        ],
        36 => [
            'question' => $c2q36,
            'correct'  => [0],
            'answers'  => $c2a36
        ],
        37 => [
            'question' => $c2q37,
            'correct'  => [0],
            'answers'  => $c2a37
        ],
        38 => [
            'question' => $c2q38,
            'correct'  => [2],
            'answers'  => $c2a38
        ],
        39 => [
            'question' => $c2q39,
            'correct'  => [3],
            'answers'  => $c2a39
        ],
        40 => [
            'question' => $c2q40,
            'correct'  => [2],
            'answers'  => $c2a40
        ],
        41 => [
            'question' => $c2q41,
            'correct'  => [1],
            'answers'  => $c2a41
        ],
        42 => [
            'question' => $c2q42,
            'correct'  => [4],
            'answers'  => $c2a42
        ],
        43 => [
            'question' => $c2q43,
            'correct'  => [2],
            'answers'  => $c2a43
        ],
        44 => [
            'question' => $c2q44,
            'correct'  => [1, 3, 4],
            'answers'  => $c2a44
        ],
        45 => [
            'question' => $c2q45,
            'correct'  => [4],
            'answers'  => $c2a45
        ],
        46 => [
            'question' => $c2q46,
            'correct'  => [2],
            'answers'  => $c2a46
        ],
        47 => [
            'question' => $c2q47,
            'correct'  => [4],
            'answers'  => $c2a47
        ],
        48 => [
            'question' => $c2q48,
            'correct'  => [3],
            'answers'  => $c2a48
        ],
        49 => [
            'question' => $c2q49,
            'correct'  => [0],
            'answers'  => $c2a49
        ],
        50 => [
            'question' => $c2q50,
            'correct'  => [4],
            'answers'  => $c2a50
        ],
        51 => [
            'question' => $c2q51,
            'correct'  => [3],
            'answers'  => $c2a51
        ],
        52 => [
            'question' => $c2q52,
            'correct'  => [3],
            'answers'  => $c2a52
        ],



    ],
    3 => [
        1 => [
            'question' => '',
            'correct'  => [],
            'answers'  => []
        ],
    ],
    4 => [
        1 => [
            'question' => $c4q1,
            'correct'  => [2],
            'answers'  => $c4a1
        ],
        2 => [
            'question' => $c4q2,
            'correct'  => [2],
            'answers'  => $c4a2
        ],
        3 => [
            'question' => $c4q3,
            'correct'  => [0],
            'answers'  => $c4a3
        ],
        4 => [
            'question' => $c4q4,
            'correct'  => [1],
            'answers'  => $c4a4
        ],
        5 => [
            'question' => $c4q5,
            'correct'  => [2],
            'answers'  => $c4a5
        ],
        6 => [
            'question' => $c4q6,
            'correct'  => [0],
            'answers'  => $c4a6
        ],
        7 => [
            'question' => $c4q7,
            'correct'  => [3],
            'answers'  => $c4a7
        ],
        8 => [
            'question' => $c4q8,
            'correct'  => [3],
            'answers'  => $c4a8
        ],
        9 => [
            'question' => $c4q9,
            'correct'  => [0,1],
            'answers'  => $c4a9
        ],
        10 => [
            'question' => $c4q10,
            'correct'  => [1],
            'answers'  => $c4a10
        ],
        11 => [
            'question' => $c4q11,
            'correct'  => [5],
            'answers'  => $c4a11
        ],
        12 => [
            'question' => $c4q12,
            'correct'  => [0],
            'answers'  => $c4a12
        ],
        13 => [
            'question' => $c4q13,
            'correct'  => [1],
            'answers'  => $c4a13
        ],
        14 => [
            'question' => $c4q14,
            'correct'  => [3],
            'answers'  => $c4a14
        ],
        15 => [
            'question' => $c4q15,
            'correct'  => [0],
            'answers'  => $c4a15
        ],
        16 => [
            'question' => $c4q16,
            'correct'  => [0],
            'answers'  => $c4a16
        ],
    ],
    5 => [
        1 => [
            'question' => $c5q1,
            'correct'  => [3],
            'answers'  => $c5a1
        ],
        2 => [
            'question' => $c5q2,
            'correct'  => [0],
            'answers'  => $c5a2
        ],
        3 => [
            'question' => $c5q3,
            'correct'  => [1],
            'answers'  => $c5a3
        ],
        4 => [
            'question' => $c5q4,
            'correct'  => [1],
            'answers'  => $c5a4
        ],
        5 => [
            'question' => $c5q5,
            'correct'  => [1,3],
            'answers'  => $c5a5
        ],
        6 => [
            'question' => $c5q6,
            'correct'  => [4],
            'answers'  => $c5a6
        ],
        7 => [
            'question' => $c5q7,
            'correct'  => [2],
            'answers'  => $c5a7
        ],
        8 => [
            'question' => $c5q8,
            'correct'  => [0],
            'answers'  => $c5a8
        ],
        9 => [
            'question' => $c5q9,
            'correct'  => [0],
            'answers'  => $c5a9
        ],
        10 => [
            'question' => $c5q10,
            'correct'  => [1],
            'answers'  => $c5a10
        ],
    ],
    6 => [],
    7 => [
        1 => [
            'question' => $c7q1,
            'correct'  => [2],
            'answers'  => $c7a1
            ],
        2 => [
            'question' => $c7q2,
            'correct'  => [1],
            'answers'  => $c7a2
            ],
        3 => [
            'question' => $c7q3,
            'correct'  => [2],
            'answers'  => $c7a3
            ],
        4 => [
            'question' => $c7q4,
            'correct'  => [1],
            'answers'  => $c7a4
            ],
        5 => [
            'question' => $c7q5,
            'correct'  => [2],
            'answers'  => $c7a5
            ],
        6 => [
            'question' => $c7q6,
            'correct'  => [3],
            'answers'  => $c7a6
            ],
        7 => [
            'question' => $c7q7,
            'correct'  => [1],
            'answers'  => $c7a7
            ],
        8 => [
            'question' => $c7q8,
            'correct'  => [0],
            'answers'  => $c7a8
            ],
        9 => [
            'question' => $c7q9,
            'correct'  => [0],
            'answers'  => $c7a9
            ],
        10 => [
            'question' => $c7q10,
            'correct'  => [0],
            'answers'  => $c7a10
            ],
        
    ],
    8 =>[],
    9 =>[],
    10 =>[],
    11 =>[],
    12 =>[
        [],
        [
        'question' => $c12q1 ,
        'correct'  => [1],
        'answers'  => $c12a1
        ],
        [
        'question' => $c12q2,
        'correct'  => [2],
        'answers'  => $c12a2
        ],
        [
        'question' => $c12q3,
        'correct'  => [1],
        'answers'  => $c12a3
        ],
        [
        'question' => $c12q4,
        'correct'  => [1],
        'answers'  => $c12a4
        ],
        [
        'question' => $c12q5 ,
        'correct'  => [1],
        'answers'  => $c12a5 
        ],
        [
        'question' => $c12q6 ,
        'correct'  => [1],
        'answers'  => $c12a6 
        ],
        [
        'question' => $c12q7 ,
        'correct'  => [4],
        'answers'  => $c12a7 
        ],
        [
        'question' => $c12q8 ,
        'correct'  => [2],
        'answers'  => $c12a8 
        ],
        [
        'question' => $c12q9 ,
        'correct'  => [2],
        'answers'  => $c12a9 
        ],
        [
        'question' => $c12q10 ,
        'correct'  => [2],
        'answers'  => $c12a10 
        ],
        [
        'question' => $c12q11 ,
        'correct'  => [1],
        'answers'  => $c12a11 
        ],
        [
        'question' => $c12q12 ,
        'correct'  => [0],
        'answers'  => $c12a12 
        ],
        [
        'question' => $c12q13 ,
        'correct'  => [1],
        'answers'  => $c12a13 
        ],
        [
        'question' => $c12q14,
        'correct'  => [2],
        'answers'  => $c12a14
        ],
        [
        'question' => $c12q15 ,
        'correct'  => [3],
        'answers'  => $c12a15 
        ],
        [
        'question' => $c12q16 ,
        'correct'  => [2],
        'answers'  => $c12a16 
        ],
        [
        'question' => $c12q17 ,
        'correct'  => [2],
        'answers'  => $c12a17 
        ],
        [
        'question' => $c12q18 ,
        'correct'  => [2],
        'answers'  => $c12a18 
        ],
        [
        'question' => $c12q19 ,
        'correct'  => [2],
        'answers'  => $c12a19 
        ],
        [
        'question' => $c12q20 ,
        'correct'  => [0],
        'answers'  => $c12a20 
        ],
        [
        'question' => $c12q21 ,
        'correct'  => [2],
        'answers'  => $c12a21 
        ],
        [
        'question' => $c12q22 ,
        'correct'  => [2],
        'answers'  => $c12a22 
        ],
        [
        'question' => $c12q23 ,
        'correct'  => [2],
        'answers'  => $c12a23 
        ],
        [
        'question' => $c12q24 ,
        'correct'  => [2],
        'answers'  => $c12a24 
        ],
        [
        'question' => $c12q25 ,
        'correct'  => [2],
        'answers'  => $c12a25 
        ],
        [
        'question' => $c12q26 ,
        'correct'  => [2],
        'answers'  => $c12a26 
        ],
        [
        'question' => $c12q27 ,
        'correct'  => [1],
        'answers'  => $c12a27 
        ],
        [
        'question' => $c12q28 ,
        'correct'  => [3],
        'answers'  => $c12a28 
        ],
        [
        'question' => $c12q29 ,
        'correct'  => [1],
        'answers'  => $c12a29 
        ],
        [
        'question' => $c12q30 ,
        'correct'  => [0],
        'answers'  => $c12a30 
        ],
        [
        'question' => $c12q31 ,
        'correct'  => [1],
        'answers'  => $c12a31 
        ],
        [
        'question' => $c12q32 ,
        'correct'  => [1],
        'answers'  => $c12a32 
        ],
        [
        'question' => $c12q33 ,
        'correct'  => [1],
        'answers'  => $c12a33 
        ],
        [
        'question' => $c12q34 ,
        'correct'  => [1],
        'answers'  => $c12a34 
        ],
        [
        'question' => $c12q35 ,
        'correct'  => [1],
        'answers'  => $c12a35 
        ],
        [
        'question' => $c12q36 ,
        'correct'  => [0],
        'answers'  => $c12a36 
        ],
        [
        'question' => $c12q37 ,
        'correct'  => [2],
        'answers'  => $c12a37 
        ],
        [
        'question' => $c12q38 ,
        'correct'  => [1],
        'answers'  => $c12a38 
        ],
        [
        'question' => $c12q39 ,
        'correct'  => [3],
        'answers'  => $c12a39 
        ],
        [
        'question' => $c12q40 ,
        'correct'  => [0],
        'answers'  => $c12a40 
        ],
    ],
    
];