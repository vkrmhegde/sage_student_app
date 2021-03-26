
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
            <div class='container' style="width:100% !important;align:right !important;" >
                <div class="header-top">
                    <div class="logo" >
                        <a href="index.php"><img src="images/logo.png" alt=""/></a>
                    </div>
                    <div class="top-menu" >
                        <span class="menu"> </span>
                        <ul>
                            <nav class="cl-effect-5" style="font-size:20px;">
                                <li><a href="index.php"><span data-hover="Home">home</span></a></li>
                                <li><a class= "active" href="#" ><span data-hover="Students">Students</span></a></li>
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
            $query = "SELECT * FROM students LIMIT $start_from, $per_page_record";  
	    $rs_result = $db_obj -> execute_query($query);
            ?>    
        <div class="container">
            <br>   
            <div>
		<h3> Students list</h3><br>
		<div id="error_display_div"></div>
                <table class="table table-striped table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
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
                                $dateofbirth=$row["dateofbirth"];
                                $contactnumber=$row["contactnumber"];
                                $student_id=$row["student_id"];
                                ?>
                            <td><?php echo $first_name;?></td>
                            <td><?php echo $last_name; ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" onclick="update_student_row('<?php echo $first_name; ?>','<?php echo $last_name; ?>', '<?php echo $dateofbirth; ?>','<?php echo $contactnumber; ?>')">Update</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="delete_student_row('<?php echo $first_name; ?>','<?php echo $student_id; ?>')">Delete</button>
                            </td>
                        </tr>
                        <?php     
                            };    
                            ?>     
                    </tbody>
                </table>
                <div class="pagination">    
                    <?php  
                        $query = "SELECT COUNT(*) FROM students";  
			$rs_result = $db_obj -> execute_query($query);
			$row = $db_obj -> get_row($rs_result);  
                        $total_records = $row[0];     
                        if($total_records==0)
				  echo "No Students to display, please regsiter students!";   
                        echo "</br>";     
                        // Number of pages required.   
                        $total_pages = ceil($total_records / $per_page_record);     
                        $pagLink = "";            
                        if($page>=2){   
                            echo "<a href='students.php?page=".($page-1)."'>  Prev </a>";   
                        }                          
                        for ($i=1; $i<=$total_pages; $i++) {   
                          if ($i == $page) {   
                              $pagLink .= "<a class = 'active' href='students.php?page=".$i."'>".$i." </a>";   
                          }               
                          else  {   
                              $pagLink .= "<a href='students.php?page=".$i."'>".$i." </a>";     
                          }   
                        };     
                        echo $pagLink;   
                        if($page<$total_pages){   
                            echo "<a href='students.php?page=".($page+1)."'>  Next </a>";   
                        }    
                        ?>    
                </div>
            </div>
        </div>
        </center>   
        <button class="open-button" onclick="openForm()">Register New Student</button>
        <div class="form-popup register_container" id="myForm">
            <form class="form-container" id="register_form" method="post">
                <h3>Register Student</h3>
                <br/>
                <div id="register_error"></div>
		<input type="hidden" name="student_registration" id="student_registration" value=1>
                <input type="text" placeholder="Enter first name" name="first_name" id="first_name" required minlength="3">
                <input type="text" placeholder="Enter last name" name="last_name" id="last_name" >
                <input type="text" placeholder="Enter DOB in dd/mm/yyyy format" name="dateofbirth" id="dateofbirth" required minlength=10>
                <input type="text" placeholder="Enter contact number"  name="contactnumber" id="contactnumber" required minlength=10 maxlength=10>
                <button type="submit" class="btn " id="registerstudent" >Register</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>
        <div class="modal fade" id="update_modal" role="dialog">
            <div class="modal-dialog">
                <div id="update_error"></div>
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Student detail</h4>
                    </div>
                    <form class="form-container" id="update_student_form">
                        <div class="modal-body">
			    <input type="hidden" name="student_updation" id="student_updation" value=1>
                            <label for="firstname"><b>First Name</b></label> 
                            <input type="text" placeholder="Enter first name" name="first_name_to_update" id="first_name_to_update" required minlength="3"> 
                            <label for="lastname"><b>Last Name</b></label>
                            <input type="text" placeholder="Enter last name" name="last_name_to_update" id="last_name_to_update" > 
                            <label for="dob"><b>Date Of Birth</b></label> 
                            <input type="text" placeholder="Enter DOB" name="dateofbirth_to_update" id="dateofbirth_to_update" required minlength=10> 
                            <label for="contactnumber"><b>Contact Number</b></label> 
                            <input type="text" placeholder="Enter contact number" name="contactnumber_to_update" id="contactnumber_to_update" required minlength=10 maxlength=10 readonly>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="update_student" onclick="update_student_form()">Update</button> 
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div id="delete_error"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button> 
                    <h4 class="modal-title">Delete Student detail</h4>
                </div>
                <form class="" id="delete_student_form">
                    <div class="modal-body">
                        Are you sure to delete the student with name
                        <div id="student_to_delete"></div> (This also removes respective enrollment)
			 <input type="hidden" name="student_deletion" id="student_deletion" value=1>
                        <input type="hidden" id="student_id_to_delete" name="student_id_to_delete">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete_student" onclick="delete_student_form()">Delete</button>
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
    window.location.href = 'students.php?page=' + page;
}

