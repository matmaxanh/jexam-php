<?php
$this->start('box-header');
echo '<h2><i class="icon-th-large"></i><span class="break"></span>' . __('Add new grade') . '</h2>';
$this->end();
$this->start('toolbar');
echo $this->Html->link('<i class="icon-ok icon-white"></i>&nbsp;' . __('Save'), 'javascript:;', array('escape' => false, 'class' => 'btn btn-small btn-success', 'onclick' => "OWS.submitbutton('save')"));
echo $this->Html->link('<i class="icon-plus"></i>&nbsp;' . __('Save & New'), 'javascript:;', array('escape' => false, 'class' => 'btn btn-small btn-info', 'onclick' => "OWS.submitbutton('save2new')"));
echo $this->Html->link('<i class="icon-remove"></i>&nbsp;' . __('Cancel'), array('controller' => 'grades', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-small'));
$this->end();
?>
<div class="grades form">
<?php
echo $this->Form->create('Grade', array(
    'inputDefaults' => array(
        'div' => 'control-group',
        'label' => array(
            'class' => 'control-label'
        ),
        'wrapInput' => 'controls'
    ),
    'class' => 'form-horizontal',
    'id' => 'gradeForm',
    'novalidate' => true
));
echo $this->Form->hidden('task', array('id' => 'task'));
echo $this->Form->input('name', array(
    'label' => array(
        'text' => __('Name') . '<span class="star">*</span>'
    ),
));
echo $this->Form->end();
?>
</div>
<script type="text/javascript">
    OWS.submitbutton = function(task) {
        OWS.submitform(task, document.getElementById('gradeForm'));
    };
</script>
