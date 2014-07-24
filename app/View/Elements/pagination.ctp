<?php $params = $this->Paginator->params();?>
<?php $span = 5; ?>
<?php $page = $params['page']; ?>
<div class="pagination">
	<ul>
		<?php echo $this->Paginator->prev(
			__('Previous'),
			array(
				'escape' => false,
				'tag' => 'li'
			),
			'<a onclick="return false;">Previous</a>',
			array(
				'class'=>'disabled prev',
				'escape' => false,
				'tag' => 'li'
			)
		);?>
		
		<?php $count = $page + $span; ?>
		<?php $i = $page - $span; ?>
		<?php while ($i < $count): ?>
			<?php $options = ''; ?>
			<?php if ($i == $page): ?>
				<?php $options = ' class="active"'; ?>
			<?php endif; ?>
			<?php if ($this->Paginator->hasPage($i) && $i > 0): ?>
				<li<?php echo $options; ?>><?php echo $this->Html->link($i, array('?'=> array("page" => $i))); ?></li>
			<?php endif; ?>
			<?php $i += 1; ?>
		<?php endwhile; ?>
		
		<?php echo $this->Paginator->next(
			__('Next'),
			array(
				'escape' => false,
				'tag' => 'li'
			),
			'<a onclick="return false;">Next</a>',
			array(
				'class' => 'disabled next',
				'escape' => false,
				'tag' => 'li'
			)
		);?>
	</ul>
</div>