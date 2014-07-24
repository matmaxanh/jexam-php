// WIZARD CONSTRUCTOR AND PROTOTYPE
var Wizard = function (element, options) {
    this.$element = $(element);
    this.options = $.extend({}, $.fn.wizard.defaults, options);
    this.currentStep = 1;
    this.numSteps = this.$element.find('li').length;
    this.$prevBtn = this.$element.find('button.btn-prev');
    this.$nextBtn = this.$element.find('button.btn-next');

    // handle events
    this.$prevBtn.on('click', $.proxy(this.previous, this));
    this.$nextBtn.on('click', $.proxy(this.next, this));
    this.$element.on('click', 'li.complete', $.proxy(this.stepclicked, this));
};

Wizard.prototype = {

    constructor: Wizard,

    setState: function () {
        var canMovePrev = (this.currentStep > 1);
        var firstStep = (this.currentStep === 1);
        var lastStep = (this.currentStep === this.numSteps);

        // disable buttons based on current step
        this.$prevBtn.attr('disabled', (firstStep === true || canMovePrev === false));

        // change button text of last step, if specified
        var data = this.$nextBtn.data();
        if (data && data.last) {
            this.lastText = data.last;
            if (typeof this.lastText !== 'undefined') {
                // replace text
                var text = (lastStep !== true) ? this.nextText : this.lastText;
                var kids = this.$nextBtn.children().detach();
                this.$nextBtn.text(text).append(kids);
            }
        }

        // reset classes for all steps
        var $steps = this.$element.find('li');
        $steps.removeClass('active').removeClass('complete');
        $steps.find('span.label').removeClass('badge-warning').removeClass('badge-success');

        // set class for all previous steps
        var prevSelector = 'li:lt(' + (this.currentStep - 1) + ')';
        var $prevSteps = this.$element.find(prevSelector);
        $prevSteps.addClass('complete');
        $prevSteps.find('span.label').addClass('badge-success');

        // set class for current step
        var currentSelector = 'li:eq(' + (this.currentStep - 1) + ')';
        var $currentStep = this.$element.find(currentSelector);
        $currentStep.addClass('active');
        $currentStep.find('span.label').addClass('badge-warning');

        // set display of target element
        var target = $currentStep.data().target;
        $('.step-pane').removeClass('active');
        $(target).addClass('active');

        this.$element.trigger('changed');
    },

    stepclicked: function (e) {
        var li = $(e.currentTarget);

        var index = $('.wizard-steps li').index(li);

        var evt = $.Event('stepclick');
        this.$element.trigger(evt, {step: index + 1});
        if (evt.isDefaultPrevented()) return;

        this.currentStep = (index + 1);
        this.setState();
    },

    previous: function () {
        var canMovePrev = (this.currentStep > 1);
        if (canMovePrev) {
            var e = $.Event('change');
            this.$element.trigger(e, {step: this.currentStep, direction: 'previous'});
            if (e.isDefaultPrevented()) return;

            this.currentStep -= 1;
            this.setState();
        }
    },

    next: function () {
        var canMoveNext = (this.currentStep + 1 <= this.numSteps);
        var lastStep = (this.currentStep === this.numSteps);

        if (canMoveNext) {
            var e = $.Event('change');
            this.$element.trigger(e, {step: this.currentStep, direction: 'next'});

            if (e.isDefaultPrevented()) return;

            this.currentStep += 1;
            this.setState();
        }
        else if (lastStep) {
            this.$element.trigger('finished');
        }
    },

    selectedItem: function (val) {
        return {
            step: this.currentStep
        };
    }
};


// WIZARD PLUGIN DEFINITION

$.fn.wizard = function (option, value) {
    var methodReturn;

    var $set = this.each(function () {
        var $this = $(this);
        var data = $this.data('wizard');
        var options = typeof option === 'object' && option;

        if (!data) $this.data('wizard', (data = new Wizard(this, options)));
        if (typeof option === 'string') methodReturn = data[option](value);
    });

    return (methodReturn === undefined) ? $set : methodReturn;
};

$.fn.wizard.defaults = {};
$.fn.wizard.Constructor = Wizard;
