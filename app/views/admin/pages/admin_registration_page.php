<?php ob_start(); ?>
<div class="formBackground">
    <form class="formBox" action="/adminRegister" method="POST" enctype="multipart/form-data">
        <span class="formTitle">Admin Create Form</span>
        <div class="formRow">
            <label>First-Name</label>
            <input type="text" name="firstName" required/>
        </div>
        <div class="formRow">
            <label>Last-Name</label>
            <input type="text" name="lastName" required/>
        </div>
        <div class="formRow">
            <label>Display-Name</label>
            <input type="text" name="displayName" required/>
        </div>
        <div class="formRow">
            <label>Email</label>
            <input type="email" name="email" required />
        </div>
        <div class="formRow">
            <label>Phone Number</label>
            <input type="tel" name="phone" required/>
        </div>
        <div class="formRow">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <div class="formRow">
            <label>Profile-Image</label>
            <input type="file" name="profileImage" required/>
        </div>
        <button class="buttonDesign1 topMargin" type="submit" name="btnSubmit">Create</button>
    </form>
    <div>
        <span class="isAdminTxt">Account already exist?  </span>
        <a class="isAdminLink" href="/adminLogin">Click to Log in. </a>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php $footerPageName = "Admin Register" ?>
<?php include __DIR__."/../../../../layout.php"; ?>