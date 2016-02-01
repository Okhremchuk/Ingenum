<?php
//Приводим $_SERVER['DOCUMENT_ROOT'] к единому стандарту и другое
class util{
		static private function standartPath($path){
				if(mb_substr($path,-1,1)=='/')$path=mb_substr($path,0,mb_strlen($path)-1);
				return $path;	
			}
		static function getPath(){
				$path=$_SERVER['DOCUMENT_ROOT'];
				return util::standartPath($path);
			}
		static function getURL(){
				$path=$_SERVER['REQUEST_URI'];
				return util::standartPath($path);	
			}
		static function loadFile($file){
				$f=fopen($file,"r");
			  		$cnt=fread($f,filesize($file));
			  	fclose($f);
				return $cnt;
			}
		static function saveFile($file,$cnt,$access='a'){
				$f=fopen($file,$access);
			  		fwrite($f,$cnt);
			  	fclose($f);
			}
	}
?> 