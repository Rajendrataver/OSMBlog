$(document).ready(function () {
  
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    });
    jQuery.validator.addMethod("confirm", function (value, element) {
        return this.optional(element) || value === $('#password').val();
    });

    $('.update-form').validate({
        rules: {
            name: {
                required: true,
                lettersonly: true,
                minlength: 2,
                maxlength: 20,

            }, email: {
                required: true,
                email: true
            },
            username: {
                required: true,
                minlength: 8,
                maxlength: 15
            },
            gender: {
                required: true,
            },
            currentPassword: {
                required: true,
            },
            "password": {
                required: true,
                minlength: 8,
                maxlength: 12,
            }, cpassword: {
                required: true,
                minlength: 8,
                confirm: true,
            }
        },
        messages: {
            name: {
                lettersonly: "Please enter characters only",
                required: "Name is Required",
                lettersonly: "Please enter characters only",
                minlength: "Name Must be Atleast 2 character",
                maxlength: "Name can be only 20 character"
            },
            email: {
                required: "Email Is Required",
                email: "Enter a Valid Email"
            },
            username: {
                required: "Username Is Required",
                minlength: "Username must be Atleast 8 character",
                maxlength: "Username can't more than 15 character"
            },
            gender: {
                required: "Select Gender"
            }, currentPassword: {
                required: 'Current Password Is Required',
            }
            , "password": {
                required: "Password is Required",
                minlength: "password must be 8 character",
                maxlength: "Password must be 12 character",
            }, cpassword: {
                required: "Confirm Password",
                minlength: "password must be same",
                confirm: "password must be same",
            }
        }
    });
    $(".update-form").validate({
        submitHandler: function (form) {
            $(form).submit();
        }
    });
    $('#profile').change(() => {
        var img = $('#profile')
        var value = img[0].value;
        extension = value.split('.').pop();
        console.log(extension);
        if (extension == 'jpg' || extension == 'png' || extension == 'webp' || extension == 'jpeg') {
            src = img[0].files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(src);
            fileReader.addEventListener("load", function () {
                document.querySelector('#avatar').src = this.result;
            });
            document.querySelector('#profileError').textContent = '';
        } else {
            document.querySelector('#profileError').textContent = 'Select a valid file';
            document.querySelector('#avatar').src = '';
        }
    });

    var ele = document.getElementById('password-checkbox').checked;
    if (ele) {
        $('.password-container').show()
    }

    $('#password-checkbox').change(() => {
        var ele = document.getElementById('password-checkbox').checked;
        if (ele) {
            $('.password-container').show()
        }
        else {
            $('.password-container').hide()
        }
    })
})