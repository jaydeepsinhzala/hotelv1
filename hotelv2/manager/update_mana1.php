<?php
require('../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mana_panel-css.css"/>
    <link rel="stylesheet" href="mobilenav.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
 
.box{
    
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-radius: 10px;
    padding:30px;
    background: #fff;
    width:40%;
  
 
  
  }
  
 
 .box h1 {
    color:#4169e1;
    font-family:Poppins;
    text-align:center;
    
 }
  

.box textarea{
    resize: none;
}
.box input:focus{
 outline: none;
}
  .box input,textarea{
  margin-bottom:20px;
  padding:10px 20px;
  width:100%;
  font-family: Poppins;
  font-size: 1rem;
  border-radius: 20px;
  background: #dae3ff;
  outline: none;
border:none;
color:#4169e1;

  
}
.box .add-btn{
   margin: 10px;
   padding:10px 30px;
   font-family: Poppins;
   font-size: 1rem;
   border-radius: 20px;
   border: none;
   background: #4169e1;
   color:#fff;
   cursor: pointer;
  

 }

@media only screen and (max-width: 720px){
  .container
  {padding:10px;
    padding-top: 20%;
    
  }
  .box{ 
    width:100%;
  }
  }
  </style>
</head>
<body>
<div class="navigation">
<?php
include('mana_menu.php')
?>
</div>
    <h1>Update Hotel Details</h1>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="hotel_id">Hotel ID:</label>
        <input type="number" name="hotel_id" id="hotel_id" required>
        <br>
        <label for="hotel_name">Hotel Name:</label>
        <input type="text" name="hotel_name" id="hotel_name" required>
        <br>
        <label for="hotel_location">Location:</label>
        <input type="text" name="hotel_location" id="hotel_location" required>
        <br>
        <label for="hotel_price">Price per night:</label>
        <input type="number" step="0.01" name="hotel_price" id="hotel_price" required>
        <br>
        <label for="hotel_description">Description:</label>
        <textarea name="hotel_description" id="hotel_description" required></textarea>
        <br>
        <label for="hotel_image">Image URL:</label>
        <input type="url" name="hotel_image" id="hotel_image">
        <br>
        <label for="hotel_ratings">Ratings (out of 5):</label>
        <input type="number" step="0.1" min="0" max="5" name="hotel_ratings" id="hotel_ratings">
        <br>
        <button type="submit">Update Hotel</button>
    </form>
</body>
</html>
<?php

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to authenticate manager
function authenticate_manager($email, $password) {
    global $conn;

    // Prepared statement for security against SQL injection
    $stmt = $conn->prepare("SELECT manager_id, manager_password FROM manager WHERE manager_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['manager_password'])) {
            return $row['manager_id']; // Return manager ID on successful authentication
        }
    }

    return false; // Authentication failed
}

// Function to update hotel details with access control
function update_hotel($manager_email, $manager_password, $hotel_id, $new_details) {
    global $conn;

    // Authenticate manager and retrieve ID
    $manager_id = authenticate_manager($manager_email, $manager_password);
    if (!$manager_id) {
        return "Invalid credentials";
    }

    // Validate hotel ID exists and belongs to the manager
    $stmt = $conn->prepare("SELECT 1 FROM hotels_list WHERE id = ? AND manager_id = ?");
    $stmt->bind_param("ii", $hotel_id, $manager_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        return "Unauthorized access: Hotel ID not found or not managed by you";
    }

    // Prepare update statement with access control and data sanitization
    $stmt = $conn->prepare("UPDATE hotels_list SET h_name = ?, h_location = ?, h_price = ?, h_description = ?, h_image = ?, h_ratings = ? WHERE id = ?");
    $stmt->bind_param("sssssis", ...array_map('htmlspecialchars', $new_details), $hotel_id); // Sanitize input

    if ($stmt->execute()) {
        return "Hotel details updated successfully";
    } else {
        return "Error updating hotel details: " . $conn->error;
    }
}

// Example usage
$manager_email = "manager@example.com";
$manager_password = "strong_password";
$hotel_id = 123;
$new_details = [
    "h_name" => "New Hotel Name",
    "h_location" => "New Location",
    "h_price" => 99.99,
    "h_description" => "A great new hotel",
    "h_image" => "new_image.jpg",
    "h_ratings" => 4.5,
];

$response = update_hotel($manager_email, $manager_password, $hotel_id, $new_details);
echo $response;


// Additional error handling for HTML form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $manager_email = htmlspecialchars($_POST["email"]);
    $manager_password = htmlspecialchars($_POST["password"]);
    $hotel_id = (int)$_POST["hotel_id"];
    $new_details = [
        "h_name" => htmlspecialchars($_POST["hotel_name"]),
        "h_location" => htmlspecialchars($_POST["hotel_location"]),
        "h_price" => (float)$_POST["hotel_price"],
        "h_description" => htmlspecialchars($_POST["hotel_description"]),
        "h_image" => htmlspecialchars($_POST["hotel_image"]),
        "h_ratings" => (float)$_POST["hotel_ratings"],
    ];

    $response = update_hotel($manager_email, $manager_password, $hotel_id, $new_details);

    // Display response in HTML depending on success or error
    if (strpos($response, "successfully") !== false) {
        echo "<p style='color: green;'>$response</p>";
    } else {
        echo "<p style='color: red;'>$response</p>";
    }
}
// Close connection
$conn->close();

?>
