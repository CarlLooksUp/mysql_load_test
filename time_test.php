<?php

require_once('vendor/fzaninotto/faker/src/autoload.php');

//get connection details
$settings = parse_ini_file('db_cxn.ini', true);
$dsn = "{$settings['driver']}:dbname={$settings['db_name']};host={$settings['host']}";
$user = $settings['username'];
$password = $settings['password'];

$cxn = new PDO($dsn, $user, $password);
$faker = Faker\Factory::create();



function build_test_data($num_rows) {
	//determine how to handle format
	$rows = array();
	for($i = 0; $i < $num_rows; $i++) {
		$row = array();

	}
}
