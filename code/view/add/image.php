<?php
$NoteId = $_GET['note'];

$rows = $db->getIdFromTable($NoteId, 'Notes');
foreach($rows as $row)
{
    $NoteName = $row['Name'];
    $NotebookId = $row['NotebookId'];
}


$redirect = "?view=get/notebook&id={$NotebookId}#n{$NoteId}";
?>
<form method="post" enctype="multipart/form-data" action="<?php echo $redirect; ?>">
    <h4>Add image to<br><b><?php echo $NoteName; ?></b></h4>
    <div>
        <input type="hidden" name="Table" value="Images">
        <input type="hidden" name="NoteId" value="<?php echo $NoteId; ?>">

        <input type="file" name="uploaded_image" required>
        <input type="text" name="Caption" placeholder="Caption" autocomplete="off">

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="add">Add</button>
        <a href="<?php echo $redirect; ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
