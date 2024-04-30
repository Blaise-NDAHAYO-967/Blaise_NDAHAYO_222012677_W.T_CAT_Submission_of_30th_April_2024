<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home Page</title>

  <style>
  .dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;
  }
  .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  .dropdown-contents a:hover {
    background-color: #f1f1f1;
  }
  section{
  padding: 160px;
}
footer{
  background-color: grey;
  padding: 30px;
}

/* Style for buttons */
  .button {
    background-color: white;
    border: none;
    margin-left: 100px;
    color: red;
    padding: 20px 50px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 23px;
    margin: 10px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }
</style>
</head>
<header>
<body style="background-image: url('./index picture.png'); background-repeat: no-repeat; background-size: cover;">
<center>
  <a href='login.html' class="button">Login</a>
  <a href='register.html' class="button">Register</a>

 </center>
</header>
  <section>
    
  </section>
  
  <footer>
  <marquee><i style="color: green;">&copy; 2024</i><b> WELLCOME TO OUR WEBSITE DESIGNED BY:NDAHAYO blaise</b></marquee></footer>
  </footer>
</body>
</html>
