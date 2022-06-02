<?php
$Id = $_GET['id'];

$rows = $db->getIdFromTable($Id,'Collections');
foreach($rows[0] as $key => $val)
{
    $$key = $val;
}
?>
<form method="post" action="?view=get/default">
    <h4>Edit Collection</h4>
    <div>
        <input type="hidden" name="Table" value="Collections">
        <input type="hidden" name="Id" value="<?php echo $Id; ?>">

        <input type="text" name="Name" autocomplete="off" required autofocus placeholder="Name" value="<?php echo $Name; ?>">
        <input type="text" name="Icon" autocomplete="off" placeholder="Icon" value="<?php echo $Icon; ?>">
        <p><a href="https://fontawesome.com/icons?d=gallery&amp;m=free">Font Awesome icons list</a></p>
        <input type="color" name="Color" title="Color" value="<?php echo $Color; ?>">

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="edit">Save</button>
        <button class="btn btn-danger" type="submit" name="Action" value="delete" onclick="return confirm('Delete?')">Delete</button>
        <a href="?view=get/default" class="btn btn-secondary">Cancel</a>
    </div>
</form>
