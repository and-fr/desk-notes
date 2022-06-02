<form method="post" action="?view=get/default">
    <h4>Add Collection</h4>
    <div>
        <input type="hidden" name="Table" value="Collections">

        <input type="text" name="Name" autocomplete="off" required autofocus placeholder="Name">
        <input type="text" name="Icon" autocomplete="off" placeholder="Icon">
        <p><a href="https://fontawesome.com/icons?d=gallery&amp;m=free">Font Awesome icons list</a></p>
        <input type="color" name="Color" value="#000000" title="Color">

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="add">Add</button>
        <a href="?view=get/default" class="btn btn-secondary">Cancel</a>
    </div>
</form>
