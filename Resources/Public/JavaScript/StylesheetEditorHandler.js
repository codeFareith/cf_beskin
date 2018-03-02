/**
 * Module: TYPO3/CMS/CfBeskin/StylesheetEditorHandler
 *
 * This file is part of the "cf_beskin" extension
 *
 * @author      Robin von den Bergen    <robinvonberg@gmx.de>
 * @copyright   Copyright (c) 2017 Robin 'codeFareith' von den Bergen
 */
define(
    ['jquery', 'TYPO3/CMS/CfBeskin/Ace/ace'],
    function($) {

        var StylesheetEditorHandler = {

            elements: {
                id: '',
                editor: null,
                saveButton: null
            },

            /**
             * initialize AceEditor
             */
            initialize: function() {
                this.elements.id = 'editor';
                this.elements.editor = ace.edit(this.elements.id);
                this.elements.saveButton = $('#save');

                var $editor = $('#' + this.elements.id);

                this.elements.editor.$blockScrolling = Infinity;
                this.elements.editor.setOptions({
                    // editor options
                    autoScrollEditorIntoView: true,

                    // renderer options
                    showPrintMargin: true,
                    theme: 'ace/theme/' + $editor.data('theme'),

                    // mouseHandler options

                    // session options
                    mode: 'ace/mode/' + $editor.data('mode')

                    // extension options
                    //enableEmmet: true
                });

                this.bindEvents();
                this.loadFile();
            },

            /**
             * bind event listener
             */
            bindEvents: function() {
                this.elements.saveButton.on('click', this.onSaveButtonClicked.bind(this));
            },

            /**
             *
             * @param evt
             */
            onSaveButtonClicked: function(evt) {
                evt.preventDefault();
                this.saveFile();
            },

            /**
             * load stylesheet
             */
            loadFile: function() {
                var self = this;

                $.ajax({
                    url: TYPO3.settings.ajaxUrls['system_CfBeskin_loadStylesheets'],
                    data: {
                        file: 'backend.css'
                    },
                    success: function(result) {
                        self.elements.editor.setValue(result);
                        self.elements.editor.clearSelection();
                        self.elements.editor.focus();
                    },
                    error: function(result) {
                        console.error(result);
                        console.trace();

                        $.when(
                            self.translate('notification.load.error.title'),
                            self.translate('notification.load.error.body')
                        ).done(function(v1, v2) {
                            top.TYPO3.Notification.error(
                                v1[0].result,
                                v2[0].result
                            );
                        });
                    }
                });
            },

            /**
             * save stylesheet
             */
            saveFile: function() {
                var self = this;

                $.ajax({
                    url: TYPO3.settings.ajaxUrls['system_CfBeskin_saveStylesheets'],
                    data: {
                        file: 'backend.css',
                        content: this.elements.editor.getValue()
                    },
                    success: function(result) {
                        $.when(
                            self.translate('notification.save.success.title'),
                            self.translate('notification.save.success.body')
                        ).done(function(v1, v2) {
                            top.TYPO3.Notification.success(
                                v1[0].result,
                                v2[0].result
                            );
                            self.loadFile();
                        });
                    },
                    error: function(result) {
                        console.error(result);
                        console.trace();

                        $.when(
                            self.translate('notification.save.error.title'),
                            self.translate('notification.save.error.body')
                        ).done(function(v1, v2) {
                            top.TYPO3.Notification.error(
                                v1[0].result,
                                v2[0].result
                            );
                        });
                    }
                })
            },

            /**
             * get translation via ajax
             *
             * @param key
             * @returns {*}
             */
            translate: function(key) {
                return $.ajax({
                    url: TYPO3.settings.ajaxUrls['utility_CfBeskin_doTranslate'],
                    data: {
                        key: key,
                        extensionName: 'cf_beskin'
                    }
                });
            }
        };

        StylesheetEditorHandler.initialize();
    }
);