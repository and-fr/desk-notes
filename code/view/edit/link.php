<?php
$Id = $_GET['id'];

$rows = $db->getLinkFullInfo($Id);
foreach($rows[0] as $key => $val)
{
    $$key = $val;
}

// notes

$notes = '';
$rows = $db->getAllFromTableWhereSortBy('Notes','NotebookId ='.$NotebookId,'Name');
foreach($rows as $row){
    $selected = ($row['Id'] == $NoteId) ? ' selected': '';
    $notes .= "<option value=\"{$row['Id']}\"{$selected}>{$row['Name']}</option>";
}


$redirect = "?view=get/notebook&id={$NotebookId}#n{$NoteId}";
?>
<form method="post" action="<?php echo $redirect; ?>">
    <h4>Edit link for<br><b><?php echo $NoteName; ?></b></h4>
    <div>
        <input type="hidden" name="Table" value="Links">
        <input type="hidden" name="Id" value="<?php echo $Id; ?>">

        <input type="text" name="Name" autocomplete="off" required autofocus placeholder="Name" value="<?php echo $Name; ?>">
        <input type="text" name="Url" autocomplete="off" placeholder="Url" value="<?php echo $Url; ?>">
        <input type="color" name="Color" title="Color" value="<?php echo $Color; ?>">

        <select name="NoteId">
        <?php echo $notes; ?>
        </select>

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="edit">Save</button>
        <button class="btn btn-danger" type="submit" name="Action" value="delete" onclick="return confirm('Delete?')">Delete</button>
        <a href="<?php echo $redirect; ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
