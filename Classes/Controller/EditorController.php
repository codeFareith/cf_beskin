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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\View\BackendTemplateView;
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
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function ajaxLoadFile(ServerRequestInterface $request, ResponseInterface $response) {
        $this->initializeAction();
        $file = ($this->extPath . 'Resources/Public/Css/' . $request->getQueryParams()['file']);
        $content = GeneralUtility::getUrl($file);
        $response->withHeader('Content-Type', 'text/plain');
        $response->getBody()->write($content);
        return $response->withHeader('Content-Type', 'text/plain');
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     * @throws \RuntimeException
     */
    public function ajaxSaveFile(ServerRequestInterface $request, ResponseInterface $response) {
        $this->initializeAction();
        $file = ($this->extPath . 'Resources/Public/Css/' . $request->getQueryParams()['file']);
        $content = $request->getQueryParams()['content'];
        $result = GeneralUtility::writeFile($file, $content);

        $response->getBody()->write(json_encode(['result' => $result]));
        return $response;
    }
}