$(document).ready(() => {
    $("#edit").submit(function (e) {
        e.preventDefault();
        var formData = {
            password: dataToEdit !== null ? $("#editPassword").val() === "" ? dataToEdit["password"] : $("#editPassword").val() : $("#editPassword").val(),
            userName: $("#editUsername").val(),
            isAdmin: $("#isAdmin").val() === "true" ? 1 : 0,
            isActive: $("#isActive").val() === "true" ? 1 : 0,
            email: $("#editEmail").val(),
            oldUserName: dataToEdit !== null ? dataToEdit["userName"] : "",
            editUser: true,
        };
        if ($('#submit').text().includes("Add")) {
            save(formData);
        } else {
            edit(formData);
        }
    })
})
function getDataToEdit(data) {
    dataToEdit = data;
    $("#editUsername").val(data["userName"]);
    $("#editEmail").val(data["email"]);
    $("#editPassword").val(null);
    $("#isAdmin").val(data["isAdmin"] === 0 ? "false" : "true");
    $("#isActive").val(data["isActive"] === 0 ? "false" : "true");
    $('#editModalLabel').text('Edit user');
    $('#submit').text('Save changes');
}
function edit(formData) {
    formData.editUser = 'editUser';
    $.ajax({
        type: "POST",
        url: 'http://localhost/TrainessT/controller/adminController.php',
        data: formData,
        success: function (data) {
            $('#editModal').modal('hide');
            console.log(data)
            refreshUserTable();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.log('AJAX error:', textStatus, errorThrown);
        }
    });
}