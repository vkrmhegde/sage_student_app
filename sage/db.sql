create database IF NOT EXISTS sage_student_project

CREATE TABLE IF NOT EXISTS `students` (
`student_id` int(11) NOT NULL AUTO_INCREMENT,
`first_name` varchar(155) DEFAULT NULL,
`last_name` varchar(155) DEFAULT NULL,
`dateofbirth` varchar(255) DEFAULT NULL,
`contactnumber` varchar(200) NOT NULL,
PRIMARY KEY (`student_id`),
UNIQUE KEY `contactnumber` (`contactnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `courses` (
`course_id` int(11) NOT NULL AUTO_INCREMENT,
`course_name` varchar(155) NOT NULL,
`course_detail` TEXT DEFAULT NULL,
PRIMARY KEY (`course_id`),
UNIQUE KEY `course_name` (`course_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE student_course_enrollment (
    `student_course_enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
    `student_id` int NOT NULL,
    `course_id` int NOT NULL,
    PRIMARY KEY (`student_course_enrollment_id`),
    FOREIGN KEY (`student_id`) REFERENCES `students`(`student_id`),
    FOREIGN KEY (`course_id`) REFERENCES `courses`(`course_id`)
); 
