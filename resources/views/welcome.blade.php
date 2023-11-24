<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toggle Database Information</title>
    <style>
        .btn {
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Toggle Database Information Using Multi Database In Laravel</h1>
    <div class="text-center">
        <button class="btn btn-success" id="toggleButton">Toggle Database</button>
    </div>
    <div class="text-center">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                </tr>
            </thead>
            <tbody id="userDataBody">
                <!-- User data will be dynamically added here -->
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            // Initialize the current database connection
            var currentDatabase = 'mysql1';

            // Function to toggle database and fetch data
            function toggleDatabase() {
                // Toggle the current database
                currentDatabase = currentDatabase === 'mysql1' ? 'mysql2' : 'mysql1';

                // Send AJAX request to get user data from the toggled database
                $.ajax({    
                    url: '/fetch-user',
                    type: 'POST',
                    data: {
                        database: currentDatabase
                    },
                    success: function (data) {
                        // Update the table body with the new user data
                        $('#userDataBody').html(data);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Event listener for the toggle button
            $('#toggleButton').click(function () {
                toggleDatabase();
            });

            // Initial data fetch on page load
            toggleDatabase();
        });
    </script>
</body>
</html>
