<?php $message = isset($message) ? $message : ''; ?>
<h2 class="first">New Comment</h2>
<?php echo $form; ?>
<p><?php echo Html::anchor('messages/view/'.$message, 'Back'); ?></p>