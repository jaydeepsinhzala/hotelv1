<?php
// Connect to your database
require('../config.php');
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['submit'])) {
    $h_name = mysqli_real_escape_string($con, $_POST['h_name']);
    $h_location = mysqli_real_escape_string($con, $_POST['h_location']);
    $h_price = mysqli_real_escape_string($con, $_POST['h_price']);
    $h_description = mysqli_real_escape_string($con, $_POST['h_description']);
    $h_image = mysqli_real_escape_string($con, $_POST['h_image']);
    $h_ratings = mysqli_real_escape_string($con, $_POST['h_ratings']);

    // Insert query
    $sql = "INSERT INTO hotels_list (h_name, h_location, h_price, h_description, h_image, h_ratings)
            VALUES ('$h_name', '$h_location', '$h_price', '$h_description', '$h_image', '$h_ratings')";

    if (mysqli_query($con, $sql)) {
        echo "New hotel added successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Close connection
mysqli_close($con);
?>

<html>
<body>
<h2>Add New Hotel</h2>
<form method="post" action="">
  <table>
    <tr>
      <td>Hotel Name:</td>
      <td><input type="text" name="h_name" required></td>
    </tr>
    <tr>
      <td>Location:</td>
      <td><input type="text" name="h_location" required></td>
    </tr>
    <tr>
      <td>Price:</td>
      <td><input type="number" name="h_price" required></td>
    </tr>
    <tr>
      <td>Description:</td>
      <td><textarea name="h_description"></textarea></td>
    </tr>
    <tr>
      <td>Image:</td>
      <td><input type="text" name="h_image"></td>
    </tr>
    <tr>
      <td>Ratings:</td>
      <td><input type="number" name="h_ratings" step="0.1"></td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" value="Add Hotel"></td>
    </tr>
  </table>
</form>
</body>
</html>
