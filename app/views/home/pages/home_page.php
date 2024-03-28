<?php ob_start(); ?>


<a href="/search">Search Campaign</a>

<section>
    <h3>New customer list for <?= $monthName?> </h3>
    <?php 
        for($a = 0; $a <count($customerList); $a++){
            $customerName = $customerList[$a]->getUserName();
            echo "<p>$customerName</p>";
        }
    ?>
</section>

<div>
    <a href="/parentHelp">How Parents Can Help</a>
</div>

<div>
    <a href="/liveStream">Livestreaming</a>
</div>

<div>
    <a href="/legislationAndGuidance">Legislation and Guidance</a>
</div>

<?php $homeContent = ob_get_clean(); ?>
<?php $footerPageName = "Home" ?>
<?php include __DIR__."/../../../core/views/home/nested_home_layout.php"; ?>
