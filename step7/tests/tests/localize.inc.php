<?php
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('guptaru1@cse.msu.edu');
    $site->setRoot('/~guptaru1/step7');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=guptaru1',
        'guptaru1',       // Database user
        'A56673301',     // Database password
        'test_');            // Table prefix
};

