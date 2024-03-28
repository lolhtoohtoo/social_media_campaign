<?php ob_start(); ?>
This is waiting room

<p id="countdown">0</p>

<?php $content = ob_get_clean(); ?>


<?php include __DIR__."/../../../../layout.php"; ?>


<script>
    
    function redirectUser(){
        window.location = '/';
    }    

    function getCookie(cookieName){
        let cookieList = document.cookie.split("; ");
        for(let i =0 ; i < cookieList.length; i++){
            let singleCookie =cookieList[i];
            let parts =singleCookie.split("=");
            if(parts[0] === cookieName){
               
                return true;
                break;
            }
        }
        return false;
    }

    function checkCookieAndRedirect(){
        let boolValue =getCookie("DisableAll");
        if(boolValue === false){
            redirectUser();
        }
    }

    let countdownValue = 0;
    const countdown =document.getElementById("countdown");
    setInterval(function(){
        countdown.textContent =countdownValue;
        countdownValue ++;
        checkCookieAndRedirect();
    }, 1000);
</script>
