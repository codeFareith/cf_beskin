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

defined('TYPO3_MODE')
    or die('Access denied.');

return [
    'system_CfBeskin_loadStylesheets' => [
        'path' => '/cf_beskin/editor/loadStylesheets',
        'target' => CodeFareith\CfBeskin\Controller\EditorController::class . '::ajaxLoadFile',
    ],
    'system_CfBeskin_saveStylesheets' => [
        'path' => '/cf_beskin/editor/saveStylesheets',
        'target' => CodeFareith\CfBeskin\Controller\EditorController::class . '::ajaxSaveFile',
    ],
    'utility_CfBeskin_doTranslate' => [
        'path' => '/cf_beskin/localization/doTranslate',
        'target' => CodeFareith\CfBeskin\Utility\AjaxLocalizationUtility::class . '::ajaxTranslate',
    ],
];
