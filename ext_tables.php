<?php

if(!defined('TYPO3_MODE'))
    die('Access denied.');

if(TYPO3_MODE === 'BE') {
    $GLOBALS['TBE_STYLES']['skins']['backend']['stylesheetDirectories']['cf_beskin'] = 'EXT:cf_beskin/Resources/Public/Css/';

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'CodeFareith.' . $_EXTKEY,
        'system',
        'tx_cfbeskin',
        '',
        [
            'Stylesheet' => 'show'
        ],
        [
            'access' => 'admin',
            'icon' => 'EXT:cf_beskin/Resources/Public/Icons/module-cf_beskin.svg',
            'labels' => 'LLL:EXT:cf_beskin/Resources/Private/Language/locallang_mod.xlf'
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerAjaxHandler(
        'cf_beskin::loadStylesheet',
        'CodeFareith\\CfBeskin\\Controller\\StylesheetController->ajaxLoad'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerAjaxHandler(
        'cf_beskin::saveStylesheet',
        'CodeFareith\\CfBeskin\\Controller\\StylesheetController->ajaxSave'
    );
}