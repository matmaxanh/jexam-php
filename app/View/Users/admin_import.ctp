<?php echo $this->Form->create('User', array('type' => 'file', 'id'=> 'user_form', 'class'=> 'form-horizontal', 'inputDefaults'=> array('div'=> false, 'label'=> false))) ?>
	<div class="control-group">
		<div class="control-label">File:</div>
		<div class="controls">
			<?php echo $this->Form->input('file', array('type' => 'file', 'class' => 'pull-left'));?>
			<button class="btn btn-small btn-success pull-left" type="submit"><i class="icon-upload icon-white"></i>Upload</button>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">Classroom:</div>
		<div class="controls">
		    <?php echo $this->Form->input('classroom', array('options' => $classes));?>
		</div>
	</div>
	<?php 
    	echo $this->Html->link(
    	        '<i class="icon-download"></i>&nbsp;'.__('Download template'),
    	        array('controller'=> 'users', 'action'=> 'download_template'),
    	        array('escape'=> false, 'class'=> 'btn btn-primary btn-small')
    	);
	?>
<?php echo $this->Form->end() ?>
<hr/>
<?php if(!empty($successCount)) : ?>
    <h4>Total imported pupils: <strong><?php echo $successCount ?></strong></h4>
    <table class="table table-bordered table-striped">
        <thead>
        	<tr>
        		<th>Fullname</th>
        		<th>Birthday</th>
        		<th>Gender</th>
        	</tr>
    	</thead>
    	<tbody>
        	<?php 
        	    foreach($users as $user) :
        	?>
        	    <tr>
        	        <td><?php echo $user['User']['fullname'] ?></td>
        	        <td><?php echo date('d/m/Y', strtotime($user['User']['birthday'])) ?></td>
        	        <td><?php
        	                $gender = Configure::read('Constant.gender');
        	                if(isset($user['User']['gender']) && !empty($user['User']['gender'])) echo $gender[$user['User']['gender']] 
        	            ?>
    	            </td>
        	    </tr>
        	<?php endforeach; ?>
    	</tbody>
    </table>
<?php endif; ?>
