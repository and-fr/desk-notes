<?php
$num_collections = $db->countRowsInTable('Collections');
$num_notebooks = $db->countRowsInTable('Notebooks');
$num_notes = $db->countRowsInTable('Notes');
$num_links = $db->countRowsInTable('Links');
$num_terms = $db->countRowsInTable('Glossary');

$menu .= 
"
<li><a href=\"?view=add/collection\" title=\"add collection\">+</a></li>
<li class=\"bright\">
    <a>
        Collections <b>{$num_collections}</b> &bull; 
        Notebooks <b>{$num_notebooks}</b> &bull; 
        Notes <b>{$num_notes}</b> &bull; 
        Links <b>{$num_links}</b> &bull; 
        Terms <b>{$num_terms}</b>
    </a>
</li>
";
$html = '';


$collections = $db->getAllFromTableSortBy('Collections','Name');
$notebooks = $db->getAllFromTableSortBy('Notebooks','Name');


foreach($collections as $collection)
{
    $faicon = empty($collection['Icon']) ? 'fa fa-question' : $collection['Icon'];
    $html .= "
        <div class=\"collection\">
            <h2>
                <i class=\"{$faicon} fa-2x\" style=\"color: {$collection['Color']}\"></i>
                <a href=\"?view=edit/collection&id={$collection['Id']}\" title=\"edit collection\">{$collection['Name']}</a>
                <a href=\"?view=add/notebook&col={$collection['Id']}\" title=\"add notebook\">+</a>
            </h2>
            <ul>";
    
            foreach($notebooks as $notebook)
            {
                if ($notebook['CollectionId'] == $collection['Id'])
                {
                    $style = "style=\"border-color: {$notebook['Color']}\"";
                    $info = is_null($notebook['Info']) ? "" : "<i>{$notebook['Info']}</i>";
                    $importance = is_null($notebook['Importance']) ? "" : " class=important";
                    $html .= "
                        <li {$style}>
                            <a href=\"?view=get/notebook&id={$notebook['Id']}\"><span{$importance}>{$notebook['Name']}</span>{$info}</a>
                        </li>";
                }
            }
    
    
    
    $html .= "
            </ul>
        </div>";
}


?>
<div id="collections">
    <?php echo $html; ?>
</div>
