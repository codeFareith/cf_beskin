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
use RuntimeException;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class AjaxLocalizationUtility
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     * @throws RuntimeException
     */
    public static function ajaxTranslate(ServerRequestInterface $request)
    {
        $key = $request->getQueryParams()['key'];
        $extensionName = $request->getQueryParams()['extensionName'];
        $result = LocalizationUtility::translate($key, $extensionName);

        $response = new Response();
        $response->getBody()->write(json_encode(['result' => $result]));

        return $response;
    }
}
