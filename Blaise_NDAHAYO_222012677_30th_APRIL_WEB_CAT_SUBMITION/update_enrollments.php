<?php
// Include the database connection file
    include('database_connection.php');

if(isset($_REQUEST['EnrollmentID'])) {
    $EID = $_REQUEST['EnrollmentID'];
    
    $stmt = $connection->prepare("SELECT * FROM enrollments WHERE EnrollmentID=?");
    $stmt->bind_param("i", $EID); // Corrected variable name
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['student_id'];
        $z = $row['CourseID'];
        $w = $row['EnrollmentDate']; // Corrected variable name
    } else {
        echo "enrollment not found.";
    }
}
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Update enrollment</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update enrollment form -->
        <h2><u>Update Form of Enrollment</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="student_id">Student ID:</label>
            <input type="number" name="student_id" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="CourseID">Course ID:</label>
            <input type="number" name="CourseID" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="EnrollmentDate">Enrollment Date:</label>
            <input type="date" name="EnrollmentDate" value="<?php echo isset($w) ? $w : ''; ?>">
            <br><br>

            <input type="submit" name="update" value="Update">
            <input type="hidden" name="EnrollmentID" value="<?php echo $EID; ?>">
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['update'])) {
    // Retrieve updated values from form
    $sid = $_POST['student_id'];
    $cID = $_POST['CourseID'];
    $EDate = $_POST['EnrollmentDate']; 
    $EID = $_POST['EnrollmentID']; // Retrieve EnrollmentID from hidden input
    
    // Update the enrollment in the database
    $stmt = $connection->prepare("UPDATE enrollments SET student_id=?, CourseID=?, EnrollmentDate=? WHERE EnrollmentID=?");
    $stmt->bind_param("iisi", $sid, $cID, $EDate, $EID);
    $stmt->execute();
    
    // Redirect to enrollments.php
    header('Location: enrollments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
