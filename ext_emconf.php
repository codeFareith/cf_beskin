<?php

$EM_CONF[$_EXTKEY] = [
    'title' => '[codeFareith] Backend Skin',
    'description' => 'Define your own css rule-sets for the TYPO3 CMS backend.',
    'category' => 'be',

    'author' => 'Robin "codeFareith" von den Bergen',
    'author_email' => 'rvdb@fareith.de',
    'author_company' => '',

    'state' => 'stable',
    'version' => '1.0.3',

    'uploadFolders' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => true,

    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-8.9.99'
        ],
        'conflicts' => [

        ],
        'suggests' => [

        ]
    ]
];