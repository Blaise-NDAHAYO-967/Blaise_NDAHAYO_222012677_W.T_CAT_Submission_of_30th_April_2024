<?php
// Include the database connection file
    include('database_connection.php');
// Check if CourseID is set
if(isset($_REQUEST['EnrollmentID'])) {
    $EID = $_REQUEST['EnrollmentID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM enrollments WHERE EnrollmentID=?");
    $stmt->bind_param("i", $EID);
     ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="EID" value="<?php echo $EID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "EnrollmentID is not set.";
}

$connection->close();
?>
