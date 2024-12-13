function quilljs_textarea(elem = null, options = null) {
    if(elem) {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll(elem));
    } else {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll('[data-quilljs]'));
    }
    editorElems.forEach(function(el) {
    if(elem && el.hasAttribute("data-quilljs")) {
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
	
	// var limit = 500;
    var limit = 4999;
    var editor = new Quill(editorDiv, default_options);
    editor.on('text-change', function(delta, oldDelta, source) {
		var n_length = editor.getLength();
        // alert(length);
        var text = editor.getText();
        var len_1 = text.length;
        // alert(len_1);
		// text = text.trim();
		//alert(text.split(/\s+/).length);
        // if (text.split(/\s+/).length >= 500) {
        // if (text.split(/\s+/).length >= 5) {
            if (n_length >= 5000) {
			// alert(11111);
			// editor.deleteText(limit,text.length);
            // editor.deleteText(n_length,text.length);
            editor.deleteText(limit,6);
            $("#warning_msg").css("display","block");
		// }else if(text.split(/\s+/).length < 5000){
        }else if(n_length < 5000){
            $("#warning_msg").css("display","none");
        }
		// if (text.split(/\s+/).length > limit) {
		// 	//alert(111111);
		// 	editor.deleteText(limit, text.split(/\s+/).length);
		// }
        var editor_value = editor.root.innerHTML;
        el.value = editor_value;
    });
    });
}

function quilljs_textarea_prob(elem = null, options = null) {
    if(elem) {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll(elem));
    } else {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll('[data-quilljs-prob]'));
    }
    editorElems.forEach(function(el) {
    if(elem && el.hasAttribute("data-quilljs-prob")) {
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
	
	var limit = 150;
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


function quilljs_textarea_goal(elem = null, options = null) {
    if(elem) {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll(elem));
    } else {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll('[data-quilljs-goal]'));
    }
    editorElems.forEach(function(el) {
    if(elem && el.hasAttribute("data-quilljs-goal")) {
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

function quilljs_campaignname(elem = null, options = null) {
    if(elem) {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll(elem));
    } else {
        var editorElems = Array.prototype.slice.call(document.querySelectorAll('[data-quilljs]'));
    }
    editorElems.forEach(function(el) {
    if(elem && el.hasAttribute("data-quilljs")) {
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
	
	var limit = 250;
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
    quilljs_textarea();
    quilljs_textarea_prob();
	quilljs_textarea_goal();
    quilljs_textarea_goaladd();
    quilljs_campaignname();
})();