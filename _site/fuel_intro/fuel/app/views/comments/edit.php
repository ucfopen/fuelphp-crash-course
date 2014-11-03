<h2>Editing Comment</h2>
<br/>
 
<?php echo render('comments/_form'); ?>
<p><?php echo Html::anchor('messages/view/'.$comment->message_id, 'Back'); ?></p>