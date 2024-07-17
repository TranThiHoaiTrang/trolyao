$(function () {
    'use strict';

    // codemirror
    const codemirror = $(".codemirror");
    if(codemirror.length) {

        let options = {
            mode: 'htmlmixed',
            lineNumbers: true,
            lineWrapping: true,
            styleActiveLine: true,
            autoCloseBrackets: true,
            autoCloseTags: true,
            tabSize: 2,
            indentUnit: 2,
            indentWithTabs: true,
            autoRefresh: true,
        };

        $.each(codemirror, function( index, value ) {
            let editor = CodeMirror.fromTextArea(value, options);
            editor.on("blur", function() {
                editor.save();
            });
        });
    }
});
