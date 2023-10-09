function deletes() {
    var formData = {
        username: username,
        deleteUser: true,
    };

    $.ajax({
        type: "POST",
        url: 'http://localhost/TrainessT/controller/adminController.php',
        data: formData,
        success: function (data) {
            console.log(data)
            refreshUserTable();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.log('AJAX error:', textStatus, errorThrown);
        }
    });
}
function deleteUser(userName) {
    username = userName;
    console.log(userName)
}