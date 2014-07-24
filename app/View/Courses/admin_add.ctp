<?php
$this->start('box-header');
echo '<h2><i class="icon-calendar-empty"></i><span class="break"></span>' . __('Add new course') . '</h2>';
$this->end();
$this->start('toolbar');
echo $this->Html->link('<i class="icon-ok icon-white"></i>&nbsp;' . __('Save'), 'javascript:;', array('escape' => false, 'class' => 'btn btn-small btn-success', 'onclick' => "OWS.submitbutton('save')"));
echo $this->Html->link('<i class="icon-plus"></i>&nbsp;' . __('Save & New'), 'javascript:;', array('escape' => false, 'class' => 'btn btn-small btn-info', 'onclick' => "OWS.submitbutton('save2new')"));
echo $this->Html->link('<i class="icon-remove"></i>&nbsp;' . __('Cancel'), array('controller' => 'courses', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-small'));
$this->end();
?>
<div class="courses form">
    <?php
    echo $this->Form->create('Course', array(
	  'inputDefaults' => array(
		'div' => 'control-group',
		'label' => array(
		    'class' => 'control-label'
		),
		'wrapInput' => 'controls'
	  ),
	  'class' => 'form-horizontal',
	  'id' => 'courseForm',
	  'novalidate' => true
    ));
    echo $this->Form->hidden('task', array('id' => 'task'));
    echo $this->Form->input('name', array(
	  'label' => array(
		'text' => __('Name') . '<span class="star">*</span>'
	  ),
    ));

    $options = array();
    $startY = date('Y') - 5;
    $endY = date('Y') + 40;
    for ($i = $startY; $i < $endY; $i++) {
	  $options[$i] = $i;
    }
    $params = array(
	  'label' => false,
	  'div' => false,
	  'options' => $options,
	  'class' => 'input-small',
	  'wrapInput' => false
    );
    ?>
    <div class="control-group">
	  <div class="control-label">
		<?php echo __('Year') ?><span class="star">*</span>
	  </div>
	  <div class="controls"><?php
		echo $this->Form->input('Course.year_from', $params);
		echo '<span class="break"> - </span>';
		echo $this->Form->input('Course.year_to', $params);
		?></div>
    </div>
</div>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">
    OWS.submitbutton = function(task) {
	  OWS.submitform(task, document.getElementById('courseForm'));
    };

    /*
    startY = <?php echo $startY?>;
    endY = <?php echo $endY?>;

    
    //Change option
    $('#CourseYearFrom').change(function() {
        console.log('select from');
        $('#CourseYearTo').val(parseInt($(this).val()) + 1);
        removeOption($(this).val());
    });


    function removeOption(val) {
        $('#CourseYearTo option').each(function() {
            if ($(this).val() <= val) {
                $(this).remove();
            }
        });
    }
    */
</script>
