<?php ob_start(); ?>
<h1>This is admin dashboard</h1>
<div>
    <p>Hello admin <?= $adminData->getDisplayName() ?></p>
</div>
<div>
    <div>
        <a href="/adminDashboard">SMC</a>
    </div>
    <div>
        <a href="/adminProfile">go to profile</a>
    </div>
    <nav>
        <a href="/addCampaignType">Add Campaign Type</a>
        <a href="/addMediaApp">Add Media App</a>
        <a href="/addCampaign">Add Campaign</a>
    </nav>
    <div>
        <a href="/adminLogout">Log out</a>
    </div>
    <div>
        <a href="/adminCustomerSupport">Check customer messages</a>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php $footerPageName = "Admin Dashboard" ?>
<?php include __DIR__."/../../../../layout.php"; ?>