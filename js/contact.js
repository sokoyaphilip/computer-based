$(document).ready(function(){
// Generate a simple captcha
function randomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
};
$('#captchaOperation').html([randomNumber(1, 10), '+', randomNumber(1, 10), '-', randomNumber(1, 10), ' ='].join(' '));
//var capt = $('#captchaOperation').html();
$('#contactform').bootstrapValidator({
    message: 'This value is not valid',
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'You have to type your name!'
                },
                stringLength: {
                    min: 3,
                    max: 30,
                    message: 'Your name can\'t be more than 3 and less than 30 characters'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9 _\.]+$/,
                    message: 'Your name can only consist of (a-zA-Z0-9 .)'
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'Email field can\'t be empty'
                },
                emailAddress: {
                    message: 'This is not a valid email address'
                }
            }
        },
        subject: {
            validators: {
                notEmpty: {
                    message: 'Subject field is required'
                }
            },
            regexp: {
                regexp: /^[a-zA-Z0-9_\.]+$/,
                message: 'Subject can only consist of (a-zA-Z0-9.)'
            }
        },
        message: {
            validators: {
                notEmpty: {
                    message: 'message field is required'
                }
            },
            regexp: {
                regexp: /^[a-zA-Z0-9_\.\?\,]+$/,
                message: 'message can only consist of (a-zA-Z0-9,?.)'
            }
        },
        captcha: {
            validators: {
                notEmpty: {
                    message: 'Make the calculation'
                },
                callback: {
                    message: 'Wrong Answer!',
                    callback: function(value, validator) {
                        var items = $('#captchaOperation').html().split(' '), value = parseInt(items[0]) + parseInt(items[2]) - parseInt(items[4]);
                        return value == value;
                    }
                }
            }
        }
    }
})
.on('success.form.bv', function(e) {
    // Prevent submit form
    e.preventDefault();
    var values = $('#contactform').serialize();
    $.post('contact.php', values, function(respond){
        var respond = JSON.parse(respond);
        if ( respond.type == 'success' ) {
            $('#contactform').fadeOut('fast', function(){
                alert = '<p class="mid"><h3><strong>Thank You!</strong></h3>'
                +'<br><h4>We would get back to your message as soon as possible.</h4></p>';
                $(this).html(alert);
                $(this).fadeIn('slow');
            });
        }else{
            alert = "<p class='alert alert-"+resp.status+"'>"+resp.msg+"</p>";
            $('#contactstatus').html( alert ).slideDown().delay(3000).slideUp;
        }
    });
});

});
