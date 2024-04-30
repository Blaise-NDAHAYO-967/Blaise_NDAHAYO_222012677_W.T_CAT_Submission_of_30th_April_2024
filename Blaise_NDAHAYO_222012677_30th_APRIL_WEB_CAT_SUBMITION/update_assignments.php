<?php
// Include the database connection file
include('database_connection.php');

if (isset($_REQUEST['AssignmentID'])) {
    $AID = $_REQUEST['AssignmentID'];

    $stmt = $connection->prepare("SELECT * FROM assignments WHERE AssignmentID=?");
    $stmt->bind_param("i", $AID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['CourseID'];
        $z = $row['AssignmentName'];
        $w = $row['DueDate'];
    } else {
        echo "Assignment not found.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update assignments</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>

<body>
    <center>
        <!-- Update assignments form -->
        <h2><u>Update Form of assignments</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="CourseID">CourseID:</label>
            <input type="number" name="CourseID" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="AssignmentName">AssignmentName:</label>
            <input type="text" name="AssignmentName" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="DueDate">DueDate:</label>
            <input type="date" name="DueDate" value="<?php echo isset($w) ? $w : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>

</html>

<?php
// Include the database connection file
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $cID = $_POST['CourseID'];
    $AName = $_POST['AssignmentName'];
    $DDAte = $_POST['DueDate'];

    // Update the assignments in the database
    $stmt = $connection->prepare("UPDATE assignments SET CourseID=?, AssignmentName=?,DueDate=? WHERE AssignmentID=?");
    $stmt->bind_param("issi", $cID, $AName, $DDAte, $AID); // Corrected parameter order and data type for AssignmentID
    $stmt->execute();

    // Redirect to assignments.php
    header('Location: assignments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
