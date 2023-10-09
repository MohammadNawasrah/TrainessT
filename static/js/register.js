$(document).ready(function () {
    $('#registrationForm').submit(function (e) {
        e.preventDefault();

        var formData = {
            username: $('#username').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            repeatPassword: $('#repeatPassword').val()
        };
        $.ajax({
            type: 'POST',
            url: 'http://localhost/TrainessT/controller/auth/registrationController.php',
            data: formData,
            success: function (response) {
                const responseObject = JSON.parse(response);
                const keys = Object.keys(responseObject);
                const keysString = keys.join(', ');
                if (keysString === "erorr") {
                    $('#registrationResult').html(responseObject[keysString]);
                }
                else if (keysString === "done") {
                    alert(responseObject[keysString]);
                    window.location.href = "index.php";
                }
            }
        });
    });
});