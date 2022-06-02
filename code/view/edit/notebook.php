<?php
$Id = $_GET['id'];

$rows = $db->getIdFromTable($Id,'Notebooks');
foreach($rows[0] as $key => $val)
{
    $$key = $val;
}

$important_check = empty($Importance) ? null : ' checked="checked"';

$colls = '';
$col_name = '';
$rows = $db->getAllFromTableSortBy('Collections','Name');
foreach($rows as $row){
    
    if ($row['Id'] == $CollectionId)
    {
        $selected = ' selected';
        $col_name = $row['Name'];
    }
    else
    {
        $selected = '';
    }
    $colls .= "<option value=\"{$row['Id']}\"{$selected}>{$row['Name']}</option>";
}

$redirect = '?view=get/default';
?>
<form method="post" action="<?php echo $redirect; ?>">
    <h4>Edit Notebook from<br><i><?php echo $col_name; ?></i></h4>
    <div>
        <input type="hidden" name="Table" value="Notebooks">
        <input type="hidden" name="Id" value="<?php echo $Id;?>">

        <input type="text" name="Name" autocomplete="off" required autofocus placeholder="Notebook's Name" value="<?php echo $Name; ?>">
		<input type="text" name="Info" placeholder="Notebook's Info" value="<?php echo $Info; ?>">
        <input type="color" name="Color" title="Color" value="<?php echo $Color; ?>">
        
        <input type="hidden" name="Importance" value="0">
        <div class="checkbox" title="Check while important!">
            <input type="checkbox" id="checkbox1" name="Importance" value="1" <?=$important_check;?>>
            <label for="checkbox1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Important</label>
        </div>
        
        <br><br>
        <select name="CollectionId">
        <?php echo $colls; ?>
        </select>

    </div>                
    <div class="form-buttons-area">
        <button class="btn btn-success" type="submit" name="Action" value="edit">Save</button>
        <button class="btn btn-danger" type="submit" name="Action" value="delete" onclick="return confirm('Delete?')">Delete</button>
        <a href="<?php echo $redirect; ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>
