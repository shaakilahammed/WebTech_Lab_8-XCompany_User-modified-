<?php
	session_start();
	$uname=$_SESSION["uname"];
	if(!isset($_SESSION["uname"]))
	{
		header("location:index.php");
	}
	$error="";
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>XCOMPANY</title>
	<style>
		body{
			margin:0;
			padding:0px 50px;
		}
		a{
			text-decoration:none;
		}
		.header_area{
			width:100%;
			
			
		}
		.logoarea{
			width:35%;
			float:left;
			background-color:#25cee0;
		}
		.logoarea h1{
			padding-left:30px;
		}
		.menu_area{
			width:65%;
			float:left;
			background-color:#25cee0;
		}
		.menu_area ul{
			list-style:none;
			text-align:right;
		}
		.menu_area ul li{
			display:inline-block;
			padding:15px;
			color:white;
		}
		.menu_area ul li a{
			
			color:white;
		}
		.content_area{
			height:500px;
			width:100%;
			overflow:hidden;
		}
		.content_left{
			width:35%;
			float:left;
		}
		
		.content_right{
			width:65%;
			float:left;
		}
		.footer_area{
			width:100%;
			overflow:hidden;
		}
		.footer_area h3{
			text-align:center;
		}
		.content_left{
			background-color:#b770d7;
			color:white;
		}
		.content_left ul{
			list-style:none;
		}
		.content_left ul li{
			padding:10px 0px;
			
		}
		.content_left ul li a{
			color:white;
			padding:10px 50px;
		}
		.content_left ul li a:hover{
			background-color:black;
		}
		.footer_area{
			background-color:#25cee0;
		}
	</style>
</head>
<body>
	<div class="header_area">
		<div class="logoarea">
			<h1><span class="x">X</span>Company</h1>
		</div>
		<div class="menu_area">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li>Logged in as <a style="color:red;" href="profile.php"><?php echo $uname; ?></a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class="content_area">
		<div class="content_left">
			<h3>Account</h3>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profile.php">View Profile</a></li>
				<li><a href="editprofile.php">Edit Profile</a></li>
				<li><a href="changepicture.php">Change Profile Picture</a></li>
				<li><a href="changepassword.php">Change Password</a></li>
			</ul>
		</div>
		<div class="content_right">
			<h3>Change Password</h3>
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "xdb";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT id, name, username, email,password FROM users WHERE username='".$_SESSION["uname"]."'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					
					while($row = $result->fetch_assoc()) {
						$eid=$row["id"];
						$ename=$row["name"];
						$eemail=$row["email"];
						$uuname=$row["username"];
						$epass=$row["password"];
					}
					
				} else {
					echo "0 results";
				}

				$conn->close();
				
				
			 ?>
			 <?php 
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if($epass==$_POST["oldpass"]){
				if($_POST["newpass"]==$_POST["renewpass"]){
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "xdb";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					$sql="UPDATE users SET password='".$_POST["newpass"]."' WHERE username='".$uname."'";
					//$sql = "INSERT INTO products (product_name, description, quantity)
					//VALUES ('".$_POST["pname"]."', '".$_POST["description"]."', '".$_POST["quantity"]."')";

					if ($conn->query($sql) === TRUE) {
						echo "New record created successfully";
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}

					$conn->close();
					header("Location:profile.php");	
				}
				else{
					$error="Password don't match";
				}
			}
			else{
				$error="Incorrect Password";
			}
					
			
			//header("Location:profile.php");	
		}
		
		
	?>
		<form method="post">
		<table>
			<tr>
				<td><b>Current password :</b></td>
				<td><input type="text" name="oldpass" /></td>
				
			</tr>
			<tr>
				<td><b>New password :</b></td>
				<td><input type="text" name="newpass"/></td>
				
			</tr>
			
			<tr>
				<td><b>Retype New Password :</b></td>
				<td><input type="text" name="renewpass"/></td>
				
			</tr>
			
			
			
			
			<tr>
				<td align="center" colspan="2"><input type="submit" value="Submit" /></td>
				
			</tr>
			
		</table>
		
			
		
	</form>
		<?php echo $error; ?>	
		</div>
	</div>
	<div class="footer_area">
		<h3>&copy; all right reserved Shakil Ahammed</h3>
	</div>
	
</body>
</html>