<?php ob_start(); ?>
<div class="formBackground">
    <form class="formBox" action="/addCampaignType" method="POST">
        <span class="formTitle">Create Campaign-Type</span>
        <div class="formRow">
            <label>Campaign-Type Name</label>
            <input type="text" name="campaignTypeName" required/>
        </div>
        <button class="buttonDesign1 topMargin" type="submit" name="btnCreateCampaignType">Create</button>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php $footerPageName = "Add Campaign-Type" ?>

<?php include __DIR__."/../../../../layout.php"; ?>