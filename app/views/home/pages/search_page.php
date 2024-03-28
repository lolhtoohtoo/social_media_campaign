<?php ob_start(); ?>
<p>Search page</p>
<form method="POST">
    <input type="text" name="searchInput" />
    <button type="submit" name="searchBtn">Search</button>
</form>
<table>
    <?php
        $campaignLength = count($campaignList);
        if($campaignLength < 1){
            echo "<h4>Campaign not found.  Search some campaign !!!</h4>";
        }else{
            for($i = 0; $i < $campaignLength; $i++){
                $name = $campaignList[$i]->getCampaignName();
                $id = $campaignList[$i]->getId();
                echo "<p><a href='campaignDetail?campaignId=$id'>$name</a></p>";
            } 
        }
    ?>
</table>

<section>
    <p>All campaignList</p>
    <?php 
        for($i = 0; $i < count($orgCampaignList); $i++){
            $name = $orgCampaignList[$i]->getCampaignName();
            $id = $orgCampaignList[$i]->getId();
            echo "<a href='campaignDetail?campaignId=$id' name='btnGoDetail'>$name</a>";
        }
    ?>
</section>
<?php $homeContent = ob_get_clean(); ?>

<?php include __DIR__."/../../../core/views/home/nested_home_layout.php"; ?>