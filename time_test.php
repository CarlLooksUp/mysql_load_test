<?php

require_once('vendor/fzaninotto/faker/src/autoload.php');

//get connection details
$settings = parse_ini_file('db_cxn.ini', false);
$dsn = "{$settings['driver']}:dbname={$settings['db_name']};host={$settings['host']}";
$user = $settings['username'];
$password = $settings['password'];

$cxn = new PDO($dsn, $user, $password);
$faker = Faker\Factory::create();

$a = build_test_data(1000000, $faker);
echo memory_get_usage() . "\n";
echo count($a) . "\n";

//write to csv
$start = microtime(true);
$f = fopen('data/products.csv', 'w');
foreach($a as $idx => $product) {
	fputcsv($f, array_values($product));
}
$duration = microtime(true) - $start;

echo "Writing to CSV takes $duration s\n";

function build_test_data($num_rows, $faker) {
	//determine how to handle format
	$rows = array();
	for($i = 0; $i < $num_rows; $i++) {
		$row = array();
		$row['product_id'] = $faker->unique()->randomNumber(8);
		$row['product_name'] = $faker->words(2, true);
		$row['brand_name'] = $faker->word;
		$row['upc'] = $faker->isbn13;
		$row['qty'] = $faker->randomNumber(2);
		$row['cost'] = $faker->randomFloat(2, 0, 1000);
		$row['price'] = $faker->randomFloat(2, 0, 1000);
		$row['sku'] = $faker->isbn10;
		$row['mpn'] = $faker->isbn10;
		$rows[$row['product_id']] = $row;
	}
	return $rows;
}
