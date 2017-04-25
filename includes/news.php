<?php
define('exec', 1) or die();
require_once '../core/init.php';
$app = new Application();
$db = new DB();
if( Input::get('title') ) {
	$folder = dirname(__DIR__).'/images/uploads';
	$respond = array( 'type' => 'warning');
	if( isset($_FILES['file']) ){
		$respond['msg'] = 'success';
		// create an array of permitted image MIME types
	    $permittedImage = array( 'image/jpeg', 'image/png', 'image/gif' );
	    //get file details we need
		$file_tmp_name 	  = $_FILES['file']['tmp_name'];
		$file_name 		  = $_FILES['file']['name'];
		$file_size 		  = $_FILES['file']['size'];
		$ext     		  = substr( $_FILES['file']['name'], strrpos($_FILES['file']['name'],'.') );
		$file_error 	  = $_FILES['file']['error'];

		if( in_array( $_FILES['file']['type'], $permittedImage ) && ( $file_size > 0 ) && $file_size <= 2048 * 1536 ) {
			//switch for error
			if($file_error > 0) {
				$mymsg = array( 
				1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini", 
				2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form", 
				3 => "The uploaded file was only partially uploaded", 
				4 => "No file was uploaded", 
				6 => "Missing a temporary folder" ); 
				
				echo json_encode(array('type'=>'warning', 'msg' => $mymsg[$file_error]));
				exit;
			} //end file error
			// Create directory(folder) to hold each img
			if (!file_exists("$folder")) {
				mkdir("$folder", 0755);
			}
			$dbname = date("Y-m-d-s");
			$imagename = $dbname;
			$destination = "$folder";
			//move uploaded file
			$result = @move_uploaded_file( $_FILES['file']['tmp_name'], $destination. "/" .$imagename.$ext );
			if( $result ) {
				//resize the image now

				$resizeObj = new Resize($destination. "/" .$imagename.$ext);
				/*if( $file_size <= 703 * 306) {
					list($w, $h) = getimagesize( $destination.'/'.$imagename.$ext);
				}else {
					$w = 702; $h = 336;
				}*/
				$resizeObj -> resizeImage( 706, 336, 'crop');
				$success = $resizeObj -> saveImage("{$destination}/{$imagename}.jpg", 100);
				if( $success ) {
					//Insert into the database	
					//unlink( $destination. '/'.$imagename.$ext );
					try {
						$app->create( 'blog' , array(
										"title" 	=> Input::get('title'),
										"content"	=> Input::get('content'),
										"author"		=> 'Sokoya Philip',
										"newscoverphoto"=> $dbname.'.jpg',
										"postdate"	=> date('Y-m-d H:i:s')
									));
						echo json_encode( array('type' => 'success', 'msg' => 'The News Has Been Posted Successfully!'));
						exit;
					} catch (Exception $e) {
						echo json_encode( array('type' => 'warning', 'msg' => $e->getMessage()) );
						exit;
					}

				} else {
					echo json_encode( array( 'type' => 'warning', 'msg' => "Image was not successfully re-crop!") );
					exit;
				}

			}else {
				echo json_encode( array( 'type' => 'warning', 'msg' => "Image was not moved to permanent folder, please try again!") );
				exit;
			}
		}else {
			$respond['msg'] = 'File Size exceeds the system size (2048 * 1536)';
			echo json_encode( $respond );
			exit;
		}
		
	}else { //Set Image to default
		try {
			$app->create( 'blog' , array(
						"title" 	=> Input::get('title'),
						"content"	=> Input::get('content'),
						"author"		=> 'Sokoya Philip',
						"newscoverphoto" => '',
						"postdate"	=> date('Y-m-d H:i:s')
					));
				echo json_encode( array('type' => 'success', 'msg' => 'The News Has Been Posted Successfully!'));
				exit;
			} catch (Exception $e) {
				echo json_encode( array('type' => 'warning', 'msg' => $e->getMessage()) );
				exit;
			}
	}// end of else
}
?>		 