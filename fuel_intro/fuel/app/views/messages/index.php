<h2>Listing Messages</h2>
    <br/>
    <?php if ($messages): ?>
    <ul>
    <?php foreach ($messages as $message): ?>
            <li><?php echo $message->name; ?>
                <ul>
                    <li><?php echo $message->message; ?></li>
                    <li><?php echo Html::anchor('messages/view/'.$message->id, $comments[$message->id]); ?></li>
                    <?php
                        if($message->name == Auth::instance()->get_screen_name())
                        { ?>
                            <li><?php echo Html::anchor('messages/edit/'.$message->id, 'Edit'); ?></li>
                            <li><?php echo Html::anchor('messages/delete/'.$message->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?></li>
                        <?php
                    } ?>
                </ul>
            </li>
    <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>No Messages.</p>
    <?php endif; ?>
<p>
<?php if(Auth::instance()->check()) {
    echo Html::anchor('messages/create', 'Add new Message');
}?>
</p>