$("#register_form").trigger('reset');

function update_student_row(first_name, last_name, dateofbirth, contactnumber) {
    $('#update_modal').modal('show');
    $("#first_name_to_update").val(first_name)
    $("#last_name_to_update").val(last_name)
    $("#dateofbirth_to_update").val(dateofbirth)
    $("#contactnumber_to_update").val(contactnumber)
}

function delete_student_row(first_name, student_id) {
    $('#delete_modal').modal('show');
    $("#student_to_delete").html('<b>' + first_name + '</b>');
    $("#student_id_to_delete").val(student_id);
}

$('document').ready(function() {

// for register student module
    $.validator.addMethod(
        "australianDate",
        function(value, element) {
            return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
        },
        "Please enter a date in the format dd/mm/yyyy."
    );
    /* handle form validation */
    $("#register_form").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3
            },

            dateofbirth: {
                required: true,
                australianDate: true
            },
            contactnumber: {
                number: true,
                required: true,
                maxlength: 10,
                minlength: 10
            },
        },
        messages: {
            first_name: "please enter first name",
            dateofbirth: "Please enter dob in dd/mm/yyyy format",
            contactnumber: "please enter a valid contact number",
        },
        submitHandler: submitForm
    });
    /* handle form submit */

    function submitForm() {

        var data = $("#register_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'student_backend.php',
            data: data,
            beforeSend: function() {
                $("#register_error").fadeOut();
                $("#registerstudent").html('Registering ...');
            },
            success: function(response) {

                if (response == 1) {
                    $("#register_error").fadeIn(100, function() {
                        $("#register_error").html('<div class="alert alert-danger">  Sorry mobile number exists !</div>');
                        $("#registerstudent").html('Register');
                    });
                } else if ($.trim(response) == "registered") {
                    setTimeout(function() {
                        location.reload();
                    }, 500);

                } else {
                    $("#register_error").fadeIn(100, function() {
                        $("#error_display_div").html('<font color="red"><b>Sorry, some error occured, unable to register student, contact support team :/</b></font>');
                        $("#registerstudent").html('Register');
                    });
                }
            }
        });
        return false;
    }
});

// for update student module
function update_student_form() {
    var data = $("#update_student_form").serialize();
    $.ajax({
        type: 'POST',
        url: 'student_backend.php',
        data: data,
        beforeSend: function() {
            $("#update_error").fadeOut();
            $("#update_student").html('Updating ...');
        },
        success: function(response) {

            if ($.trim(response) == "updated") {
                $('#update_modal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 500);
            } else {
                $("#update_error").fadeIn(1000, function() {
                    $("#error_display_div").html('<font color="red"><b>Sorry, some error occured, unable to update student, contact support team :/</b></font>');
		    $('#update_modal').modal('hide');
                });
            }

        }
    });
    return false;
}

//for delete student module
function delete_student_form() {
    var data = $("#delete_student_form").serialize();
    $.ajax({
        type: 'POST',
        url: 'student_backend.php',
        data: data,
        beforeSend: function() {
            $("#delete_error").fadeOut();
            $("#delete_student").html('Deleting ...');
        },
        success: function(response) {

            if ($.trim(response) == "deleted") {
                $('#delete_modal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 500);
            } else {
                $("#delete_error").fadeIn(1000, function() {
		    $("#error_display_div").html('<font color="red"><b>Sorry, some error occured, unable to delete student, contact support team :/</b></font>');
                    $('#delete_modal').modal('hide');
                });
            }

        }
    });
    return false;
}
</script>
