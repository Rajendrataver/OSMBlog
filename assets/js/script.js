$(document).ready(function () {

    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    });
    jQuery.validator.addMethod("confirm", function (value, element) {
        return this.optional(element) || value === $('#password').val();
    });

    $('.register-form').validate({
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
            }, "password": {
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
            }, "password": {
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
    $(".register-form").validate({
        submitHandler: function (form) {

            $(form).submit();
        }
    });
    $('#profile').change(() => {
        var img = $('#profile')
        var value = img[0].value;
        extension = value.split('.').pop();
        if (extension == 'jpg' || extension == 'png' || extension == 'webp') {
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


    //Blog javascript=================>

    $('#teaserImage').change(() => {
        var img = $('#teaserImage')
        var value = img[0].value;
        extension = value.split('.').pop();
        if (extension == 'jpg' || extension == 'png' || extension == 'webp' || extension == 'jpeg') {
            src = img[0].files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(src);
            fileReader.addEventListener("load", function () {
                document.querySelector('#preview-teaserImage').src = this.result;
            });
            document.querySelector('#teaserImageError').textContent = '';
        } else {
            document.querySelector('#teaserImageError').textContent = 'Select a valid file';
            document.querySelector('#preview-teaserImage').src = '';
        }
    })

    $('#categoryFilter').change(() => {
        $("#category-form").submit();
    })

    $(".register-form").on("submit", function () {
        $("#pageloader").show();
        setTimeout(() => {
            $("#pageloader").hide();
        }, 4000)
    });



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


const hamburger = document.getElementById("hamburger-icon");
const closHamburger = document.getElementById('close-menu-icon');
const menu = document.getElementById("links");
const body = document.querySelector('body');

let closed = true;
const change1 = () => {
    $('#links').hide("slow")
    $('#hamburger-icon').fadeIn(1000)
    $('#close-menu-icon').fadeOut(1000)

};

const change = () => {
    $('#links').show(1000)
    $('#close-menu-icon').fadeIn(1000)
    $('#hamburger-icon').fadeOut(1000)

};
body.addEventListener("wheel", change1);
hamburger.addEventListener("click", change);
closHamburger.addEventListener("click", change1);
