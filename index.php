<?php

	error_reporting(E_ALL);
//	set_time_limit(5);
	ini_set('display_errors','1');
	ini_set('xdebug.max_nesting_level','4192');

	use IvanMatthews\GeoPack\Geo;

	include __DIR__ . "/src/Geo.php";

	$geo = new Geo();
	$mysqli = new \mysqli(/* параметры подключения к БД */);

	$geo->getCountriesFiles(function($file)use($geo,$mysqli){
		$file_data = include $file;					// подключить файл

		$query_header = "INSERT INTO database.countries (`id`,`total_regions`,`total_cities`,`title_ru`,`title_en`) VALUES\n";

		foreach($file_data as $item){				// пройтись циклом по массиву данных
			$query = $query_header;

			$query .= "('{$item['g_country_id']}','{$item['g_total_regions']}','{$item['g_total_cities']}','{$item['g_title_ru']}','{$item['g_title_en']}')";
			$query .= "ON DUPLICATE KEY UPDATE `title_ru`='{$item['g_title_ru']}', `title_en`='{$item['g_title_en']}';";

			$mysqli->query($query);					// записать данные в БД
			unset($query,$item);					// освободить память
		}

		unset($file_data,$query_header,$file);		// освободить память
	});
