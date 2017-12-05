<?php
/**
 * Created by PhpStorm.
 * User: Mortimer
 * Date: 12/3/2017
 * Time: 2:16 PM
 */

switch ($action) {
    default:
        $button = "Add";
        include_once ("catdropdownform.php");
        include_once ("catform.php");
        break;
    case 'Add':
        echo addCategory($db, $category); //calls function to add new record
        include_once ("catdropdownform.php");
        include_once ("catform.php");
        break;
    case 'Edit':
        echo $id;
        $button = "Update";
        foreach($categories as $cat) {
            if($cat['category_id'] == $id){
                //$_SESSION['selectedcat'] = $cat['category'];
                $selectedcat = $cat['category'];
            }
        }
        include_once ("catdropdownform.php");
        include_once ("catform.php");
        break;
    case 'Update':
        echo "ID: " . $id . "CAT:" . $category;
        echo updateCategory($db, $id, $category);
        $button = "Add";
        include_once ("catdropdownform.php");
        include_once ("catform.php");
        break;
    case 'TRY THIS':
        echo "ID: " . $id . "CAT:" . $category;
        break;
    case 'Delete':

        break;
    case 'View':

        break;
}


switch ($action) {
    case 'Add':
        echo $id . $action;
        echo addCategory($db, $category);
        include_once("catdropdownform.php");
        include_once("catform.php");
        break;
    case 'Edit':
        //echo $id . $action;
        $button = "Update";
        foreach($categories as $cat){
            if($cat['category_id'] == $id){
                $selectedcat = $cat['category'];
            }
        }
        echo "Selected cat: " . $selectedcat;
        include_once("catdropdownform.php");
        include_once("catform.php");
        break;
}