<?php

namespace CodeFareith\CfBeskin\Controller;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\Buttons\Action\HelpButton;
use TYPO3\CMS\Backend\Template\Components\Buttons\Action\ShortcutButton;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Http\AjaxRequestHandler;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

class StylesheetController extends ActionController {
    /** @var BackendTemplateView */
    protected $view;

    /** @var string */
    protected $defaultViewObjectName = BackendTemplateView::class;

    /** @var string */
    protected $extPath;

    /** @var string */
    protected $targetFile;

    /**
     * initialize properties
     */
    public function initializeAction() {
        $extKey = GeneralUtility::camelCaseToLowerCaseUnderscored($this->extensionName);
        $this->extPath = ExtensionManagementUtility::extPath($extKey);
        $this->targetFile = ($this->extPath . 'Resources/Public/Css/backend.css');
    }

    /**
     * Set up the doc header
     *
     * @param ViewInterface $view
     * @return void
     */
    protected function initializeView(ViewInterface $view) {
        parent::initializeView($view);
        $this->generateMenu();
        $this->generateButtons();

        $this->view
            ->getModuleTemplate()
            ->setFlashMessageQueue($this->controllerContext->getFlashMessageQueue());
    }

    /**
     * generate the action menu
     *
     * @return void
     */
    protected function generateMenu() {
        // get current menu
        $menu = $this->view
            ->getModuleTemplate()
            ->getDocHeaderComponent()
            ->getMenuRegistry()
            ->makeMenu();

        // config menu
        $menu->setIdentifier('BackendSkinModuleMenu');

        // add menu
        $this->view
            ->getModuleTemplate()
            ->getDocHeaderComponent()
            ->getMenuRegistry()
            ->addMenu($menu);
    }

    /**
     * generate the button menu
     *
     * @return void
     */
    protected function generateButtons() {
        $moduleName = $this->request->getPluginName();

        /** @var ButtonBar $buttonBar */
        $buttonBar = $this->view
            ->getModuleTemplate()
            ->getDocHeaderComponent()
            ->getButtonBar();

        /** @var HelpButton $helpButton */
        $helpButton = $buttonBar
            ->makeHelpButton()
            ->setModuleName($moduleName)
            ->setFieldName('');

        /** @var ShortcutButton $shortcutButton */
        $shortcutButton = $buttonBar
            ->makeShortcutButton()
            ->setModuleName($moduleName);

        $buttonBar->addButton($shortcutButton);
        $buttonBar->addButton($helpButton);
    }

    /**
     * action show
     */
    public function showAction() {
        $this->view->assign('aceBasePath', ($this->extPath . 'Resources/Public/JavaScript/Ace'));
    }

    /**
     * @param array $params
     * @param AjaxRequestHandler|NULL $ajaxObj
     * @return void
     */
    public function ajaxLoad($params = array(), AjaxRequestHandler &$ajaxObj = NULL) {
        $this->initializeAction();
        $content = GeneralUtility::getURL($this->targetFile);
        $ajaxObj->addContent('fileContent', $content);
    }

    /**
     * @param array $params
     * @param AjaxRequestHandler|NULL $ajaxObj
     * @return void
     */
    public function ajaxSave($params = array(), AjaxRequestHandler &$ajaxObj = NULL) {
        $this->initializeAction();
        $content = $params['request']->getQueryParams()['content'];
        $result = GeneralUtility::writeFile($this->targetFile, $content);

        $ajaxObj->setContentFormat('json');
        $ajaxObj->addContent('result', $result);
    }
}