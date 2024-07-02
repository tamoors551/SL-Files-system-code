http://localhost/Tamoor/Extra%20Working/previous-data/Files-system-code/files%20-%20system-crud/index.php
<?php
// Start a new session or resume an existing session.
session_start();

// Check if the user is logged in.
// If the 'loggedin' session variable is not set or is false, redirect to 'login.php' and exit.
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
    exit;
}

// Define the path to the JSON file that will store the student data.
define('STUDENTS_FILE', 'students.json');

// Helper function to read students from the file.
function readStudents() {
    // Check if the JSON file exists. If not, return an empty array.
    if (!file_exists(STUDENTS_FILE)) {
        return [];
    }
    // Read the contents of the JSON file.
    $json = file_get_contents(STUDENTS_FILE);
    //* Decode the JSON data to a PHP array and return it.
    return json_decode($json, true);
}

// Helper function to write students to the file.
function writeStudents($students) {
    // Encode the PHP array to a JSON string with pretty print formatting.
    $json = json_encode($students, JSON_PRETTY_PRINT);
    // Write the JSON string to the file.
    file_put_contents(STUDENTS_FILE, $json);
}

// Function to create a new student.
function createStudent($name, $age) {
    // Read the current list of students.
    $students = readStudents();
    // Generate a unique ID for the new student.
    $id = uniqid();
    // Add the new student to the students array.
    $students[] = ['id' => $id, 'name' => $name, 'age' => $age];
    // Write the updated students array back to the file.
    writeStudents($students);
}

// Function to display the list of students.
function displayStudents() {
    // Read the students from the file.
    $students = readStudents();
    echo '<h2>Student List</h2>';
    echo '<table class="table table-bordered"><thead class="thead-dark"><tr><th>ID</th><th>Name</th><th>Age</th><th>Actions</th></tr></thead 
    </tbody>';
    // Loop through each student and display their details in a table row.><
    foreach ($students as $student) {

        echo "<tr><td>{$student['id']}</td><td>{$student['name']}</td><td>{$student['age']}</td>";
        // Provide 'Edit' and 'Delete' action links for each student.
        echo "<td><a href=\"?action=edit&id={$student['id']}\" class=\"btn btn-warning btn-sm\">Edit</a> ";
        echo "<a href=\"?action=delete&id={$student['id']}\" class=\"btn btn-danger btn-sm\">Delete</a></td></tr>";
    }
    echo '</tbody></table>';
}

// Function to update an existing student.
function updateStudent($id, $name, $age) {
    // Read the current list of students.
    $students = readStudents();
    // Loop through each student to find the one with the matching ID.

    foreach ($students as &$student) {

        if ($student['id'] == $id) {
            // Update the student's name and age.
            $student['name'] = $name;
            $student['age'] = $age;
            break;
        }
    }
    // Write the updated students array back to the file.
    writeStudents($students);
}

// Function to delete a student.
function deleteStudent($id) {
    // Read the current list of students.
    $students = readStudents();
    // Filter out the student with the matching ID.
    $students = array_filter($students, function($student) use ($id) {
        return $student['id'] !== $id;
    });
    // Write the updated students array back to the file.
    writeStudents($students);
}

// Handle form submissions and actions.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle create or update actions based on the 'action' value from the form.
    if ($_POST['action'] == 'create') {
        createStudent($_POST['name'], $_POST['age']);
    } elseif ($_POST['action'] == 'update') {
        updateStudent($_POST['id'], $_POST['name'], $_POST['age']);
    }
} elseif (isset($_GET['action'])) {
    // Handle delete and edit actions based on the 'action' value from the URL.
    if ($_GET['action'] == 'delete') {
        deleteStudent($_GET['id']);
    } elseif ($_GET['action'] == 'edit') {
        $students = readStudents();
        // Find the student to be edited.
        $student = array_filter($students, function($s) {
            return $s['id'] == $_GET['id'];
        });
        $student = array_shift($student); // Get the first (and only) element of the filtered array.
        // Display the edit form with the student's current data.
        echo '<div class="container mt-5">';
        echo '<h2>Edit Student</h2>';
        echo '<form method="POST">';
        echo '<input type="hidden" name="action" value="update">';
        echo '<input type="hidden" name="id" value="' . htmlspecialchars($student['id']) . '">';
        echo '<div class="form-group">';
        echo '<label>Name:</label>';
        echo '<input type="text" name="name" class="form-control" value="' . htmlspecialchars($student['name']) . '">';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label>Age:</label>';
        echo '<input type="text" name="age" class="form-control" value="' . htmlspecialchars($student['age']) . '">';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary">Update Student</button>';
        echo '</form>';
        echo '</div>';
        exit; // Stop further script execution to show only the edit form.
    }
}
/*
//*The htmlspecialchars() function converts the following characters to their HTML entity equivalents:

& (ampersand) becomes &amp;
" (double quote) becomes &quot;
' (single quote) becomes &#039;
< (less than) becomes &lt;
> (greater than) becomes &gt;
Here's an example of how to use htmlspecialchars():

*/

// HTML structure with Bootstrap for the page.
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Student CRUD</title>';
echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
echo '</head>';
echo '<body>';
echo '<div class="container mt-5">';
echo '<h2>Add New Student</h2>';
// Form to add a new student.
echo '<form method="POST" class="mb-4">';
echo '<input type="hidden" name="action" value="create">';
echo '<div class="form-group">';
echo '<label>Name:</label>';
echo '<input type="text" name="name" class="form-control" required>';
echo '</div>';
echo '<div class="form-group">';
echo '<label>Age:</label>';
echo '<input type="text" name="age" class="form-control" required>';
echo '</div>';
echo '<button type="submit" class="btn btn-success">Add Student</button>';
echo '</form>';

// Display the list of students.
displayStudents();

// Logout button to end the session.
echo '<a href="logout.php" class="btn btn-danger mt-4">Logout</a>';
echo '</div>';

// Include Bootstrap JS libraries.
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
echo '</body>';
echo '</html>';
?>
```

<!-- ### Summary
This PHP script provides a basic CRUD (Create, Read, Update, Delete) application for managing student data stored in a JSON file.
 It includes functions for creating, reading, updating, and deleting students, as well as handling user authentication via sessions.
  The HTML output is styled using Bootstrap for a better user interface. -->