<?php 
echo $this->Html->script(array('jquery.blockUI', 'jquery.base64.min'), array('inline'=> false)); 
?>
<div style="margin-bottom:15px" class="clearover pager-wrap">
	<div class="left">
		<span><?php echo __('Page') ?>&nbsp;</span>
		<?php 
		$paging = $this->Paginator->params();
		if($this->Paginator->hasPrev()){
			echo $this->Html->link(
				$this->Html->image('backend/pager_arrow_left.gif', array('class'=> 'arrow', 'alt'=> __('Go to Previous page'))),'#',
				array('escape'=> false, 'title'=> __('Previous page'), 'onclick'=> $jsObject.".setPage('".($paging['page'] - 1)."');return false;")
			);
		}else{
			echo $this->Html->image('backend/pager_arrow_left_off.gif', array('class'=> 'arrow', 'alt'=> __('Go to Previous page')));
		}
		echo $this->Form->input('page', array('value'=> $paging['page'], 'class'=> 'page input-text', 'wrapInput' => false, 'onkeypress'=> $jsObject.".inputPage(event, '".$paging['pageCount']."')"));
		if($this->Paginator->hasNext()){
			echo $this->Html->link(
				$this->Html->image('backend/pager_arrow_right.gif', array('class'=> 'arrow', 'alt'=> __('Go to Previous page'))),'#',
				array('escape'=> false, 'title'=> __('Next page'), 'onclick'=> $jsObject.".setPage('".($paging['page'] + 1)."');return false;")
			);
		}else{
			echo $this->Html->image('backend/pager_arrow_right_off.gif', array('class'=> 'arrow', 'alt'=> __('Go to Next page')));
		}
		echo sprintf(__('of %d pages'), $paging['pageCount']);
		?>
		
		<span class="separator">|</span>
		<?php echo __('View') ?>&nbsp
		<?php
		$perPageOptions = explode(",", Configure::read('Setting.rows_per_page_option'));
		$limitOptions = array_combine($perPageOptions, $perPageOptions); 
		echo $this->Form->select('limit', $limitOptions, array('empty'=> false, 'onchange'=> $jsObject.'.loadByElement("limit", this.value)', 'value'=> $paging['limit']))?>
		<?php echo __('per page') ?>
		
		<span class="separator">|</span>
		<?php echo __(sprintf('Total %d records found', $paging['count'])) ?>
		<span class="separator">|</span>
        <span id="grid_count">0</span> <?php echo __('items selected')?>
	</div>
	<div class="right">
		<?php echo $this->Form->button('<i class="icon-refresh"></i>&nbsp;'.__('Reset',true), array('escape'=> false, 'type'=> 'button', 'class'=> 'btn btn-small', 'onclick'=> $jsObject.'.resetFilter()'))?>
		<?php echo $this->Form->button('<i class="icon-search icon-white"></i>&nbsp;'.__('Search',true), array('escape'=> false, 'type'=> 'button', 'class'=> 'btn btn-small btn-warning', 'onclick'=> $jsObject.'.doFilter()'))?>
	</div>
</div>
