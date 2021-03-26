
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
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'/>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/app.css" rel="stylesheet" type="text/css" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery.min.js"></script>                                                                                      
        <script src="js/bootstrap.min.js"></script> 
        <script src="js/jquery.validate.min.js"></script> 
        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
    </head>
    <body>
        <div class="new_header" id="new_head" style=" background-image: url('images/banner.jpg');">
            <div class='container' style="width:100% !important;align:right !important;">
                <div class="header-top" >
                    <div class="logo" >
                        <a href="index.php"><img src="images/logo.png" alt=""/></a>
                    </div>
                    <div class="top-menu" >
                        <span class="menu"> </span>
                        <ul>
                             <nav class="cl-effect-5" style="font-size:20px;">
                                <li><a href="index.php"><span data-hover="Home">home</span></a></li>
                                <li><a href="students.php"  ><span data-hover="Students">Students</span></a></li>
                                <li><a href="courses.php" ><span data-hover="Courses"><span>Courses</span></a></li>
                                <li><a class= "active" href="#" ><span data-hover="Enroll">Enroll</span></a></li>
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
                <div >
                </div>
            </div>
        </div>
        <div class="content">
        <div class="container">
        <?php  
           require_once("DatabaseClass.php");
	    $db_obj = DatabaseClass::getInstance();
            $per_page_record = 5;  // Number of entries to show in a page.   
            // Look for a GET variable page if not found default is 1.        
            if (isset($_GET["page"])) {    
                $page  = $_GET["page"];    
            }    
            else {$page=1;}     
            $start_from = ($page-1) * $per_page_record;     
            $query = "SELECT student_course_enrollment.student_course_enrollment_id, courses.course_name, students.first_name, students.last_name FROM student_course_enrollment JOIN students ON students.student_id = student_course_enrollment.student_id JOIN courses ON student_course_enrollment.course_id = courses.course_id LIMIT $start_from, $per_page_record";  
	    $rs_result = $db_obj -> execute_query($query);  
        
            ?>    
        <div class="container">
            <br>   
            <div>
		<h3> Enrollment list</h3><br>
		<div id="error_display_div"></div>
                <table class="table table-striped table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Student name</th>
                            <th>Course name</th>
                            <th> Options </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php     
			     while ($row = $db_obj -> get_fetched_data($rs_result)) {    
                            // Display each field of the records.    
                            ?>     
                        <tr>
                            <?php
                                $first_name=$row['first_name'];
                                $last_name=$row["last_name"];
				$course_name=$row["course_name"];
                                $student_course_enrollment_id=$row["student_course_enrollment_id"];
				$student_full_name = $first_name." ".$last_name;
                                ?>
				
                            <td><?php echo $student_full_name;?></td>
                            <td><?php echo $course_name; ?></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="delete_student_enrollment_row('<?php echo $student_full_name; ?>','<?php echo $course_name; ?>','<?php echo $student_course_enrollment_id; ?>')">Delete</button>
                            </td>
                        </tr>
                        <?php     
                            };    
                            ?>     
                    </tbody>
                </table>
                <div class="pagination">    
                    <?php  
                        $query = "SELECT COUNT(*) FROM student_course_enrollment";  
			$rs_result = $db_obj -> execute_query($query);  
			$row = $db_obj -> get_row($rs_result);  
                        $total_records = $row[0];     
                        if($total_records==0)
				  echo "No Student enrollments to display, please enroll students to courses!";   
                        echo "</br>";     
                        // Number of pages required.   
                        $total_pages = ceil($total_records / $per_page_record);     
                        $pagLink = "";            
                        if($page>=2){   
                            echo "<a href='student_course_enrollment.php?page=".($page-1)."'>  Prev </a>";   
                        }                          
                        for ($i=1; $i<=$total_pages; $i++) {   
                          if ($i == $page) {   
                              $pagLink .= "<a class = 'active' href='student_course_enrollment.php?page=".$i."'>".$i." </a>";   
                          }               
                          else  {   
                              $pagLink .= "<a href='student_course_enrollment.php?page=".$i."'>".$i." </a>";     
                          }   
                        };     
                        echo $pagLink;   
                        if($page<$total_pages){   
                            echo "<a href='student_course_enrollment.php?page=".($page+1)."'>  Next </a>";   
                        }    
                        ?>    
                </div>
            </div>
        </div>
        </center>   
        <button class="open-button" onclick="openForm()">Enroll Student to Course</button>
        <div class="form-popup register_container" id="myForm">
            <form class="form-container" id="register_form" method="post">
                <h3>Enroll Student to course</h3>
                <br/>
                <div id="register_error"></div>
		<input type="hidden" name="student_enrollment" id="student_enrollment" value=1>
                
		<table>
		<tr>
		<td>    <label for="students">&nbsp;&nbsp;student</label>
			<select name="student_id" id="student_id">
			     <?php $query = "SELECT * FROM students";
				$rs_result = $db_obj -> execute_query($query);
				while ($row = $db_obj -> get_fetched_data($rs_result)) {
					$student_name=$row['first_name']." ".$row['last_name'];
					$student_id=$row['student_id'];
		                ?>       
				 <option value=<?php echo $student_id ?> ><?php echo $student_name ?></option>
		             <?php } ?>
			</select>
		</td>
		<td>
			<label for="courses">&nbsp;&nbsp;course</label>
			<select name="course_id" id="course_id">
			     <?php $query = "SELECT * FROM courses";
				$rs_result = $db_obj -> execute_query($query);
				while ($row = $db_obj -> get_fetched_data($rs_result)) {
					$course_name=$row['course_name'];
					$course_id=$row['course_id'];
		                ?>       
				 <option value=<?php echo $course_id ?> ><?php echo $course_name ?></option>
		             <?php } ?>
			</select>
		</td>
		</tr>
		</table>
                <br><br>
                <button type="submit" class="btn " id="enrollstudent" >Enroll</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>
        
        <div class="modal fade" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div id="delete_error"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button> 
                    <h4 class="modal-title">Delete Student Enrollment</h4>
                </div>
                <form  id="delete_student_emrollment_form">
			
                    <div class="modal-body">
			 Are you sure to remove <span id="student_to_delete"></span> 
			Enrolled to course <span id="course_to_delete"></span> 
			 <input type="hidden" name="student_enrollment_deletion" id="student_enrollment_deletion" value=1>
                        <input type="hidden" id="student_course_enrollment_id" name="student_course_enrollment_id">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete_student_enrollment" onclick="delete_student_emrollment_form()">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </body>
