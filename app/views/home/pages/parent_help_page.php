<?php ob_start(); ?>
Parent help page
<?php $homeContent = ob_get_clean(); ?>

<?php include __DIR__."/../../../core/views/home/nested_home_layout.php"; ?>