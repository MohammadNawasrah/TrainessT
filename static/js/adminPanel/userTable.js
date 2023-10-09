function createUserTable() {
    var formData = {
        getUsers: true,

    };
    $.ajax({
        type: "POST",
        url: 'http://localhost/TrainessT/controller/adminController.php',
        dataType: 'json',
        data: formData,
        success: function (data) {
            console.log(data)
            var tableBody = $('#data-table tbody');
            tableBody.empty();
            $.each(data, (index, record) => {
                var row = '<tr>' +
                    '<td>' + record.userName + '</td>' +
                    '<td>' + record.email + '</td>' +
                    `<td><button class="btn btn-primary edit-btn" onclick='getDataToEdit(${JSON.stringify(record)})'>Edit</button></td> ` +
                    '<td><button class="btn btn-danger delete-btn" onclick="deleteUser(\'' + record.userName + '\')">Delete</button></td>' +
                    '</tr>';
                tableBody.append(row);
            });

            // Add click handlers for edit and delete buttons
            tableBody.on('click', '.edit-btn', function () {

                // Handle edit action here, e.g., open the edit modal
                $('#editModal').modal('show');
            });

            tableBody.on('click', '.delete-btn', function () {
                var id = $(this).data('id');
                // Handle delete action here, e.g., open the delete modal
                $('#deleteModal').modal('show');
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.log('AJAX error:', textStatus, errorThrown);
        }
    });

};