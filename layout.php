
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="./app/core/views/style/index.css" rel="stylesheet" type="text/css"/>
    <link href="./app/core/views/style/form.css" rel="stylesheet" type="text/css"/>
    <link href="./app/core/views/home/style/nested_home_layout.css" rel="stylesheet" type="text/css"/>
    <link href="./app/views/home/styles/info.css" rel="stylesheet" type="text/css" />
    <link href="./app/views/campaign/styles/campaign_detail.css" rel="stylesheet" type="text/css" />
    <link href="./app/views/customer/styles/customer_form.css" rel="stylesheet" type="text/css" />


    <title>Social Media Campaigns</title>
    <!-- <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>  -->
</head>
<body id="google_translate_element">
    <div id="contentBody">
        <?= $content ?>
    </div>
    <!-- <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script> -->
    <footer>
        <span>You are here ( <?= $footerPageName ?> )</span>
        <div class="backgroundBlack smallFont">
            <span>CopyRight @ 2024</span>
        </div>
    </footer>
</body>
</html>