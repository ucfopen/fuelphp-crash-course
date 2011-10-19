<?php echo Form::open(); ?>
    <p>
        <?php echo 'Name: '.Auth::instance()->get_screen_name(); ?>
    </p>
	<p>
		<?php echo Form::label('Message', 'message'); ?>
<?php echo Form::textarea('message', Input::post('message', isset($message) ? $message->message : ''), array('cols' => 60, 'rows' => 8)); ?>
	</p>

	<div class="actions">
		<?php echo Form::submit(); ?>	</div>

<?php echo Form::close(); ?>