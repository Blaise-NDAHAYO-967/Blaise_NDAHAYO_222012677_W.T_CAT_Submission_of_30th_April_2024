<?php
// Include the database connection file
    include('database_connection.php');
// Check if SubmissionID is set
if(isset($_REQUEST['SubmissionID'])) {
    $SID = $_REQUEST['SubmissionID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM submissions WHERE SubmissionID=?");
    $stmt->bind_param("i", $SID);
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
            <input type="hidden" name="SID" value="<?php echo $SID; ?>">
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
    echo "SubmissionID is not set.";
}

$connection->close();
?>
