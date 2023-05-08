$(document).ready(function () {
    $("#pageloader").show();
    setTimeout(() => {
        $("#pageloader").hide();
    }, 1000)
    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    });
    console.log('coming');
    $('.blog-form').validate({
        rules: {
            title: {
                required: true,
                lettersonly: true,
                minlength: 2,
                maxlength: 20,

            },
            addCategory: {
                lettersonly: true,
                minlength: 3,
                maxlength: 20
            },
            shortNote: {
                required: true,
                minlength: 50,
            },
            description: {
                required: true,
                minlength: 100,
            }
        },
        messages: {
            title: {
                required: "Blog Title is Required",
                lettersonly: "Blog Title can be only Letters",
                minlength: "Title Min length can be 2 letters",
                maxlength: "Title Max length can be 20 letters",

            },
            addCategory: {
                lettersonly: "Category can be only Letters",
                minlength: "Category must have 3 character",
                lettersonly: "Category can be only Letters",
                maxlength: "Category can have 20 character"
            }, shortNote: {
                required: 'Blog Short Description is Required',
                minlength: "Blog Short Description must be 50 character",
            },
            description: {
                required: "Blog Description is Requireed",
                minlength: "Blog must have 100 words",
            }
        }


    });
    $(".blog-form").validate({
        submitHandler: function (form) {
            $(form).submit();
        }
    })
    $

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
    $('#bannerImage').change(() => {
        var img = $('#bannerImage')
        var value = img[0].value;
        extension = value.split('.').pop();
        if (extension == 'jpg' || extension == 'png' || extension == 'webp' || extension == 'jpeg') {
            src = img[0].files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(src);
            fileReader.addEventListener("load", function () {
                document.querySelector('#preview-bannerImage').src = this.result;
            });
            document.querySelector('#bannerImageError').textContent = '';
        } else {
            document.querySelector('#bannerImageError').textContent = 'Select a valid file';
            document.querySelector('#preview-bannerImage').src = '';
        }
    })

    $('#category').change(() => {
        var category = $('#category')
        var value = category.val();
        console.log(value);
        if (value != 'Select') {
            document.getElementById('addCategory').value = '';
            document.getElementById('addCategory').readOnly = true;

        } else {
            document.getElementById('addCategory').readOnly = false;
        }
    })
    $("#category").load(() => {
        console.log('hi');
        if (this.val() != 'Select') {
            document.getElementById('addCategory').readOnly = true;
        }
    })

});