<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold_1.php                                                  ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../config.php");

error_reporting(E_ALL);

$GLOBALS["link"] = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysqli_select_db($GLOBALS["link"], SQL_DB);

$session = (int) $_POST['admid'];

$sql = mysqli_query($GLOBALS["link"], "SELECT * FROM ".TB_PREFIX."users WHERE id = ".$session."");
$access = mysqli_fetch_array($sql);
$sessionaccess = $access['access'];

if($sessionaccess != 9) die("<h1><font color=\"red\">Access Denied: You are not Admin!</font></h1>");

$q = "UPDATE ".TB_PREFIX."users SET gold = gold + ".(int) $_POST['gold']." WHERE id != '0'";
mysqli_query($GLOBALS["link"], $q) or die(mysqli_error($database->dblink));

header("Location: ../../../Admin/admin.php?p=maintenenceResetPlusBonus&g");
?>