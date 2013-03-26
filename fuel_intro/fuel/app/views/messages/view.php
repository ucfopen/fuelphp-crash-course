<h2>Viewing #<?php echo $message->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $message->name; ?></p>
<p>
	<strong>Message:</strong>
	<?php echo $message->message; ?></p>
	<h3>Comments</h3>
<ul>
<?php
foreach ($comments as $comment) { ?>
    <li>
        <ul>
            <li><strong>Name:</strong> <?php echo $comment["name"]; ?></li>
            <li><strong>Comment:</strong><br /><?php echo $comment["comment"]; ?></li>
            <?php
                if($comment["name"] == Auth::instance()->get_screen_name())
                { ?>
                    <li><p><?php echo Html::anchor('comments/edit/'.$comment["id"].'/'.$message->id, 'Edit'); ?>|
                    <?php echo Html::anchor('comments/delete/'.$comment["id"].'/'.$message->id, 'Delete', array('onclick'=> "return confirm('Are you sure?')")); ?></li>
                <?php
            } ?>
        </ul>
    </li>
<?php } ?>
</ul>
<?php if(Auth::instance()->check()) { ?>
    <p><?php echo Html::anchor('comments/create/'.$message->id, 'Add new Comment'); ?></p>
<?php } ?>
<?php
    if($message->name == Auth::instance()->get_screen_name())
    { ?>
<?php echo Html::anchor('messages/edit/'.$message->id, 'Edit'); ?> |
<?php } ?>
<?php echo Html::anchor('messages', 'Back'); ?>