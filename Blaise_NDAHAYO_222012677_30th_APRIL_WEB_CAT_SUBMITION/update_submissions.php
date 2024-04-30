<?php
include('database_connection.php');

// Check if SubmissionID is set
if(isset($_REQUEST['SubmissionID'])) {
    $SID = $_REQUEST['SubmissionID'];
    
    $stmt = $connection->prepare("SELECT * FROM submissions WHERE SubmissionID=?");
    $stmt->bind_param("i", $SID); // Corrected variable name
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['AssignmentID'];
        $z = $row['student_id'];
        $w = $row['SubmissionDate']; // Corrected variable name
    } else {
        echo "Submission not found.";
    }
}
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Update submissions</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update submissions form -->
        <h2><u>Update Form of Submissions</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="AssignmentID">AssignmentID:</label>
            <input type="text" name="AssignmentID" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="student_id">Student ID:</label>
            <input type="number" name="student_id" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="SubmissionDate">Submission Date:</label>
            <input type="date" name="SubmissionDate" value="<?php echo isset($w) ? $w : ''; ?>"> <!-- Corrected variable name -->
            <br><br>

            <input type="submit" name="up" value="Update">
            <input type="hidden" name="SubmissionID" value="<?php echo $SID; ?>"> <!-- Add hidden field for SubmissionID -->
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $AID = $_POST['AssignmentID'];
    $sid  = $_POST['student_id'];
    $SDate= $_POST['SubmissionDate'];
    $SID = $_POST['SubmissionID']; // Retrieve SubmissionID
    
    // Update the submissions in the database
    $stmt = $connection->prepare("UPDATE submissions SET AssignmentID=?, student_id=?, SubmissionDate=? WHERE SubmissionID=?");
    $stmt->bind_param("sisi", $AID, $sid, $SDate, $SID); // Corrected parameter order and data type for SubmissionID
    $stmt->execute();
    
    // Redirect to submissions.php
    header('Location: submissions.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
