
<!--Author: Template Stock
    Author URL: http://templatestock.co
    template downloaded from https://www.free-css.com/free-css-templates/page263/above
    -->
<!DOCTYPE html>
<html>
    <head>
        <title>Sage: course Project</title>
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
                <div class="header-top" >
                    <div class="logo" >
                        <a href="index.php"><img src="images/logo.png" alt=""/></a>
                    </div>
                    <div class="top-menu">
                        <span class="menu"> </span>
                        <ul>
                             <nav class="cl-effect-5" style="font-size:20px;">
                                <li><a href="index.php"><span data-hover="Home">home</span></a></li>
                                <li><a href="students.php"><span data-hover="students">students</span></a></li>
                                <li><a class="active" href="#"><span data-hover="Courses"><span>Courses</span></a></li>
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
	     $db_obj = new DatabaseClass();  
            $per_page_record = 5;  // Number of entries to show in a page.   
            // Look for a GET variable page if not found default is 1.        
            if (isset($_GET["page"])) {    
                $page  = $_GET["page"];    
            }    
            else {$page=1;}     
            $start_from = ($page-1) * $per_page_record;     
            $query = "SELECT * FROM courses LIMIT $start_from, $per_page_record";     
             $rs_result = $db_obj -> execute_query($query);  
            ?>    
        <div class="container">
            <br>   
            <div>
		<h3> Courses list</h3><br>
                <table class="table table-striped table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Course Detail</th>
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
                                $course_name=$row["course_name"];
                                $course_detail=$row["course_detail"];                      
                                $course_id=$row["course_id"];
                                ?>
                            <td><?php echo $course_name; ?></td>
                            <td><?php echo $course_detail; ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" onclick="update_course_row('<?php echo $course_name; ?>','<?php echo $course_detail; ?>')">Update</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="delete_course_row('<?php echo $course_name; ?>','<?php echo $course_id; ?>')">Delete</button>
                            </td>
                        </tr>
                        <?php     
                            };    
                            ?>     
                    </tbody>
                </table>
                <div class="pagination">    
                    <?php  
                        $query = "SELECT COUNT(*) FROM courses";     
                        $rs_result = $db_obj -> execute_query($query);    
                        $row = $db_obj -> get_row($rs_result);    
                        $total_records = $row[0];     
                        if($total_records==0)
				  echo "No Courses to display, please add courses!";

                        echo "</br>";     
                        // Number of pages required.   
                        $total_pages = ceil($total_records / $per_page_record);     
                        $pagLink = "";            
                        if($page>=2){   
                            echo "<a href='courses.php?page=".($page-1)."'>  Prev </a>";   
                        }                          
                        for ($i=1; $i<=$total_pages; $i++) {   
                          if ($i == $page) {   
                              $pagLink .= "<a class = 'active' href='courses.php?page=".$i."'>".$i." </a>";   
                          }               
                          else  {   
                              $pagLink .= "<a href='courses.php?page=".$i."'>".$i." </a>";     
                          }   
                        };     
                        echo $pagLink;   
                        if($page<$total_pages){   
                            echo "<a href='courses.php?page=".($page+1)."'>  Next </a>";   
                        }    
                        ?>    
                </div>
            </div>
        </div>
        </center>   
        <button class="open-button" onclick="openForm()">Add New course</button>
        <div class="form-popup register_container" id="myForm">
            <form class="form-container" id="register_form" method="post">
                <h3>Add Course</h3>
                <br/>
                <div id="register_error"></div>
 		<input type="hidden" name="course_addition" id="course_addition" value=1>
                <input type="text" placeholder="Enter course name" name="course_name" id="course_name" required minlength="3">
		<textarea id="course_detail" name="course_detail" rows="4" cols="30" placeholder="enter course description"></textarea><br><br>
                <button type="submit" class="btn " id="registercourse" >Add</button>
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
                        <h4 class="modal-title">Update course detail</h4>
                    </div>
                    <form class="form-container" id="update_course_form">
                        <div class="modal-body">
			    <input type="hidden" name="course_updation" id="course_updation" value=1>
                            <label for="course_name"><b>Course Name</b></label> 
                            <input type="text" placeholder="Enter first name" name="course_name_to_update" id="course_name_to_update" required minlength="3" readonly> 
                            <label for="course_detail"><b>Course Detail</b></label>
                            <textarea id="course_detail_to_update" name="course_detail_to_update" rows="4" cols="30" placeholder="enter course description"></textarea>  <br/> <br>            
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="update_course" onclick="update_course_form()">Update</button> 
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
                    <h4 class="modal-title">Delete course detail</h4>
                </div>
                <form class="" id="delete_course_form">
                    <div class="modal-body">
                        Are you sure to delete the course with name 
                        <div id="course_to_delete"></div> (This also removes respective enrollment)
			<input type="hidden" name="course_deletion" id="course_deletion" value=1>
                        <input type="hidden" id="course_id_to_delete" name="course_id_to_delete">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete_course" onclick="delete_course_form()">Delete</button>
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
    window.location.href = 'courses.php?page=' + page;
}

