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
