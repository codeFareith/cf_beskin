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

defined('TYPO3_MODE')
    or die('Access denied.');

call_user_func(
    static function ($extKey) {
        if (TYPO3_MODE === 'BE') {
            $GLOBALS['TBE_STYLES']['skins']['backend']['stylesheetDirectories']['cf_beskin'] = vsprintf(
                'EXT:%s/Resources/Public/Css/',
                [
                    $extKey
                ]
            );

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'CodeFareith.' . $extKey,
                'system',
                'tx_cfbeskin',
                '',
                [
                    'Editor' => 'render',
                ],
                [
                    'access' => 'admin',
                    'icon' => 'EXT:cf_beskin/Resources/Public/Icons/module-cf_beskin.svg',
                    'labels' => 'LLL:EXT:' . 'cf_beskin/Resources/Private/Language/locallang_mod.xlf',
                ]
            );
        }
    },
    $_EXTKEY
);
