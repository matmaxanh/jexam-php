<div class="row-fluid test-detail">
    <div class="span12">
	  <div class="test-name"><?php echo $exam['Exam']['name'] ?></div>
	  <div class="row-fluid">
		<div class="span6">
		    <div class="subtitle"><?php echo __('Description') ?></div>
		    <?php echo $exam['Exam']['description'] ?>
		</div>
		<div class="span6">
		    <div class="subtitle"><?php echo __('Rules for Taking the Exam') ?></div>
		    <table class="desc-table">
			  <tbody>
				<tr>
				    <th><?php echo __('Duration') ?></td>
				    <td><?php echo __('%d minutes', round($exam['Exam']['duration'] / 60)) ?></td>
				</tr>
				<tr>
				    <th><?php echo __('Number of Questions') ?></td>
				    <td>
					  <?php echo __('%d questions.', $exam['Exam']['question_number']) ?></p>
					  <div class="null"><?php echo __('Each question has between 2 and 8 options. One or more answers may be correct.') ?></div>
				    </td>
				</tr>
			  </tbody>
		    </table>
		</div>
	  </div>

	  <!--	    <div> 
			  Read <a href="#" target="_blank">policies</a> and 
			  <a href="#" target="_blank">FAQ</a> for taking the tests before you hit the Start Exam button.
		  </div>-->
	  <br/>
	  <div class="center">
		<?php
		echo $this->Form->create('Exam');
		echo $this->Form->hidden('id', array('value' => $exam['Exam']['id']));
		echo $this->Form->button('<i class="icon-play icon-white"></i>&nbsp;' . __('Start test'), array('escape' => false, 'class' => 'btn btn-primary'));
		echo $this->Form->end();
		?>
	  </div>
        <div class="clear"></div>
    </div>
</div>