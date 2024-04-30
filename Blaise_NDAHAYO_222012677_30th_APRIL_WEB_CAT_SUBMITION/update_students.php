<?php
 include('database_connection.php');
        // Check if there are any results
if(isset($_REQUEST['student_id'])) {
    $sid = $_REQUEST['student_id'];
    
    $stmt = $connection->prepare("SELECT * FROM students WHERE student_id=?");
    $stmt->bind_param("i", $sid); // Corrected variable name
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['first_name'];
        $z = $row['last_name'];
         $y = $row['age'];
        $z = $row['email'];
        $z = $row['gender'];
        $w = $row['student_id']; // Corrected variable name
    } else {
        echo "students not found.";
    }
}
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Update students</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update students form -->
    <h2><u>Update Form of students</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="first_name">first_name:</label>
        <input type="text" name="first_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="last_name">last_name:</label>
        <input type="text" name="last_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="age">age :</label>
        <input type="number" name="age" value="<?php echo isset($w) ? $w : ''; ?>"> <!-- Corrected variable name -->
        <br><br>

        <label for="email">email :</label>
        <input type="number" name="email" value="<?php echo isset($w) ? $w : ''; ?>"> <!-- Corrected variable name -->
        <br><br>


         <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

        <input type="submit" name="up" value="Update">
        <input type="hidden" name="student_id" value="<?php echo $sid; ?>"> <!-- Add hidden field for student_id -->
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $fname = $_POST['first_name'];
    $lname  = $_POST['last_name'];
    $ag= $_POST['age'];
    $em = $_POST['email'];
    $gd  = $_POST['Gender'];
    $sid = $_POST['student_id']; // Retrieve CourseID
    
    // Update the courses in the database
    $stmt = $connection->prepare("UPDATE students SET first_name=?, last_name=?, age=?,email=?,Gender=? WHERE student_id=?");
    $stmt->bind_param("sssiss", $fname, $lname, $ag, $em,$gd,$sid); // Corrected parameter order and data type for student_id
    $stmt->execute();
    
    // Redirect to students.php
    header('Location: students.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
