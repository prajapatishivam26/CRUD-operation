<!-- index.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Set the page title -->
    <title>Student Registration</title>
    <!-- Include Alertify CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
</head>

<body>

    <!-- Registration Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <!-- Registration Form Header -->
                        <h4>Register Here</h4>
                    </div>
                    <div class="card-body">
                        <!-- Registration Form -->
                        <form id="saveStudentForm">
                            <!-- Display error messages if any -->
                            <div id="errorMessage" class="alert alert-warning d-none"></div>
                            <!-- Input field for Name with required attribute -->
                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <!-- Input field for Email with required attribute -->
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" required />
                            </div>
                            <!-- Input field for Phone with required attribute -->
                            <div class="mb-3">
                                <label for="">Phone</label>
                                <input type="text" name="phone" class="form-control" required />
                            </div>
                            <!-- Input field for Password with required attribute -->
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control" required />
                            </div>
                            <!-- Submit button for form submission -->
                            <button type="submit" class="btn btn-primary">Save Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Display Student Data Section -->
    <!-- <div class="container mt-4" id="displaySection" style="display:none;">
        < include 'display.php'; ?>
    </div> -->
    <!-- Load student data section -->
    <div class="container mt-4" id="displaySection" style="display:none;">
        <?php include 'students.php'; ?>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Alertify script -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).ready(function () {
            // Handle registration form submission
            $('#saveStudentForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append("save_student", true);

                // AJAX request to handle form submission
                $.ajax({
                    type: "POST",
                    url: "code.php", // Update the URL to your PHP script
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 422) {
                            // Display error message if any
                            $('#errorMessage').removeClass('d-none');
                            $('#errorMessage').text(res.message);
                        } else if (res.status == 200) {
                            // Hide error message
                            $('#errorMessage').addClass('d-none');
                            // Display success message
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);
                            // Redirect to students.php
                            window.location.href="students.php";
                            // Show the display section
                            $('#displaySection').show();
                            // Load student data into the display section
                            $('#displaySection').load(location.href + " #displaySection");
                        } else if (res.status == 500) {
                            // Display server error message
                            alert(res.message);
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>
