<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "edit" ); ?>'><?php echo Html::anchor('comments/edit','Edit');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('comments/create','Create');?></li>
</ul>
<h2>Editing Comment</h2>
<br/>
<?php $message = isset($message) ? $message : ''; ?>
<?php echo $form; ?>
<p><?php echo Html::anchor('messages/view/'.$comment->message_id, 'Back'); ?></p>
