<ul class="nav nav-pills">
    <li class="<?php echo Arr::get($subnav, "edit" ); ?>"><?php echo Html::anchor('comments/edit','Edit');?></li>
    <li class="<?php echo Arr::get($subnav, "create" ); ?>"><?php echo Html::anchor('comments/create','Create');?></li>
</ul>
<?php $message = isset($message) ? $message : ''; ?>
<h2 class="first">New Comment</h2>
<?php echo $form; ?>
<p><?php echo Html::anchor('messages/view/'.$message, 'Back'); ?></p>