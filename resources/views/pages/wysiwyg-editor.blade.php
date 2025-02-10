@extends('../layout/' . $layout)

@section('subhead')
    <title>Wysiwyg Editor - Rubick - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">CKEditor</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Simple Editor -->
        <div class="col-span-12 lg:col-span-6">
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Simple Editor</h2>
                    <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <label class="form-check-label ml-0 sm:ml-2" for="show-example-1">Show example code</label>
                        <input data-target="#simple-editor" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-1">
                    </div>
                </div>
                <div class="p-5" id="simple-editor">
                    <div class="preview">
                        <div data-simple-toolbar="true" class="editor">
                            <p>Content of the editor.</p>
                        </div>
                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-simple-editor" class="copy-code btn py-1 px-2 btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                            <pre class="source-preview" id="copy-simple-editor">
                                <code class="text-xs p-0 rounded-md html pl-5 pt-8 pb-4 -mb-10 -mt-10">
                                    {{ \Hp::formatCode('
                                        <div data-simple-toolbar="true" class="editor">
                                            <p>Content of the editor.</p>
                                        </div>
                                    ') }}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Simple Editor -->
        <!-- BEGIN: Standard Editor -->
        <div class="col-span-12 lg:col-span-6">
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Standard Editor</h2>
                    <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <label class="form-check-label ml-0 sm:ml-2" for="show-example-2">Show example code</label>
                        <input data-target="#standard-editor" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-2">
                    </div>
                </div>
                <div class="p-5" id="standard-editor">
                    <div class="preview">
                        <div class="editor">
                            <p>Content of the editor.</p>
                        </div>
                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-standard-editor" class="copy-code btn py-1 px-2 btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                            <pre class="source-preview" id="copy-standard-editor">
                                <code class="text-xs p-0 rounded-md html pl-5 pt-8 pb-4 -mb-10 -mt-10">
                                    {{ \Hp::formatCode('
                                        <div class="editor">
                                            <p>Content of the editor.</p>
                                        </div>
                                    ') }}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Standard Editor -->
        <!-- BEGIN: Inline Editor -->
        <div class="col-span-12 lg:col-span-6">
        <div class="mt-3">
                                <label>Textarea</label>
                                <div class="mt-2">
                                    <textarea data-feature="basic" class="summernote" name="editor" style="display: none;"></textarea><div class="note-editor note-frame"><div class="note-dropzone"><div class="note-dropzone-message"></div></div><div class="note-toolbar" role="toolbar"><div class="note-btn-group note-font"><button type="button" class="note-btn note-btn-bold" tabindex="-1" aria-label="Bold (CTRL+B)"><i class="note-icon-bold"></i></button><button type="button" class="note-btn note-btn-underline" tabindex="-1" aria-label="Underline (CTRL+U)"><i class="note-icon-underline"></i></button><button type="button" class="note-btn note-btn-italic" tabindex="-1" aria-label="Italic (CTRL+I)"><i class="note-icon-italic"></i></button></div></div><div class="note-editing-area"><div class="note-placeholder" style="display: block;">Hello stand alone ui</div><div class="note-handle"><div class="note-control-selection"><div class="note-control-selection-bg"></div><div class="note-control-holder note-control-nw"></div><div class="note-control-holder note-control-ne"></div><div class="note-control-holder note-control-sw"></div><div class="note-control-sizing note-control-se"></div><div class="note-control-selection-info"></div></div></div><textarea class="note-codable" aria-multiline="true"></textarea><div class="note-editable" contenteditable="true" role="textbox" aria-multiline="true" spellcheck="true" autocorrect="true" style="height: 120px;"><p><br></p></div></div><output class="note-status-output" role="status" aria-live="polite"></output><div class="note-statusbar" role="status"><div class="note-resizebar" aria-label="resize"><div class="note-icon-bar"></div><div class="note-icon-bar"></div><div class="note-icon-bar"></div></div></div><div class="note-modal link-dialog" aria-hidden="false" tabindex="-1" role="dialog" aria-label="Insert Link"><div class="note-modal-content"><div class="note-modal-header"><button type="button" class="close" aria-label="Close" aria-hidden="true"><i class="note-icon-close"></i></button><h4 class="note-modal-title">Insert Link</h4></div><div class="note-modal-body"><div class="form-group note-form-group"><label for="note-dialog-link-txt-16303945933211" class="note-form-label">Text to display</label><input id="note-dialog-link-txt-16303945933211" class="note-link-text form-control note-form-control note-input" type="text"></div><div class="form-group note-form-group"><label for="note-dialog-link-url-16303945933211" class="note-form-label">To what URL should this link go?</label><input id="note-dialog-link-url-16303945933211" class="note-link-url form-control note-form-control note-input" type="text" value="http://"></div><div class="checkbox sn-checkbox-open-in-new-window"><label><input role="checkbox" type="checkbox" checked="" aria-checked="true">Open in new window</label></div><div class="checkbox sn-checkbox-use-protocol"><label><input role="checkbox" type="checkbox" checked="" aria-checked="true">Use default protocol</label></div></div><div class="note-modal-footer"><input type="button" href="#" class="btn btn-primary note-btn note-btn-primary note-link-btn" value="Insert Link" disabled=""></div></div></div><div class="note-popover bottom note-link-popover" style="display: none;"><div class="note-popover-arrow"></div><div class="popover-content note-children-container"><span><a target="_blank"></a>&nbsp;</span><div class="note-btn-group note-link"><button type="button" class="note-btn" tabindex="-1" aria-label="Edit"><i class="note-icon-link"></i></button><button type="button" class="note-btn" tabindex="-1" aria-label="Unlink"><i class="note-icon-chain-broken"></i></button></div></div></div><div class="note-modal" aria-hidden="false" tabindex="-1" role="dialog" aria-label="Insert Image"><div class="note-modal-content"><div class="note-modal-header"><button type="button" class="close" aria-label="Close" aria-hidden="true"><i class="note-icon-close"></i></button><h4 class="note-modal-title">Insert Image</h4></div><div class="note-modal-body"><div class="form-group note-form-group note-group-select-from-files"><label for="note-dialog-image-file-16303945933211" class="note-form-label">Select from files</label><input id="note-dialog-image-file-16303945933211" class="note-image-input form-control-file note-form-control note-input" type="file" name="files" accept="image/*" multiple="multiple"></div><div class="form-group note-group-image-url"><label for="note-dialog-image-url-16303945933211" class="note-form-label">Image URL</label><input id="note-dialog-image-url-16303945933211" class="note-image-url form-control note-form-control note-input" type="text"></div></div><div class="note-modal-footer"><input type="button" href="#" class="btn btn-primary note-btn note-btn-primary note-image-btn" value="Insert Image" disabled=""></div></div></div><div class="note-popover bottom note-image-popover" style="display: none;"><div class="note-popover-arrow"></div><div class="popover-content note-children-container"><div class="note-btn-group note-resize"><button type="button" class="note-btn" tabindex="-1" aria-label="Resize full"><span class="note-fontsize-10">100%</span></button><button type="button" class="note-btn" tabindex="-1" aria-label="Resize half"><span class="note-fontsize-10">50%</span></button><button type="button" class="note-btn" tabindex="-1" aria-label="Resize quarter"><span class="note-fontsize-10">25%</span></button><button type="button" class="note-btn" tabindex="-1" aria-label="Original size"><i class="note-icon-rollback"></i></button></div><div class="note-btn-group note-float"><button type="button" class="note-btn" tabindex="-1" aria-label="Float Left"><i class="note-icon-float-left"></i></button><button type="button" class="note-btn" tabindex="-1" aria-label="Float Right"><i class="note-icon-float-right"></i></button><button type="button" class="note-btn" tabindex="-1" aria-label="Remove float"><i class="note-icon-rollback"></i></button></div><div class="note-btn-group note-remove"><button type="button" class="note-btn" tabindex="-1" aria-label="Remove Image"><i class="note-icon-trash"></i></button></div></div></div><div class="note-popover bottom note-table-popover" style="display: none;"><div class="note-popover-arrow"></div><div class="popover-content note-children-container"><div class="note-btn-group note-add"><button type="button" class="note-btn btn-md" tabindex="-1" aria-label="Add row below"><i class="note-icon-row-below"></i></button><button type="button" class="note-btn btn-md" tabindex="-1" aria-label="Add row above"><i class="note-icon-row-above"></i></button><button type="button" class="note-btn btn-md" tabindex="-1" aria-label="Add column left"><i class="note-icon-col-before"></i></button><button type="button" class="note-btn btn-md" tabindex="-1" aria-label="Add column right"><i class="note-icon-col-after"></i></button></div><div class="note-btn-group note-delete"><button type="button" class="note-btn btn-md" tabindex="-1" aria-label="Delete row"><i class="note-icon-row-remove"></i></button><button type="button" class="note-btn btn-md" tabindex="-1" aria-label="Delete column"><i class="note-icon-col-remove"></i></button><button type="button" class="note-btn btn-md" tabindex="-1" aria-label="Delete table"><i class="note-icon-trash"></i></button></div></div></div><div class="note-modal" aria-hidden="false" tabindex="-1" role="dialog" aria-label="Insert Video"><div class="note-modal-content"><div class="note-modal-header"><button type="button" class="close" aria-label="Close" aria-hidden="true"><i class="note-icon-close"></i></button><h4 class="note-modal-title">Insert Video</h4></div><div class="note-modal-body"><div class="form-group note-form-group row-fluid"><label for="note-dialog-video-url-16303945933211" class="note-form-label">Video URL <small class="text-muted">(YouTube, Vimeo, Vine, Instagram, DailyMotion or Youku)</small></label><input id="note-dialog-video-url-16303945933211" class="note-video-url form-control note-form-control note-input" type="text"></div></div><div class="note-modal-footer"><input type="button" href="#" class="btn btn-primary note-btn note-btn-primary note-video-btn" value="Insert Video" disabled=""></div></div></div><div class="note-modal" aria-hidden="false" tabindex="-1" role="dialog" aria-label="Help"><div class="note-modal-content"><div class="note-modal-header"><button type="button" class="close" aria-label="Close" aria-hidden="true"><i class="note-icon-close"></i></button><h4 class="note-modal-title">Help</h4></div><div class="note-modal-body" style="max-height: 300px; overflow: scroll;"><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>ENTER</kbd></label><span>Insert Paragraph</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+Z</kbd></label><span>Undoes the last command</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+Y</kbd></label><span>Redoes the last command</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>TAB</kbd></label><span>Tab</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>SHIFT+TAB</kbd></label><span>Untab</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+B</kbd></label><span>Set a bold style</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+I</kbd></label><span>Set a italic style</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+U</kbd></label><span>Set a underline style</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+SHIFT+S</kbd></label><span>Set a strikethrough style</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+BACKSLASH</kbd></label><span>Clean a style</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+SHIFT+L</kbd></label><span>Set left align</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+SHIFT+E</kbd></label><span>Set center align</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+SHIFT+R</kbd></label><span>Set right align</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+SHIFT+J</kbd></label><span>Set full align</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+SHIFT+NUM7</kbd></label><span>Toggle unordered list</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+SHIFT+NUM8</kbd></label><span>Toggle ordered list</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+LEFTBRACKET</kbd></label><span>Outdent on current paragraph</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+RIGHTBRACKET</kbd></label><span>Indent on current paragraph</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+NUM0</kbd></label><span>Change current block's format as a paragraph(P tag)</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+NUM1</kbd></label><span>Change current block's format as H1</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+NUM2</kbd></label><span>Change current block's format as H2</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+NUM3</kbd></label><span>Change current block's format as H3</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+NUM4</kbd></label><span>Change current block's format as H4</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+NUM5</kbd></label><span>Change current block's format as H5</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+NUM6</kbd></label><span>Change current block's format as H6</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+ENTER</kbd></label><span>Insert horizontal rule</span><div class="help-list-item"></div><label style="width: 180px; margin-right: 10px;"><kbd>CTRL+K</kbd></label><span>Show Link Dialog</span></div><div class="note-modal-footer"><p class="text-center"><a href="http://summernote.org/" target="_blank">Summernote 0.8.16</a> · <a href="https://github.com/summernote/summernote" target="_blank">Project</a> · <a href="https://github.com/summernote/summernote/issues" target="_blank">Issues</a></p></div></div></div></div>
                                </div>
                            </div>
        </div>
        <!-- END: Inline Editor -->
        <!-- BEGIN: Balloon Editor -->
        <div class="col-span-12 lg:col-span-6">
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Balloon Editor</h2>
                    <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <label class="form-check-label ml-0 sm:ml-2" for="show-example-4">Show example code</label>
                        <input data-target="#balloon-editor" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-4">
                    </div>
                </div>
                <div class="p-5" id="balloon-editor">
                    <div class="preview">
                        <div data-editor="balloon" class="editor">
                            <p>Content of the editor.</p>
                        </div>
                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-balloon-editor" class="copy-code btn py-1 px-2 btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                            <pre class="source-preview" id="copy-balloon-editor">
                                <code class="text-xs p-0 rounded-md html pl-5 pt-8 pb-4 -mb-10 -mt-10">
                                    {{ \Hp::formatCode('
                                        <div data-editor="balloon" class="editor">
                                            <p>Content of the editor.</p>
                                        </div>
                                    ') }}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Balloon Editor -->
        <!-- BEGIN: Document Editor -->
        <div class="col-span-12">
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">Document Editor</h2>
                    <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <label class="form-check-label ml-0 sm:ml-2" for="show-example-5">Show example code</label>
                        <input data-target="#document-editor" class="show-code form-check-switch mr-0 ml-3" type="checkbox" id="show-example-5">
                    </div>
                </div>
                <div class="p-5" id="document-editor">
                    <div class="preview">
                        <div data-editor="document" class="editor document-editor">
                            <div class="document-editor__toolbar"></div>
                            <div class="document-editor__editable-container">
                                <div class="document-editor__editable">
                                    <p>Content of the editor.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-document-editor" class="copy-code btn py-1 px-2 btn-outline-secondary">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                        </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                            <pre class="source-preview" id="copy-document-editor">
                                <code class="text-xs p-0 rounded-md html pl-5 pt-8 pb-4 -mb-10 -mt-10">
                                    {{ \Hp::formatCode('
                                        <div data-editor="document" class="editor document-editor">
                                            <div class="document-editor__toolbar"></div>
                                            <div class="document-editor__editable-container">
                                                <div class="document-editor__editable">
                                                    <p>Content of the editor.</p>
                                                </div>
                                            </div>
                                        </div>
                                    ') }}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Document Editor -->
    </div>    
@endsection