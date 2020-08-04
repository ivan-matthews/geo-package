<?php

	namespace IvanMatthews\GeoPack;
	/**
	 * Class Geo
	 * @package IvanMatthews\GeoPack
	 */
	class Geo
	{

		/** @var string */
		protected $geo_files_directory;
		/** @var string */
		protected $geo_countries_directory;
		/** @var string */
		protected $geo_regions_directory;
		/** @var string */
		protected $geo_cities_directory;
		/** @var array */
		protected $geo_countries_files = array();
		/** @var array */
		protected $geo_regions_files = array();
		/** @var array */
		protected $geo_cities_files = array();
		/** @var  string */
		protected $current_file;
		/** @var  string */
		protected $file_name;

		/**
		 * Geo constructor.
		 */
		public function __construct()
		{
			$this->geo_files_directory = __DIR__ . "/../insert_data";

			$this->geo_countries_directory = "{$this->geo_files_directory}/countries";
			$this->geo_regions_directory = "{$this->geo_files_directory}/regions";
			$this->geo_cities_directory = "{$this->geo_files_directory}/cities";
		}

		/**
		 * @param int $sort
		 * @return $this
		 */
		protected function setCountriesFiles($sort = SORT_NATURAL)
		{
			$this->geo_countries_files = glob("{$this->geo_countries_directory}/*.php");
			sort($this->geo_countries_files, $sort);
			return $this;
		}

		/**
		 * @param int $sort
		 * @return $this
		 */
		protected function setRegionsFiles($sort = SORT_NATURAL)
		{
			$this->geo_regions_files = glob("{$this->geo_regions_directory}/*.php");
			sort($this->geo_regions_files, $sort);
			return $this;
		}

		/**
		 * @param int $sort
		 * @return $this
		 */
		protected function setCitiesFiles($sort = SORT_NATURAL)
		{
			$this->geo_cities_files = glob("{$this->geo_cities_directory}/*.php");
			sort($this->geo_cities_files, $sort);
			return $this;
		}

		/**
		 * @return $this
		 */
		protected function setFileName()
		{
			$this->file_name = pathinfo($this->current_file, PATHINFO_FILENAME);
			return $this;
		}

		/**
		 * @param string $current_file
		 * @return $this
		 */
		protected function setCurrentFile($current_file)
		{
			$this->current_file = $current_file;
			return $this;
		}

		/**
		 * @param int $sort
		 * @param callable $callback_function
		 * @return array
		 */
		public function getCountriesFiles(callable $callback_function = null, $sort = SORT_NATURAL)
		{
			$this->setCountriesFiles($sort);
			if ($callback_function) {
				return $this->call($this->geo_countries_files, $callback_function);
			}
			return $this->geo_countries_files;
		}

		/**
		 * @param int $sort
		 * @param callable $callback_function
		 * @return array
		 */
		public function getRegionsFiles(callable $callback_function = null, $sort = SORT_NATURAL)
		{
			$this->setRegionsFiles($sort);
			if ($callback_function) {
				return $this->call($this->geo_regions_files, $callback_function);
			}
			return $this->geo_regions_files;
		}

		/**
		 * @param int $sort
		 * @param callable $callback_function
		 * @return array
		 */
		public function getCitiesFiles(callable $callback_function = null, $sort = SORT_NATURAL)
		{
			$this->setCitiesFiles($sort);
			if ($callback_function) {
				return $this->call($this->geo_cities_files, $callback_function);
			}
			return $this->geo_cities_files;
		}

		/**
		 * @return string
		 */
		public function getFileName()
		{
			$this->setFileName();
			return $this->file_name;
		}

		/**
		 * @param array $files_list
		 * @param callable $callback_function
		 * @return array
		 */
		public function call(array $files_list, callable $callback_function)
		{
			foreach ($files_list as $file) {
				$this->setCurrentFile($file);
				call_user_func($callback_function, $file);
			}
			return $files_list;
		}


	}
