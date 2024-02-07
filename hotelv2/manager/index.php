<?php
// conect to your database
require('../config.php');

// Check conection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the table
$sql = "SELECT * FROM hotels_list";
$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result) > 0)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mobilenav.css"/>
    <link rel="stylesheet" href="mana_panel-css.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Galada' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    *{
margin: 0;
padding: 0;
box-sizing: border-box;
}
html{
  scroll-behavior: smooth;
}
body{
  font-family: Poppins;
  margin: 0;
  padding: 0;
  animation: fadeInAnimation ease 2s;
}
.contain{
    width:100%;
    
    padding:5px;
    display:flex;
    flex-direction:column;
    
}
.contain .view{
  width: 100%; 
  display: flex;
  scroll-snap-type: x mandatory;
  overflow-x:auto;
  -ms-overflow-style: none; /* for Internet Explorer, Edge */
  scrollbar-width: none; /* for Firefox */

    
}
.contain.view::-webkit-scrollbar {
display: none; /* for Chrome, Safari, and Opera */
}
.contain h1{
    margin-top:8%;
    text-align:center;
    color:#4169e1;
}
table{
    background:#fff;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    scroll-snap-align: start;
 

}
th{
    font-size:.8rem;
    padding:10px 30px;
    text-align:center;
    background:#dae3ff;
    border-radius:10px;
    color:#4169e1;
}
td{
    font-size:.7rem;
    padding:5px;
    text-align:center;
    border-bottom:1px solid #dae3ff;
    color:#4169e1;
}

 
@media only screen and (max-width: 720px){
    .contain h1{
    margin-top:20%;}

}
.hotels .hotel-box .card .hotel-img{
width:20%;
border-radius:10px;
object-fit: fill;
box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.hotels .hotel-box .card .content{
  width: 100%;
  padding:15px 0;
  
}
.hotels .hotel-box .card .content h3{
  text-align: center;
}
.hotels .hotel-box .card .content p{
  padding-top: 10px;
  font-size: .8rem;
  text-align: justify;
}
.hotels .hotel-box .card .content .c-box{
  padding:20px 5px;
  display: flex;
  justify-content:space-between;
  align-items: center;

}
.hotels .hotel-box .card .content .c-box h4{
  color:#4169e1;
}
.hotels .hotel-box .card .content  .view-details{
  width:100%;
  background: rgba(0, 89, 255, 0.2);
  padding: 10px 40px;
  border-radius: 10px;
  text-decoration: none;
  color:#4169e1;
  border: none; font-weight:600;
  transition: all .5s;
}
.hotels .hotel-box .card .content  .view-details:hover{
  background: #4169e1;
  color: #fff;
}
.td-img {
  display: flex;
  justify-content: center;
  align-items: center;
}

 </style>
 </head>
 <body>
<div class="navigation">
<?php
include('mana_menu.php')
?>
</div>
<div class="contain">
    <h1>Booking Details</h1>
<div class="view">
<table>
    <tr>
        <th>Booking ID</th>
        <th>Customer Name</th>
        <th>Customer Ph. No.</th>
        <th>Hotel Name</th>
        <th>Hotel Location</th>
        <th>Price</th>
        <th>Rooms Booked</th>
        <th>CheckIn Date</th>
        <th>CheckOut Date</th>
        <th>Total Price</th>
        <th>Booking Date</th>
    </tr>
    <?php 
    $res = $con->query("SELECT * FROM bookings");
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            echo "<tr><td>".$row['id']."</td><td>".$row['cus_name']."</td><td>".$row['cus_phone']."</td><td>".$row['h_name']."</td><td>".$row['h_location']."</td><td>".$row['h_price']."</td><td>".$row['no_of_rooms']."</td><td>".$row['checkin_date']."</td><td>".$row['checkout_date']."</td><td>".$row['total_price']."</td><td>".$row['booking_date']."</td></tr>";
        }
        echo "</table>";
    }
    ?>
</table>
</div>
</div>
</body>
</html>