</html>


<script> 

function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

function go2Page() {
    var page = document.getElementById("page").value;
    page = ((page > <?php echo $total_pages; ?> ) ? <?php echo $total_pages; ?> : ((page < 1) ? 1 : page));
    window.location.href = 'student_course_enrollment.php?page=' + page;
}

$("#register_form").trigger('reset');

function delete_student_enrollment_row(student_name, course_name,student_enrollment_id) {
    $('#delete_modal').modal('show');
    $("#student_to_delete").html('<b>' + student_name + '</b>');
    $("#course_to_delete").html('<b>' + course_name + '</b>');
    $("#student_course_enrollment_id").val(student_enrollment_id);
}

$('document').ready(function() {

// enrollment addition  
    /* handle form validation */
    $("#register_form").validate({
        rules: {
            student_id: {
                required: true,
            },

            course_id: {
                required: true,
            },
        },
        messages: {
            student_id: "please choose student",
            course_id: "please choose course"
        },
        submitHandler: submitForm
    });
    /* handle form submit */

    function submitForm() {

        var data = $("#register_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'student_course_enrollment_backend.php',
            data: data,
            beforeSend: function() {
                $("#register_error").fadeOut();
                $("#enrollstudent").html('Registering ...');
            },
            success: function(response) {

                if (response == 1) {
                    $("#register_error").fadeIn(100, function() {
                        $("#register_error").html('<div class="alert alert-danger">  Sorry, enrollment exists !</div>');
                        $("#enrollstudent").html('Register');
                    });
                } else if ($.trim(response) == "enrolled") {
                    setTimeout(function() {
                        location.reload();
                    }, 500);

                } else {
                    $("#register_error").fadeIn(100, function() {
                        $("#error_display_div").html('<font color="red"><b>Sorry, some error occured, unable to add new enrollment, contact support team :/</b></font>');
                        $("#enrollstudent").html('Enroll');
                    });
                }
            }
        });
        return false;
    }
});

//enrollment deletion
function delete_student_emrollment_form() {
    var data = $("#delete_student_emrollment_form").serialize();
    $.ajax({
        type: 'POST',
        url: 'student_course_enrollment_backend.php',
        data: data,
        beforeSend: function() {
            $("#delete_error").fadeOut();
            $("#delete_student_enrollment").html('Deleting ...');
        },
        success: function(response) {

            if ($.trim(response) == "deleted") {
                $('#delete_modal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 500);
            } else {
                $("#delete_error").fadeIn(1000, function() {
			$("#error_display_div").html('<font color="red"><b>Sorry, some error occured, unable to delete enrollment, contact support team :/</b></font>');
                    	 $('#delete_modal').modal('hide');
                });
            }

        }
    });
    return false;
}
</script>
