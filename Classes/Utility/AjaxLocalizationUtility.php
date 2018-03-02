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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class AjaxLocalizationUtility {
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     * @throws \RuntimeException
     */
    public static function ajaxTranslate(ServerRequestInterface $request, ResponseInterface $response) {
        $key = $request->getQueryParams()['key'];
        $extensionName = $request->getQueryParams()['extensionName'];
        $result = LocalizationUtility::translate($key, $extensionName);

        $response->getBody()->write(json_encode(['result' => $result]));
        return $response;
    }
}