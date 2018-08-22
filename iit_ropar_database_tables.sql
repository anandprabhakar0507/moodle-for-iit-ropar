-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2018 at 03:26 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a_database`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cal_CGPA` (`SEM` INT, `Stu_ID` VARCHAR(50)) RETURNS DOUBLE READS SQL DATA
BEGIN

   DECLARE done INT DEFAULT FALSE;
   DECLARE siteID INT DEFAULT 0;
   DECLARE A FLOAT DEFAULT 0;
   DECLARE B INT DEFAULT 0;
   DECLARE x FLOAT DEFAULT 0;
   DECLARE y INT DEFAULT 0;
   DECLARE v_finished INTEGER DEFAULT 0;

   DECLARE cur cursor for SELECT Credits,grade from all_courses_floated,all_courses_taken where student_id=Stu_ID and all_courses_taken.semester<=SEM and Course_ID=Course_code and all_courses_floated.year=all_courses_taken.year and MOD(all_courses_taken.semester,2)=all_courses_floated.semester and Ins_ID=Instructor_id and grade!=0;
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
   open cur;get_email: LOOP
         
         FETCH cur INTO A,B;
         IF done = TRUE THEN 
 		    LEAVE get_email;
 	     END IF;
         SET x=x+A*B;
         SET y=y+A;
   END LOOP get_email;      
         close cur;
   
   IF y = 0 THEN
         RETURN y;
   END IF;


   SET x=x/y;
   
   RETURN x;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `cal_sgpa` (`SEM` INT, `Stu_ID` VARCHAR(50)) RETURNS FLOAT READS SQL DATA
BEGIN

   DECLARE done INT DEFAULT FALSE;
   DECLARE siteID INT DEFAULT 0;
   DECLARE A FLOAT DEFAULT 0;
   DECLARE B INT DEFAULT 0;
   DECLARE x FLOAT DEFAULT 0;
   DECLARE y INT DEFAULT 0;
   DECLARE v_finished INTEGER DEFAULT 0;

   DECLARE cur cursor for SELECT Credits,grade from all_courses_floated,all_courses_taken where student_id=Stu_ID and all_courses_taken.semester=(SEM) and Course_ID=Course_code and all_courses_floated.year=all_courses_taken.year and MOD(all_courses_taken.semester,2)=all_courses_floated.semester and Ins_ID=Instructor_id and grade!=0;
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
   open cur;get_email: LOOP
         
         FETCH cur INTO A,B;
         IF done = TRUE THEN 
 		    LEAVE get_email;
 	     END IF;
         SET x=x+A*B;
         SET y=y+A;
   END LOOP get_email;      
         close cur;
      

   IF y = 0 THEN
         RETURN y;
   END IF;


   SET x=x/y;
   
   RETURN x;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `credit_rule` (`SEM` INT, `Stu_ID` VARCHAR(50)) RETURNS FLOAT READS SQL DATA
BEGIN

   DECLARE done INT DEFAULT FALSE;
   DECLARE siteID INT DEFAULT 0;
   DECLARE A FLOAT DEFAULT 0;
   DECLARE B INT DEFAULT 0;
   DECLARE x FLOAT DEFAULT 0;
   DECLARE y INT DEFAULT 0;
   DECLARE v_finished INTEGER DEFAULT 0;   
   DECLARE cur cursor for SELECT Credits from all_courses_floated,all_courses_taken where student_id=Stu_ID and all_courses_taken.semester<SEM and all_courses_taken.semester>(SEM-3) and Course_ID=Course_code and all_courses_floated.year=all_courses_taken.year and MOD(all_courses_taken.semester,2)=all_courses_floated.semester and Instructor_id=Ins_ID and grade!=0;
   
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
   open cur;get_email: LOOP
         
         FETCH cur INTO A;
         IF done = TRUE THEN 
 		    LEAVE get_email;
 	     END IF;
         SET y=y+A;
   END LOOP get_email;      
         close cur;
   
   IF SEM = 1 THEN
       RETURN 19.2;
   END IF;    

   IF SEM = 2 THEN
       RETURN 19.2;
   END IF;    
	SET y=y/2;
   RETURN y;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `insert_probate` () RETURNS INT(11) MODIFIES SQL DATA
