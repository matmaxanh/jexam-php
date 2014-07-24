var OWSGrid = {
	init : function(options, elem) {
		// Mix in the passed in options with the default options
		this.options = $.extend( {}, this.options, options);

		// Save the element reference, both as a jQuery
		// reference and a normal reference
		this.elem = elem;
		this.$elem = $(elem);
		this.containerId = this.elem.id;
		this.baseUrl = this.options.url;
		this.checkedString = this.options.checkedValues = '';
		this.listen();
		
		if(this.options.actions !== {}){
			var self = this;
			$.each(self.options.actions, function(action, option) {
				  $("#" + option.id).bind('click', function(){
					  self.apply(action);
				  });
			});
		}
		
		// return this so we can chain/use the bridge with less code.
		return this;
	},

	options : {
		url: '',
		exportUrl: '',
		actions: {},
		pageVar : false,
        sortVar : false,
        dirVar : false,
        filterVar : false,
		formFieldNameInternal : 'item',
		checkedValues: '',
		gridIds: '',
		checkValidate: false
	},
	
	listen: function(){
		var self = this;
		this.reloadParams = {};
		this.count = $("#grid_count");
		this.rows = $("#" + this.containerId + " table tbody tr");
		if(this.options.sortVar && this.options.dirVar){
			$('#'+this.containerId + ' table thead a').click(function(){
				self.doSort(this, self);
			});
        }
		$("input[type=checkbox]", this.rows).click(function(){
			self.setCheckbox(this);
		});
		$("#" + this.containerId + " table thead tr th input[type=checkbox]").click(function(){
    		if(this.checked){
    			self.selectVisible();
    		}else{
    			self.unselectVisible();
    		}
    	});
		this.checkCheckboxes();
		this.updateCount();
	},

	checkCheckboxes: function() {
    	var checkedString = this.checkedString;
        $.each(this.getCheckboxes(), function(index, checkbox) {
        	$(checkbox).attr('checked', OWSStringArray.has($(checkbox).val(), checkedString));
        });
    },
    selectVisible: function() {
        this.setCheckedValues(this.getCheckboxesValuesAsString());
        this.checkCheckboxes();
        this.updateCount();
        return false;
    },
    unselectVisible: function() {
    	var checkedString = this.checkedString;
        $.each(this.getCheckboxesValues(), function(index, value){
        	checkedString = OWSStringArray.remove(value, checkedString);
        });
        this.checkedString = checkedString;
        this.checkCheckboxes();
        this.updateCount();
        return false;
    },
	setCheckedValues : function(values) {
		this.checkedString = values;
	},
	getCheckedValues : function() {
		return this.checkedString;
	},
	getCheckboxes : function() {
		var result = [];
		this.rows.each(function(index) {
			var checkboxes = $(this).find('.row-checkbox');
			checkboxes.each(function() {
				result.push($(this));
			});
		});
		return result;
	},
	getCheckboxesValues : function() {
		var result = [];
		$.each(this.getCheckboxes(), function(index, checkbox) {
			result.push(checkbox.val());
		});
		return result;
	},
	getCheckboxesValuesAsString : function() {
		return this.getCheckboxesValues().join(',');
	},
	setCheckbox : function(checkbox) {
		if (checkbox.checked) {
			this.checkedString = OWSStringArray.add(checkbox.value,
					this.checkedString);
		} else {
			this.checkedString = OWSStringArray.remove(checkbox.value,
					this.checkedString);
		}
		this.updateCount();
	},
	updateCount : function() {
		this.count.html(OWSStringArray.count(this.checkedString));
		if (!this.reloadParams) {
			this.reloadParams = {};
		}
		this.reloadParams[this.options.formFieldNameInternal] = this.checkedString;
	},
	inputPage : function(event, maxNum){
        var element = event.srcElement;
        var keyCode = event.keyCode || event.which;
        if(keyCode == 13){
            this.setPage(element.value);
        }
    },
    setPage : function(pageNumber){
        this.reload(this.addVarToUrl(this.options.pageVar, pageNumber), false);
    },
    loadByElement : function(name, value){
        this.reload(this.addVarToUrl(name, value), false);
    },
    filterDay: function(day){
    	this.options.url = this.baseUrl;
    	this.reload(this.addVarToUrl('day', day), true);
    },
    doSort: function(element, self){
		var sortField,
			direction;
		sortField = self._getParameterByName(element.search, 'sort');
		direction = self._getParameterByName(element.search, 'direction');
		if(sortField.length && direction.length){
			self.addVarToUrl(self.options.filterVar, self.getFilter());
			self.addVarToUrl(self.options.sortVar, sortField);
			self.addVarToUrl(self.options.dirVar, direction);
			self.reload(self.options.url, true);
		}
		return false;
    },
    doFilter : function(){
    	if(this.options.checkValidate && !this.validate()){
    		return false;
    	}
    	this.reload(this.addVarToUrl(this.options.filterVar, this.getFilter()), true);
    },
    getFilter : function(){
    	var elements = {};
        $('#' + this.containerId + ' .filter input, #' + this.containerId + ' .filter select').each(function(){
        	var value = $(this).val();
        	if(value && value.length){
        		elements[$(this).attr('name')] = value;
        	}
        });
        return $.base64.encode($.param(elements));
    },
    resetFilter : function(){
    	$('#'+this.containerId+' .filter input, #'+this.containerId+' .filter select').each(function(){
    		$(this).val('');
    	});	 
        return false;
    },
    doExport : function(){
        if(this.options.exportUrl){
        	var exportUrl;
        	if(this.checkedString != ''){
        		exportUrl = this._addVarToUrl(this.options.exportUrl, this.options.formFieldNameInternal + "_ids", this.checkedString);
        	}else{
        		exportUrl = this._addVarToUrl(this.options.exportUrl, this.options.filterVar, this.getFilter());
        	}
        	location.href = exportUrl;
        }
    },
    
    getAction: function(action) {
        if(this.options.actions[action]) {
            return this.options.actions[action];
        }
        return false;
    },
    apply: function(actionName){
    	var self = this;
    	if(OWSStringArray.count(this.checkedString) == 0) {
            alert('Please check a item.');
            return false;
        }
    	var action = this.getAction(actionName);
    	if(action.confirm && !window.confirm(action.confirm)) {
            return false;
        }
    	if(action !== false){
    		this.reloadParams['action'] = actionName;
        	this.reload(this.options.url, true);
    	}
    	return false;
    },
    reload : function(url, resetFilter){
    	var self = this;
    	var containerId = this.containerId;
        url = url || this.options.url;
        $.blockUI({
	        css: {
	            border: 'none',
	            padding: '15px',
	            backgroundColor: '#000',
	            '-webkit-border-radius': '10px',
	            '-moz-border-radius': '10px',
	            opacity: .5,
	            color: '#fff',
	            cursor: 'wait'
	        }
        });
        $.ajax({
        	url: url,
        	type: 'post',
        	data: this.reloadParams || {},
        	error: this._processFailure,
        	success: function(responseText) {
            	$('#' + containerId).html(responseText);
            	if(resetFilter){
            		self.checkedString = self.options.checkedValues = '';
            	}
            	self.listen();
            	$.unblockUI();
        	}
        });
        return;
    },
    _processFailure : function(transport){
//        location.reload();
    },
    _addVarToUrl : function(url, varName, valValue){
        var newAdditionalURL = "";
        var tempArray = url.split("?");
        var baseURL = tempArray[0];
        var aditionalURL = tempArray[1]; 
        var temp = "";
        if(aditionalURL){
            var tempArray = aditionalURL.split("&");
            for ( i=0; i<tempArray.length; i++ ){
                if( tempArray[i].split('=')[0] != varName ){
                    newAdditionalURL += temp+tempArray[i];
                    temp = "&";
                }
            }
        }
        return baseURL + "?" + newAdditionalURL + temp + "" + varName + "=" + valValue;
    },
    addVarToUrl : function(varName, varValue){
    	this.options.url = this._addVarToUrl(this.options.url, varName, varValue);
        return this.options.url;
    },
    _getParameterByName: function(urlSearch, name){
	  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	  var regexS = "[\\?&]" + name + "=([^&#]*)";
	  var regex = new RegExp(regexS);
	  var results = regex.exec(urlSearch);
	  if(results == null)
	    return "";
	  else
	    return decodeURIComponent(results[1].replace(/\+/g, " "));
	},
	validate: function(){
		var result = true;
		$('#' + this.containerId + ' .filter input').each(function(){
			var value = $(this).val();
			if($(this).hasClass('digits') && value){
				result = /^\d+$/.test($(this).val());
				if(!result){
					$(this).addClass('error');
				}else{
					$(this).removeClass('error');
				}
			}
		});
		if(!result){
			alert("Please enter only digits.");
		}
		return result;
	}
};
var OWSStringArray = {
	remove : function(str, haystack) {
		haystack = ',' + haystack + ',';
		haystack = haystack.replace(new RegExp(',' + str + ',', 'g'), ',');
		return this.trimComma(haystack);
	},
	add : function(str, haystack) {
		haystack = ',' + haystack + ',';
		if (haystack.search(new RegExp(',' + str + ',', 'g'), haystack) === -1) {
			haystack += str + ',';
		}
		return this.trimComma(haystack);
	},
	has : function(str, haystack) {
		haystack = ',' + haystack + ',';
		if (haystack.search(new RegExp(',' + str + ',', 'g'), haystack) === -1) {
			return false;
		}
		return true;
	},
	count : function(haystack) {
		if (typeof haystack != 'string') {
			return 0;
		}
		if (match = haystack.match(new RegExp(',', 'g'))) {
			return match.length + 1;
		} else if (haystack.length != 0) {
			return 1;
		}
		return 0;
	},
	each : function(haystack, fnc) {
		var haystack = haystack.split(',');
		for ( var i = 0; i < haystack.length; i++) {
			fnc(haystack[i]);
		}
	},
	trimComma : function(string) {
		string = string.replace(new RegExp('^(,+)', 'i'), '');
		string = string.replace(new RegExp('(,+)$', 'i'), '');
		return string;
	}
};

if (typeof Object.create !== 'function') {
	Object.create = function(o) {
		function F() {
		}
		
		F.prototype = o;
		return new F();
	};
};
(function($) {
	$.fn.owsGrid = function(options) {
		if (this.length) {
			return this.each(function() {
				var grid = Object.create(OWSGrid);
				grid.init(options, this);
				$.data(this, 'owsGrid', grid);
			});
		}
	};
})(jQuery);