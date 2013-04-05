<?php echo Form::open(); ?>
<p>
	<?php echo Form::label('Name', 'name'); ?>
	<?php echo 'Name: '.Auth::instance()->get_screen_name(); ?>
</p>
<p>
	<?php echo Form::label('Comment', 'comment'); ?>
	<?php echo Form::textarea('comment', Input::post('comment', isset($comment) ? $comment->comment : ''), array('cols' => 60, 'rows' => 8)); ?>
</p>
<div class="actions">
	<?php echo Form::submit(); ?>
</div>
<?php echo Form::close(); ?>