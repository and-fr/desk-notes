<?php
$Id = $_GET['id'];

$rows = $db->getImageFullInfo($Id);
foreach($rows[0] as $key => $val)
{
    $$key = $val;
}
$base64 = base64_encode($Image);

// notes

$notes = '';
$rows = $db->getAllFromTableWhereSortBy('Notes','NotebookId ='.$NotebookId,'Name');
foreach($rows as $row){
    $selected = ($row['Id'] == $NoteId) ? ' selected': '';
    $notes .= "<option value=\"{$row['Id']}\"{$selected}>{$row['Name']}</option>";
}


$redirect = "?view=get/notebook&id={$NotebookId}#n{$NoteId}";
?>
<form method="post" enctype="multipart/form-data" action="<?php echo $redirect; ?>">
    <h4>Edit image for<br><b><?php echo $NoteName; ?></b></h4>
    <div>
        <input type="hidden" name="Table" value="Images">
        <input type="hidden" name="Id" value="<?php echo $Id; ?>">

        <input type="file" name="uploaded_image">
        <input type="text" name="Caption" autocomplete="off" placeholder="Caption" value="<?php echo $Caption; ?>">

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
<p><img src="data:<?php echo $MIME; ?>;base64,<?php echo $base64; ?>"></p>
