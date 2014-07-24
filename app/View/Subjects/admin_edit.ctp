<?php 
$this->start('box-header');
echo '<h2><i class="icon-th-large"></i><span class="break"></span>'.__('Edit subject').'</h2>';
$this->end();
$this->start('toolbar');
echo $this->Html->link(
	'<i class="icon-ok icon-white"></i>&nbsp;'.__('Save'),
	'javascript:;',
	array('escape'=> false, 'class'=> 'btn btn-small btn-success', 'onclick'=> "OWS.submitbutton('save')")
);
echo $this->Html->link(
	'<i class="icon-plus"></i>&nbsp;'.__('Save & New'),
	'javascript:;',
	array('escape'=> false, 'class'=> 'btn btn-small btn-info', 'onclick'=> "OWS.submitbutton('save2new')")
);
echo $this->Html->link(
	'<i class="icon-remove"></i>&nbsp;'.__('Cancel'),
	array('controller'=> 'subjects', 'action'=> 'index'),
	array('escape'=> false, 'class'=> 'btn btn-small')
);
$this->end();
?>
<div class="subjects form">
<?php 
echo $this->Form->create('Subject', array(
    'inputDefaults' => array(
        'div' => 'control-group',
        'label' => array(
            'class' => 'control-label'
        ),
        'wrapInput' => 'controls'
    ),
    'class' => 'form-horizontal',
    'id' => 'subject_form',
    'novalidate' => true
));
echo $this->Form->hidden('id');
echo $this->Form->hidden('task', array('id' => 'task'));
echo $this->Form->input('parent_id', array(
    'label' => array(
        'text' => __('Group Subject')
    ),
    'options' => $parentSubjects,
    'empty' => true,
));
echo $this->Form->input('name', array(
    'label' => array(
        'text' => __('Name') . '<span class="star">*</span>'
    ),
));
echo $this->Form->input('description', array(
    'label' => array(
        'text' => __('Description')
    ),
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
<script type="text/javascript">
OWS.submitbutton = function(task) {
	OWS.submitform(task, document.getElementById('subject_form'));
};
</script>
