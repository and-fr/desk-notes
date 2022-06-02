<?php
$nbook_id = $_GET['nbook'];

$rows = $db->getIdFromTable($nbook_id, 'Notebooks');
foreach($rows as $row)
{
    $NotebookName = $row['Name'];
}


$redirect = '?view=get/notebook&id='.$nbook_id;
?>
<form method="post" action="<?php echo $redirect; ?>">
    <h4>Add note to<br><b><?php echo $NotebookName; ?></b></h4>
    <div>
        <input type="hidden" name="Table" value="Notes">
        <input type="hidden" name="NotebookId" value="<?php echo $nbook_id; ?>">

        <input type="text" name="Name" autocomplete="off" required autofocus placeholder="Name">
        <input type="color" name="Color" value="#808080" title="Color">

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="add">Add</button>
        <a href="<?php echo $redirect; ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
