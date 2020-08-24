<?php
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

unset($_SESSION[Felis\User::SESSION_NAME]);
header('location:../index.php');
