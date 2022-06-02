<?php
// CRUD FUNCTIONS

// GENERIC POST SANITATION

function setEmptyAsNull($val)
{
    $val = empty($val) ? null : $val;
    return $val;
}

$data = $_POST;
$data = array_map('trim', $data);
$data = array_map('setEmptyAsNull', $data);

$table = $data['Table'];
$action = $data['Action'];
unset($data['Table']);
unset($data['Action']);


//print_r($data);die();


// ACTIONS

switch($action)
{
    case 'add': 

        // SPECIFIC POST SANITATION
        // process $data of image uploads
        if (array_key_exists('uploaded_image',$_FILES))
        {
            $file = $_FILES['uploaded_image']['tmp_name'];
            $data['Image'] = file_get_contents($file);
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mtype = finfo_file($finfo,$file);
            finfo_close($finfo);
            $data['MIME'] = $mtype;
        }

        $db->addRowToTable($data,$table); 
        break;

    case 'edit': 

        // SPECIFIC POST SANITATION
        // process $data of image uploads


        if (array_key_exists('uploaded_image',$_FILES))
        {
            $file = $_FILES['uploaded_image']['tmp_name'];
            if ($file <> "")
            {
                $data['Image'] = file_get_contents($file);
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mtype = finfo_file($finfo,$file);
                finfo_close($finfo);
                $data['MIME'] = $mtype;
            }
        }

        $db->setRowInTable($data,$table); 
        break;

    case 'delete': $db->delRowFromTable($data,$table); break;
}

?>
