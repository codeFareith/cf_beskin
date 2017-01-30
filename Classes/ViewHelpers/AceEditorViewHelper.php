<?php
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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class AceEditorViewHelper extends AbstractTagBasedViewHelper {
    /** @var ObjectManager */
    protected $objectManager;

    /** @var PageRenderer */
    protected $pageRenderer;

    /**
     * @param PageRenderer $pageRenderer
     * @return void
     */
    public function injectPageRenderer(PageRenderer $pageRenderer) {
        $this->pageRenderer = $pageRenderer;
    }

    /**
     * initialize
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->tag->setTagName('pre');
        $this->tag->forceClosingTag(true);
    }

    /**
     * initialize arguments
     * @return void
     */
    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();
    }

    /**
     * @param string $handler
     * @param string $theme
     * @param string $mode
     * @return string
     */
    public function render($handler, $theme = '', $mode = '') {
        $this->tag->addAttribute('data-theme', $theme);
        $this->tag->addAttribute('data-mode', $mode);

        $this->pageRenderer->loadRequireJsModule($handler);

        return $this->tag->render();
    }
}