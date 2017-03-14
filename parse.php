<?php
	include_once 'list.php';
	include_once 'log.php';
	include_once 'path.php';
	include_once 'version.php';
	include_once 'fileList.php';
	
	class Assignment{
		public $logs = array();
		public $lists = array();
		public $fileList = array();
		public $title;
		public $date;
		public $version;
		public $summary;
		
		public function __construct($AssignmentName, $log_file, $list_file){
			$svn_log_xml = simplexml_load_file($log_file);
			$svn_list_xml = simplexml_load_file($list_file);
			
			foreach($svn_log_xml->logentry as $logentry){
				$temp = new svn_log($logentry);
				$this->logs[]= $temp;	
			}
			
			foreach($svn_list_xml->list->entry as $entry){
				$temp = new svn_list($entry);
				$this->lists[] = $temp;
			}
			
			
			$full_path = "/wtsai9/".$AssignmentName;
			$full_path_len = strlen($full_path);
			
			$exist= 0;

			foreach($this->logs as $log){
				foreach($log->paths as $path){
					if(strcmp("file", (string)$path->kind)==0 and strcmp("A", (string)$path->action) == 0 and
					(strcmp((string)$full_path, (string)substr($path->pathname, 0, $full_path_len)))==0){
						$this->title = $AssignmentName;
						$this->date = $log->date;
						$this->version = $log->revision;
						$this->summary = $log->msg;

						$temp_ver = new svn_version($log->revision, $log->author, $log->date, $log->msg);
						//Check if the file already exist, if yes, then added to the version array. 
						foreach($this->fileList as $file){
							if(strcmp($path->pathname, $file->path)==0){
								$f->version[] = $temp_ver;
								$exist = 1;
							}
						}
						
						//if file not exist, create a new file 
						if($exist == 0){

							foreach($this->lists as $list){
								if(strcmp(substr($list->name, 0, strlen($AssignmentName)), $AssignmentName)==0){
									$temp = "/wtsai9/".(string)$list->name;
									if(strcmp($temp, $path->pathname) == 0){
										$f_size = $list->size;
									}
								}

							}
							$f_type = $this->file_type($path->pathname);
							$temp = new svn_fileList($f_size, $f_type, $path->pathname);
							$temp->version[] = $temp_ver;
							$this->fileList[] = $temp;
						}
	 				}
				}
			}
			//Check for deleted file, set the file size to 0
			foreach($this->logs as $log){
				foreach($log->paths as $path){
					foreach($this->fileList as $file){
						if (strcmp("D", (string)$path->action) == 0 and strcmp($path->pathname, $file->path)==0){
							$file->size = "0 (File Deleted)";
						}
					}
				}
			}			
			
		}
	
		public function file_type($filename){
			if(strcmp(".json", substr($filename, -5))==0){
				return "JSON File";
			}
			elseif(strcmp(".java", substr($filename, -5))==0 or
				 strcmp(".py", substr($filename, -3))==0){
				return "Code";
			}
			elseif(strcmp(".txt", substr($filename, -4)) ==0 or 
				   strcmp(".docx", substr($filename, -5)) == 0 or 
				   strcmp(".pdf", substr($filename, -4)) == 0){
				return "Doc";
			}
			elseif(strcmp(".jpg", substr($filename, -4)) == 0 or
				   strcmp(".png", substr($filename, -4)) == 0){
				return "Picture";
			}
			elseif(strcmp(".class", substr($filename, -6)) == 0){
				return "Java Class File";
			}
			else{
				return "Other";
			}
			
			
		}
		
	}
	
?>