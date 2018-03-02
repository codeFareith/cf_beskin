<?php

if(!defined('TYPO3_MODE'))
    die('Access denied.');

return [
    'system_CfBeskin_loadStylesheets' => [
        'path' => '/cf_beskin/editor/loadStylesheets',
        'target' => CodeFareith\CfBeskin\Controller\EditorController::class . '::ajaxLoadFile'
    ],
    'system_CfBeskin_saveStylesheets' => [
        'path' => '/cf_beskin/editor/saveStylesheets',
        'target' => CodeFareith\CfBeskin\Controller\EditorController::class . '::ajaxSaveFile'
    ],
    'utility_CfBeskin_doTranslate' => [
        'path' => '/cf_beskin/localization/doTranslate',
        'target' => CodeFareith\CfBeskin\Utility\AjaxLocalizationUtility::class . '::ajaxTranslate'
    ]
];