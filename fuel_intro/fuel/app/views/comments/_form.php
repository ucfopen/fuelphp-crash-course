<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>
			<?php echo Auth::instance()->get_screen_name(); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Comment', 'comment', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('comment', Input::post('comment', isset($comment) ? $comment->comment : ''), array('cols' => 60, 'rows' => 8)); ?>
		</div>
		<div class="actions">
			<?php echo Form::hidden('message_id', Input::post('message_id', isset($message) ? $message : '')); ?>
			<?php echo Form::submit('submit', 'Submit', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>