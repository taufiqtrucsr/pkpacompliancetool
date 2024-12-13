
function quilljs_textarea_goaladd(elem = null, options = null) {
    if(elem) {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll(elem));
    } else {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll('[data-quilljs-goaladd]'));
    }
    editorElems.forEach(function(el) {
    if(elem && el.hasAttribute("data-quilljs-goaladd")) {
        return;
    }
    var elemType = el.type;
    if(elemType == 'textarea') {
        elemValue = el.value;
        editorDiv = document.createElement('div');
        editorDiv.innerHTML = elemValue;
        el.parentNode.insertBefore(editorDiv, el.nextSibling);
        el.style.display = "none";
        var placeholder = el.placeholder;
    } else {
        var placeholder = null;
        editorDiv = el;   
    }
    if(!options) {
        var default_options = {
        theme: 'snow',
        placeholder: placeholder,
        };
    } else {
        if(!options.placeholder) {
        options.placeholder = placeholder;
        }
        var default_options = options;
    }
	
	var limit = 750;
    var editor = new Quill(editorDiv, default_options);
    editor.on('text-change', function(delta, oldDelta, source) {
		var text = editor.getText();
		text = text.trim();
		//alert(text.split(/\s+/).length);
		if (text.split(/\s+/).length > limit) {
			//alert(111111);
			editor.deleteText(limit, text.split(/\s+/).length);
		}
        var editor_value = editor.root.innerHTML;
        el.value = editor_value;
    });
    });
}


(function() {
    quilljs_textarea_goaladd();
})();