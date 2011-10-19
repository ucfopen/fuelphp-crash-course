<h2 class="first">Editing Message</h2>

<?php echo render('messages/_form'); ?>
<br />
<p>
<?php echo Html::anchor('messages/view/'.$message->id, 'View'); ?> |
<?php echo Html::anchor('messages', 'Back'); ?></p>
