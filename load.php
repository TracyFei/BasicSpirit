<?php 

session_start();
include("includes/db.php");
include("functions/functions.php");
if  (!array_key_exists('sAction', $_REQUEST))
{
    return;
}
switch($_REQUEST['sAction']){

    default :

    getProducts();

    break;

    case'getPaginator';

    getPaginator();

    break;

}

?> 