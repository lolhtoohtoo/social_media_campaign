<?php ob_start(); ?>
<div class="formBackground">
    <form class="formBox" action="/addCampaign" method="POST" enctype="multipart/form-data">
        <span class="formTitle">Add Campaign</span>
        <div class="formRow">
            <label>Campaign Name</label>
            <input type="text" name="campaignName" required />
        </div>
        <div class="formRow">
            <label>Select Media-App</label>
            <select name="mediaAppOptions">
                <?php
                    for($a =0; $a <count($arrayMediaApp); $a++){
                        $id = $arrayMediaApp[$a]->getId();
                        $name = $arrayMediaApp[$a]->getMediaAppName();
                        echo "<option value=$id >$name</option>";
                    }
                ?>
            </select>
        </div>
        <div class="formRow">
            <label>Select Campaign-Type</label>
            <select name="campaignTypeOptions">
                <?php
                    for($b = 0; $b < count($arrayCampaignType); $b++){
                        $id = $arrayCampaignType[$b]->getId();
                        $name = $arrayCampaignType[$b]->getCampaignTypeName();
                        echo "<option value=$id >$name</option>";
                    }
                ?>
            </select>
        </div>
        <div class="formRow">
            <label>Image 1</label>
            <input type="file" name="campaignImageOne" required />
        </div>
        <div class="formRow">
            <label>Image 2</label>
            <input type="file" name="campaignImageTwo" />
        </div>
        <div class="formRow">
            <label>Image 3</label>
            <input type="file" name="campaignImageThree" />
        </div>
        <div class="formRow">
            <label>Image 4</label>
            <input type="file" name="campaignImageFour" />
        </div>
        <div class="formRow">
            <label>Description</label>
            <textarea name="description" rows="4" required></textarea>
        </div>
        <div class="formRow">
            <label>Aim</label>
            <input type="text" name="aim" required />
        </div>
        <div class="formRow">
            <label>Vision</label>
            <input type="text" name="vision" required />
        </div class="formRow">
        <div class="formRow">
            <label>Start Date</label>
            <input type="date" name="startDate" value ="<?= gmdate("Y-m-d H:i:s") ?>" required />
        </div>
        <div class="formRow">
            <label>End Date</label>
            <input type="date" name="endDate" required />
        </div>
        <div class="formRow">
            <label>Fees</label>
            <input type="number" name="fees" required />
        </div>
        <div class="formRow">
            <label>Location</label>
            <input type="text" name="location" required />
        </div>
        <div class="formRow">
            <label>Map-Link</label>
            <input type="text" name="mapDataLink" />
        </div>
        <div class="formRow">
            <label>Active</label>
            <input type="checkbox" name="activeStatus" />
        </div>
        <div class="formRow">
            <label>Contact Email for Campaign</label>
            <input type="text" name="campaignContactEmail" required />
        </div>
        <div class="formRow">
            <label>Additional Contact Info</label>
            <input type="text" name="campaignContactAdditionalInfo" required />
        </div>
        <button class="buttonDesign1 topMargin" type="submit" name="btnCreateCampaign" >Create Campaign</button>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php $footerPageName = "Add Campaign" ?>
<?php include __DIR__."/../../../../layout.php"; ?>