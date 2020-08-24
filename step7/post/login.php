<?php
$open = true;		// Can be accessed when not logged in
require '../lib/site.inc.php';

$controller = new Felis\LoginController($site, $_SESSION, $_GET);


header("location: " . $controller->getRedirect());