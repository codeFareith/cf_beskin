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
 * AceEditorViewHelper
 *
 * This file is part of the "cf_beskin" extension
 *
 * @author      Robin von den Bergen    <robinvonberg@gmx.de>
 * @copyright   Copyright (c) 2017 Robin 'codeFareith' von den Bergen
 */

namespace CodeFareith\CfBeskin\ViewHelpers;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class AceEditorViewHelper
    extends AbstractTagBasedViewHelper
{
    /** @var ObjectManager */
    protected $objectManager;

    /** @var PageRenderer */
    protected $pageRenderer;

    /**
     * @param PageRenderer $pageRenderer
     *
     * @return void
     */
    public function injectPageRenderer(PageRenderer $pageRenderer)
    {
        $this->pageRenderer = $pageRenderer;
    }

    /**
     * initialize
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->tag->setTagName('pre');
        $this->tag->forceClosingTag(true);
    }

    /**
     * initialize arguments
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();

        $this->registerArgument('handler', 'integer', 'enthaelt die UID des CE', true);
        $this->registerArgument('theme', 'string', 'enthaelt das Tabellenelement aus sys_category', true);
        $this->registerArgument('mode', 'string', 'enthaelt den Tabellennamen aus sys_category_record_mm', true);
    }

    public function render()
    {
        $handler = $this->arguments['handler'];
        $theme = $this->arguments['theme'];
        $mode = $this->arguments['mode'];

        $this->tag->addAttribute('data-theme', $theme);
        $this->tag->addAttribute('data-mode', $mode);

        $this->pageRenderer->loadRequireJsModule($handler);

        return $this->tag->render();
    }
}
