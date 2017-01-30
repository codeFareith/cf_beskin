<?php
/**
 * EditorController
 *
 * This file is part of the "cf_beskin" extension
 *
 * @author      Robin von den Bergen    <robinvonberg@gmx.de>
 * @copyright   Copyright (c) 2017 Robin 'codeFareith' von den Bergen
 */
namespace CodeFareith\CfBeskin\Controller;

use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Http\AjaxRequestHandler;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

class EditorController extends ActionController {
    /** @var BackendTemplateView */
    protected $view;

    /** @var string */
    protected $defaultViewObjectName = BackendTemplateView::class;

    /** @var PageRenderer */
    protected $pageRenderer;

    /** @var string */
    protected $extKey;

    /** @var string */
    protected $extPath;

    /**
     * initialize properties
     * @return void
     */
    protected function initializeAction() {
        $this->extKey = GeneralUtility::camelCaseToLowerCaseUnderscored($this->extensionName);
        $this->extPath = ExtensionManagementUtility::extPath($this->extKey);
    }

    /**
     * @param ViewInterface $view
     * @return void
     */
    protected function initializeView(ViewInterface $view) {
        parent::initializeView($view);

        $this->view
            ->getModuleTemplate()
            ->setFlashMessageQueue($this->controllerContext->getFlashMessageQueue());

        $this->pageRenderer = $this->view
            ->getModuleTemplate()
            ->getPageRenderer();
    }

    /**
     * action "render"
     * @return void
     */
    public function renderAction() {}

    /**
     * @param array $params
     * @param AjaxRequestHandler|null $ajaxObj
     * @return void
     */
    public function ajaxLoadFile($params = array(), AjaxRequestHandler &$ajaxObj = null) {
        $this->initializeAction();
        $file = ($this->extPath . 'Resources/Public/Css/' . $params['request']->getQueryParams()['file']);
        $content = GeneralUtility::getURL($file);

        $ajaxObj->setContentFormat('plain');
        $ajaxObj->addContent('fileContent', $content);
    }

    /**
     * @param array $params
     * @param AjaxRequestHandler|null $ajaxObj
     * @return void
     */
    public function ajaxSaveFile($params = array(), AjaxRequestHandler &$ajaxObj = null) {
        $this->initializeAction();
        $file = ($this->extPath . 'Resources/Public/Css/' . $params['request']->getQueryParams()['file']);
        $content = $params['request']->getQueryParams()['content'];
        $result = GeneralUtility::writeFile($file, $content);

        $ajaxObj->setContentFormat('json');
        $ajaxObj->addContent('result', $result);
    }
}