@push('alpine-components')
    <script>
        window.bitflanHtmlCodeEditorComponent = function() {
            return {
                editor: null,
                srcdoc: '',

                init() {
                    this.editor = ace.edit(this.$refs.editor_input);
                    this.editor.setOption("showPrintMargin", false);
                    this.editor.setOption("wrap", true);

                    this.editor.setTheme("ace/theme/clouds");
                    this.editor.session.setMode("ace/mode/html");

                    this.editor.session.on('change', () => {
                        this.srcdoc = this.editor.session.getValue();
                    });

                    let tmpl = '<html><head></head><body>{content}</body></html>';

                    this.$watch('srcdoc', () => this.$refs.frame.srcdoc = tmpl.replace('{content}', this.srcdoc));
                },
                clean(){
                    this.editor.session.setValue('');
                }
            }
        }
    </script>
@endpush

<div x-data="window.bitflanHtmlCodeEditorComponent()">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group d-flex justify-content-between align-items-center">
                <label class="custom-label m-0">{{ trans('webtools/tools/html-code-editor.title') }}</label>
                <button x-on:click="clean()" class="btn custom--btn button__sm">{{ trans('webtools/tools/html-code-editor.clean') }}</button>
            </div>
            <div x-ref="editor_input" id="editor"></div>
        </div>
        <div class="col-lg-6 d-flex flex-column">
            <div class="form-group">
                <label class="custom-label">{{ trans('webtools/tools/html-code-editor.preview') }}</label>
            </div>
            <iframe class="card w-100 flex-grow-1 p-3" src="javascript:' '" x-ref="frame" frameborder="0"></iframe>
        </div>
    </div>
</div>
