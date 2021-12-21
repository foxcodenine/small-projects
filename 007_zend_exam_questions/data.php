<?php

include './questions/questions_1.php';
include './questions/questions_2.php';
include './questions/questions_4.php';
include './questions/questions_7.php';

$titels = [
    0,
    'Chapter 1 - PHP Basics',
    'Chapter 2 - Functions',
    'Chapter 3 - Strings and Patterns',
    'Chapter 4 - Arrays',
    'Chapter 5 - ',
    'Chapter 6 - ',
    'Chapter 7 - Data Formats and Types',
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
            'correct'  => [5],
            'answers'  => $c4a1
        ],
        2 => [
            'question' => $c4q2,
            'correct'  => [0],
            'answers'  => $c4a2
        ],
        3 => [
            'question' => $c4q3,
            'correct'  => [1],
            'answers'  => $c4a3
        ],
        4 => [
            'question' => $c4q4,
            'correct'  => [3],
            'answers'  => $c4a4
        ],
        5 => [
            'question' => $c4q5,
            'correct'  => [0],
            'answers'  => $c4a5
        ],
        6 => [
            'question' => $c4q6,
            'correct'  => [0],
            'answers'  => $c4a6
        ],
    ],
    5 => [],
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
    
];