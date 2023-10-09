<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (isset($_SESSION['logedin'])) {
    $isLogedin = $_SESSION['logedin'];
    if (!$isLogedin) {
        header("Location: index.php");
        exit();
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table with Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <!-- Edit Pop-up Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for editing user details -->
                        <form id="edit">
                            <div class="mb-3">
                                <label for="editUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="editUsername">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="editEmail">
                            </div>
                            <div class="mb-3">
                                <label for="editPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="editPassword">
                            </div>
                            <div class="mb-3">
                                <label for="isAdmin" class="form-label">Is Admin ?</label>
                                <select class="form-select" id="isAdmin">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="isActive" class="form-label">Is Active ?</label>
                                <select class="form-select" id="isActive">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                            <div id="result"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="submit" class="btn btn-primary"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Pop-up Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="deleteUser" data-bs-dismiss="modal" onclick=" deletes()"
                            class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- buttton to add new student -->
        <button class="btn btn-success addUser" id="addUser">addUser</button>
        <!-- table -->
        <table id="data-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script> var username = "";
        var dataToEdit = null;
    </script>
    <script src="static/js/adminPanel/userTable.js"> </script>
    <script src="static/js/adminPanel/deleteUser.js"> </script>
    <script src="static/js/adminPanel/editUser.js"> </script>
    <script src="static/js/adminPanel/saveUser.js"> </script>
    <script>
        createUserTable();
        function refreshUserTable() {
            createUserTable();
        }
    </script>
</body>

</html>

<script>