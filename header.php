<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>

		header {
			margin-right: 5px;
			background-color: #e0e1dd;
			font-family: Arial, sans-serif;
			
			padding: 2px;
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 999;
		}
	
	
		header nav {
			margin-top: 10px;
			text-align: center;
		}
	
		header nav ul {
			list-style: none;
			margin: 0;
			padding: 15px;
		}
	
		header nav ul li {
			display: inline-block;
			margin-right: 20px;
			font-size: 16px;
		}
	
		header nav ul li:last-child {
			margin-right: 0;
		}
	
		header nav ul li a {
			color: #333;
			text-decoration: none;
			transition: color 0.3s ease;
		}
	
		header nav ul li a:hover {
			color: #6c5ce7;
		}
	
	</style>
</head>
<body>
	
<header style="display: flex; align-items: center;">
    <img style="height: 50px; width: 50px;" src="./images/logo.png">
    <h2 style="margin-left: 10px;">IoT Framework</h2>
    <nav style="margin-left: auto;">
        <ul style="display: flex;">
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
          
        </ul>
    </nav>
</header>
</body>
</html>

