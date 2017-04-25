<?php
require_once 'core/init.php';
if(Input::get('create')) {
	$respond = array( 'type' => 'warning');
	$respond['msg'] = '';
	$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'email' => array(
				'required'	=> true,
				'min'		=> 3,
				'max'		=> 30,
				'unique'	=> 'users'
			),
			'username'	=> array(
				'required'	=> true,
				'min'		=> 2,
				'max'		=> 20,
				'unique'	=> 'users'
				
			),	
			'firstname' => array(
				'required'	=> true,
				'min'		=> 3,
				'max'		=> 20
			),
			'othername' => array(
				'required'	=> true,
				'min'		=> 3,
				'max'		=> 20
			),
			'password'			=> array(
				'required'	=> true,
				'min'		=> 6
			),

			'password_confirm'	=> array(
				'required'	=> true,
				'matches'	=> 'password'
			)
		));

	if( $validation->passed() ){
		$user = new User();

		$salt = Hash::salt(32);
		try {
			$user->create(array(
				'firstname' => ucwords(Input::get('firstname')),
				'othername' => ucwords(Input::get('othername')),
				'email'		=> Input::get('email'),
				'username'	=> Input::get('username'),
				'gender'		=> Input::get('gender'),
				'password' => Hash::make(Input::get('password'), $salt),
				'salt' => $salt,
				'lastlogin'	=> date('Y-m-d H:i:s'),
				'ip'	=> getenv('REMOTE_ADDR'),
				'joined' => date('Y-m-d H:i:s')
				));
			//Message success
			$respond['type'] = 'success';
			$respond['msg']	= 'You have successfully register';
			echo json_encode( $respond );
			exit();

		} catch(Exception $e) {
			die($e->getMessage());
			$respond['msg'] = 'Ooops, something went wrong while creating your account!';
			echo json_encode( $respond );
			exit;
		}
	}else {
		
		foreach($validation->errors() as $error){
			$respond['msg'] .= $error. '<br>';
		}
		 echo json_encode( $respond );
		 exit;
	}
}
?>
<!DOCTYPE html>
<head>
	<title>Obes</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrapValidator.css">
</head>
<body class="philtech-bg-image-2">

    <div class="container-fluid menu-wrap hidden-sm ">
        <div class="container">
            <div class="col-md-offset-1 col-md-10 menu">
                
            </div>
        </div>
    </div><!--Menu Wrap Close -->
	<div class="container">
		<div class="col-md-12">			
			<form class="form-horizontal philtech-login-form philtech-container" role="form" id="register_form" method="post">
				<div class="form-inner">
					<div id="registerstatus"></div>
					<div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="first_name" class="control-label">First Name</label>
			            <input type="text" class="form-control" name="firstname" id="first_name" placeholder="First name" autofocus="autofocus">		            		            		            
			          </div>  
			          <div class="col-md-6">		          	
			            <label for="othername" class="control-label">Last Name</label>
			            <input type="text" class="form-control" name="othername" id="other_name" placeholder="Lastname">		            		            		            
			          </div>             
			        </div>
			        <div class="form-group">
			          <div class="col-md-12">		          	
			            <label for="email" class="control-label">Email</label>
			            <input type="email" class="form-control" name="email" id="email" placeholder="Please enter a valid email">		            		            		            
			          </div>              
			        </div>			
			        <div class="form-group">
			          <div class="col-md-6">		          	
			            <label for="username" class="control-label">Username</label>
			            <input type="text" class="form-control" name="username" id="username" placeholder="Username">		            		            		            
			          </div>
			          <div class="col-md-6 philtech-radio-group">
			          	<label class="radio-inline">
		          			<input type="radio" name="gender" id="options1" value="Male" checked> Male
		          		</label>
		          		<label class="radio-inline">
		          			<input type="radio" name="gender" id="options2" value="Female"> Female
		          		</label>
			          </div>             
			        </div>
			        <div class="form-group">
			          <div class="col-md-6">
			            <label for="password" class="control-label">Password</label>
			            <input type="password" class="form-control" name="password" id="password" placeholder="Your desired password">
			          </div>
			          <div class="col-md-6">
			            <label for="password" class="control-label">Confirm Password</label>
			            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Type your passord again">
			          </div>
			        </div>
			        <div class="form-group">
			          <div class="col-md-12">
			            <label for="terms"><input type="checkbox" name="terms">I agree to the <a href="javascript:;" data-toggle="modal" data-target="#philtech_modal">Terms of Service</a></label>
			          </div>
			        </div>
			        
			        <div class="form-group">
			          <div class="col-md-12">
			          	<input type="hidden" name="create" value="create" />
			            <input type="submit" value="Create My Account" class="btn btn-sm btn-info btn-block">
			          </div>
			        </div>	
				</div>				    	
		      </form>		      
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="philtech_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Terms of Service</h4>
	      </div>
	      <div class="modal-body">
	      	<p>This form is provided by <a rel="nofollow" href="http://www.philtech.com/page/1">Free HTML5 Templates</a> that can be used for your websites. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
	        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
	        <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
$('#register_form').bootstrapValidator({
    feedbackIcons : {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
    	firstname : {
          validators: {
              notEmpty: {
                  message: 'Field Can\'t be Empty!'
              }
          }
      	},
      	lastname : {
          validators: {
              notEmpty: {
                  message: 'Field Can\'t be Empty!'
              }
          }
      	},
      	email: {
          validators: {
          	  notEmpty: {
          	  	message: 'Email field can not be empty'
          	  },
              emailAddress: {
                message: 'The input is not a valid email address'
              }
          }
      	},
      	terms: {
      		validators: {
              notEmpty: {
                  message: 'You must agree to the terms and condition'
              }
          	}
      	},
      	username : {
          validators: {
              notEmpty: {
                  message: 'Field Can\'t be Empty!'
              }
          }
      	},
      	password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    identical: {
                        field: 'password_confirm',
                        message: 'The password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
          },
          password_confirm: {
              validators: {
                  notEmpty: {
                      message: 'The confirm password is required and cannot be empty'
                  },
                  identical: {
                      field: 'password',
                      message: 'The password and its confirm are not the same'
                  },
                  different: {
                      field: 'username',
                      message: 'The password cannot be the same as username'
                  }
              }
          }    	

  	} //fields

})
.on('success.form.bv', function(e) {
    e.preventDefault();
    var values = $('#register_form').serialize();
    
    $.post('register.php', values, function( respond ){
      var respond = jQuery.parseJSON(respond);

       if( $.trim(respond.type) == "success" ) {
          var alert = "<p class='alert alert-"+respond.type+"'>"+respond.msg+"</p>";
          $('#registerstatus').html(alert).slideUp().delay(3000).slideDown();
          $('#register_form').trigger('reset');
          window.location = 'register.php';
          return;
        } else {
          var alert = "<p class='alert alert-"+respond.type+"'>"+respond.msg+"</p>";
          $('#registerstatus').html(alert).slideDown();
        }
    }); //post
});
</script>
</body>
</html>