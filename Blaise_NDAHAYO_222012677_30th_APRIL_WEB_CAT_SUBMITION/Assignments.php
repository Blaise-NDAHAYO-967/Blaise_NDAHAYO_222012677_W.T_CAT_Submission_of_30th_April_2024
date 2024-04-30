<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>assignments</title>
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

 <body bgcolor="skyblue">
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><a href="./home.html" style="padding: 10px; color: white; background-color: blue; text-decoration: none; margin-right: 15px;">HOME</a></li>
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
    <h1>assignments Form</h1>
    <form method="post" action="assignments.php">
        <label for="AssignmentID">AssignmentID :</label>
        <input type="number" id="AssignmentID" name="AssignmentID" required><br><br>

        <label for="CourseID">CourseID:</label>
        <input type="number" id="CourseID" name="CourseID" required><br><br>

        <label for="AssignmentName">AssignmentName:</label>
        <input type="text" id="AssignmentName" name="AssignmentName" required><br><br>

        <label for="DueDate">DueDate:</label>
        <input type="date" id="DueDate" name="DueDate" required><br><br>

       
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
        $stmt = $connection->prepare("INSERT INTO assignments (AssignmentID, CourseID, AssignmentName,DueDate) VALUES (?, ?, ?,?)");
        $stmt->bind_param("isss", $AID, $cID, $AName,$DDAte);
        // Set parameters from POST and execute
        $AID = $_POST['AssignmentID'];
        $cID = $_POST['CourseID'];
        $AName = $_POST['AssignmentName'];
        $DDAte = $_POST['DueDate'];
        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
        $stmt->close();
    }

    // Fetch data from the assignments table
    $sql = "SELECT * FROM assignments";
    $result = $connection->query($sql);
    ?>
    <!-- Displaying Table of assignments -->
    <center><h2>Table of assignments</h2></center>
    <table>
        <tr>
            <th>AssignmentID</th>
            <th>CourseID</th>
            <th>AssignmentName</th>
            <th>DueDate</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('database_connection.php');
        // Check if there are any results
        if ($result->num_rows > 0) { 
            // Loop through each row
            while ($row = $result->fetch_assoc()) {
                // Store the AssignmentID in a variable
                $AID = $row["AssignmentID"];
                // Output the data in table row format
                echo "<tr>
                    <td>" . $row["AssignmentID"] . "</td>
                    <td>" . $row["CourseID"] . "</td>
                    <td>" . $row["AssignmentName"] . "</td> 
                    <td>" . $row["DueDate"] . "</td>
                    <td><a href='delete_assignments.php?AssignmentID=$AID'>Delete</a></td> 
                    <td><a href='update_assignments.php?AssignmentID=$AID'>Update</a></td> 
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
  <marquee><i style="color: yellow;">&copy; 2024</i><i style="color: blue;" ><b>>WELLCOME TO OUR WEBSITE DESIGNED BY:NDAHAYO blaise</b></marquee>
</footer>
</body>
</html>
