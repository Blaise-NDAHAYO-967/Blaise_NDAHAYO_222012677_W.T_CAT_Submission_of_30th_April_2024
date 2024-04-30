<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>submissions</title>
    <style>
        body {
            background-color: grey;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        header {
            background-color: burlywood;
            padding: 20px;
        }
        section {
            padding: 71px;
            border-bottom: 1px solid #ddd;
            background-color: mediumslateblue;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: burlywood;
        }
    </style>
</head>
<body>
<header>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
         <img src="./my logo.JFIF" width="20" height="50" alt="logo">
        <a href="./home.html" style="padding: 10px; color: white; background-color: blue; text-decoration: none; margin-right: 15px;">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./assignments.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">assignments</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./courses.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">courses</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./enrollments.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">enrollments</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./instructors.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">instructors</a></li>
     <li style="display: inline; margin-right: 10px;"><a href="./students.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">students</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./submissions.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">submissions</a></li>
    
        <li class="dropdown" style="display: inline; margin-right: 10px;">
            <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
            <div class="dropdown-contents">
                <!-- Links inside the dropdown menu -->
                <a href="login.html">Login</a>
                <a href="register.html">Register</a>
                <a href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
    <form class="d-flex" role="search" action="search.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</header>
<section>
    <h1>Submissions Form</h1>
    <form method="post" action="submissions.php">
        <label for="SubmissionID">SubmissionID :</label>
        <input type="number" id="SubmissionID" name="SubmissionID" required><br><br>

        <label for="AssignmentID">AssignmentID:</label>
        <input type="number" id="AssignmentID" name="AssignmentID" required><br><br>

        <label for="student_id">student_id:</label>
        <input type="number" id="student_id" name="student_id" required><br><br>

        <label for="SubmissionDate">SubmissionDate:</label>
        <input type="date" id="SubmissionDate" name="SubmissionDate" required><br><br>

       
        <input type="submit" name="insert" value="Insert"><br><br>
    </form>
    <a href="./home.html">Go Back to Home</a>
    <!-- PHP Code to Insert Data -->
    <?php
    // Include the database connection file
    include('database_connection.php');

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Prepare the insert statement
        $stmt = $connection->prepare("INSERT INTO submissions (SubmissionID, AssignmentID,student_id,SubmissionDate) VALUES (?, ?, ?,?)");
        $stmt->bind_param("isss", $SID, $AID, $sid,$SDate);
        // Set parameters from POST and execute
        $SID = $_POST['SubmissionID'];
        $AID = $_POST['AssignmentID'];
        $sid = $_POST['student_id'];
        $SDate = $_POST['SubmissionDate'];
        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
        $stmt->close();
    }

    // Fetch data from the assignments table
    $sql = "SELECT * FROM submissions";
    $result = $connection->query($sql);
    ?>
    <!-- Displaying Table of submissions -->
    <center><h2>Table of submissions</h2></center>
    <table>
        <tr>
            <th>SubmissionID</th>
            <th>AssignmentID</th>
            <th>student_id</th>
            <th>SubmissionDate</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('database_connection.php');
        // Check if there are any results
        if ($result->num_rows > 0) { 
            // Loop through each row
            while ($row = $result->fetch_assoc()) {
                // Store the SubmissionID in a variable
                $SID = $row["SubmissionID"];
                // Output the data in table row format
                echo "<tr>
                    <td>" . $row["SubmissionID"] . "</td>
                    <td>" . $row["AssignmentID"] . "</td>
                    <td>" . $row["student_id"] . "</td> 
                    <td>" . $row["SubmissionDate"] . "</td>
                    <td><a href='delete_submissions.php?SubmissionID=$SID'>Delete</a></td> 
                    <td><a href='update_submissions.php?SubmissionID=$SID'>Update</a></td> 
                </tr>";
            }
        } else {
            // If no data found, display a message
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</section>
<footer>
  <marquee><i style="color: yellow;">&copy; 2024</i><i style="color: blue;" ><b> WELLCOME TO OUR WEBSITE DESIGNED BY:NDAHAYO blaise</b></marquee>
</footer>
</body>
</html>