BEGIN
 DECLARE done INT DEFAULT FALSE;
   DECLARE siteID INT DEFAULT 0;
   DECLARE A VARCHAR(50) DEFAULT 0;
   DECLARE B INT DEFAULT 0;
   DECLARE x FLOAT DEFAULT 0;
   DECLARE y INT DEFAULT 0;
   
   DECLARE cur cursor for SELECT username,current_sem from students;
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
   open cur;get_email: LOOP
         
         FETCH cur INTO A,B;
         IF done = TRUE THEN 
 		    LEAVE get_email;
 	     END IF;
         SET x=cal_CGPA(B,A);
	 IF x<5 and x>=0 THEN
         INSERT INTO probation_students values(A,x,B);
         END IF;
   END LOOP get_email;      
         close cur;

 RETURN 1;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `update_cgpa` () RETURNS INT(1) MODIFIES SQL DATA
BEGIN
 DECLARE done INT DEFAULT FALSE;
   DECLARE siteID INT DEFAULT 0;
   DECLARE A VARCHAR(50) DEFAULT 0;
   DECLARE B INT DEFAULT 0;
   DECLARE x FLOAT DEFAULT 0;
   DECLARE y INT DEFAULT 0;
   
   DECLARE cur cursor for SELECT username,current_sem from students;
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
   open cur;get_email: LOOP
         
         FETCH cur INTO A,B;
         IF done = TRUE THEN 
 		    LEAVE get_email;
 	     END IF;
         SET x=cal_CGPA(B,A);
         UPDATE students SET CGPA=x WHERE username=A;
   END LOOP get_email;      
         close cur;

 RETURN 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `current_year` int(4) NOT NULL,
  `current_semester` int(2) NOT NULL,
  `sem_completed` int(1) NOT NULL DEFAULT '0',
  `activate_course_registration` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`current_year`, `current_semester`, `sem_completed`, `activate_course_registration`) VALUES
(2017, 1, 0, 1);

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `back_up_data` BEFORE UPDATE ON `admin` FOR EACH ROW BEGIN
DECLARE x FLOAT;
IF NEW.sem_completed=1 THEN
SET x=update_cgpa();
DELETE  FROM notifications;
DELETE FROM takes;
DELETE  FROM course_offerings;
SET NEW.sem_completed=0;
UPDATE students SET current_sem=(current_sem+1);
IF OLD.current_semester=0 THEN
	SET NEW.current_year=OLD.current_year+1;
    SET NEW.current_semester=1;
ELSE
	SET NEW.current_semester=0;
END IF; 
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `advisor_table`
--

