<?php ob_start(); ?>

<?php 
     $id = $campaignModelData->getId();
     $name = $campaignModelData->getCampaignName();

    echo "
        <div id='campaignTitleWithParticipate'>
            <figcaption class='bigFont lightBlueColor fontWeightBold'>$name</figcaption>
            <a href='/participationForm?selectedCampaignId=$id'><button class='buttonDesign1'>Participate</button></a>
        </div>
    ";
?>

<article id="campaignDetailArticle">
<?php 
   
    $imageList = $campaignModelData->getAllImages();
    $description = $campaignModelData->getDescription();
    $aim = $campaignModelData->getAim();
    $vision = $campaignModelData->getVision();
    $startDate = $campaignModelData->getStartDate();
    $endDate = $campaignModelData->getEndDate();
    $fees = $campaignModelData->getFees();
    $taxPercentage = $campaignModelData->getTaxPercentage();
    $location = $campaignModelData->getLocation();
    $mapDataLink = $campaignModelData->getMapDataLink();
    $campaignContactEmail = $campaignModelData->getCampaignContactEmail();
    $additionalContactInfo = $campaignModelData->getCampaignContactAdditionalInfo();

    $mediaAppName = $mediaAppModelData->getMediaAppName();
    $campaignTypeName = $campaignTypeModelData->getCampaignTypeName();
    
    echo "<figure>";
    
    

    echo "
        <div>
            <p>Media App : $mediaAppName</p>
            <p>CampaignType : $campaignTypeName</p>
        </div>
    ";
    
    echo "<div id='imageList'>";
    for($j = 0; $j < count($imageList); $j++){
        $imagePath = $imageList[$j];
    
        $localhost = $_SERVER['HTTP_HOST'];
        echo "<img class='imageBox' src='http://$localhost/$imagePath'/>";
    }
    echo "</div>";

    echo "<div>";
    echo "<p>Check Detail</p>";

    echo "<details>";
    echo "<summary>$description</summary>";
    echo "<p><mark>$aim</mark></p>";
    echo "<p><mark>$vision</mark></p>";

    echo "
        <div class='makeVertical'>
            <span class='greenColor'>Start Date : <time class='darkBlackColor mediumFont fontWeightBold'>$startDate</time></span>
            <span class='redColor'>End Date : <time class='darkBlackColor mediumFont fontWeightBold'>$endDate</time></span>
        </div>
        <br/>
    ";

    echo "
        <div class='makeVertical'>
            <span>Fees : $<span>$fees</span></span>
            <span>Tax  : <span>$taxPercentage</span>%</span>
        </div>
      
    ";

    echo "
        <div>
            <span class='campaignDetailAddress'>Address : <address class='makeDisplayInline bigMediumMediumFont fontWeightBold brownOrangeColor'>$location</address></span>
            
            <iframe 
                class='mapBox'
                src='$mapDataLink' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'>
            </iframe>
        </div>
    ";

    echo "
        <div>
            <p class='greyColor bigMediumMediumFont fontWeightBold'>Email : $campaignContactEmail</p>
            <p class='greyColor bigMediumMediumFont fontWeightBold'>AdditionalContactInfo : $additionalContactInfo</p>
        </div>
    ";

    echo "</details>";

    echo "</div>";

    echo "</figure>";
?>
</article>



<?php $homeContent = ob_get_clean(); ?>
<?php $footerPageName = "Campaign Detail" ?>
<?php include __DIR__."/../../../core/views/home/nested_home_layout.php"; ?>