var OWSAnswer = {
	init : function(options, elem) {
		this.elem = elem;
		this.$elem = $(elem);
		// Mix in the passed in options with the default options
		this.options = $.extend( {}, this.options, options);
		this.displayListAnswer();
	},
	options : {
		formId : 'adminForm',
		type : 1,
		choices : [],
		placeholderText: '',
		minAnswerNumber: 5
	},
	displayListAnswer : function() {
		var choices = this.options.choices,
			listAnswerHtml = '<ul class="unstyled">',
			totalChoice, type;
		if(choices.length < this.options.minAnswerNumber){
			for(var j = choices.length; j < this.options.minAnswerNumber; j++){
				choices.push({correctAnswer:false, value: ''});
			}
		}
		totalChoice = choices.length;
		for ( var i = 0; i < totalChoice; i++) {
			switch (this.options.type) {
			case 1:
			case 2:
				if(this.options.type == 1){
					type = 'radio';
				}else{
					type = 'checkbox';
				}
				listAnswerHtml += this.displayAnswer(type, choices[i].value, choices[i].correctAnswer);
				break;
			}
		}
		listAnswerHtml += '</ul>';
		this.$elem.html(listAnswerHtml);
		this.bindAddNewAnswer();
		this.bindDeleteAnswer();
	},
	/*
	 * @param type radio or checkbox
	 * @param value answer text
	 * @param correctAnswer true or false answer
	 */
	displayAnswer: function(type, value, correctAnswer){
		var html = '';
		html += '<li class="' + type + '">';
		if (correctAnswer) {
			html += '<input type="' + type + '" name="answer_group" checked="checked" />';
		} else {
			html += '<input type="' + type + '" name="answer_group" />';
		}
		html += '<input type="text" name="answer_text" value="' + value + '" placeholder="' + this.options.placeholderText + '" />';
		html += '<a href="javascript:;" class="answer-delete"><i class="icon-remove"></i></a>';
		html += '</li>';
		return html;
	},
	getAnswerData : function() {
		var choices = [];
		switch (this.options.type) {
		case 1:
		case 2:
			this.$elem.find('input[name=answer_group]').each(function() {
				var choice = {};
				choice.value = $(this).next().val();
				if(choice.value !== ''){
					if($(this).attr('checked')){
						choice.correctAnswer = true;
					}else{
						choice.correctAnswer = false;
					}
					choices.push(choice);
				}
			});
			break;
		}
		return JSON.stringify(choices);
	},
	bindAddNewAnswer: function(){
		var self = this;
		this.$elem.on('focusin', 'input[name=answer_text]:last', function(){
			self.addNewAnswer();
			self.bindDeleteAnswer();
		});
		
	},
	addNewAnswer : function(){
		switch(this.options.type){
		case 1:
		case 2:
			if(this.options.type == 1){
				type = 'radio';
			}else{
				type = 'checkbox';
			}
			this.$elem.find('ul').append(this.displayAnswer(type, '', false));
			break;
		}
	},
	bindDeleteAnswer: function(){
		var self = this;
		var listAnswer = $('#' + this.elem.id + ' ul').children();
		if(listAnswer.length > 5){
			$.each(listAnswer, function(i, item){
				$(item).find('.answer-delete').on('click', function(){
					$(item).remove();
					self.bindDeleteAnswer();
				});
			});
		}else{
			$.each(listAnswer, function(i, item){
				$(item).find('.answer-delete').off('click');
			});
		}
	}
};

if (typeof Object.create !== 'function') {
	Object.create = function(o) {
		function F() {
		} // optionally move this outside the declaration and into
		// a closure if you need more speed.
		F.prototype = o;
		return new F();
	};
};
(function($) {
	// Start a plugin
	$.fn.owsAnswer = function(options) {
		// Don't act on absent elements -via Paul Irish's advice
		if (this.length) {
			return this.each(function() {
				// Create a new speaker object via the Prototypal Object.create
				var owsAnswer = Object.create(OWSAnswer);

				// Run the initialization function of the speaker
				owsAnswer.init(options, this); // `this` refers to the element

				// Save the instance of the speaker object in the element's data
				// store
				$.data(this, 'owsAnswer', owsAnswer);
			});
		}
	};
})(jQuery);