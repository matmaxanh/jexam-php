<?php
echo $this->Html->script(array('bootstrap-timepicker'), array('inline' => false));
echo $this->Html->css(array('bootstrap-timepicker'), null, array('inline' => false));
$this->start('box-header');
echo '<h2><i class="icon-list-alt"></i><span class="break"></span>' . __('Add new exam') . '</h2>';
$this->end();
$this->start('toolbar');
echo $this->Html->link('<i class="icon-ok icon-white"></i>&nbsp;' . __('Save'), 'javascript:;', array('escape' => false, 'class' => 'btn btn-small btn-success', 'onclick' => "OWS.submitbutton('save')"));
echo $this->Html->link('<i class="icon-plus"></i>&nbsp;' . __('Save & New'), 'javascript:;', array('escape' => false, 'class' => 'btn btn-small btn-info', 'onclick' => "OWS.submitbutton('save2new')"));
echo $this->Html->link('<i class="icon-arrow-left"></i>&nbsp;' . __('Back'), 'javascript:history.back()', array('escape' => false, 'class' => 'btn btn-small'));
$this->end();
?>

<div class="exams form">
    <?php
    echo $this->Form->create('Exam', array(
	  'inputDefaults' => array(
		'div' => 'control-group',
		'label' => array(
		    'class' => 'control-label'
		),
		'wrapInput' => 'controls',
		'errorMessage' => false
	  ),
	  'class' => 'form-horizontal',
	  'id' => 'exam_form',
    ));
    echo $this->Form->hidden('task', array('id' => 'task'));

    echo $this->Form->input('class_id', array(
	  'label' => array(
		'text' => __('Class') . '<span class="star">*</span>'
	  ),
	  'options' => $classes,
	  'empty' => true,
    ));

    echo $this->Form->input('subject_id', array(
	  'label' => array(
		'text' => __('Subject') . '<span class="star">*</span>'
	  ),
	  'options' => $subjects,
	  'empty' => true,
    ));

    echo $this->Form->input('name', array(
	  'label' => array(
		'text' => __('Name') . '<span class="star">*</span>'
	  ),
    ));

    echo $this->Form->input('question_type', array(
	  'label' => array(
		'text' => __('Question Type') . '<span class="star">*</span>'
	  ),
	  'options' => $questionTypes,
	  'multiple' => 'checkbox',
	  'class' => 'checkbox'
    ));

    echo $this->Form->input('description', array(
	  'label' => array(
		'text' => __('Description')
	  ),
	  'rows' => 7,
	  'cols' => 10
    ));

    echo $this->Form->input('difficulty', array(
	  'label' => array(
		'text' => __('Difficulty')
	  ),
	  'options' => $difficulties,
    ));

    echo $this->Form->input('duration', array(
	  'type' => 'text',
	  'label' => array(
		'text' => __('Duration'),
	  ),
	  'wrapInput' => array(
		'tag' => 'div',
		'class' => 'controls',
	  ),
	  'class' => 'input-small',
	  'beforeInput' => '<div class="input-append bootstrap-timepicker">',
	  'afterInput' => '<span class="add-on"><i class="icon-time"></i></span></div>',
	  'id' => 'duration',
    ));
    echo $this->Form->input('question_number', array(
	  'label' => array(
		'text' => __('Question number')
	  ),
	  'value' => (isset($this->data['Exam']['question_number']) ? $this->data['Exam']['question_number'] : 20),
	  'class' => 'input-small',
    ));
    echo $this->Form->input('pass_score', array(
	  'label' => array(
		'text' => __('Pass Score')
	  ),
	  'options' => range(1, 10),
	  'value' => (isset($this->data['Exam']['pass_score']) ? $this->data['Exam']['pass_score'] : 5),
	  'class' => 'input-small',
    ));
    echo $this->Form->input('status', array(
	  'type' => 'radio',
	  'before' => '<label class="control-label">' . __('Status') . '<span class="star">*</span></label>',
	  'legend' => false,
	  'options' => Configure::read('Constant.status'),
	  'value' => STATUS_ACTIVE,
    ));
    echo $this->Form->end();
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
	  OWS.submitbutton = function(task) {
		OWS.submitform(task, document.getElementById('exam_form'));
	  };
	  $("#duration").timepicker({
		defaultTime: '00:00:00',
		showSeconds: true,
		minuteStep: 1,
		showMeridian: false
	  });
    });
</script>
