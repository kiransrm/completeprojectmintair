<?php
/* written by kiransrm*/

class CommonFunctions{


	public function downloadFile($file, $dir = ''){

		try{
			if(file_exists($dir.$file)) {
		        header('Content-Description: File Transfer');
		        header('Content-Type: application/octet-stream');
		        header('Content-Disposition: attachment; filename="'.basename($dir.$file).'"');
		        header('Expires: 0');
		        header('Cache-Control: must-revalidate');
		        header('Pragma: public');
		        header('Content-Length: ' . filesize($dir.$file));
		        flush(); // Flush system output buffer
		        readfile($dir.$file);
		    	exit;
			}
		}
		catch (Exception $e) {

			echo $e->getMessage();

		}
	    
	}

	public function deleteFile($filename, $dir = ''){

		try {
			
			if(file_exists($dir.$filename)){

				if(unlink($dir.$filename)){
					return true;
				}
				else{
					return false;
				}
				

			}

		} catch (Exception $e) {

			echo $e->getMessage();

		}
		
	}

	public function doUpload($filename, $newFilename, $dir){

	 	$file_tmp = $filename['tmp_name'];
	 	$file_name = $filename['name'];
	 	//$newFilename = $this->renameUploadFile($file_name);
	   	try {

  			if(!move_uploaded_file($file_tmp,WEB_PATH.'/'.$dir.'/'.$newFilename)){

  				return false;
  			}else{
  				return true;
  			}
		  	
		}

		catch(Exception $e) {
		  echo $e->getMessage();
		}


	}
	public function fileUploadValidation($filename, $allowExtension){
		
		$file_name = $filename['name'];
      	//$file_size = $filename['size'];
      	$file_type = $filename['type'];
      	
      	if(empty($file_name)){

      		throw new Exception('Please Upload a File!'); ;
      	
      	}
      	else{

      		$file_ext=$this->getFileExtension($file_name);

      		// check if the extension passed as array or just a text

      		$allowExtension = is_array($allowExtension) ? $allowExtension : explode(',',$tables);

      		/*if(count($allowExtension > 1)):
      			// if there is more than one extension sperate by coma
      			$showAsText = implode(", ", $allowExtension);
      		else:
      			$showAsText = implode(" ", $allowExtension);
      		endif;*/

      		if(in_array($file_ext, $allowExtension)){

      			throw new Exception( "Extension not allowed, please upload valid file");
      		}

      		/* TBD
      		If need in future add file size
      		*/

      		/* true if there is no error*/

      		
      	}
      	return true;
	}

	public function getFileExtension($filename) 
 	{ 
 		$dd=strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	 	return  $dd; 
 	}

 	public function renameUploadFile($filename){

 		$oldFilename = pathinfo($filename, PATHINFO_FILENAME);

 		$Extension  = $this->getFileExtension($filename);

 		$newFilename = $oldFilename.time().'.'.$Extension;

 		return $newFilename;
 	}
}

