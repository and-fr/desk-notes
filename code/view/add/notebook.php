<?php
$CollectionId = $_GET['col'];

$rows = $db->getIdFromTable($CollectionId,'Collections');
foreach($rows as $row)
{
    $col_name = $row['Name'];
}
?>
<form method="post" action="?view=get/default">
    <h4>Add Notebook to <i><?php echo $col_name; ?></i></h4>
    <div>
        <input type="hidden" name="Table" value="Notebooks">
        <input type="hidden" name="CollectionId" value="<?php echo $CollectionId;?>">

        <input type="text" name="Name" autocomplete="off" required autofocus placeholder="Notebook's Name">
        <input type="color" name="Color" value="#000000" title="Color">

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="add">Add</button>
        <a href="?view=get/default" class="btn btn-secondary">Cancel</a>
    </div>
</form>
