<?php
include('inc/func.php');

$NotebookId = $_GET['id'];
$note_html = '';
$menu_notes = '';


$rows = $db->getFullNotebookName($NotebookId);
foreach($rows[0] as $key => $val)
{
    $$key = $val;
}


$notes = $db->getAllFromTableWhereSortBy('Notes','NotebookId = '.$NotebookId,'Color DESC, Name');
$links = $db->getAllLinksForNotebook($NotebookId);
$terms = $db->getAllTermsForNotebook($NotebookId);
$images = $db->getAllImagesForNotebook($NotebookId);


$note_html .= "<h1 id=\"notebook-title\"><span>{$CollectionName}</span><div id=\"actual-title\">{$Name}</div></h1>";

foreach($notes as $note)
{   
    $menu_notes .= "<li style=\"border-color:{$note['Color']}\"><a href=\"#n{$note['Id']}\">{$note['Name']}</a></li>";

    $menu_terms = '';
    foreach($terms as $term)
    {
        if ($term['NoteId'] == $note['Id'])
        {
            // $menu_terms .= "&bull; <a href=\"#t{$term['Id']}\">{$term['Term']}</a> ";
            $menu_terms .= "<a href=\"#t{$term['Id']}\" style=\"border-color:{$term['Color']}\">{$term['Term']}</a>";
        }
    }


    $links_list = '';
    $images_list = '';
    $terms_list = '';
    $note_html .= "<article>";
    $note_html .= "<a class=\"anchor\" id=\"n{$note['Id']}\"></a>";
    $note_html .= "
        <h2 class=\"menu-terms-trigger\">
            <span style=\"border-color:{$note['Color']}\">
                <a href=\"?view=edit/note&id={$note['Id']}\">{$note['Name']}</a>
                <div class=\"menu-terms\">
                    {$menu_terms}
                </div>
            </span>
            <input type=\"checkbox\" id=\"nm{$note['Id']}\">
            <label for=\"nm{$note['Id']}\">+</label>
            <ul class=\"notemenu\">
                <li><a href=\"?view=add/link&note={$note['Id']}\">add link</a></li>
                <li><a href=\"?view=add/term&note={$note['Id']}\">add term</a></li>
                <li><a href=\"?view=add/image&note={$note['Id']}\">add image</a></li>
            </ul>
        </h2>
        ";


        // links
        foreach($links as $link)
        {
            if ($link['NoteId'] == $note['Id'])
            {
                $links_list .= "
                    <li class=\"lnk\">
                        <span class=\"edit-link\">
                            <a href=\"?view=edit/link&id={$link['Id']}\">&bull;</a>
                        </span>
                        <span class=\"lnk\">
                            <a href=\"{$link['Url']}\" style=\"color:{$link['Color']}\">{$link['Name']}</a>
                            <i>{$link['Url']}</i>
                        </span>
                    </li>";
            }
        }

        if (!empty($links_list))
        {
            $note_html .= "<ul class=\"links\">";
            $note_html .= $links_list;
            $note_html .= "</ul>";
        }


        // images
        foreach($images as $image)
        {
            if ($image['NoteId'] == $note['Id'])
            {
                $caption = empty($image['Caption']) ? null : '<p>'.$image['Caption'].'</p>';
                $mime = $image['MIME'];
                $base64 = base64_encode($image['Image']);
                $images_list .= "
                    <span class=\"image\">{$caption}<a href=\"?view=edit/image&id={$image['Id']}\"><img src=\"data:{$mime};base64,{$base64}\"></a></span>
                    ";
            }
        }

        if (!empty($images_list))
        {
            $note_html .= "<div class=\"images\">";
            $note_html .= $images_list;
            $note_html .= "</div>";
        }


        // terms
        foreach($terms as $term)
        {
            if ($term['NoteId'] == $note['Id'])
            {
                $def = ParseCode($term['Definition']);
                $terms_list .= "
                <dl>
                        <dt style=\"border-color:{$term['Color']}\">
                            <a class=\"anchor\" id=\"t{$term['Id']}\"></a>
                            <a href=\"?view=edit/term&id={$term['Id']}\">{$term['Term']}</a>
                        </dt>
                        <dd>{$def}</dd>
                    </dl>";
            }
        }

        if (!empty($terms_list))
        {
            $note_html .= "<section class=\"terms\">";
            $note_html .= $terms_list;
            $note_html .= "</section>";
        }


    $note_html .= "</article>";
}


$menu .= "
    <li><a href=\"?view=add/note&nbook={$Id}\" title=\"add note\">+</a></li>
    <li class=\"bright\"><a href=\"?view=get/default\">{$CollectionName}</a></li>
    <li class=\"bright\"><a href=\"?view=edit/notebook&id={$Id}\" title=\"edit notebook\"><b>{$Name}</b></a></li>
    <li id=\"menu1\">
        <input id=\"menu1switch\" type=\"checkbox\" name=\"menu\"/>
        <label for=\"menu1switch\"><i class=\"fas fa-search\"></i></label>
        <ul id=\"menu1sub\">
            {$menu_notes}
        </ul>
    </li>
    <li><a href=\"\" onclick=\"return prepare_print();\"><i class=\"fas fa-print\"></i></a></li>
    ";
//  <li><a href=\"?view=get/printrtf&id={$NotebookId}\"><i class=\"fas fa-print\"></i></a></li>

?>
<div id="notebook">
    <?php
    echo $note_html;
    ?>
</div>