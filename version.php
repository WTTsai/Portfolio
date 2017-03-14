<?php
	class svn_version{
		public $revision;
		public $author;
		public $msg;
		public $date;
	
		public function __construct($entry_rev, $entry_aut, $entry_date, $entry_msg){
			$this->revision = $entry_rev;
			$this->author = $entry_aut;
			$this->msg = $entry_msg;
			$this->date = $entry_date;
		}
	}

?>