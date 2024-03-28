<?php ob_start(); ?>
Live streaming page
<?php $homeContent = ob_get_clean(); ?>

<?php include __DIR__."/../../../core/views/home/nested_home_layout.php"; ?>