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
<form method="post" action="<?php echo $redirect; ?>">
    <h4>Add link to<br><b><?php echo $NoteName; ?></b></h4>
    <div>
        <input type="hidden" name="Table" value="Links">
        <input type="hidden" name="NoteId" value="<?php echo $NoteId; ?>">

        <input type="text" name="Name" autocomplete="off" required autofocus placeholder="Name">
        <input type="text" name="Url" autocomplete="off" placeholder="Url">
        <input type="color" name="Color" value="#0000ff" title="Color">

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="add">Add</button>
        <a href="<?php echo $redirect; ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
