<?php
define('exec', 1) or die();
ini_set('auto_detect_line_endings', TRUE);
require_once '../core/init.php';
$app = new Application();
$db = new DB();
if( Input::get('add_questions') ) {
	if( $_FILES['question']['size'] > 0 ) {
		$filename = $_FILES['question']['tmp_name'];
		$file = fopen( $filename , "r" );
	
		while ( (!feof($file)) and ($row = fgetcsv($file, 1000, ",",'"')) !== FALSE ){	
		
			//insert into the db
			try {
				$app->create('questions', array(
					'qtype' => addslashes(ucfirst(trim($row[1]))),
					'school' => addslashes(ucfirst(trim($row[2]))),
					'year'	=> addslashes(ucfirst(trim($row[3]))),
					'subject'	=> addslashes(ucfirst(trim($row[4]))),
					'question' => addslashes(ucfirst(trim($row[5]))),
					'explanation' => addslashes(ucfirst(trim($row[6]))),
					'opt1'		=> addslashes(ucfirst(trim($row[7]))),
					'opt2'		=> addslashes(ucfirst(trim($row[8]))),
					'opt3'		=> addslashes(ucfirst(trim($row[9]))),
					'opt4'		=> addslashes(ucfirst(trim($row[10]))),
					'ans'		=> addslashes(ucfirst(trim($row[11])))
				));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		fclose($file);
		//successful ouput
		echo json_encode( array( 'type' => 'success', 'msg' => 'Questions added successfully.'));
		exit;
		
		
	}else { //file size <0
		echo json_encode( array('type' => 'warning', 'msg' => 'SIZE IS SMALL'));	
	}
}else {
	echo json_encode( array('type' => 'warning', 'msg' => 'NOT SET') );
	exit;
}
?>		 