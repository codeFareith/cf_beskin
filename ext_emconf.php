<?php

$EM_CONF[$_EXTKEY] = [
    'title' => '[codeFareith] Backend Skin',
    'description' => 'Define your own css rule-sets for the TYPO3 CMS backend.',
    'category' => 'be',

    'author' => 'Robin "codeFareith" von den Bergen',
    'author_email' => 'rvdb@fareith.de',
    'author_company' => '',

    'state' => 'stable',
    'version' => '1.2.1',

    'uploadFolders' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => true,

    'constraints' => [
        'depends' => [
            'php' => '5.6-',
            'typo3' => '7.6.0-9.9.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],

    'autoload' => [
        'psr-4' => [
            'CodeFareith\\CfBeskin\\' => 'Classes',
        ],
    ],
];
