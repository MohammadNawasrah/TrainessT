$(document).ready(function () {
    $('#loginForm').submit(function (e) {
        e.preventDefault();
        var formData = {
            username: $('#username').val(),
            password: $('#password').val()
        };
        $.ajax({
            type: 'POST',
            url: 'http://localhost/TrainessT/controller/auth/loginController.php', // Replace with your server-side endpoint
            data: formData,
            success: function (response) {
                const responseObject = JSON.parse(response);
                const keys = Object.keys(responseObject);
                const keysString = keys.join(', ');
                if (keysString === "erorr") {
                    $('#result').html(responseObject["erorr"]);
                }
                else if (keysString === "done") {
                    createSesssion();
                    window.location.href = `/TrainessT/${responseObject["done"]}.php`;
                } else if (keysString === "notActivate") {
                    alert(responseObject["notActivate"])
                }
            }
        });
    });
});