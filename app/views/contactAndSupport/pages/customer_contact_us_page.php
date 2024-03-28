<?php ob_start(); ?>
<form action="/contactUs" method="POST">
    <h3>Contact US</h3>

    <div>
        <label>Subject : </label>
        <input type="text" name="subjectTitle" required/>
    </div>

    <div>
        <label>Message : </label>
        <input type="text" name="message" />
    </div>

    <div>
        <label>Username : </label>
        <input type="text" name="userName" />
    </div>

    <div>
        <label>Email : </label>
        <input type="email" name="email" required />
    </div>

    <div>
        <label>Phone Number : </label>
        <input type="tel" name="phoneNumber" />
    </div>

    <button type="submit" name="submitQuestion" >Submit</button>
</form>
<?php $content = ob_get_clean(); ?>

<?php include __DIR__."/../../../../layout.php"; ?>