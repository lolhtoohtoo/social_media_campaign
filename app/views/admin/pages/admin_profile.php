<?php ob_start(); ?>
<h1>This is admin profile</h1>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__."/../../../../layout.php"; ?>