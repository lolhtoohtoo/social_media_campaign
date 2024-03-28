<?php ob_start(); ?>
<div class="formBackground">
    <form class="formBox" action="/adminLogin" method="POST">
        <span class="formTitle">Admin Login Form</span>
        <div class="formRow">
            <label>Email</label>
            <input type="email" name="loginEmail" required />
        </div>
        <div class="formRow">
            <label>Password</label>
            <input type="password" name="loginPassword" required />
        </div>
        <button class="buttonDesign1 topMargin" type="submit" name="btnLogin">Login</button>
    </form>
    <div>
        <span class="isAdminTxt">New admin? </span>
        <a class="isAdminLink" href="/adminRegister">Click to register as an admin. </a>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php $footerPageName = "Admin Login" ?>
<?php include __DIR__."/../../../../layout.php"; ?>