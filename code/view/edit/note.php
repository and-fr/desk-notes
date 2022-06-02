<?php
$Id = $_GET['id'];

$rows = $db->getIdFromTable($Id, 'Notes');
foreach($rows[0] as $key => $val)
{
    $$key = $val;
}

$col_name = '';
$notebooks = '';
$NotebookName = '';
$rows = $db->getAllNotebooksList('Notebooks','Name');
foreach($rows as $row){
    
    if ($col_name !== $row['CollectionName']) {
        $col_name = $row['CollectionName'];
        $notebooks .= "<option disabled>{$col_name}</option>";
    }

    if ($row['Id'] == $NotebookId)
    {
        $selected = ' selected';
        $NotebookName = $row['Name'];
    }
    else
    {
        $selected = '';
    }

    $notebooks .= "<option value=\"{$row['Id']}\"{$selected}>{$row['Name']}</option>";
}


$redirect = '?view=get/notebook&id='.$NotebookId;
?>
<form method="post" action="<?php echo $redirect; ?>">
    <h4>Edit note from<br><b><?php echo $NotebookName; ?></b></h4>
    <div>
        <input type="hidden" name="Table" value="Notes">
        <input type="hidden" name="Id" value="<?php echo $Id; ?>">

        <input type="text" name="Name" autocomplete="off" required autofocus placeholder="Name" value="<?php echo $Name; ?>">
        <input type="color" name="Color" title="Color" value="<?php echo $Color; ?>">

        <select name="NotebookId">
        <?php echo $notebooks; ?>
        </select>

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="edit">Save</button>
        <button class="btn btn-danger" type="submit" name="Action" value="delete" onclick="return confirm('Delete?')">Delete</button>
        <a href="<?php echo $redirect; ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