CREATE TABLE `advisor_table` (
  `id` int(11) NOT NULL,
  `Instructor_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advisor_table`
--

INSERT INTO `advisor_table` (`id`, `Instructor_id`) VALUES
(1, 'sudarshan');

-- --------------------------------------------------------

--
-- Table structure for table `all_courses_floated`
--

CREATE TABLE `all_courses_floated` (
  `Course_code` varchar(50) NOT NULL,
  `Course_name` varchar(50) NOT NULL,
  `Instructor_id` varchar(50) NOT NULL,
  `Credits` int(5) NOT NULL,
  `L-T-P` varchar(50) NOT NULL,
  `Slot` varchar(10) NOT NULL,
  `prerequisite` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='contains all the courses that are floated' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `all_courses_floated`
--

INSERT INTO `all_courses_floated` (`Course_code`, `Course_name`, `Instructor_id`, `Credits`, `L-T-P`, `Slot`, `prerequisite`, `year`, `semester`) VALUES
('BIG', 'BTP', 'mudgal', 14, '14-0-0', 'A3', 'CSL 355', 2017, '1'),
('CSL 105', 'Discrete', 'sudarshan', 4, '3-0-1', '', '', 2017, '1'),
('CSL 202', 'Advanced Discrete', 'sudarshan', 3, '1-0-2', 'A5', 'CSL 105', 2016, '1'),
('CSL 301', 'database', 'sudarshan', 4, '3-0-1', 'A1', '', 2017, '1'),
('CSL 343', 'Networks', 'gunturi', 3, '3-0-1', 'A1', '', 2017, '1');

-- --------------------------------------------------------

--
-- Table structure for table `all_courses_taken`
--

CREATE TABLE `all_courses_taken` (
  `student_id` varchar(50) NOT NULL,
  `Course_ID` varchar(50) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `Ins_ID` varchar(50) NOT NULL,
  `semester` int(4) NOT NULL,
  `year` int(4) NOT NULL,
  `grade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='contains all the courses that are taken by a student';

--
-- Dumping data for table `all_courses_taken`
--

INSERT INTO `all_courses_taken` (`student_id`, `Course_ID`, `section_id`, `Ins_ID`, `semester`, `year`, `grade`) VALUES
('2015csb1009', 'CSL 105', '1', 'sudarshan', 1, 2017, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_catalog`
--

CREATE TABLE `course_catalog` (
  `Course_ID` varchar(50) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Dept_name` varchar(50) NOT NULL,
  `Credits` int(5) NOT NULL,
  `L-T-P` varchar(50) NOT NULL,
  `prerequisite1` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_catalog`
--

INSERT INTO `course_catalog` (`Course_ID`, `Title`, `Dept_name`, `Credits`, `L-T-P`, `prerequisite1`) VALUES
('BIG', 'BTP', 'Computer Science', 14, '14-0-0', 'CSL 355'),
('CSL 105', 'Discrete', 'Computer Science', 4, '3-0-1', ''),
('CSL 202', 'Advanced Discrete', 'Computer Science', 3, '1-0-2', 'CSL 105'),
('CSL 301', 'database', 'Computer Science', 4, '3-0-1', ''),
('CSL 343', 'Networks', 'Computer Science', 3, '3-0-1', ''),
('CSL 355', 'Logic', 'Computer Science', 4, '3-1-0', 'CSL 105'),
('CSL 704', 'Advanced OS', 'Computer Science', 4, '4-0-0', ''),
('MAL 424', 'Numerical', 'Computer Science', 4, '2-0-2', '');

-- --------------------------------------------------------

--
-- Table structure for table `course_offerings`
--

CREATE TABLE `course_offerings` (
  `Course_code` varchar(50) NOT NULL,
  `Course_name` varchar(50) NOT NULL,
  `Instructor_id` varchar(50) NOT NULL,
  `Credits` int(5) NOT NULL,
  `L-T-P` varchar(50) NOT NULL,
  `Slot` varchar(10) NOT NULL,
  `prerequisite1` varchar(50) NOT NULL,
  `Max_students` int(10) DEFAULT '1000',
  `Current_Strength` int(10) NOT NULL DEFAULT '0',
  `cgpa_constraint` float NOT NULL DEFAULT '0',
  `allowed_batches` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `course_offerings`
--

INSERT INTO `course_offerings` (`Course_code`, `Course_name`, `Instructor_id`, `Credits`, `L-T-P`, `Slot`, `prerequisite1`, `Max_students`, `Current_Strength`, `cgpa_constraint`, `allowed_batches`) VALUES
('BIG', 'BTP', 'mudgal', 14, '14-0-0', 'A3', 'CSL 355', 1000, 0, 0, '2017'),
('CSL 105', 'Discrete', 'sudarshan', 4, '3-0-1', 'A2', '', 1000, 2, 0, '2017'),
('CSL 202', 'Advanced Discrete', 'sudarshan', 3, '1-0-2', 'A5', 'CSL 105', 1000, 0, 0, '2016'),
('CSL 301', 'database', 'sudarshan', 4, '3-0-1', 'A1', '', 1000, 0, 0, ''),
('CSL 343', 'Networks', 'gunturi', 3, '3-0-1', 'A1', '', 1000, 0, 0, '');

--
-- Triggers `course_offerings`
--
DELIMITER $$
CREATE TRIGGER `into_all_floated` BEFORE INSERT ON `course_offerings` FOR EACH ROW INSERT INTO all_courses_floated VALUES (NEW.Course_code, NEW.Course_name, NEW.Instructor_id, NEW.Credits, NEW.`L-T-P`, NEW.Slot, NEW.prerequisite1, (SELECT current_year from admin),(SELECT current_semester from admin))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dean_academics`
--

CREATE TABLE `dean_academics` (
  `dean_id` varchar(50) NOT NULL,
  `Instructor_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dean_academics`
--

INSERT INTO `dean_academics` (`dean_id`, `Instructor_id`, `password`, `email`) VALUES
('pk_raina', 'raina', '1234', 'q@q.c');

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `Dept_name` varchar(50) NOT NULL,
  `hod_id` varchar(50) NOT NULL,
  `Instructor_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`Dept_name`, `hod_id`, `Instructor_id`, `password`, `email`) VALUES
('Computer Science', 'hodcse', 'mudgal', 'q', 'q@q.c'),
('EEE', 'hodeee', 'gunturi', 'q', 'q@q.c');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `Ins_ID` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Dept_Name` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Contact_No` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`Ins_ID`, `Name`, `Password`, `Dept_Name`, `Address`, `Contact_No`, `email`) VALUES
('gunturi', 'Viswanath Gunturi', '12345', 'Computer Science', 'xyz', '1', 'q@q.c'),
('mudgal', 'Apoorva Mudgal', '12345', 'Computer Science', 'xyz', '1', 'qs@q.c'),
('nitin', 'Nitin Auluck', '12345', 'Computer Science', 'xyz', '1', 'q@q.c'),
('raina', 'PK Raina', '12345', 'Physics', '12345', '1', 'q@q.c'),
('sudarshan', 'Sudarshan Iyenger', '12345', 'Computer Science', '12345', '1', 'q@q.c'),
('sujata', 'Sujata Pal', '12345', 'Computer Science', 'xyz', '1', 'q@q.c');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `student_id` varchar(50) NOT NULL,
  `Course_code` varchar(50) NOT NULL,
  `teacher_id` varchar(50) NOT NULL,
  `category` int(10) NOT NULL,
  `status` int(50) NOT NULL,
  `count` int(8) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`student_id`, `Course_code`, `teacher_id`, `category`, `status`, `count`, `Description`, `Timestamp`) VALUES
('2015csb1009', 'BIG', 'mudgal', 4, 0, 0, 'Pre-requisite is not cleared. ', '2018-05-17 07:23:51');

--
-- Triggers `notifications`
--
DELIMITER $$
CREATE TRIGGER `take_action` BEFORE UPDATE ON `notifications` FOR EACH ROW BEGIN
DECLARE curr1 INT;
IF NEW.status=1 THEN
	IF (OLD.count+1) <> OLD.category THEN
		IF (OLD.count+1 = 2) THEN 
			SET NEW.teacher_id = (SELECT hod_id FROM hod where Dept_name= (SELECT department FROM students WHERE username=OLD.student_id));
		ELSEIF (OLD.count+1 = 1) THEN
			SET NEW.teacher_id = (SELECT Instructor_id FROM advisor_table where id=(SELECT advisor_id from students where username=NEW.student_id));
        ELSEIF (OLD.count+1 = 3) THEN
         SET NEW.teacher_id=(SELECT dean_id FROM dean_academics);     
		END IF;
		SET NEW.status=0;
		SET NEW.count=(OLD.count+1);
		SET NEW.Timestamp=NOW();
   ELSE
   INSERT INTO all_courses_taken VALUES (NEW.student_id,NEW.Course_code,1,(SELECT Instructor_id FROM course_offerings where
   course_code= NEW.course_code),(SELECT current_sem from students where username=NEW.student_id),(SELECT current_year from admin),
   0);
	UPDATE takes SET status=1 WHERE course_id=NEW.Course_code;
    SET curr1=(SELECT Current_strength FROM course_offerings WHERE Course_code=NEW.Course_code);
     UPDATE course_offerings SET Current_Strength = curr1+1  WHERE Course_code=NEW.Course_code;
   END IF;

ELSEIF NEW.status=0 THEN
    	SET NEW.status=0;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `probation_students`
--

CREATE TABLE `probation_students` (
  `student_id` varchar(50) NOT NULL,
  `sgpa` float NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_dean_academics`
--

CREATE TABLE `staff_dean_academics` (
  `staff_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_dean_academics`
--

INSERT INTO `staff_dean_academics` (`staff_id`, `password`, `email`) VALUES
('ashu', '12345', 'q@q.c'),
('vishnu', '12345', 'q@q.c');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` double NOT NULL,
  `department` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `advisor_id` int(4) NOT NULL DEFAULT '1',
  `CGPA` float NOT NULL DEFAULT '0',
  `current_sem` int(3) NOT NULL DEFAULT '1',
  `year_of_join` varchar(4) NOT NULL,
  `purchased` int(1) NOT NULL DEFAULT '0',
  `attempts_left` int(3) NOT NULL DEFAULT '20',
  `latest_subs_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `firstname`, `lastname`, `email`, `phone_number`, `department`, `password`, `advisor_id`, `CGPA`, `current_sem`, `year_of_join`, `purchased`, `attempts_left`, `latest_subs_data`) VALUES
('2015csb1009', 'Yugandhar', 'Bandi', 'yugandhar.bunny.2220@gmail.com', 9494555549, 'Computer Science', 'q', 1, 0, 1, '2017', 1, -1, '2018-06-08'),
('sainath', 'thota', 'venkata', '2015csb1037@iitrpr.ac.in', 9915370787, 'Computer Science', '12345', 1, 0, 1, '2017', 0, 20, '2018-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `takes`
--

CREATE TABLE `takes` (
  `student_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `grade` float NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `takes`
--

INSERT INTO `takes` (`student_id`, `course_id`, `section_id`, `semester`, `year`, `grade`, `status`) VALUES
('2015csb1009', 'BIG', '1', '1', 2017, 0, 0),
('2015csb1009', 'CSL 105', '1', '1', 2017, 0, 1);

--
-- Triggers `takes`
--
DELIMITER $$
CREATE TRIGGER `ch` BEFORE INSERT ON `takes` FOR EACH ROW BEGIN

DECLARE curr INT;
DECLARE curr1 INT;
DECLARE maxi INT;
DECLARE twice INT;
DECLARE chec VARCHAR(500);
DECLARE total_credits INT;
DECLARE ex_credits INT;
DECLARE prereq VARCHAR(50);
DECLARE batch_constraint VARCHAR(50);
DECLARE A float;
SET chec="";
SET ex_credits = (select SUM(Credits) from course_offerings, takes where takes.student_id=NEW.student_id AND 
takes.course_id=course_offerings.Course_code);
SELECT cgpa_constraint INTO A FROM course_offerings where Course_code=NEW.course_id;
SET batch_constraint=(SELECT allowed_batches FROM course_offerings where Course_code=NEW.course_id);
IF ex_credits >0 THEN

	SET total_credits=ex_credits+(SELECT Credits FROM course_offerings WHERE Course_code=NEW.course_id);

ELSE 

	SET total_credits=(SELECT Credits FROM course_offerings WHERE Course_code=NEW.course_id);

END IF;

IF total_credits > (credit_rule((SELECT current_sem FROM students WHERE username=NEW.student_id), NEW.student_id)) THEN 
	SET chec = CONCAT(chec, "Request for extra credits. ");
END IF;

SET curr=(SELECT Current_strength FROM course_offerings WHERE Course_code=NEW.course_id);

SET twice=0;

SET maxi=(SELECT Max_students FROM course_offerings WHERE Course_code=NEW.course_id);

SET prereq=(SELECT prerequisite1 FROM course_offerings where Course_code=NEW.course_id);
IF LENGTH(batch_constraint)>0 THEN
IF (SELECT POSITION((SELECT year_of_join from students where username=NEW.student_id) IN batch_constraint)) = 0 THEN
		SET chec = CONCAT(chec, "BAtch ");
END IF;
END IF;

IF LENGTH(prereq)>0 THEN

	IF NOT EXISTS (SELECT * from course_offerings WHERE Course_code=NEW.course_id AND prerequisite1 IN (SELECT course_id FROM all_courses_taken WHERE student_id=NEW.student_id) > 0) THEN

		SET chec = CONCAT(chec, "Pre-requisite is not cleared. ");

	END IF;

END IF;

IF NOT EXISTS (SELECT * from students where username=NEW.student_id and CGPA>=A) THEN
	SET chec = CONCAT(chec, "CGPA constraint. ");
END IF;

IF (curr+1)>maxi THEN
		SET chec = CONCAT(chec, "Class limit is exceeded. ");		
END IF;
IF LENGTH(chec)<>0 THEN
INSERT INTO `notifications` VALUES (NEW.student_id,NEW.course_id, (SELECT Instructor_id FROM course_offerings where course_code= NEW.course_id), 4, 0, 0, chec, NOW());
ELSE 
	SET NEW.status=1;
	SET curr1=(SELECT Current_strength FROM course_offerings WHERE Course_code=NEW.course_id);
	INSERT INTO all_courses_taken VALUES (NEW.student_id,NEW.course_id,1,(SELECT Instructor_id FROM course_offerings where course_code= NEW.course_id),(SELECT current_sem from students where username=NEW.student_id),(SELECT current_year from admin), 0);
    UPDATE course_offerings SET Current_Strength = curr1+1  WHERE Course_code=NEW.course_id;
END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_cgpa` AFTER UPDATE ON `takes` FOR EACH ROW BEGIN
	IF NEW.status=1 AND NEW.grade<>0  THEN
    	UPDATE all_courses_taken SET grade=NEW.grade WHERE student_id=NEW.student_id AND Course_ID=NEW.course_id AND section_id=NEW.section_id AND semester=NEW.semester AND year=NEW.year;
        END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`current_year`,`current_semester`);

--
-- Indexes for table `advisor_table`
--
ALTER TABLE `advisor_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Instructor_id` (`Instructor_id`);

--
-- Indexes for table `all_courses_floated`
--
ALTER TABLE `all_courses_floated`
  ADD PRIMARY KEY (`Course_code`,`year`,`semester`),
  ADD KEY `Course_code` (`Course_code`,`Course_name`),
  ADD KEY `Instructor_id` (`Instructor_id`);

--
-- Indexes for table `all_courses_taken`
--
ALTER TABLE `all_courses_taken`
  ADD PRIMARY KEY (`student_id`,`Course_ID`,`section_id`,`semester`,`year`),
  ADD KEY `Course_name` (`Course_ID`),
  ADD KEY `Ins_ID` (`Ins_ID`);

--
-- Indexes for table `course_catalog`
--
ALTER TABLE `course_catalog`
  ADD PRIMARY KEY (`Course_ID`,`Title`),
  ADD UNIQUE KEY `Title` (`Title`);

--
-- Indexes for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD PRIMARY KEY (`Course_code`),
  ADD UNIQUE KEY `Course_name` (`Course_name`),
  ADD KEY `Course_code` (`Course_code`,`Course_name`),
  ADD KEY `Instructor_id` (`Instructor_id`);

--
-- Indexes for table `dean_academics`
--
ALTER TABLE `dean_academics`
  ADD PRIMARY KEY (`dean_id`),
  ADD KEY `Instructor_id` (`Instructor_id`);

--
-- Indexes for table `hod`
--
ALTER TABLE `hod`
  ADD PRIMARY KEY (`Dept_name`),
  ADD UNIQUE KEY `hod_id` (`hod_id`),
  ADD KEY `Instructor_id` (`Instructor_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`Ins_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`Course_code`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `probation_students`
--
ALTER TABLE `probation_students`
  ADD PRIMARY KEY (`student_id`,`semester`);

--
-- Indexes for table `staff_dean_academics`
--
ALTER TABLE `staff_dean_academics`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`username`),
  ADD KEY `advisor_id` (`advisor_id`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `takes`
--
ALTER TABLE `takes`
  ADD PRIMARY KEY (`student_id`,`course_id`,`section_id`,`semester`,`year`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advisor_table`
--
ALTER TABLE `advisor_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisor_table`
--
ALTER TABLE `advisor_table`
  ADD CONSTRAINT `advisor_table_ibfk_1` FOREIGN KEY (`Instructor_id`) REFERENCES `instructor` (`Ins_ID`);

--
-- Constraints for table `all_courses_floated`
--
ALTER TABLE `all_courses_floated`
  ADD CONSTRAINT `all_courses_floated_ibfk_1` FOREIGN KEY (`Course_code`,`Course_name`) REFERENCES `course_catalog` (`Course_ID`, `Title`),
  ADD CONSTRAINT `all_courses_floated_ibfk_2` FOREIGN KEY (`Instructor_id`) REFERENCES `instructor` (`Ins_ID`);

--
-- Constraints for table `all_courses_taken`
--
ALTER TABLE `all_courses_taken`
  ADD CONSTRAINT `all_courses_taken_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`username`),
  ADD CONSTRAINT `all_courses_taken_ibfk_2` FOREIGN KEY (`Course_ID`) REFERENCES `course_catalog` (`Course_ID`),
  ADD CONSTRAINT `all_courses_taken_ibfk_3` FOREIGN KEY (`Ins_ID`) REFERENCES `instructor` (`Ins_ID`);

--
-- Constraints for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD CONSTRAINT `course_offerings_ibfk_1` FOREIGN KEY (`Course_code`,`Course_name`) REFERENCES `course_catalog` (`Course_ID`, `Title`),
  ADD CONSTRAINT `course_offerings_ibfk_2` FOREIGN KEY (`Instructor_id`) REFERENCES `instructor` (`Ins_ID`);

--
-- Constraints for table `dean_academics`
--
ALTER TABLE `dean_academics`
  ADD CONSTRAINT `dean_academics_ibfk_1` FOREIGN KEY (`Instructor_id`) REFERENCES `instructor` (`Ins_ID`);

--
-- Constraints for table `hod`
--
ALTER TABLE `hod`
  ADD CONSTRAINT `hod_ibfk_1` FOREIGN KEY (`Instructor_id`) REFERENCES `instructor` (`Ins_ID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`username`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`Course_code`) REFERENCES `course_offerings` (`Course_code`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`advisor_id`) REFERENCES `advisor_table` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`department`) REFERENCES `hod` (`Dept_name`);

--
-- Constraints for table `takes`
--
ALTER TABLE `takes`
  ADD CONSTRAINT `takes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`username`),
  ADD CONSTRAINT `takes_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_offerings` (`Course_code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
