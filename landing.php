<!DOCTYPE html>
<html>
<head>
	<title>IoT and Technology Landing Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>
	<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        color: #333;
        
    }

    header {
        background-color: #fff;
        box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.1);
        padding: 2px;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 999;
    }

    header h {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #333;
        text-align: center;
    }

    header nav {
        margin-top: 20px;
        text-align: center;
    }

    header nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
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

    main {
        margin-top: 80px;
        background-image: url("./images/IOT.png");
        background-attachment: fixed;
        color: #fff;
    }

    section {
        padding: 50px;
        background-color: #0f0f0fa6;
        text-align: center;
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
    }

    section h2 {
        margin-top: 0;
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        /* color: #333; */
    }

    section p {
        margin: 20px 0;
        font-size: 16px;
        line-height: 1.5;
        /* color: #777; */
    }

    section ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    section ul li {
        margin-right: 30px;
        font-size: 16px;
        /* color: #333; */
        display: flex;
        align-items: center;
    }

    section ul li:last-child {
        margin-right: 0;
    }

    section ul li img {
        margin-right: 10px;
        max-width: 30px;
    }

    section .cta-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #6c5ce7;
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bold;
        border-radius: 30px;
        transition: background-color 0.3s ease;
        position: relative;
        z-index: 1;
    }

    section .cta-btn:hover {
        background-color: #53409d;
    }

    section .cta-btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
       
		opacity: 0.2;
    border-radius: 30px;
    z-index: -1;
    transform: scale(1.3);
    transition: transform 0.3s ease;
}

section .cta-btn:hover::before {
    transform: scale(1);
}

footer {
    background-color: #333;
    padding: 50px;
    color: #fff;
    text-align: center;
}

footer p {
    margin: 0;
    font-size: 16px;
    line-height: 1.5;
    color: #fff;
}

/* Animations */

.section-title {
    opacity: 0;
    transform: translateY(50px);
}

.section-title.animated {
    opacity: 1;
    transform: translateY(0);
    transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.section-text {
    opacity: 0;
    transform: translateY(50px);
}

.section-text.animated {
    opacity: 1;
    transform: translateY(0);
    transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) 0.2s;
}

.section-list li {
    opacity: 0;
    transform: translateY(50px);
}

.section-list li.animated {
    opacity: 1;
    transform: translateY(0);
    transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) 0.4s;
}

.cta-btn {
    opacity: 0;
    transform: translateY(50px);
}

.cta-btn.animated {
    opacity: 1;
    transform: translateY(0);
    transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) 0.6s;
}
</style>


</head>
<body>
<div id="loading" style="display:none;"><img src="loading.gif" /></div>

<header style="display: flex; align-items: center;">
    <img style="height: 50px; width: 50px;" src="./images/logo.png">
    <h2 style="margin-left: 10px;">IoT Framework</h2>
    <nav style="margin-left: auto;">
        <ul style="display: flex;">
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="login_val.php">Login</a></li>
            <li><a href="login.php">Sign Up</a></li>
        </ul>
    </nav>
</header>

	<main>

		<section id="banner">
			<h2>Welcome to the IoT Landing Page</h2>
			<p class="section-text animated">IoT Framework is a platform that provides the necessary tools and functionalities for building Internet of Things (IoT) applications. It is designed to simplify the development process of IoT applications by providing a set of pre-built components and features, including device management, data collection, storage, analytics, and visualization.</p>
            <ul class="section-list">
            <li class="animated">Easy integration with different devices and protocols</li>
            <li class="animated">Scalable and flexible architecture</li>
            <li class="animated">Real-time data processing and analytics</li>
            <li class="animated">Customizable dashboard and visualization</li>
            </ul>
            </div>
            </section>
            <section>
            <h2>Our Vision</h2>
            <p>to provide a comprehensive and customizable interface that allows users to monitor and control their IoT devices and systems.
            The dashboard should provide real-time analytics and insights, allowing users to easily visualize and understand their IoT data. 
            It should also allow for easy integration with different types of IoT devices and systems, regardless of the manufacturer or communication protocol.</br>
            
            The framework should be scalable, secure, and flexible enough to handle large-scale IoT deployments, while 
            also providing support for cloud-based and edge computing architectures. Additionally, it should enable the development of custom 
            applications and services that can leverage the data generated by IoT devices.</br>
            
            Overall, the vision for an IoT dashboard and framework is to provide a seamless and intuitive user experience, 
            empowering users to make data-driven decisions and optimize their IoT systems for maximum efficiency 
            and performance.</p>
            <video src="images/video2.mp4" height="500px" width="900px" controls>IoT Video 1</video>
        </section>

        <section>
            <h2 >How it Works..?</h2>
            <video src="images/video.mp4" height="500px" width="900px" controls autoplay loop>IoT Video 2</video>
        </section>
    </main>
            
        <footer>
            
            <p>© 2023 IoT Framework. All Rights Reserved.</p>
            
        </footer>

        


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
            $(document).ready(function() {
            $('.section-title').addClass('animated');
            $('.section-text').addClass('animated');
            $('.section-list li').addClass('animated');
            $('.cta-btn').addClass('animated');
            });

            gsap.from(".section-title", {
                opacity: 0,
                y: 50,
                duration: 0.6,
                ease: "cubic-bezier(0.165, 0.84, 0.44, 1)"
            });
            </script>

</body>
</html>