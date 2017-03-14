<?php
	include_once "version.php";
	
	class svn_fileList{
		public $size;
		public $type;
		public $path;
		public $file;
		public $version = array();
	
		public function __construct($entry_size, $entry_type, $entry_path){
			$this->size = $entry_size;
			$this->type = $entry_type;
			$this->path = $entry_path;

		}
	}

?>