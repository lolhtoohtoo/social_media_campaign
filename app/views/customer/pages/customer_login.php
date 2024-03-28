<?php ob_start(); ?>
<div class="formBackground">
    <p class="isAdminTxt">Are you admin?  <a class="isAdminLink" href="/adminLogin">Click to login as admin</a></p>
    <form class="formBox" method="POST">
        <span class="formTitle">Customer Login</span>
        <div class="formRow">
            <label>Email</label>
            <input type="email" name="cusLoginEmail" required />
        </div>
        <div class="formRow">
            <label>Password</label>
            <input type="password" name="cusLoginPassword" required />
        </div>
        <button class="buttonDesign1 topMargin" type="submit" name="cusLoginBtn">Login</button>
    </form>
    <div>
        <span class="isAdminTxt">New Customer ? </span>
        <a class="isAdminLink" href="/customerRegister?selectedCampaignId=<?= $selectedCampaignId ?>">Click to register</a>
    </div>
</div>
<?php $homeContent = ob_get_clean(); ?>
<?php $footerPageName = "Customer Login" ?>
<?php include __DIR__."/../../../core/views/home/nested_home_layout.php"; ?>