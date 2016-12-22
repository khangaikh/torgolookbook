<?php

	require 'js/parse/autoload.php';
	use Parse\ParseClient;

     $app_id = '4IP9TbwR6X29Y6oO0fnLh2i2JjpTGqr89R9Ttt9N';
    $rest_key = 'guscdOR2euxdvyZg8909LtvXSJfKmC2xUdycHE2b';
    $master_key = 'QIJcNWZt5yClZa5QvigEwOid0beF83gWrbpBn55s';
    ParseClient::initialize( $app_id, $rest_key, $master_key );

?>