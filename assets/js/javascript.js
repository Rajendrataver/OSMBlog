$(document).ready(function () {
    $('.form').validate({
        rules: {
            email: {
                required: true,
            }, "password": {
                required: true,
            }
        },
        messages: {
            email: {
                required: "Email or username Is Required",

            }, "password": {
                required: 'Password is Required',
            }
        }
    });
    $(".form").validate({
        submitHandler: function (form) {
            $(form).submit();
        }
    });
})