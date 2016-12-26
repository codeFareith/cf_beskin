<?php

namespace CodeFareith\CfBeskin\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Http\AjaxRequestHandler;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class StylesheetController extends ActionController {
    /** @var string */
    protected $targetFile;

    /**
     * initialize
     */
    public function initializeAction() {
        $extKey = GeneralUtility::camelCaseToLowerCaseUnderscored($this->extensionName);
        $this->targetFile = (ExtensionManagementUtility::extPath($extKey) . 'Resources/Public/Css/backend.css');
    }

    /**
     * action show
     */
    public function showAction() {
        //$content = GeneralUtility::getURL($this->targetFile);
        //$this->view->assign('fileContent', $content);
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