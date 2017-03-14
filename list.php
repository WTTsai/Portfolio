<?php
	class svn_list{
		
		public $kind;
		public $name;
		public $size;
		public $revision;
		public $author;
		public $date;



		public function __construct($entry){
			$this->kind = $entry->attributes()["kind"];
			$this->name = $entry->name;
			$this->size = $entry->size;
			$this->revision = $entry->commit->attributes()["revision"];
			$this->author = $entry->commit->author;
			$this->date = $entry->commit->date;
		}
	}

?>