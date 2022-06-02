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
    <h4>Add term to<br><b><?php echo $NoteName; ?></b></h4>
    <div>
        <input type="hidden" name="Table" value="Glossary">
        <input type="hidden" name="NoteId" value="<?php echo $NoteId; ?>">

        <input type="text" name="Term" autocomplete="off" required autofocus placeholder="Term">
        <textarea name="Definition" placeholder="Definition"></textarea>
        <input type="color" name="Color" title="Color" value="#808080">

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="add">Add</button>
        <a href="<?php echo $redirect; ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
