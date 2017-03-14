<?php
	class svn_path{
		
		public $kind;
		public $action;
		public $pathname;
		
		public function __construct($entry_kind, $entry_action, $entry_pathname){
			$this->kind = $entry_kind;
			$this->action = $entry_action;
			$this->pathname = $entry_pathname;
		}
	}
	
?>