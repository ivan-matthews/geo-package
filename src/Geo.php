<?php

	namespace IvanMatthews\GeoPack;

	class Geo{

		protected $geo_files_directory;
		protected $geo_countries_directory;
		protected $geo_regions_directory;
		protected $geo_cities_directory;

		protected $geo_countries_files = array();
		protected $geo_regions_files = array();
		protected $geo_cities_files = array();

		protected $current_file;
		protected $file_name;

		public function __construct(){
			$this->geo_files_directory = __DIR__ . "/../insert_data";

			$this->geo_countries_directory = "{$this->geo_files_directory}/countries";
			$this->geo_regions_directory = "{$this->geo_files_directory}/regions";
			$this->geo_cities_directory = "{$this->geo_files_directory}/cities";
		}

		protected function setCountriesFiles(){
			$this->geo_countries_files = glob("{$this->geo_countries_directory}/*.php");
			return $this;
		}

		protected function setRegionsFiles(){
			$this->geo_regions_files = glob("{$this->geo_regions_directory}/*.php");
			return $this;
		}

		protected function setCitiesFiles(){
			$this->geo_cities_files = glob("{$this->geo_cities_directory}/*.php");
			return $this;
		}

		protected function setFileName(){
			$this->file_name = pathinfo($this->current_file,PATHINFO_FILENAME);
		}

		public function getCountriesFiles(){
			$this->setCountriesFiles();
			return $this->geo_countries_files;
		}

		public function getRegionsFiles(){
			$this->setRegionsFiles();
			return $this->geo_regions_files;
		}

		public function getCitiesFiles(){
			$this->setCitiesFiles();
			return $this->geo_cities_files;
		}

		public function getFileName(){
			$this->setFileName();
			return $this->file_name;
		}

		public function call(array $files_list,callable $callback_function){
			foreach($files_list as $file){
				$this->current_file = $file;
				call_user_func($callback_function,$file);
			}
			return $this;
		}















	}