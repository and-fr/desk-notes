<?php
include('inc/forms.php');

$Id = $_GET['id'];

$rows = $db->getTermFullInfo($Id);
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

$links = "<a href=\"https://onlinepngtools.com/convert-png-to-base64\">PNG-to-Base64</a>"
    ."<a href=\"https://www.wolframalpha.com\">wolframalpha</a>"
    ."<a href=\"https://pl.wikisource.org/wiki/Unicode/Operatory_matematyczne\">Unicode/Operatory matematyczne</a>"
    ."<a href=\"https://mathscribe.com/author/jqmath.html\">jqMath</a>";


$redirect = "?view=get/notebook&id={$NotebookId}#n{$NoteId}";
?>
<form method="post" action="<?php echo $redirect; ?>">
    <h4>Edit term for <b><?php echo $NoteName; ?></b> <?php echo $links; ?></h4>
    <div>
        <input type="hidden" name="Table" value="Glossary">
        <input type="hidden" name="Id" value="<?php echo $Id; ?>">

        <input type="text" name="Term" autocomplete="off" required autofocus placeholder="Term" value="<?php echo $Term; ?>">

        <?php DisplayRichTextMenu(); ?>
        
        <textarea name="Definition" placeholder="Definition" id="text"><?php echo $Definition; ?></textarea>
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
