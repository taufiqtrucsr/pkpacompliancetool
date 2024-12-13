(function() {
	var Counter = function (quilljs_textarea, options) {
	  this.quilljs_textarea = quilljs_textarea;
	  this.options = options;
	  this.container = document.querySelector(options.container);
	  quilljs_textarea.on('text-change', this.update.bind(this));
	  this.update(); // Account for initial contents
	};

	Counter.prototype.calculate = function () {
	  var text = this.quilljs_textarea.getText();
	  if (this.options.unit === 'word') {
		text = text.trim();
		// Splitting empty text returns a non-empty array
		return text.length > 0 ? text.split(/\s+/).length : 0;
	  } else {
		return text.length;
	  }
	};

	Counter.prototype.update = function () {
	  var length = this.calculate();
	  
	  var label = this.options.unit;
	  if (length !== 1) {
		label += 's';
	  }
	  this.container.innerHTML = length + '&nbsp;' +label;
	  // if(length > 10){
		  // alert(111111);
	  // }
	}

	Quill.register('modules/counter', Counter);
	quilljs_textarea('.quilljs-textarea', {
	modules: {
		// counter: { container: "#counter", unit: 'word' },
		counter: { container: "#counter", unit: 'character' },
		toolbar:[
		[{font:[]},{size:[]}],
		["bold","italic","underline","strike"],
		[{color:[]},{background:[]}],
		[{script:"super"},{script:"sub"}],
		[{header:[!1,1,2,3,4,5,6]},"blockquote","code-block"],
		[{list:"ordered"},{list:"bullet"},{indent:"-1"},{indent:"+1"}],
		["direction",{align:[]}],
		["link","image","video"],
		["clean"] 
	]},
	// placeholder: 'Enter Project Description here',
	theme: 'snow',
	});
	
	var CounterProb = function (quilljs_textarea_prob, options) {
	  this.quilljs_textarea_prob = quilljs_textarea_prob;
	  this.options = options;
	  this.container = document.querySelector(options.container);
	  quilljs_textarea_prob.on('text-change', this.update.bind(this));
	  this.update(); // Account for initial contents
	};

	CounterProb.prototype.calculate = function () {
	  var text = this.quilljs_textarea_prob.getText();
	  if (this.options.unit === 'word') {
		text = text.trim();
		// Splitting empty text returns a non-empty array
		return text.length > 0 ? text.split(/\s+/).length : 0;
	  } else {
		return text.length;
	  }
	};

	CounterProb.prototype.update = function () {
	  var length = this.calculate();
	  
	  var label = this.options.unit;
	  if (length !== 1) {
		label += 's';
	  }
	  this.container.innerHTML = length + ' ' + label;
	  // if(length > 10){
		  // alert(111111);
	  // }
	}

	Quill.register('modules/counterprob', CounterProb);
	quilljs_textarea_prob('.quilljs-textarea-prob', {
	modules: {
		counterprob: { container: "#prob-counter", unit: 'word' },
		toolbar:[
		[{font:[]},{size:[]}],
		["bold","italic","underline","strike"],
		[{color:[]},{background:[]}],
		[{script:"super"},{script:"sub"}],
		[{header:[!1,1,2,3,4,5,6]},"blockquote","code-block"],
		[{list:"ordered"},{list:"bullet"},{indent:"-1"},{indent:"+1"}],
		["direction",{align:[]}],
		["link","image","video"],
		["clean"] 
	]},
	placeholder: 'Enter Project Description here.',
	theme: 'snow',
	});
	
	
	var Goal = function (quilljs_textarea_goal, options) {
	  this.quilljs_textarea_goal = quilljs_textarea_goal;
	  this.options = options;
	  this.container = document.querySelector(options.container);
	  quilljs_textarea_goal.on('text-change', this.update.bind(this));
	  this.update(); // Account for initial contents
	};

	Goal.prototype.calculate = function () {
	  var text = this.quilljs_textarea_goal.getText();
	  if (this.options.unit === 'word') {
		text = text.trim();
		// Splitting empty text returns a non-empty array
		return text.length > 0 ? text.split(/\s+/).length : 0;
	  } else {
		return text.length;
	  }
	};

	Goal.prototype.update = function () {
	  var length = this.calculate();
	  
	  var label = this.options.unit;
	  if (length !== 1) {
		label += 's';
	  }
	  this.container.innerHTML = length + ' ' + label;
	  // if(length > 10){
		  // alert(111111);
	  // }
	}
	//alert($("#total_goal-counter").val())
	totalCounter = $("#total_goal-counter").val();
	Quill.register('modules/goal', Goal);
	var i = 1;
	for(i;i<=totalCounter;i++){
	quilljs_textarea_goal('.quilljs-textarea-goal_'+i, {
	modules: {
		goal: { container: "#goal-counter_"+i, unit: 'word'},
		toolbar:[
		[{font:[]},{size:[]}],
		["bold","italic","underline","strike"],
		[{color:[]},{background:[]}],
		[{script:"super"},{script:"sub"}],
		[{header:[!1,1,2,3,4,5,6]},"blockquote","code-block"],
		[{list:"ordered"},{list:"bullet"},{indent:"-1"},{indent:"+1"}],
		["direction",{align:[]}],
		["link","image","video"],
		["clean"] 
	]},
	placeholder: 'Enter Goal Description here.',
	theme: 'snow',
	});
	}
	
	
	var Counter = function (quilljs_campaignname, options) {
	  this.quilljs_campaignname = quilljs_campaignname;
	  this.options = options;
	  this.container = document.querySelector(options.container);
	  quilljs_campaignname.on('text-change', this.update.bind(this));
	  this.update(); // Account for initial contents
	};

	Counter.prototype.calculate = function () {
	  var text = this.quilljs_campaignname.getText();
	  if (this.options.unit === 'word') {
		text = text.trim();
		// Splitting empty text returns a non-empty array
		return text.length > 0 ? text.split(/\s+/).length : 0;
	  } else {
		return text.length;
	  }
	};

	Counter.prototype.update = function () {
	  var length = this.calculate();
	  
	  var label = this.options.unit;
	  if (length !== 1) {
		label += 's';
	  }
	  this.container.innerHTML = length + '' + label;
	  // if(length > 10){
		  // alert(111111);
	  // }
	}

	Quill.register('modules/counter', Counter);
	quilljs_campaignname('.quilljs-campaignname', {
	modules: {
		counter: { container: "#campaign-counter", unit: 'word' },
		toolbar:[
		[{font:[]},{size:[]}],
		["bold","italic","underline","strike"],
		[{color:[]},{background:[]}],
		[{script:"super"},{script:"sub"}],
		[{header:[!1,1,2,3,4,5,6]},"blockquote","code-block"],
		[{list:"ordered"},{list:"bullet"},{indent:"-1"},{indent:"+1"}],
		["direction",{align:[]}],
		["link","image","video"],
		["clean"] 
	]},
	placeholder: 'Enter a campaign name.',
	theme: 'snow',
	});
	
})();