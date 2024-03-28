<?php ob_start(); ?>
<div class="formBackground">
    <form class="formBox" method="POST" enctype="multipart/form-data">
        <span class="formTitle">Customer Register</span>
        <div class="formRow">
            <label>User-Name</label>
            <input type="text" name="cusRegisterUserName" required/>
        </div>
        <div class="formRow">
            <label>First-Name</label>
            <input type="text" name="cusRegisterFirstName" required/>
        </div>
        <div class="formRow">
            <label>Last-Name</label>
            <input type="text" name="cusRegisterLastName" required/>
        </div>
        <div class="formRow">
            <label>Phone Number</label>
            <input type="tel" name="cusRegisterPhoneNumber" required />
        </div>
        <div class="formRow">
            <label>Email</label>
            <input type="email" name="cusRegisterEmail" required/>
        </div>
        <div class="formRow">
            <label>Password</label>
            <input type="password" name="cusRegisterPassword" required/>
        </div>
        <div class="formRow">
            <label>Profile Image</label>
            <input type="file" name="cusRegisterProfileImage" />
        </div>
        <button class="buttonDesign1 topMargin" type="submit" name="CusRegisterBtn">Register</button>
    </form>
    <div>
        <span class="isAdminTxt">Already a customer ? </span>
        <a class="isAdminLink" href="/customerLogin?selectedCampaignId=<?= $selectedCampaignId ?>">Click to Login</a>
    </div>
</div>
<?php $homeContent = ob_get_clean(); ?>
<?php $footerPageName = "Customer Register" ?>
<?php include __DIR__."/../../../core/views/home/nested_home_layout.php"; ?>