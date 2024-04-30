<?php
// Include the database connection file
include('database_connection.php');

// Check if search term is provided
if (isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query for assignments
    $sql_assignments = "SELECT * FROM assignments WHERE AssignmentName LIKE '%$searchTerm%'";
    $result_assignments = $connection->query($sql_assignments);

    // Perform the search query for courses
    $sql_courses = "SELECT * FROM courses WHERE CourseName LIKE '%$searchTerm%'";
    $result_courses = $connection->query($sql_courses);

    // Perform the search query for enrollments
    $sql_enrollments = "SELECT * FROM enrollments WHERE student_id LIKE '%$searchTerm%'";
    $result_enrollments = $connection->query($sql_enrollments);

    // Perform the search query for instructors
    $sql_instructors = "SELECT * FROM instructors WHERE InstructorName LIKE '%$searchTerm%'";
    $result_instructors = $connection->query($sql_instructors);

     // Perform the search query for students
    $sql_students = "SELECT * FROM students WHERE email LIKE '%$searchTerm%'";
    $result_students = $connection->query($sql_students);

    // Perform the search query for submissions
    $sql_submissions = "SELECT * FROM submissions WHERE AssignmentID LIKE '%$searchTerm%'";
    $result_submissions = $connection->query($sql_submissions);



    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    
    // Display assignments
    echo "<h3>assignments:</h3>";
    if ($result_assignments->num_rows > 0) {
        while ($row = $result_assignments->fetch_assoc()) {
            echo "<p>" . $row['AssignmentName'] . "</p>";
        }
    } else {
        echo "<p>No assignments found matching the search term: " . $searchTerm . "</p>";
    }

    // Display courses
    echo "<h3>courses:</h3>";
    if ($result_courses->num_rows > 0) {
        while ($row = $result_courses->fetch_assoc()) {
            echo "<p>" . $row['CourseName'] . "</p>";
        }
    } else {
        echo "<p>No courses found matching the search term: " . $searchTerm . "</p>";
    }

    // Display enrollments
    echo "<h3>Payment:</h3>";
    if ($result_enrollments->num_rows > 0) {
        while ($row = $result_enrollments->fetch_assoc()) {
            echo "<p>" . $row['student_id'] . "</p>";
        }
    } else {
        echo "<p>No enrollments found matching the search term: " . $searchTerm . "</p>";
    }

    // Display instructors
    echo "<h3>instructors:</h3>";
    if ($result_instructors->num_rows > 0) {
        while ($row = $result_instructors->fetch_assoc()) {
            echo "<p>" . $row['InstructorName'] . "</p>";
        }
    } else {
        echo "<p>No instructors found matching the search term: " . $searchTerm . "</p>";
    }

     // Display students
    echo "<h3>students:</h3>";
    if ($result_students->num_rows > 0) {
        while ($row = $result_students->fetch_assoc()) {
            echo "<p>" . $row['email'] . "</p>";
        }
    } else {
        echo "<p>No students found matching the search term: " . $searchTerm . "</p>";
    }

    // Display students
    echo "<h3>students:</h3>";
    if ($result_submissions->num_rows > 0) {
        while ($row = $result_submissions->fetch_assoc()) {
            echo "<p>" . $row['AssignmentID'] . "</p>";
        }
    } else {
        echo "<p>No submissions found matching the search term: " . $searchTerm . "</p>";
    }

    // Close the database connection
    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
