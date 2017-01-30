<?php
/**
 * AjaxLocalizationUtility
 *
 * This file is part of the "cf_beskin" extension
 *
 * @author      Robin von den Bergen    <robinvonberg@gmx.de>
 * @copyright   Copyright (c) 2017 Robin 'codeFareith' von den Bergen
 */
namespace CodeFareith\CfBeskin\Utility;

use TYPO3\CMS\Core\Http\AjaxRequestHandler;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class AjaxLocalizationUtility {
    /**
     * @param array $params
     * @param AjaxRequestHandler|null $ajaxObj
     * @return void
     */
    public static function ajaxTranslate($params = array(), AjaxRequestHandler &$ajaxObj = null) {
        $key = $params['request']->getQueryParams()['key'];
        $extensionName = $params['request']->getQueryParams()['extensionName'];
        $result = LocalizationUtility::translate($key, $extensionName);

        $ajaxObj->setContentFormat('json');
        $ajaxObj->addContent('result', $result);
    }
}