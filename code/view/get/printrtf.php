<?php
require_once('lib/PHPRtfLite.php');
PHPRtfLite::registerAutoloader();

try
{
    $rtf = new PHPRtfLite();
    
    // Margins
    $rtf->setMargins(2,2,2,2);
    
    // Footer
    $footer = $rtf->addFooter();
    $fontFooter = new PHPRtfLite_Font(8, 'Arial', '#000000');
    $alignFooter = new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_CENTER);
    $footer->writeText('<pagenum>', $fontFooter, $alignFooter);

    // Fonts
    $fontH1 = new PHPRtfLite_Font(22, 'Arial', '#000000'); $fontH1->setBold();
    $fontH2 = new PHPRtfLite_Font(18, 'Arial', '#800000'); $fontH2->setBold();
    $fontH3 = new PHPRtfLite_Font(14, 'Arial', '#800080'); $fontH3->setBold();
    $fontP = new PHPRtfLite_Font(12, 'Helvetica', '#000000');
    $fontA = new PHPRtfLite_Font(12, 'Helvetica', '#000088');
    $fontAhref = new PHPRtfLite_Font(10, 'Helvetica', '#888888');

    // Space
    $formatH1 = new PHPRtfLite_ParFormat();
    $formatH1->setSpaceAfter(30);
    $formatH2 = new PHPRtfLite_ParFormat();
    $formatH2->setSpaceAfter(20);
    $formatH3 = new PHPRtfLite_ParFormat();
    $formatH3->setSpaceBefore(10);
    $formatH3->setSpaceAfter(10);
    $formatA = new PHPRtfLite_ParFormat();
    $formatA->setSpaceAfter(3);
    $formatAhref = new PHPRtfLite_ParFormat();
    $formatAhref->setSpaceAfter(9);
    $formatP = new PHPRtfLite_ParFormat();
    $formatP->setSpaceAfter(3);


    // Retrieve things from DB

    $NotebookId = $_GET['id'];
    
    $rows = $db->getFullNotebookName($NotebookId);
    foreach($rows[0] as $key => $val)
    {
        $$key = $val;
    }
    
    
    $notes = $db->getAllFromTableWhereSortBy('Notes','NotebookId = '.$NotebookId,'Color DESC, Name');
    $links = $db->getAllLinksForNotebook($NotebookId);
    $terms = $db->getAllTermsForNotebook($NotebookId);
    


    // Page content
    $section = $rtf->addSection();
    $section->writeText("{$CollectionName} / {$Name}", $fontH1, $formatH1);

    foreach($notes as $note)
    {

        $section->insertPageBreak();
        $section->writeText("{$note['Name']}", $fontH2, $formatH2);

        // links
        foreach($links as $link)
        {
            if ($link['NoteId'] == $note['Id'])
            {
                $section->writeText("{$link['Name']}", $fontA, $formatA);
                $section->writeText("{$link['Url']}", $fontAhref, $formatAhref);
            }
        }


        // terms
        foreach($terms as $term)
        {
            if ($term['NoteId'] == $note['Id'])
            {
                // $def = ParseCode($term['Definition']);
                $def = strip_tags($term['Definition'], '<b>');

                $section->writeText($term['Term'], $fontH3, $formatH3);
                $section->writeText($def, $fontP, $formatP);


                $terms_list = "
                <dl>
                        <dt style=\"border-color:{$term['Color']}\">
                            <a class=\"anchor\" id=\"t{$term['Id']}\"></a>
                            <a href=\"?view=edit/term&id={$term['Id']}\">{$term['Term']}</a>
                        </dt>
                        <dd>{$def}</dd>
                    </dl>";
            }
        }

    }



    // Output file
    $rtf->sendRtf('tmp.rtf');

}
catch (Excaeption $e)
{
    echo $e->getMessage();
}
?>