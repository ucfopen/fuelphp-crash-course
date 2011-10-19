<h2 class="first">Listing Messages</h2>
	<ul>
	<?php foreach ($messages as $message): ?>
		<li><?php echo $message->name; ?>
			<ul>
				<li><?php echo $message->message; ?></li>
				<li><?php echo Html::anchor('messages/view/'.$message->id, 'View'); ?></li>
				<li><?php echo Html::anchor('messages/edit/'.$message->id, 'Edit'); ?></li>
				<li><?php echo Html::anchor('messages/delete/'.$message->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?></li>
			</ul>
		</li>
	<?php endforeach; ?>
	</ul>
<br />
<?php if(Auth::instance()->check())
{
	echo Html::anchor('messages/create', 'Add new Message');
}
?>