<?php ob_start(); ?>
legislation and guidance page
<?php $homeContent = ob_get_clean(); ?>

<?php include __DIR__."/../../../core/views/home/nested_home_layout.php"; ?>