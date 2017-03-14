<?php
	include_once "path.php";
	class svn_log{
		
		public $revision;
		public $author;
		public $date;
		public $paths;
		public $msg;
	
		public function __construct($entry){
			$this->revision = $entry->attributes()["revision"];
			$this->author = $entry->author;
			$this->date = $entry->date;
			$this->paths = array(); 
			$this->msg = $entry->msg;
			foreach ($entry->paths->path as $path){
				$kind = $path->attributes()["kind"];
				$action = $path->attributes()["action"];
				$temp = new svn_path($kind, $action, $path);
				$this->paths[] = $temp;
			}
	
		}
	
	}

?>