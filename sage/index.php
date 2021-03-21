
<!--Author: Template Stock
    Author URL: http://templatestock.co
    template downloaded from https://www.free-css.com/free-css-templates/page263/above
    -->
<!DOCTYPE html>
<html>
    <head>
        <title>Sage: Student Project</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Onepage Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
            Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
            	$(".scroll").click(function(event){		
            		event.preventDefault();
            		$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
            	});
            });
        </script>
    </head>
    <body>
        <div class="header" id="head">
            <div class="container">
                <div class="header-top">
                    <div class="logo">
                        <a href="#"><img src="images/logo.png" alt=""/></a>
                    </div>
                    <div class="top-menu">
                        <span class="menu"> </span>
                        <ul>
                            <nav class="cl-effect-5" style="font-size:20px">
                                <li><a class="active" href="#"><span data-hover="Home">home</span></a></li>
                                <li><a href="students.php" ><span data-hover="Students">Students</span></a></li>
                                <li><a href="courses.php" ><span data-hover="Courses"><span>Courses</span></a></li>
                                <li><a href="student_course_enrollment.php" ><span data-hover="Enroll">Enroll</span></a></li>
                            </nav>
                        </ul>
                    </div>
                    <!--script-nav-->
                    <script>
                        $("span.menu").click(function(){
                        $(".top-menu ul").slideToggle("slow" , function(){
                        });
                        });
                    </script>
                    <div class="clearfix"></div>
                </div>
                <div class="index-banner">
                    <div class="wmuSlider example1">
                        <div class="wmuSliderWrapper">
                            <article style="position: absolute; width: 100%; opacity: 0;">
                                <div class="banner-wrap">
                                    <div class="banner_center">
                                        <h1>This is a demo app for students</h1>
                                    </div>
                                </div>
                            </article>
                            <article style="position: relative; width: 100%; opacity: 1;">
                                <div class="banner-wrap">
                                    <div class="banner_center">
                                        <span>
                                            <h2>Students can get registered and can get enrolled to courses
                                        </span>
                                        </h2>
                                    </div>
                                </div>
                            </article>
                            <article style="position: absolute; width: 100%; opacity: 0;">
                                <div class="banner-wrap">
                                    <div class="banner_center">
                                        <h2>Students/Courses can be added/updated/deleted</h2>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <script src="js/jquery.wmuSlider.js"></script> 
                    <script>
                        $('.example1').wmuSlider();         
                    </script> 	           	      
                </div>
            </div>
        </div>
        <div class="content">
        <div class="about-section" id="about" id="about">
            <div class="container">
            </div>
            <div class="col-md-6 about-rightgrid">
            </div>
            <div class="arrow1">
            </div>
            <!-- about-section-ends -->
            <div class="works-section" id="work" id="work">
                <div class="works-header">
                </div>
                <!-- portfolio-section-ends -->
                <div class="services-section" id="services">
                    <div class="container">
                        <div class="services-header" style="text-align:left !important">
			   <font color="white">
                            <h4>Services:</h4>
                            The App mainly contains 3 sections.<br>
			
			    -> <b>Students</b> can get added/updated/deleted. Contact number has made unique, hence cant be changed on update.<br>
			-> <b>Courses</b> can get added/updated/deleted. Course name has made unique, hence cant be changed on update.<br>
			   -> <b>Enrollment</b> makes one to assign a student to any course. Enrollments can only be added or removed. Since it all depends on FK of other 2, it cannot be edited.<br>  
				 Since there's a FK relationship, Removing the student/course will remove the respective enrollment aswell.<br>
				Pagination is made to 5 rows for ease of testing
				</font>
	
                        </div>
                        <div class="services-sectiongrids">
                            
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- services-section-ends -->
            </div>
            <div class="footer-section" id="contact" id="contact">
                <div class="container">
                    <div class="footer-bottom">
                       
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


