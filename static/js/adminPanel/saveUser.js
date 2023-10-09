
function save(formData) {
    formData.addUser = 'addUser';
    $.ajax({
        type: "POST",
        url: 'http://localhost/TrainessT/controller/adminController.php',
        data: formData,
        success: function (response) {
            console.log(response)
            const responseObject = JSON.parse(response);
            const keys = Object.keys(responseObject);
            const keysString = keys.join(', ');
            if (keysString === "erorr") {
                $('#result').html(responseObject["erorr"]);
            }
            else if (keysString === "done") {
                $('#editModal').modal('hide');
                $("#result").text(null);
                refreshUserTable();
            } else if (keysString === "notActivate") {
                alert(responseObject["notActivate"])
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.log('AJAX error:', textStatus, errorThrown);
        }
    });
    return;
}
$("#addUser").on("click", function () {
    $("#editUsername").val(null);
    $("#editEmail").val(null);
    $("#editPassword").val(null);
    $("#isAdmin").val("false");
    $("#isActive").val("false");
    $('#editModal').modal('show');
    $('#editModalLabel').text('Add new User');
    $('#submit').text('Add');
    // $("#editPassword").attr("required", "true");
    $("#edit").attr("id", "save");
})