<?php

if(!defined('TYPO3_MODE'))
    die('Access denied.');

if(TYPO3_MODE === 'BE') {
    $GLOBALS['TBE_STYLES']['skins']['backend']['stylesheetDirectories']['cf_beskin'] = 'EXT:' . $_EXTKEY . '/Resources/Public/Css/';

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'CodeFareith.' . $_EXTKEY,
        'system',
        'tx_cfbeskin',
        '',
        [
            'Editor' => 'render'
        ],
        [
            'access' => 'admin',
            'icon' => 'EXT:cf_beskin/Resources/Public/Icons/module-cf_beskin.svg',
            'labels' => 'LLL:EXT:' . 'cf_beskin/Resources/Private/Language/locallang_mod.xlf'
        ]
    );
}