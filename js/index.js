$(document).ready( function() {
$('#login_form').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        username: {
            validators: {
                notEmpty: {
                    message: 'Field Can\'t be Empty!'
                },
                stringLength: {
                    min: 3,
                    max: 60,
                    message: 'Field character between 3-10 characters'
                }
            }
        },

        password: {
            validators: {
                nonEmpty: {
                    message: "Fields Can't Be Empty"
                },
                stringLength: {
                    min: 3,
                    max: 60,
                    message: "Fields Can't be more than 3-10 characters"
                }
            }
        }
    }//fields
})
.on('success.form.bv', function(e) {
    // Prevent submit form
    e.preventDefault();
    var values = $('#login_form').serialize();
    $.post('index.php', values, function(resp){

        var resp = JSON.parse(resp);

        //Not necessary to make if statement
        if( resp.status == "success" ) {
                window.location = 'home.php';
            return;
        }
        alert = "<p class='alert alert-"+resp.status+"'>"+resp.msg+"</p>";
        $('#loginstatus').html(alert).slideDown().delay(2000).slideUp();
    });
}); //Login Form Ends
//Registration form starts
$('#register_form').bootstrapValidator({
    feedbackIcons : {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        fullname : {
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
    
    $.post('index.php', values, function( respond ){
      var respond = jQuery.parseJSON(respond);

       if( $.trim(respond.type) == "success" ) {
          var alert = "<p class='alert alert-"+respond.type+"'>"+respond.msg+", please login with your details</p>";
          $('#registerstatus').html(alert).slideUp().delay(30000).slideDown();
          $('#register_form').trigger('reset');
          window.location = 'index.php';
          return;
        } else {
          var alert = "<p class='alert alert-"+respond.type+"'>"+respond.msg+"</p>";
          $('#registerstatus').html(alert).slideDown();
        }
    }); //post
});//Registration form ends
$('#retrieve_form').bootstrapValidator({
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        retrieveemail: {
          validators: {
              notEmpty: {
                message: 'Email field can not be empty'
              },
              emailAddress: {
                message: 'The input is not a valid email address'
              }
          }
        }
    }//fields
})
.on('success.form.bv', function(e) {
    // Prevent submit form
    e.preventDefault();
    var values = $('#retrieve_form').serialize();
    $.post('index.php', values, function(resp){
        var resp = JSON.parse(resp);
        if( resp.status == "success" ) {
            alert = "<p class='alert alert-"+resp.status+"'>"+resp.msg+"</p>";
            $('#retrievestatus').html(alert).slideDown();
        }
        alert = "<p class='alert alert-"+resp.status+"'>"+resp.msg+"</p>";
        $('#retrievestatus').html(alert).slideDown();
    });
}); //Login Form Ends
});//Document ready ends here