<?php echo $this->Form->create('User', array('type' => 'file', 'id'=> 'user_form', 'class'=> 'form-horizontal', 'inputDefaults'=> array('div'=> false, 'label'=> false))) ?>
	<div class="control-group">
		<div class="control-label">Test:</div>
		<div class="controls">
		    <?php echo $this->Form->input('test', array('options' => $tests));?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">Grade:</div>
		<div class="controls">
		    <?php echo $this->Form->input('grade', array('options' => $grades, 'empty' => '', 'id' => 'grade'));?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">Classroom:</div>
		<div class="controls">
		    <?php echo $this->Form->input('classroom', array('options' => $classes, 'empty' => '', 'id' => 'classroom'));?>
		</div>
	</div>
	<button class="btn btn-small btn-success pull-left" type="submit"><i class="icon-download icon-white"></i>Export</button>
<?php echo $this->Form->end() ?>