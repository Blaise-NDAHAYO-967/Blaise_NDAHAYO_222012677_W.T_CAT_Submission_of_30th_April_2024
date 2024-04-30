<?php
include('database_connection.php');

// Check if there are any results
if(isset($_REQUEST['CourseID'])) {
    $cID = $_REQUEST['CourseID'];

    $stmt = $connection->prepare("SELECT * FROM courses WHERE CourseID=?");
    $stmt->bind_param("i", $cID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['CourseName'];
        $z = $row['Description'];
        $w = $row['InstructorID'];
    } else {
        echo "Course not found.";
    }
}
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Update courses</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update courses form -->
        <h2><u>Update Form of courses</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="CourseName">CourseName:</label>
            <input type="text" name="CourseName" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="Description">Description:</label>
            <input type="text" name="Description" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="InstructorID">InstructorID:</label>
            <input type="number" name="InstructorID" value="<?php echo isset($w) ? $w : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
            <input type="hidden" name="CourseID" value="<?php echo $cID; ?>">
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $cName = $_POST['CourseName'];
    $Dcrpt = $_POST['Description'];
    $IID = $_POST['InstructorID'];
    $cID = $_POST['CourseID']; // Retrieve CourseID
    
    // Update the courses in the database
    $stmt = $connection->prepare("UPDATE courses SET CourseName=?, Description=?, InstructorID=? WHERE CourseID=?");
    $stmt->bind_param("ssii", $cName, $Dcrpt, $IID, $cID);
    $stmt->execute();
    
    // Redirect to Courses.php
    header('Location: Courses.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
