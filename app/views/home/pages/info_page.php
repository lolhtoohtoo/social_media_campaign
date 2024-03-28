<?php ob_start(); ?>
<p class="bigFont fontWeightBold brownOrangeColor infoTitle">Latest Campaign</p>
<section id="infoSection">
    
    <?php
       
        for($i = 0; $i < count($dataList); $i++){
            echo "<figure class='infoSingleCampaign'>" ;
            $name = $dataList[$i]->getCampaignName();
            $id = $dataList[$i]->getId();
            $imageArray = $dataList[$i]->getAllImages();
            $startDate = $dataList[$i]->getStartDate();
            // echo "<a href='campaignDetail?campaignId=$id' name='btnGoDetail'>$name</a>";
            echo "<figcaption class='bigFont lightBlueColor fontWeightBold'>$name</figcaption>";
        
            echo "<div>";
            for($j = 0; $j < count($imageArray); $j++){
                $imagePath = $imageArray[$j];
     
                $localhost = $_SERVER['HTTP_HOST'];
                echo "<img class='campaignImage' src='http://$localhost/$imagePath'/>";
            }
            echo "</div>";

            echo "<span class='greenColor'>Start Date : <time class='darkBlackColor mediumFont fontWeightBold'>$startDate</time></span>";
            echo "<a href='campaignDetail?campaignId=$id' name='btnGoDetail'><button class='buttonDesign1'>See more</button></a>";
            echo "</figure>" ;
        }
       
    ?>
</section>

<?php $homeContent = ob_get_clean(); ?>
<?php $footerPageName = "Information" ?>
<?php include __DIR__."/../../../core/views/home/nested_home_layout.php"; ?>
