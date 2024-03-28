<?php ob_start(); ?>
<main>
    <h3>Privacy Policy</h3>
    <ul>
        <li>This is policy one</li>
        <li>This is policy one</li>
        <li>This is policy one</li>
        <li>This is policy one</li>
        <li>This is policy one</li>
        <li>This is policy one</li>
        <li>This is policy one</li>
    </ul>
</main>

<footer>
    <a href="/contactUs"><button>Ask question</button></a>
</footer>
<?php $content = ob_get_clean(); ?>

<?php include __DIR__."/../../../../layout.php"; ?>