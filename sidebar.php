
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    
.sidebar {
  background-color: #e0e1dd;
  color: #1b263b;
  width: 200px;
  padding: 20px;
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  overflow: auto;
  transition: all 0.3s ease;
}

/* Styling for the logo */
.logo {
  margin-bottom: 20px;
}

/* Styling for the sidebar links */
.sidebar a {
  /* font-size:large; */
  font-weight: bolder;
  display: block;
  color: #1b263b;
  padding: 2px;
  text-decoration: none;
  transition: all 0.3s ease;
  height: 30px;
  justify-content: right;
  margin-bottom: 4px;
  
}

/* Hover effect for sidebar links */
.sidebar a:hover {
  background-color: #1080cbc1;
  transition: all 0.3s ease;
  
}
</style>
<div class="sidebar">
    <div class="logo">
    <img height = "100px" width = "100px"src="./images/logo.png" alt="Logo">
    </div>
    <a href="index.php"><i class="fa fa-home"></i> Dashboard</a>
    <a href="device.php"><i class="fa fa-cog"></i> Device Management</a>
    <a href="humiditydata.php"><i class="fa fa-bar-chart"></i> Data Visualization</a>
    <a href="analytics.html"><i class="fa fa-line-chart"></i> Analytics & Insights</a>
    <a href="user.php"><i class="fa fa-user"></i> User Management</a>
    <a href="performance.html"><i class="fa fa-tachometer"></i> Performance </a>
</div>
