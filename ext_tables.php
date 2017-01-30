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
            'labels' => 'LLL:EXT:cf_beskin/Resources/Private/Language/locallang_mod.xlf'
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerAjaxHandler(
        $_EXTKEY . '::loadStylesheet',
        'CodeFareith\\CfBeskin\\Controller\\EditorController->ajaxLoadFile'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerAjaxHandler(
        $_EXTKEY . '::saveStylesheet',
        'CodeFareith\\CfBeskin\\Controller\\EditorController->ajaxSaveFile'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerAjaxHandler(
        $_EXTKEY . '::ajaxTranslate',
        'CodeFareith\\CfBeskin\\Utility\\AjaxLocalizationUtility->ajaxTranslate'
    );
}