<?php ob_start(); ?>
<header class="nestedHomeHeader backgroundTealBlue">
    <div class="smcTitle">
        <span class="ultraFont fontWeightBold logoFont">SMC</span>
        <span class="bigMediumFont fontWeightBold">Social Media Campaign</span>
    </div>
    <button class="menuHeaderBtn" onclick="toggleNavHeader()">
        <i class="fa-solid fa-bars fa-xl"></i>  
    </button>
    <nav id="headerNav" class="bigMediumMediumFont">
        <a href="/">Home Page</a>
        <a href="/info">Info Page</a>
        <a href="/privacyPolicy">Contact Us</a>
        <a href="/customerLogin">Log In</a>
    </nav>
</header>
<div id="homeContent">
    <?= $homeContent ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__."/../../../../layout.php"; ?>

<script>
    function toggleNavHeader(){
        const navbar = document.getElementById("headerNav");
        if(navbar.style.display === "flex"){
            navbar.style.display = "none";
        }else{
            navbar.style.display = "flex";
        }
    }
</script>