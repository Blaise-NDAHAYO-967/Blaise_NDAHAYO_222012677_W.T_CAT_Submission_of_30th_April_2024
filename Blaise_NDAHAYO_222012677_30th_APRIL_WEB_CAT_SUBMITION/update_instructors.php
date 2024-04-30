<?php
// Include the database connection file
    include('database_connection.php');

if(isset($_REQUEST['InstructorID'])) {
    $IID = $_REQUEST['InstructorID'];
    
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE InstructorID=?");
    $stmt->bind_param("i", $IID); // Corrected variable name
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['InstructorName'];
        $z = $row['ContactInfo'];
        $w = $row['InstructorID']; // Corrected variable name
    } else {
        echo "instructors not found.";
    }
}
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Update instructors</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of instructors</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="InstructorName">InstructorName:</label>
        <input type="text" name="InstructorName" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="ContactInfo">ContactInfo:</label>
        <input type="text" name="ContactInfo" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="InstructorID">InstructorID:</label>
        <input type="text" name="InstructorID" value="<?php echo isset($w) ? $w : ''; ?>"> <!-- Corrected variable name -->
        <br><br>

        <input type="submit" name="up" value="Update">
        <input type="hidden" name="InstructorID" value="<?php echo $IID; ?>"> <!-- Add hidden field for InstructorID -->
    </form>
</body>
</html>

<?php
include('database_connection.php');
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $IName = $_POST['InstructorName'];
    $cInfo  = $_POST['ContactInfo'];
    $IID = $_POST['InstructorID']; // Retrieve InstructorID
    
    // Update the instructors in the database
    $stmt = $connection->prepare("UPDATE instructors SET InstructorName=?, ContactInfo=? WHERE InstructorID=?");
    $stmt->bind_param("sss", $IName, $cInfo, $IID); // Corrected parameter order and data type for InstructorID
    $stmt->execute();
    
    // Redirect to instructors.php
    header('Location:instructors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
