<?php
require_once('inc/db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    require_once('inc/crud.php');
    $redirect = $_SERVER['REQUEST_URI'];
    header("Location:{$redirect}");
}
$menu = '';
$view = isset($_GET['view']) ? $_GET['view'] : 'get/default';
$viewfile = 'view/'.$view.'.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Notes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <?php
    if ($view == 'get/notebook')
    {
        echo "<link rel=\"stylesheet\" href=\"css/notebook.css\">";
        echo '<script type="text/javascript" src="js/prepare-print.js"></script>';
        // mathscribe
		/* 
		temporary disabled, as there's no much of math on univ anymore
        
		echo "<link rel=\"stylesheet\" href=\"mathscribe/jqmath-0.4.3.css\">";
        echo '<script type="text/javascript" src="mathscribe/jquery-1.4.3.min.js"></script>';
        echo '<script type="text/javascript" src="mathscribe/jqmath-etc-0.4.6.min.js"></script>';
		*/
    }
    if ($view == 'edit/term')
    {
        echo "<link rel=\"stylesheet\" href=\"css/rich-text-menu.css\">";
        echo '<script type="text/javascript" src="js/insert-at-caret.js"></script>';
    }
    ?>
</head>
<body>

<?php
if (file_exists($viewfile))
{
    include($viewfile);
}
else
{
    include('view/get/default.php');
}
?>

<nav>
    <ul>
    <li><a href="..">&bull;</a></li>
    <li><a class="name" href="?view=get/default">Notes</a></li>
    <?php echo $menu; ?>
    </ul>
</nav>

</body>
</html>