$("#register_form").trigger('reset');

function update_course_row(course_name, course_detail) {
    $('#update_modal').modal('show');
    $("#course_name_to_update").val(course_name)
    $("#course_detail_to_update").val(course_detail)
}

function delete_course_row(course_name, course_id) {
    $('#delete_modal').modal('show');
    $("#course_to_delete").html('<b>' + course_name + '</b>');
    $("#course_id_to_delete").val(course_id);
}

$('document').ready(function() {

    /* handle form validation */
    $("#register_form").validate({
        rules: {
            course_name: {
                required: true,
                minlength: 3
            },
	    course_detail: {
                required: true,
                minlength: 15
            },        
        },
        messages: {
            course_name: "please enter course name",
            course_detail: "Please enter minimum 15 characters", 
        },
        submitHandler: submitForm
    });
    /* handle form submit */

    function submitForm() {

        var data = $("#register_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'course_backend.php',
            data: data,
            beforeSend: function() {
                $("#register_error").fadeOut();
                $("#registercourse").html('Adding ...');
            },
            success: function(response) {

                if (response == 1) {
                    $("#register_error").fadeIn(100, function() {
                        $("#register_error").html('<div class="alert alert-danger">  Sorry course name exists !</div>');
                        $("#registercourse").html('Add');
                    });
                } else if ($.trim(response) == "added") {
                    setTimeout(function() {
                        location.reload();
                    }, 500);

                } else {
                    $("#register_error").fadeIn(100, function() {
                        $("#register_error").html('<div class="alert alert-danger"> ' + data + ' !</div>');
                        $("#registercourse").html('Add');
                    });
                }
            }
        });
        return false;
    }
});

function update_course_form() {
    var data = $("#update_course_form").serialize();
    $.ajax({
        type: 'POST',
        url: 'course_backend.php',
        data: data,
        beforeSend: function() {
            $("#update_error").fadeOut();
            $("#update_course").html('Updating ...');
        },
        success: function(response) {

            if ($.trim(response) == "updated") {
                $('#update_modal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 500);
            } else {
                $("#update_error").fadeIn(1000, function() {

                    $("#update_course").text('some error occured');
                });
            }

        }
    });
    return false;
}

function delete_course_form() {
    var data = $("#delete_course_form").serialize();
    $.ajax({
        type: 'POST',
        url: 'course_backend.php',
        data: data,
        beforeSend: function() {
            $("#delete_error").fadeOut();
            $("#delete_course").html('Deleting ...');
        },
        success: function(response) {

            if ($.trim(response) == "deleted") {
                $('#delete_modal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 500);
            } else {
                $("#delete_error").fadeIn(1000, function() {

                    $("#delete_course").text('some error occured');
                });
            }

        }
    });
    return false;
}
</script>
