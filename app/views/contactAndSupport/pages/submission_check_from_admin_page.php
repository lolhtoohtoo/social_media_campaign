<?php ob_start(); ?>

<?php 
    for($a = 0; $a < count($supportList); $a++){
        $contactUs = $supportList[$a];
        $id = $contactUs->getId();
        $title = $contactUs->getTitle();
        echo "<a href='/adminReplySupport?contactUsId=$id' >$title</a>";
    }
?>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__."/../../../../layout.php"; ?>