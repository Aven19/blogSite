document.addEventListener("DOMContentLoaded", function (event) {

    $(".registration_form").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2,
                maxlength: 255

            },
            last_name: {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            email: {
                required: true,
                regex: /[A-Z0-9a-z-._]{3,}@[-A-Za-z0-9]{3,}[.]{1}[A-Za-z]{2,6}/,
                email: true,
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15,
            },
            password: {
                required: true,
                minlength: 6,
            },
            password_confirmation: {
                required: true,
                minlength: 6,
            },
        },
        messages: {
            email: {
                regex: "Please enter a valid email address.",
            },
        },
        errorClass: "error-class-labels"
    });

    $(".login_form").validate({
        rules: {
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15,
            },
            password: {
                required: true,
                minlength: 6,
            }
        },
        errorClass: "error-class-labels"
    });

    $(".blog-add-form").validate({
        rules: {
            title: {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            file: {
                required: true,
                extension: "jpg|jpeg|png",
                filesize: 2242880,
            },
            description: {
                required: true,
            },

        },
        messages: {
            file: {
                filesize: "File size must be less than 2 mb",
            },
        },
        errorClass: "error-class-labels"
    });

    $(".blog-edit-form").validate({
        rules: {
            title: {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            file: {
                required: false,
                extension: "jpg|jpeg|png",
                filesize: 2242880,
            },
            description: {
                required: true,
            },

        },
        messages: {
            file: {
                filesize: "File size must be less than 2 mb",
            },
        },
        errorClass: "error-class-labels"
    });

});
