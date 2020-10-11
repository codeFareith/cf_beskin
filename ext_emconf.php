<?php
/**
 * [codeFareith] Backend Skin - CSS editor for TYPO3 CMS backend style
 * Copyright (C) 2020 Robin 'codeFareith' von den Bergen
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
/**
 * @var string $_EXTKEY
 */
$EM_CONF[$_EXTKEY] = [
    'title' => '[codeFareith] Backend Skin',
    'description' => 'Define your own css rule-sets for the TYPO3 CMS backend.',
    'category' => 'be',

    'author' => 'Robin "codeFareith" von den Bergen',
    'author_email' => 'rvdb@fareith.de',
    'author_company' => '',

    'state' => 'stable',
    'version' => '1.2.2',

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
