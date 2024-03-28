<?php ob_start(); ?>
<div class="formBackground">
    <form class="formBox" action="/addMediaApp" method="POST" enctype="multipart/form-data">
        <span class="formTitle">Create Media-app</span>
        <div class="formRow">
            <label>Media-app Name</label>
            <input type="text" name="mediaAppName" required/>
        </div>
        <div class="formRow">
            <label>Media-app latest technique</label>
            <textarea name="mediaAppTechnique" rows="4" required></textarea>
        </div>
        <div class="formRow">
            <label>Media-app Link or Website</label>
            <input type="text" name="mediaAppLink">
        </div>
        <div class="formRow">
            <label>Rating</label>
            <input type="number" name="mediaAppRating" min="1" max="5" />
        </div>
        <div class="formRow">
            <label>Media-app Image</label>
            <input type="file" name="mediaAppImage" required />
        </div>
        <button class="buttonDesign1 topMargin" type="submit" name="btnCreateMediaApp">Create</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php $footerPageName = "Add Media-App" ?>
<?php include __DIR__."/../../../../layout.php"; ?>