<?php ob_start(); ?>

<form method="POST">
    <input type="text" name="replyMessage" placeholder="Reply the message" required />
    <button type="submit" name="replyBtn">Reply</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__."/../../../../layout.php"; ?>