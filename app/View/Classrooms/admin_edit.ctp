<?php
$this->start('box-header');
echo '<h2><i class="icon-th-large"></i><span class="break"></span>' . __('Edit classroom') . '</h2>';
$this->end();
$this->start('toolbar');
echo $this->Html->link('<i class="icon-ok icon-white"></i>&nbsp;' . __('Save'), 'javascript:;', array('escape' => false, 'class' => 'btn btn-small btn-success', 'onclick' => "OWS.submitbutton('save')"));
echo $this->Html->link('<i class="icon-plus"></i>&nbsp;' . __('Save & New'), 'javascript:;', array('escape' => false, 'class' => 'btn btn-small btn-info', 'onclick' => "OWS.submitbutton('save2new')"));
echo $this->Html->link('<i class="icon-remove"></i>&nbsp;' . __('Cancel'), array('controller' => 'classrooms', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-small'));
$this->end();
?>
<div class="form">
<?php
echo $this->Form->create('Classroom', array(
    'inputDefaults' => array(
        'div' => 'control-group',
        'label' => array(
            'class' => 'control-label'
        ),
        'wrapInput' => 'controls'
    ),
    'class' => 'form-horizontal',
    'id' => 'classroomForm',
    'novalidate' => true
));
echo $this->Form->hidden('id');
echo $this->Form->hidden('task', array('id' => 'task'));
echo $this->Form->input('name', array(
    'label' => array(
        'text' => __('Name') . '<span class="star">*</span>'
    ),
));
echo $this->Form->input('course_id', array(
	'label' => array(
		'text' => __('Course')
	),
	'options' => $courses
));
echo $this->Form->input('teacher_id', array(
	'label' => array(
		'text' => __('Teacher')
	),
	'options' => $teachers
));
echo $this->Form->end();
?>
</div>
<script type="text/javascript">
    OWS.submitbutton = function(task) {
        OWS.submitform(task, document.getElementById('classroomForm'));
    };
</script>
