<?php
session_start();

// Define the path to the users JSON file
define('USERS_FILE', 'users.json');

// Helper function to read users from the file
function readUsers() {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $json = file_get_contents(USERS_FILE); // Read the JSON file
    return json_decode($json, true); // Decode JSON to PHP array
}

// Helper function to write users to the file
function writeUsers($users) {
    $json = json_encode($users, JSON_PRETTY_PRINT); // Encode PHP array to JSON
                                                    //Decode JOSON to php array 
    file_put_contents(USERS_FILE, $json); // Write JSON to the file
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $users = readUsers();

    // Check if username already exists
    foreach ($users as $user) {
        if ($user['username'] == $username) {
            $error = 'Username already exists';
            break;
        }
    }

    if (!isset($error)) {
        $users[] = ['username' => $username, 'password' => $password];
        writeUsers($users);
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Register</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
