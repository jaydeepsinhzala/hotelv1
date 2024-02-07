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


if (mysqli_num_rows($result) > 0) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mobilenav.css"/>
    <link rel="stylesheet" href="adminpanel-css.css"/>
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
<?php include('../adminmenu.php');
?>
</div>
<div class="contain">
    <h1>Hotels Details</h1>
 <div class="view">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Hotel Name</th>
                <th>Location</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['h_name']; ?></td>
                    <td><?php echo $row['h_location']; ?></td>
                    <td><?php echo $row['h_price']; ?></td>
                    <td><?php echo $row['h_description']; ?></td>
                    <?php
						// $result is the result of your query
						while($hotel = mysqli_fetch_assoc($result)) {
							echo '<td class="td-img">';
							echo '<img class="hotel-img" src="data:image/jpeg;base64,' . base64_encode($hotel['h_image']) . '" alt="Hotel Image" style="width:20%" style="text-align:right"/>';
							echo '</td>';
						}
					?>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
} else {
	
    echo "No hotels found.";
}

// Close conection
mysqli_close($con);
?>
</div>
</body>
</html>