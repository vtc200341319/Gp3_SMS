-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2023 at 10:23 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

DROP TABLE IF EXISTS `assessment`;
CREATE TABLE IF NOT EXISTS `assessment` (
  `assessmentID` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `startingTime` time NOT NULL,
  `finishingTime` time NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectDetailsName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`assessmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`assessmentID`, `date`, `startingTime`, `finishingTime`, `type`, `subjectCode`, `subjectDetailsName`) VALUES
(1, '2023-03-20', '08:05:00', '09:15:00', 'P.1-6 Test', 'CHI', 'Writing'),
(2, '2023-03-20', '09:30:00', '10:40:00', 'P.1-6 Test', 'GS', NULL),
(3, '2023-03-21', '08:05:00', '09:15:00', 'P.1-6 Test', 'ENG', 'Reading'),
(4, '2023-03-21', '09:30:00', '10:40:00', 'P.1-6 Test', 'ENG', 'Writing'),
(5, '2023-03-22', '08:05:00', '09:15:00', 'P.1-6 Test', 'MATHS', NULL),
(6, '2023-03-22', '09:30:00', '10:40:00', 'P.1-6 Test', 'CHI', 'Reading');

-- --------------------------------------------------------

--
-- Table structure for table `booking_facility_application`
--

DROP TABLE IF EXISTS `booking_facility_application`;
CREATE TABLE IF NOT EXISTS `booking_facility_application` (
  `bookFacilityID` int NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `schoolFacilitiesCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`bookFacilityID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_facility_application`
--

INSERT INTO `booking_facility_application` (`bookFacilityID`, `reason`, `startDate`, `endDate`, `startTime`, `endTime`, `schoolFacilitiesCode`, `approval`, `staffCode`) VALUES
(1, 'Teachers\' Training', '2023-05-07', '2023-05-07', '14:00:00', '16:00:00', 'MET101', 'Yes', 'CHOWTL'),
(2, 'EDB Meeting', '2023-05-18', '2023-05-18', '13:00:00', '16:00:00', 'MET401', 'Yes', 'HOTC'),
(3, 'PTA Meeting', '2023-05-17', '2023-05-17', '16:30:00', '20:00:00', 'COM402', 'Yes', 'YEUNGTL');

-- --------------------------------------------------------

--
-- Table structure for table `book_details`
--

DROP TABLE IF EXISTS `book_details`;
CREATE TABLE IF NOT EXISTS `book_details` (
  `bookID` int NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookAuthor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookPublishYear` int NOT NULL,
  `bookPublishPlace` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookCatergory` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookLanguage` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookAvailableQuatity` int DEFAULT NULL,
  `bookViewQuatity` int DEFAULT NULL,
  PRIMARY KEY (`bookID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_details`
--

INSERT INTO `book_details` (`bookID`, `ISBN`, `bookName`, `bookAuthor`, `bookPublishYear`, `bookPublishPlace`, `bookCatergory`, `bookLanguage`, `bookAvailableQuatity`, `bookViewQuatity`) VALUES
(1, '9781406321', '\"Have you seen the crocodile?\"', 'Colin West , West, Colin', 1998, 'London', 'Story', 'English', 10, 100),
(2, '1405201355', '\"Here I am\" said Smedley', 'Simon Puttock', 2000, 'London', 'Story', 'English', 10, 100),
(3, '9781406321', '\"Pardon?\" said the giraffe', 'Colin West , West, Colin', 2008, 'London', 'Literature', 'English', 10, 100),
(4, '1590259458', '\"What is that?\" said the cat', 'Grace MacCarone', 2003, 'New York', 'Fiction', 'English', 10, 100),
(5, '9789881401', '大偵探福爾摩斯 - 逃獄大追捕II', '厲河', 2015, 'Hong Kong', '小說', 'Chinese', 10, 100),
(6, '9789881576', '大偵探福爾摩斯 - 史上最強的女敵手', '厲河', 2013, 'Hong Kong', '小說', 'Chinese', 10, 100),
(7, '9789867137', '昆蟲世界歷險記', '洪在徹', 2006, 'Taiwan', '科學', 'Chinese', 10, 100),
(8, '9789573254', '魔數小子', '凱瑟琳.克莉絲托迪', 2005, 'Taiwan', '科學', 'Chinese', 10, 100),
(9, '9781406335', '\"The Gruffalo\"', 'Julia Donaldson, Axel Scheffler', 1999, 'London', 'Story', 'English', 10, 100),
(10, '0747538492', '\"Harry Potter and the Philosopher Stone\"', 'J.K. Rowling', 1997, 'London', 'Fiction', 'English', 10, 100),
(11, '0679884408', '\"Where the Wild Things Are\"', 'Maurice Sendak', 1963, 'New York', 'Story', 'English', 10, 100),
(12, '0439023521', '\"The Hunger Games\"', 'Suzanne Collins', 2008, 'New York', 'Fiction', 'English', 10, 100),
(13, '9573317242', '\"The Little Prince\"', 'Antoine de Saint-Exupery', 1943, 'New York', 'Literature', 'Chinese', 10, 100),
(14, '957031903X', '\"1984\"', 'George Orwell', 1949, 'London', 'Fiction', 'Chinese', 10, 100),
(15, '9576384224', '\"The Alchemist\"', 'Paulo Coelho', 1988, 'Rio de Janeiro', 'Literature', 'Chinese', 10, 100),
(16, '9570840427', '\"To Kill a Mockingbird\"', 'Harper Lee', 1960, 'New York', 'Literature', 'Chinese', 10, 100),
(17, '9571462378', '\"The Kite Runner\"', 'Khaled Hosseini', 2003, 'New York', 'Fiction', 'Chinese', 10, 100),
(18, '9789861371959', '\"A Brief History of Time\"', 'Stephen Hawking', 1988, 'London', 'Science', 'Chinese', 10, 100),
(19, '9869435732', '\"The Da Vinci Code\"', 'Dan Brown', 2003, 'New York', 'Fiction', 'Chinese', 10, 100),
(20, '9789867287664', '\"The Martian\"', 'Andy Weir', 2011, 'New York', 'Fiction', 'Chinese', 10, 100),
(21, '9866288384', '\"The Art of Thinking Clearly\"', 'Rolf Dobelli', 2011, 'Zurich', 'Self-help', 'Chinese', 10, 100),
(22, '9579572223', '\"The Power of Now\"', 'Eckhart Tolle', 1997, 'Vancouver', 'Self-help', 'Chinese', 10, 100),
(23, '9789862135235', '\"The Lean Startup\"', 'Eric Ries', 2011, 'New York', 'Business', 'Chinese', 10, 100),
(24, '9866251718', '\"The Tipping Point\"', 'Malcolm Gladwell', 2000, 'New York', 'Business', 'Chinese', 10, 100);

-- --------------------------------------------------------

--
-- Table structure for table `campus_news`
--

DROP TABLE IF EXISTS `campus_news`;
CREATE TABLE IF NOT EXISTS `campus_news` (
  `campusNewsID` int NOT NULL AUTO_INCREMENT,
  `issueDate` date NOT NULL,
  `topic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`campusNewsID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campus_news`
--

INSERT INTO `campus_news` (`campusNewsID`, `issueDate`, `topic`, `content`, `staffCode`) VALUES
(1, '2023-03-03', 'Lunch Order Information', 'Parents are requested to order the February meals online from 13/1-17/1. ', 'WONGPH'),
(2, '2023-03-04', 'Student Council Election', 'Nominations for the student council election are now open. Interested students should submit their forms by 10/4.', 'CHANMY'),
(3, '2023-03-05', 'Parent-Teacher Association Meeting', 'The next PTA meeting will be held on 15/4. All parents are welcome to attend.', 'WONGKL'),
(4, '2023-03-07', 'Career Talk', 'A career talk on the field of medicine will be held on 20/4. Interested students should register with the Careers Office.', 'MAKW'),
(5, '2023-03-18', 'Basketball Tryouts', 'Tryouts for the school basketball team will be held on 25/4. Interested students should register with the PE department.', 'LAUCM'),
(6, '2023-03-19', 'School Carnival', 'The school carnival will be held on 29/4. There will be games, food, and entertainment for all.', 'KWOKSM'),
(7, '2023-03-20', 'Mathematics Olympiad', 'The school will be hosting a mathematics olympiad on 5/5. Interested students should register with the Mathematics Department.', 'TANGKC'),
(8, '2023-03-28', 'Model United Nations Conference', 'The school will be hosting a Model United Nations conference on 6/5. Interested students should register with the Social Sciences Department.', 'LOKY'),
(9, '2023-03-29', 'Volunteer Recruitment', 'The school is recruiting volunteers for the upcoming charity event. Interested students should sign up at the General Office.', 'CHOWSK'),
(10, '2023-04-01', 'Student Council Inauguration', 'The student council inauguration ceremony will be held on 8/5. All are welcome to attend.', 'NGWY'),
(11, '2023-04-02', 'International Cultural Fair', 'The school annual International Cultural Fair will be held on 13/5. Students are encouraged to showcase their cultural heritage through food, music, and dance.', 'YIMCY'),
(12, '2023-04-03', 'Sports Day', 'The school annual Sports Day will be held on 20/5. All students are encouraged to participate.', 'CHOWWK'),
(13, '2023-04-05', 'Environmental Awareness Campaign', 'The school is launching an environmental awareness campaign. Interested students should sign up at the General Office.', 'KWONGYC'),
(14, '2023-04-06', 'Art Club Workshop', 'The art club will be hosting a workshop on 13/5. Interested students should register with the Art Department.', 'WONGCK'),
(15, '2023-04-08', 'Music Club Auditions', 'Auditions for the school music club will be held on 15/5. Interested students should register with the Music Department.', 'CHOWKM'),
(16, '2023-04-09', 'English Writing Competition', 'The school annual English writing competition will be held on 17/5. Interested students should register with the English Department.', 'TANGYC'),
(17, '2023-04-11', 'Charity Event', 'The school is organizing a charity event on 27/5 to raise funds for a local orphanage. All are encouraged to participate and support this worthy cause.', 'NGKW');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `classID` int NOT NULL AUTO_INCREMENT,
  `className` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `classTeacherName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chiTeacherName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engTeacherName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mathsTeacherName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gsTeacherName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`classID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classID`, `className`, `classTeacherName`, `chiTeacherName`, `engTeacherName`, `mathsTeacherName`, `gsTeacherName`) VALUES
(1, '1A', NULL, NULL, NULL, NULL, NULL),
(2, '1B', NULL, NULL, NULL, NULL, NULL),
(3, '1C', NULL, NULL, NULL, NULL, NULL),
(4, '1D', NULL, NULL, NULL, NULL, NULL),
(5, '2A', NULL, NULL, NULL, NULL, NULL),
(6, '2B', NULL, NULL, NULL, NULL, NULL),
(7, '2C', NULL, NULL, NULL, NULL, NULL),
(8, '2D', NULL, NULL, NULL, NULL, NULL),
(9, '3A', NULL, NULL, NULL, NULL, NULL),
(10, '3B', NULL, NULL, NULL, NULL, NULL),
(11, '3C', NULL, NULL, NULL, NULL, NULL),
(12, '3D', NULL, NULL, NULL, NULL, NULL),
(13, '4A', NULL, NULL, NULL, NULL, NULL),
(14, '4B', NULL, NULL, NULL, NULL, NULL),
(15, '4C', NULL, NULL, NULL, NULL, NULL),
(16, '4D', NULL, NULL, NULL, NULL, NULL),
(17, '5A', NULL, NULL, NULL, NULL, NULL),
(18, '5B', NULL, NULL, NULL, NULL, NULL),
(19, '5C', NULL, NULL, NULL, NULL, NULL),
(20, '5D', NULL, NULL, NULL, NULL, NULL),
(21, '6A', NULL, NULL, NULL, NULL, NULL),
(22, '6B', NULL, NULL, NULL, NULL, NULL),
(23, '6C', NULL, NULL, NULL, NULL, NULL),
(24, '6D', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_timetable`
--

DROP TABLE IF EXISTS `class_timetable`;
CREATE TABLE IF NOT EXISTS `class_timetable` (
  `classTimeTableID` int NOT NULL AUTO_INCREMENT,
  `day` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson` int NOT NULL,
  `startingTime` time NOT NULL,
  `finishingTime` time NOT NULL,
  `className` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`classTimeTableID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_timetable`
--

INSERT INTO `class_timetable` (`classTimeTableID`, `day`, `lesson`, `startingTime`, `finishingTime`, `className`, `subjectCode`) VALUES
(1, 'Monday', 1, '08:00:00', '08:35:00', '1A', 'CHI'),
(2, 'Monday', 2, '08:35:00', '09:10:00', '1A', 'CHI'),
(3, 'Monday', 3, '09:10:00', '09:45:00', '1A', 'ENG'),
(4, 'Monday', 4, '10:00:00', '10:35:00', '1A', 'MATHS'),
(5, 'Monday', 5, '10:35:00', '11:10:00', '1A', 'MATHS'),
(6, 'Monday', 6, '11:20:00', '11:55:00', '1A', 'GS'),
(7, 'Monday', 7, '11:55:00', '12:30:00', '1A', 'GS');

-- --------------------------------------------------------

--
-- Table structure for table `electronic_application`
--

DROP TABLE IF EXISTS `electronic_application`;
CREATE TABLE IF NOT EXISTS `electronic_application` (
  `electronicApplicationID` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dayCount` int NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `approval` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `studentRegNumber` int DEFAULT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`electronicApplicationID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `electronic_application`
--

INSERT INTO `electronic_application` (`electronicApplicationID`, `type`, `reason`, `dayCount`, `startDate`, `endDate`, `startTime`, `endTime`, `approval`, `studentRegNumber`, `staffCode`) VALUES
(1, 'Personal Leave', 'Sick', 1, '2023-04-03', '2023-04-03', NULL, NULL, 'Yes', NULL, 'LIWL'),
(2, 'Personal Leave', 'Sick', 1, '2023-04-04', '2023-04-04', NULL, NULL, 'Yes', NULL, 'CHANKL');

-- --------------------------------------------------------

--
-- Table structure for table `electronic_notice`
--

DROP TABLE IF EXISTS `electronic_notice`;
CREATE TABLE IF NOT EXISTS `electronic_notice` (
  `eNoticeID` int NOT NULL AUTO_INCREMENT,
  `issueDate` date NOT NULL,
  `eNoticeNumber` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `eNoticeType` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `issuePerson` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targetClass` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targerPerson` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signedNumber` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`eNoticeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `electronic_notice`
--

INSERT INTO `electronic_notice` (`eNoticeID`, `issueDate`, `eNoticeNumber`, `eNoticeType`, `title`, `issuePerson`, `targetClass`, `targerPerson`, `signedNumber`) VALUES
(1, '2023-04-03', 'A01', 'Payment', 'School Picnic Details', 'YEUNGTL', 'ALL', NULL, NULL),
(2, '2023-04-04', 'A02', 'Normal', 'P.1-6 Test Details', 'CHOWTL', 'ALL', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE IF NOT EXISTS `exercise` (
  `exerciseID` int NOT NULL AUTO_INCREMENT,
  `grade` int NOT NULL,
  `class` varchar(50) NOT NULL,
  `subjectCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` int DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `upload_date` timestamp NULL DEFAULT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`exerciseID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`exerciseID`, `grade`, `class`, `subjectCode`, `file_name`, `file_size`, `file_type`, `file_path`, `deadline`, `upload_date`, `staffCode`) VALUES
(12, 2, 'C', 'History', 'Doc1.docx', 48086, 'application/vnd.openxmlformats-officedocument.word', 'uploads/2/C/History/Doc1.docx', '2023-04-27', '2023-04-24 02:11:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `extra_curricular_activities`
--

DROP TABLE IF EXISTS `extra_curricular_activities`;
CREATE TABLE IF NOT EXISTS `extra_curricular_activities` (
  `ecaID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ecaID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_curricular_activities`
--

INSERT INTO `extra_curricular_activities` (`ecaID`, `name`, `Date`, `startTime`, `endTime`, `staffCode`) VALUES
(1, 'Table Tennis Training Course', '17/4、24/4、8/5、15/5、22/5、29/5', '15:00:00', '17:00:00', 'CHOWTL'),
(2, 'Badminton Training Course', '17/4、24/4、8/5、15/5、22/5、29/5', '15:00:00', '17:00:00', 'HOTC'),
(3, 'Basketball Training Course', '17/4、24/4、8/5、15/5、22/5、29/5', '15:00:00', '17:00:00', 'YEUNGTL'),
(4, 'Football Training Course', '17/4、24/4、8/5、15/5、22/5、29/5', '15:00:00', '17:00:00', 'LIWL'),
(5, 'Athletics Training Course', '17/4、24/4、8/5、15/5、22/5、29/5', '15:00:00', '17:00:00', 'LIWL');

-- --------------------------------------------------------

--
-- Table structure for table `extra_curricular_activities_enrollment`
--

DROP TABLE IF EXISTS `extra_curricular_activities_enrollment`;
CREATE TABLE IF NOT EXISTS `extra_curricular_activities_enrollment` (
  `ecaEnrolmentID` int NOT NULL AUTO_INCREMENT,
  `firstChoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondChoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thirdChoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `studentRegNumber` int NOT NULL,
  PRIMARY KEY (`ecaEnrolmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_curricular_activities_enrollment`
--

INSERT INTO `extra_curricular_activities_enrollment` (`ecaEnrolmentID`, `firstChoice`, `secondChoice`, `thirdChoice`, `studentRegNumber`) VALUES
(1, 'Table Tennis Training Course', 'Badminton Training Course', 'Basketball Training Course', 201800001),
(2, 'Basketball Training Course', 'Football Training Course', 'Athletics Training Course', 201800002),
(3, 'Athletics Training Course', NULL, NULL, 201800003);

-- --------------------------------------------------------

--
-- Table structure for table `extra_curricular_activities_record`
--

DROP TABLE IF EXISTS `extra_curricular_activities_record`;
CREATE TABLE IF NOT EXISTS `extra_curricular_activities_record` (
  `ecaRecordID` int NOT NULL AUTO_INCREMENT,
  `name1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name3` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `studentRegNumber` int NOT NULL,
  PRIMARY KEY (`ecaRecordID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_curricular_activities_record`
--

INSERT INTO `extra_curricular_activities_record` (`ecaRecordID`, `name1`, `name2`, `name3`, `studentRegNumber`) VALUES
(1, 'Table Tennis Training Course', 'Badminton Training Course', 'Basketball Training Course', 201800001),
(2, 'Basketball Training Course', 'Football Training Course', 'Athletics Training Course', 201800002),
(3, 'Athletics Training Course', NULL, NULL, 201800003);

-- --------------------------------------------------------

--
-- Table structure for table `e_classroom`
--

DROP TABLE IF EXISTS `e_classroom`;
CREATE TABLE IF NOT EXISTS `e_classroom` (
  `eclassroomID` int NOT NULL AUTO_INCREMENT,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targetClass` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targetPerson` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`eclassroomID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `e_classroom`
--

INSERT INTO `e_classroom` (`eclassroomID`, `startTime`, `endTime`, `title`, `link`, `staffCode`, `targetClass`, `targetPerson`) VALUES
(1, '2023-04-03', '2023-04-07', 'Upload a video for your speech competition practice.', NULL, 'CHOWTL', '4A', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

DROP TABLE IF EXISTS `homework`;
CREATE TABLE IF NOT EXISTS `homework` (
  `homeworkID` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `className` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subjectCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photoUploadLink` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`homeworkID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`homeworkID`, `date`, `className`, `details`, `subjectCode`, `photoUploadLink`) VALUES
(1, '2023-03-31', '1A', NULL, NULL, 'https://ibb.co/BGkZWct'),
(2, '2023-03-31', '1B', NULL, NULL, 'https://ibb.co/nnvsk72');

-- --------------------------------------------------------

--
-- Table structure for table `imail`
--

DROP TABLE IF EXISTS `imail`;
CREATE TABLE IF NOT EXISTS `imail` (
  `iMailID` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targetClass` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targetPerson` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`iMailID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `imail`
--

INSERT INTO `imail` (`iMailID`, `subject`, `date`, `staffCode`, `targetClass`, `targetPerson`) VALUES
(1, 'Test Warm Notice', '2023-04-03', 'CHANTM', '1A', '200800001');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `languageID` int NOT NULL AUTO_INCREMENT,
  `languageName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`languageID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`languageID`, `languageName`) VALUES
(1, 'Chinese'),
(2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `loginID` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `loginName` varchar(50) NOT NULL,
  `loginEmail` varchar(500) NOT NULL,
  `loginPassword` varchar(50) NOT NULL,
  `securityQ` varchar(200) NOT NULL,
  `securityAns` varchar(100) NOT NULL,
  `state` varchar(50) DEFAULT 'Active',
  PRIMARY KEY (`loginID`),
  UNIQUE KEY `unique_loginName` (`loginName`)
) ENGINE=MyISAM AUTO_INCREMENT=20230004 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginID`, `type`, `loginName`, `loginEmail`, `loginPassword`, `securityQ`, `securityAns`, `state`) VALUES
(20220001, 'A', 'operator1', 'operator1@sms.edu.hk', '161ebd7d45089b3446ee4e0d86dbcf92', '2', '4b583376b2767b923c3e1da60d10de59', 'Active'),
(20220002, 'S', 'student1', '200341319@stu.vtc.edu.hk', '161ebd7d45089b3446ee4e0d86dbcf92', '2', '9ab1c5afa4946ca0040271736f38c83a', 'Active'),
(20220003, 'A', 'operator2', 'oper@sms.com', '161ebd7d45089b3446ee4e0d86dbcf92', '2', '4b583376b2767b923c3e1da60d10de59', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `loginlog`
--

DROP TABLE IF EXISTS `loginlog`;
CREATE TABLE IF NOT EXISTS `loginlog` (
  `loginlogID` int NOT NULL AUTO_INCREMENT,
  `loginID` int DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `loginName` varchar(50) NOT NULL,
  `state` varchar(10) NOT NULL,
  `loginDateTime` datetime NOT NULL,
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`loginlogID`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginlog`
--

INSERT INTO `loginlog` (`loginlogID`, `loginID`, `type`, `loginName`, `state`, `loginDateTime`, `remark`) VALUES
(1, 20230001, 'A', 'operator1', 'success', '2023-04-23 19:17:56', ''),
(2, 20230001, 'A', 'operator1', 'fail', '2023-04-23 19:18:11', 'wrong password'),
(3, 20230001, 'A', 'operator1', 'success', '2023-04-23 19:36:02', ''),
(4, 20230001, 'A', 'operator1', 'fail', '2023-04-23 19:36:08', 'wrong password'),
(5, 20230001, 'A', 'operator1', 'fail', '2023-04-23 19:36:12', 'wrong password'),
(6, 20230001, 'A', 'operator1', 'success', '2023-04-23 19:54:37', ''),
(7, 20230001, 'A', 'operator1', 'success', '2023-04-23 21:38:39', ''),
(8, 20230001, 'A', 'operator1', 'success', '2023-04-23 21:39:54', ''),
(9, 20230001, 'A', 'operator1', 'success', '2023-04-23 21:43:24', ''),
(10, 20230001, 'A', 'operator1', 'success', '2023-04-23 21:44:20', ''),
(11, 20230001, 'A', 'operator1', 'fail', '2023-04-23 21:48:10', 'wrong password'),
(12, 20230001, 'A', 'operator1', 'fail', '2023-04-23 21:48:14', 'wrong password'),
(13, 20230001, 'A', 'operator1', 'fail', '2023-04-23 21:48:27', 'wrong password'),
(14, 20230001, 'A', 'operator1', 'fail', '2023-04-23 21:48:39', 'wrong password'),
(15, 20230001, 'A', 'operator1', 'fail', '2023-04-23 21:48:46', 'wrong password'),
(16, 20230001, 'A', 'operator1', 'fail', '2023-04-23 21:48:46', 'fail 5 times account lock'),
(17, 20230001, 'A', 'operator1', 'success', '2023-04-24 16:58:32', ''),
(18, 20230001, 'A', 'operator1', 'success', '2023-04-24 17:05:32', ''),
(19, 20230001, 'A', 'operator1', 'fail', '2023-04-24 17:32:23', 'wrong password'),
(20, 20230001, 'A', 'operator1', 'fail', '2023-04-24 17:32:30', 'wrong password'),
(21, 20230001, 'A', 'operator1', 'fail', '2023-04-24 17:32:37', 'wrong password'),
(22, 20230001, 'A', 'operator1', 'success', '2023-04-24 17:32:43', ''),
(23, 20230001, 'A', 'operator1', 'fail', '2023-04-24 17:35:03', 'wrong password'),
(24, 20230001, 'A', 'operator1', 'fail', '2023-04-24 17:35:08', 'wrong password'),
(25, 20230001, 'A', 'operator1', 'fail', '2023-04-24 17:35:08', 'fail 5 times account lock'),
(26, 20230001, 'A', 'operator1', 'success', '2023-04-24 17:35:54', ''),
(27, 20230001, 'A', 'operator1', 'success', '2023-04-24 17:41:45', ''),
(28, 20230001, 'A', 'operator1', 'fail', '2023-04-24 17:47:27', 'wrong password'),
(29, 20230001, 'A', 'operator1', 'fail', '2023-04-24 17:47:27', 'fail 5 times account lock'),
(30, 20230001, 'A', 'operator1', 'success', '2023-04-24 17:50:53', ''),
(31, 20230001, 'A', 'operator1', 'success', '2023-04-24 18:05:46', ''),
(32, 20230002, 'S', 'student1', 'success', '2023-04-28 17:19:29', ''),
(33, 20230001, 'A', 'operator1', 'success', '2023-04-28 17:19:58', ''),
(34, 20230001, 'A', 'operator1', 'success', '2023-04-28 17:23:19', ''),
(35, 20230001, 'A', 'operator1', 'fail', '2023-04-28 18:05:05', 'wrong password'),
(36, 20230001, 'A', 'operator1', 'fail', '2023-04-28 18:05:09', 'wrong password'),
(37, 20230001, 'A', 'operator1', 'success', '2023-04-28 18:05:15', ''),
(38, 20230001, 'A', 'operator1', 'success', '2023-05-02 17:37:53', ''),
(39, 20230001, 'A', 'operator1', 'success', '2023-05-08 11:15:17', ''),
(40, 20230001, 'A', 'operator1', 'fail', '2023-05-08 11:47:11', 'wrong password'),
(41, 20230001, 'A', 'operator1', 'fail', '2023-05-08 11:47:16', 'wrong password'),
(42, 20230001, 'A', 'operator1', 'success', '2023-05-08 11:47:22', ''),
(43, 20230002, 'S', 'student1', 'fail', '2023-05-08 11:56:22', 'wrong password'),
(44, 20230002, 'S', 'student1', 'success', '2023-05-08 11:56:31', ''),
(45, 20230001, 'A', 'operator1', 'success', '2023-05-08 11:56:38', ''),
(46, 20230001, 'A', 'operator1', 'fail', '2023-05-08 12:09:29', 'wrong password'),
(47, 20230001, 'A', 'operator1', 'success', '2023-05-08 12:09:37', ''),
(48, 20230001, 'A', 'operator1', 'success', '2023-05-08 12:20:53', ''),
(49, 20230002, 'S', 'student1', 'fail', '2023-05-08 12:34:21', 'wrong password'),
(50, 20230002, 'S', 'student1', 'success', '2023-05-08 12:34:29', ''),
(51, 20230001, 'A', 'operator1', 'success', '2023-05-08 12:38:37', ''),
(52, 20230001, 'A', 'operator1', 'success', '2023-05-15 17:03:14', ''),
(53, 20230001, 'A', 'operator1', 'success', '2023-05-15 18:05:08', ''),
(54, 20230001, 'A', 'operator1', 'success', '2023-05-16 10:40:09', ''),
(55, 20230001, 'A', 'operator1', 'success', '2023-05-16 11:10:01', ''),
(56, 20230001, 'A', 'operator1', 'success', '2023-05-16 11:54:40', ''),
(57, 20230001, 'A', 'operator1', 'success', '2023-05-16 12:41:52', ''),
(58, 20230001, 'A', 'operator1', 'success', '2023-05-16 18:06:26', ''),
(59, 20230001, 'A', 'operator1', 'success', '2023-05-17 10:30:59', ''),
(60, 20230003, 'A', 'operator2', 'fail', '2023-05-17 10:43:26', 'wrong password'),
(61, 20230003, 'A', 'operator2', 'success', '2023-05-17 10:43:30', ''),
(62, 20230001, 'A', 'operator1', 'success', '2023-05-17 17:12:34', ''),
(63, 20230001, 'A', 'operator1', 'success', '2023-05-17 18:05:39', ''),
(64, 20230001, 'A', 'operator1', 'success', '2023-05-19 17:06:31', '');

-- --------------------------------------------------------

--
-- Table structure for table `login_type`
--

DROP TABLE IF EXISTS `login_type`;
CREATE TABLE IF NOT EXISTS `login_type` (
  `loginTypeID` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loginName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loginPassword` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`loginTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_type`
--

INSERT INTO `login_type` (`loginTypeID`, `type`, `loginName`, `loginPassword`, `staffCode`) VALUES
(7, 'Staff', 'CHOWTL', 'CHOWTL', 'CHOWTL'),
(8, 'Staff', 'HOTC', 'HOTC', 'HOTC'),
(9, 'Staff', 'YEUNGTL', 'YEUNGTL', 'YEUNGTL'),
(10, 'Staff', 'LIWL', 'LIWL', 'LIWL'),
(11, 'Administrator', 'CHANKL', 'CHANKL', 'CHANKL'),
(12, 'Staff', 'LEEWT', 'LEEWT', 'LEEWT'),
(13, 'Staff', 'WONGPH', 'WONGPH', 'WONGPH'),
(14, 'Staff', 'CHANCH', 'CHANCH', 'CHANCH'),
(15, 'Student', '201800001', '201800001', '201800001'),
(16, 'Parent', 'parent001', 'parent001', 'parent001');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `album_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

DROP TABLE IF EXISTS `parents`;
CREATE TABLE IF NOT EXISTS `parents` (
  `parentID` int NOT NULL AUTO_INCREMENT,
  `parentRegCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentEngName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parentChiName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parentSex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentDateOfBirth` date DEFAULT NULL,
  `parentAddress` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationWithStudent` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentRegNumber` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`parentID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parentID`, `parentRegCode`, `parentEngName`, `parentChiName`, `parentSex`, `parentDateOfBirth`, `parentAddress`, `relationWithStudent`, `studentRegNumber`) VALUES
(1, 'p201800001', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201800002'),
(2, 'p201800002', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201800002'),
(3, 'p201800003', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201800003'),
(4, 'p201800004', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201800004'),
(5, 'p201800005', NULL, NULL, 'Male', NULL, 'Hong Kong', 'Father', 's201800005'),
(6, 'p201800006', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201800006'),
(7, 'p201800007', NULL, NULL, 'Male', NULL, 'Hong Kong', 'Father', 's201800007'),
(8, 'p201800008', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201800008'),
(9, 'p201900001', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201900001'),
(10, 'p201900002', NULL, NULL, 'Male', NULL, 'Hong Kong', 'Father', 's201900002'),
(11, 'p201900003', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201900003'),
(12, 'p201900004', NULL, NULL, 'Male', NULL, 'Hong Kong', 'Father', 's201900004'),
(13, 'p201900005', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201900005'),
(14, 'p201900006', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201900006'),
(15, 'p201900007', NULL, NULL, 'Male', NULL, 'Hong Kong', 'Father', 's201900007'),
(16, 'p201900008', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's201900008'),
(17, 'p202000001', NULL, NULL, 'Male', NULL, 'Hong Kong', 'Father', 's202000001'),
(18, 'p202000002', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's202000002'),
(19, 'p202000003', NULL, NULL, 'Male', NULL, 'Hong Kong', 'Father', 's202000003'),
(20, 'p202000004', NULL, NULL, 'Male', NULL, 'Hong Kong', 'Father', 's202000004'),
(21, 'p202000005', NULL, NULL, 'Male', NULL, 'Hong Kong', 'Father', 's202000005'),
(22, 'p202000006', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's202000006'),
(23, 'p202000007', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's202000007'),
(24, 'p202000008', NULL, NULL, 'Female', NULL, 'Hong Kong', 'Mother', 's202000008'),
(25, 'p20230001', '123', '123', 'male', '2023-05-14', '123', 'father', 's20230001');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `PaymentID` int NOT NULL AUTO_INCREMENT,
  `paymentMethod` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creditCardNumber` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiryDate` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authorizedCode` int DEFAULT NULL,
  `eNoticeNumber` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentRegNumber` int NOT NULL,
  PRIMARY KEY (`PaymentID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `paymentMethod`, `total`, `name`, `creditCardNumber`, `expiryDate`, `authorizedCode`, `eNoticeNumber`, `studentRegNumber`) VALUES
(1, 'VISA', 30, 'CHAN Tai Man', '4523696523658569', '2023/05', 668, 'A01', 201800001),
(2, 'CASH', 30, NULL, NULL, NULL, NULL, 'A01', 201800002);

-- --------------------------------------------------------

--
-- Table structure for table `photos_and_videos`
--

DROP TABLE IF EXISTS `photos_and_videos`;
CREATE TABLE IF NOT EXISTS `photos_and_videos` (
  `pAvID` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `WebsitePictureLInk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`pAvID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos_and_videos`
--

INSERT INTO `photos_and_videos` (`pAvID`, `date`, `name`, `WebsitePictureLInk`) VALUES
(1, '2022-11-11', 'School Picnic Day', 'https://photos.google.com/'),
(2, '2023-02-16', 'Sports Day', 'https://photos.google.com/'),
(3, '2023-03-12', 'Teachers\' Developing Day', 'https://photos.google.com/');

-- --------------------------------------------------------

--
-- Table structure for table `polling`
--

DROP TABLE IF EXISTS `polling`;
CREATE TABLE IF NOT EXISTS `polling` (
  `PollingID` int NOT NULL AUTO_INCREMENT,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL,
  `question` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstChoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondChoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thirdChoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fourthChoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targetClass` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targetPerson` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result_1` int DEFAULT '0',
  `result_2` int DEFAULT '0',
  `result_3` int DEFAULT '0',
  `result_4` int DEFAULT '0',
  PRIMARY KEY (`PollingID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polling`
--

INSERT INTO `polling` (`PollingID`, `startTime`, `endTime`, `question`, `firstChoice`, `secondChoice`, `thirdChoice`, `fourthChoice`, `targetClass`, `targetPerson`, `result_1`, `result_2`, `result_3`, `result_4`) VALUES
(1, '2023-04-03', '2023-04-07', 'Which festival day you like the most?', 'Easter', 'Mid-Autumn Festival', 'Lunar New Year ', 'Christmas', 'ALL', NULL, 0, 0, 0, 0),
(2, '2023-05-01', '2023-05-20', 'What is your favorite color?', 'Red', 'Blue', 'Green', 'Yellow', 'ALL', NULL, 99, 302, 70, 121),
(3, '2023-06-10', '2023-06-15', 'What is your favorite food?', 'Pizza', 'Sushi', 'Burger', 'Fried chicken', 'ALL', NULL, 0, 0, 0, 0),
(4, '2023-07-04', '2023-07-08', 'What is your favorite season?', 'Spring', 'Summer', 'Fall', 'Winter', 'ALL', NULL, 0, 0, 0, 0),
(5, '2023-08-20', '2023-08-25', 'What is your favorite animal?', 'Dog', 'Cat', 'Horse', 'Rabbit', 'ALL', NULL, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `qa_answers`
--

DROP TABLE IF EXISTS `qa_answers`;
CREATE TABLE IF NOT EXISTS `qa_answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `qa_answers`
--

INSERT INTO `qa_answers` (`id`, `question_id`, `answer`) VALUES
(1, 1, 'A school management system is a system used to manage data related to students, teachers, courses, and grades in a school.'),
(2, 2, 'You can use the add function in the student management module to add a new student.'),
(3, 3, 'You can use the search function in the student management module to search for student data.'),
(4, 4, 'You can use the edit function in the student management module to edit student data.'),
(5, 5, 'You can use the delete function in the student management module to delete a student.'),
(6, 6, 'You can use the add function in the teacher management module to add a new teacher.'),
(7, 7, 'You can use the search function in the teacher management module to search for teacher data.'),
(8, 8, 'You can use the edit function in the teacher management module to edit teacher data.'),
(9, 9, 'You can use the delete function in the teacher management module to delete a teacher.'),
(10, 10, 'You can use the add function in the timetable management module to schedule a timetable for classes.'),
(11, 11, 'You can use the search function in the timetable management module to search for timetable information.'),
(12, 12, 'You can use the search function in the timetable management module to search for timetable information.'),
(13, 13, 'You can use the edit function in the timetable management module to edit the timetable.'),
(14, 14, 'You can use the delete function in the timetable management module to delete a timetable entry.'),
(15, 15, 'You can use the add function in the grades management module to record student grades.'),
(16, 16, 'You can use the search function in the grades management module to search for student grades.'),
(17, 17, 'You can use the edit function in the grades management module to edit student grades.'),
(18, 18, 'You can use the delete function in the grades management module to delete student grades.'),
(19, 19, 'You can use the generate function in the report card generation module to generate report cards.'),
(20, 20, 'You can use the search function in the report card generation module to search for report cards.');

-- --------------------------------------------------------

--
-- Table structure for table `qa_questions`
--

DROP TABLE IF EXISTS `qa_questions`;
CREATE TABLE IF NOT EXISTS `qa_questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `qa_questions`
--

INSERT INTO `qa_questions` (`id`, `question`) VALUES
(1, 'What is a school management system?'),
(2, 'How to add a new student?'),
(3, 'How to search for student data?'),
(4, 'How to edit student data?'),
(5, 'How to delete a student?'),
(6, 'How to add a new teacher?'),
(7, 'How to search for teacher data?'),
(8, 'How to edit teacher data?'),
(9, 'How to delete a teacher?'),
(10, 'How to schedule a timetable for classes?'),
(11, 'How to search for timetable information?'),
(12, 'How to edit the timetable?'),
(13, 'How to delete a timetable entry?'),
(14, 'How to record student grades?'),
(15, 'How to search for student grades?'),
(16, 'How to edit student grades?'),
(17, 'How to delete student grades?'),
(18, 'How to generate report cards?'),
(19, 'How to search for report cards?'),
(20, 'How to print report cards?');

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

DROP TABLE IF EXISTS `questionnaire`;
CREATE TABLE IF NOT EXISTS `questionnaire` (
  `questionnaireID` int NOT NULL AUTO_INCREMENT,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targetClass` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `targetPerson` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formLink` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`questionnaireID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`questionnaireID`, `startTime`, `endTime`, `title`, `targetClass`, `targetPerson`, `formLink`) VALUES
(1, '2023-04-03', '2023-04-07', 'Opinion of the School Pinic Day', 'ALL', NULL, 'https://docs.google.com/forms/u/0/'),
(2, '2023-04-03', '2023-04-07', 'Opinion of the Sports Day', 'ALL', NULL, 'https://docs.google.com/forms/u/0/');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `schoolID` int NOT NULL AUTO_INCREMENT,
  `schoolCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schoolName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `establishedYear` int NOT NULL,
  `schoolAddress` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`schoolID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`schoolID`, `schoolCode`, `schoolName`, `establishedYear`, `schoolAddress`) VALUES
(1, '136200', 'Happy Primary School', 1980, 'Hong Kong');

-- --------------------------------------------------------

--
-- Table structure for table `school_calendar`
--

DROP TABLE IF EXISTS `school_calendar`;
CREATE TABLE IF NOT EXISTS `school_calendar` (
  `schoolCalendarID` int NOT NULL AUTO_INCREMENT,
  `month` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `holidayName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`schoolCalendarID`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_calendar`
--

INSERT INTO `school_calendar` (`schoolCalendarID`, `month`, `day`, `status`, `holidayName`, `eventName`) VALUES
(1, 'Sep', '1', 'Event', 'Beginning of School Year (1)', ''),
(2, 'Sep', '9', 'Event', 'Respect the Teachers Day', ''),
(3, 'Sep', '12', 'Holiday', 'The Day following Mid-Autumn Festival', ''),
(4, 'Sep', '23', 'Event', 'Swimming Gala', ''),
(5, 'Sep', '27', 'Event', 'Staff Meeting (2)', ''),
(6, 'Sep', '28-30', 'Event', 'S1 Student Development Camp (3 days)', ''),
(7, 'Oct', '1', 'Holiday', 'National Day', ''),
(8, 'Oct', '4', 'Holiday', 'Chung Yeung Festival', ''),
(9, 'Oct', '7', 'Event', 'Hall Assembly (2)', ''),
(10, 'Oct', '10', 'Event', 'Sports Day (Heat)', ''),
(11, 'Oct', '11', 'Holiday', 'Discretioary Holiday (1)', ''),
(12, 'Oct', '13', 'Event', 'PTA AGM', ''),
(13, 'Oct', '14', 'Event', 'Sports Day (Final)', ''),
(14, 'Oct', '21', 'Event', 'S3 Parents Day', ''),
(15, 'Oct', '31-3/11', 'Event', '1st Uniform Test (4 days)', ''),
(16, 'Nov', '2', 'Event', NULL, 'Staff Meeting (3)'),
(17, 'Nov', '3', 'Event', NULL, 'SMC Meeting (1) (Tentative)'),
(18, 'Nov', '4', 'Event', NULL, 'Outdoor Learning Day'),
(19, 'Nov', '11', 'Holiday', 'Remembrance Day', NULL),
(20, 'Nov', '20', 'Event', NULL, 'Careers Expo'),
(21, 'Nov', '21', 'Event', NULL, 'Open Day cum S1 Information Day'),
(22, 'Nov', '25', 'Event', NULL, 'Parents\' Education Workshop (1)'),
(23, 'Dec', '24', 'Holiday', 'Christmas Day', NULL),
(24, 'Dec', '25', 'Holiday', 'Boxing Day', NULL),
(25, 'Dec', '31', 'Holiday', 'New Year\'s Eve', NULL),
(26, 'Jan', '1', 'Holiday', 'New Year\'s Day', NULL),
(27, 'Jan', '6', 'Event', NULL, 'S2 Student Development Camp (3 days)'),
(28, 'Dec', '2', 'Event', 'Speech Day', ''),
(29, 'Dec', '4', 'Holiday', 'Constitution Day', ''),
(30, 'Dec', '5', 'Event', 'Hall Assembly (3)', ''),
(31, 'Dec', '6', 'Event', 'School Photo', ''),
(32, 'Dec', '8', 'Event', 'Staff Development Day (1)', ''),
(33, 'Dec', '10', 'Event', 'Tea Tea Talk Talk (1)', ''),
(34, 'Dec', '16', 'Event', 'Parents Education Workshop (2)', ''),
(35, 'Dec', '22', 'Event', 'Christmas Party / Dress Casual Day', ''),
(36, 'Dec', '23-01/2', 'Holiday', 'Christmas & New Year Holidays', ''),
(37, 'Jan', '4-18', 'Holiday', 'Half-yearly Examination', ''),
(38, 'Jan', '6', 'Event', 'Staff Meeting', ''),
(39, 'Jan', '13', 'Event', 'S4 Parents\' Day', ''),
(40, 'Jan', '16-18', 'Holiday', 'Study Leave for S6', ''),
(41, 'Jan', '17', 'Event', 'Joint GSS Staff Development Day', ''),
(42, 'Jan', '19', 'Event', 'Post-examination Activities', ''),
(43, 'Jan', '19-Feb 10', 'Holiday', 'Mock Examination', ''),
(44, 'Jan', '20-29', 'Holiday', 'Lunar New Year', ''),
(45, 'Jan', '30', 'Event', 'Second Term Begins', ''),
(46, 'Feb', '3', 'Event', 'Singing Contest', ''),
(47, 'Feb', '13-17', 'Holiday', '', ''),
(48, 'Feb', '15', 'Event', 'Hall Assembly (4)', ''),
(49, 'Feb', '17', 'Event', 'S6 Last School Day', ''),
(50, 'Feb', '19', 'Event', 'Parents\' Day', ''),
(51, 'Feb', '20', 'Holiday', '', 'Discretionary Holiday (3)'),
(52, 'Feb', '25', 'Event', 'S1 DP Interview', ''),
(53, 'Mar', '10-14', 'Holiday', '', 'Second Term Break'),
(54, 'Mar', '2', 'Event', 'Staff Meeting (5)', ''),
(55, 'Mar', '3', 'Event', 'S3 Parents\' Day', ''),
(56, 'Mar', '6-10', 'Event', 'Academic Festival', ''),
(57, 'Mar', '24', 'Event', 'S5 Parents\' Day', ''),
(58, 'Mar', '31-11/4', 'Holiday', 'Ching Ming Festival & Easter', ''),
(59, 'Apr', '13-18', 'Event', '2nd Uniform Test (4 days)', ''),
(60, 'Apr', '14', 'Event', 'SMC Meeting (2) (Tentative)', ''),
(61, 'Apr', '25-26', 'Event', 'S3 TSA Oral Examinations', ''),
(62, 'Apr', '26', 'Event', 'House Meeting', ''),
(63, 'May', '1', 'Holiday', '', 'Labour Day'),
(64, 'May', '2', 'Holiday', '', 'Hall Assembly (5)'),
(65, 'May', '4', 'Event', 'Staff Meeting (6)', ''),
(66, 'May', '5', 'Event', 'SU Election Day', ''),
(67, 'May', '5', 'Event', 'Parents Education Workshop (3)', ''),
(68, 'May', '13', 'Event', 'Tea Tea Talk Talk (2)', ''),
(69, 'May', '19', 'Event', 'Parents Education Workshop (4)', ''),
(70, 'May', '26', 'Holiday', '', 'The Birthday of Buddha'),
(71, 'Jun', '9', 'Event', 'Staff Meeting (7)', ''),
(72, 'Jun', '12', 'Event', 'Study Leave for S1-5 (1 day)', ''),
(73, 'Jun', '13-28', 'Event', 'Yearly Examination (11 days)', ''),
(74, 'Jun', '20-21', 'Holiday', '', 'S3 TSA Test (2 days)'),
(75, 'Jun', '22', 'Event', 'Tuen Ng Festival', ''),
(76, 'Jun', '23', 'Event', 'SMC Meeting (3) (Tentative)', ''),
(77, 'Jun', '29-3', 'Event', 'Discussion of Exam Papers (3 days)', ''),
(78, 'Jul', '1', 'Holiday', 'HKSAR Establishment Day Holiday', ''),
(79, 'Jul', '4-11', 'Event', 'Post-examination Activities (6 days)', ''),
(80, 'Jul', '11', 'Event', 'Release of SSPA Result', ''),
(81, 'Jul', '12', 'Event', 'Last School Day / Hall Assembly (6)', ''),
(82, 'Jul', '13-14', 'Event', 'Registration of S1 students', ''),
(83, 'Jul-Aug', '13-31', 'Holiday', '', 'Summer Vacation (50 days)'),
(84, 'Jul', '17', 'Event', 'S6 Parents\' Day', ''),
(85, 'Jul', '18', 'Event', 'Pre-S1 Test', ''),
(86, 'Jul', '19', 'Event', 'Release of HKDSE Result', '');

-- --------------------------------------------------------

--
-- Table structure for table `school_details`
--

DROP TABLE IF EXISTS `school_details`;
CREATE TABLE IF NOT EXISTS `school_details` (
  `schoolDetailID` int NOT NULL AUTO_INCREMENT,
  `schoolName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `establishedYear` int NOT NULL,
  `schoolAddress` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schoolDistrict` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schoolID` int NOT NULL,
  PRIMARY KEY (`schoolDetailID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_details`
--

INSERT INTO `school_details` (`schoolDetailID`, `schoolName`, `establishedYear`, `schoolAddress`, `schoolDistrict`, `schoolID`) VALUES
(1, 'Happy School', 1990, '2A, Happy Road, North Point, Hong Kong', 'Hong Kong Island', 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_facilities`
--

DROP TABLE IF EXISTS `school_facilities`;
CREATE TABLE IF NOT EXISTS `school_facilities` (
  `schoolFacilitiesID` int NOT NULL AUTO_INCREMENT,
  `schoolFacilitiesCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schoolFacilitiesName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`schoolFacilitiesID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_facilities`
--

INSERT INTO `school_facilities` (`schoolFacilitiesID`, `schoolFacilitiesCode`, `schoolFacilitiesName`) VALUES
(1, '101', '1A Classroom'),
(2, '102', '1B Classroom'),
(3, '103', '1C Classroom'),
(4, '104', '1D Classroom'),
(5, '201', '2A Classroom'),
(6, '202', '2B Classroom'),
(7, '203', '2C Classroom'),
(8, '204', '2D Classroom'),
(9, '301', '3A Classroom'),
(10, '302', '3B Classroom'),
(11, '303', '3C Classroom'),
(12, '304', '3D Classroom'),
(13, '401', '4A Classroom'),
(14, '402', '4B Classroom'),
(15, '403', '4C Classroom'),
(16, '404', '4D Classroom'),
(17, '501', '5A Classroom'),
(18, '502', '5B Classroom'),
(19, '503', '5C Classroom'),
(20, '504', '5D Classroom'),
(21, '601', '6A Classroom'),
(22, '602', '6B Classroom'),
(23, '603', '6C Classroom'),
(24, '604', '6D Classroom');

-- --------------------------------------------------------

--
-- Table structure for table `securityquestion`
--

DROP TABLE IF EXISTS `securityquestion`;
CREATE TABLE IF NOT EXISTS `securityquestion` (
  `questionID` int NOT NULL AUTO_INCREMENT,
  `question` varchar(100) NOT NULL,
  PRIMARY KEY (`questionID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `securityquestion`
--

INSERT INTO `securityquestion` (`questionID`, `question`) VALUES
(1, 'What is your mother\'s maiden name?'),
(2, 'Where were you born?'),
(3, 'What was the name of your first pet?'),
(4, 'What was the name of your elementary school?'),
(5, 'What is your favorite food?');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staffID` int NOT NULL AUTO_INCREMENT,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffEngName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffChiName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffSex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffJobTitle` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffDateOfBirth` date NOT NULL,
  `staffDateOfEmployment` date NOT NULL,
  `staffPlaceOfBirth` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffAddress` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffPhoneNumber` int NOT NULL,
  PRIMARY KEY (`staffID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffCode`, `staffEngName`, `staffChiName`, `staffSex`, `staffJobTitle`, `staffDateOfBirth`, `staffDateOfEmployment`, `staffPlaceOfBirth`, `staffAddress`, `staffPhoneNumber`) VALUES
(1, 'CHOWTL', 'CHOW Tsz Long', '周子朗', 'Male', 'Teacher', '1991-06-07', '2020-09-01', 'Hong Kong', 'Hong Kong', 65125236),
(2, 'HOTC', 'HO Tsz Ching', '何芷晴', 'Female', 'Teacher', '1995-08-09', '2022-09-01', 'Hong Kong', 'Hong Kong', 66336347),
(3, 'YEUNGTL', 'YEUNG Tin Long', '楊天朗', 'Male', 'Teacher', '1985-04-08', '2008-09-01', 'Hong Kong', 'Hong Kong', 56985692),
(4, 'LIWL', 'LI Wing Lam', '李詠琳', 'Female', 'Teacher', '1988-06-12', '2009-09-01', 'Hong Kong', 'Hong Kong', 58556369),
(5, 'CHANKL', 'CHAN Ka Lok', '陳家樂', 'Male', 'Clerk', '1996-02-28', '2021-09-01', 'Hong Kong', 'Hong Kong', 95678596),
(6, 'LEEWT', 'LEE Wing Tung', '李穎彤', 'Female', 'Clerk', '1990-06-22', '2019-09-01', 'Hong Kong', 'Hong Kong', 69563698),
(7, 'WONGPH', 'WONG Pak Hei', '黃柏晞', 'Male', 'IT Coordinator', '1994-05-22', '2018-09-01', 'Hong Kong', 'Hong Kong', 98563695),
(8, 'CHANCH', 'CHAN Chun Hei', '陳俊熙', 'Male', 'IT Assistant', '1991-07-10', '2018-09-01', 'Hong Kong', 'Hong Kong', 91203563);

-- --------------------------------------------------------

--
-- Table structure for table `staff_advanced_study_record`
--

DROP TABLE IF EXISTS `staff_advanced_study_record`;
CREATE TABLE IF NOT EXISTS `staff_advanced_study_record` (
  `staffAdvancedStudyRecordID` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `duration` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`staffAdvancedStudyRecordID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_advanced_study_record`
--

INSERT INTO `staff_advanced_study_record` (`staffAdvancedStudyRecordID`, `date`, `startTime`, `endTime`, `duration`, `topic`, `staffCode`) VALUES
(1, '2023-04-01', '10:00:00', '12:30:00', '2 hours 30 mins', 'EDB Meeting ', 'CHOWTL'),
(2, '2023-04-01', '10:00:00', '12:30:00', '2 hours 30 mins', 'EDB Meeting ', 'HOTC'),
(3, '2023-04-01', '10:00:00', '12:30:00', '2 hours 30 mins', 'EDB Meeting ', 'YEUNGTL'),
(4, '2023-04-01', '10:00:00', '12:30:00', '2 hours 30 mins', 'EDB Meeting ', 'LIWL'),
(5, '2023-04-08', '09:00:00', '11:00:00', '2 hours', 'STEM Training ', 'CHOWTL'),
(6, '2023-04-08', '09:00:00', '11:00:00', '2 hours', 'STEM Training ', 'HOTC'),
(7, '2023-04-08', '09:00:00', '11:00:00', '2 hours', 'STEM Training ', 'YEUNGTL'),
(8, '2023-04-08', '09:00:00', '11:00:00', '2 hours', 'STEM Training ', 'LIWL');

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendence_record_daily`
--

DROP TABLE IF EXISTS `staff_attendence_record_daily`;
CREATE TABLE IF NOT EXISTS `staff_attendence_record_daily` (
  `staffAttendenceRecordDailyID` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `attendTime` time DEFAULT NULL,
  `timeslot` time NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`staffAttendenceRecordDailyID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_attendence_record_daily`
--

INSERT INTO `staff_attendence_record_daily` (`staffAttendenceRecordDailyID`, `date`, `attendTime`, `timeslot`, `status`, `reason`, `staffCode`) VALUES
(1, '2023-04-03', '07:28:55', '07:30:00', 'Present', NULL, 'CHOWTL'),
(2, '2023-04-03', '07:25:54', '07:30:00', 'Present', NULL, 'HOTC'),
(3, '2023-04-03', '07:16:02', '07:30:00', 'Present', NULL, 'YEUNGTL'),
(4, '2023-04-03', NULL, '07:30:00', 'Absent', 'Sick', 'LIWL'),
(5, '2023-04-03', '07:59:40', '08:00:00', 'Present', NULL, 'CHANKL'),
(6, '2023-04-03', '08:31:15', '08:30:00', 'Late', 'Traffic Jam', 'LEEWT'),
(7, '2023-04-03', '08:15:05', '08:30:00', 'Present', NULL, 'WONGPH'),
(8, '2023-04-03', '08:25:26', '08:30:00', 'Present', NULL, 'CHANCH');

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendence_record_monthly`
--

DROP TABLE IF EXISTS `staff_attendence_record_monthly`;
CREATE TABLE IF NOT EXISTS `staff_attendence_record_monthly` (
  `staffAttendenceRecordMonthlyID` int NOT NULL AUTO_INCREMENT,
  `month` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalTime` int NOT NULL,
  `presentTime` int DEFAULT NULL,
  `lateTime` int DEFAULT NULL,
  `earlyLeaveTime` int DEFAULT NULL,
  `absentTime` int DEFAULT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`staffAttendenceRecordMonthlyID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_attendence_record_monthly`
--

INSERT INTO `staff_attendence_record_monthly` (`staffAttendenceRecordMonthlyID`, `month`, `totalTime`, `presentTime`, `lateTime`, `earlyLeaveTime`, `absentTime`, `staffCode`) VALUES
(1, 'April', 5, 5, 0, 0, 0, 'CHOWTL'),
(2, 'April', 5, 5, 0, 0, 0, 'HOTC'),
(3, 'April', 5, 5, 0, 0, 0, 'YEUNGTL'),
(4, 'April', 5, 5, 4, 0, 1, 'LIWL'),
(5, 'April', 5, 4, 0, 0, 1, 'CHANKL'),
(6, 'April', 5, 5, 0, 0, 0, 'LEEWT'),
(7, 'April', 5, 5, 0, 0, 0, 'WONGPH'),
(8, 'April', 5, 5, 0, 0, 0, 'CHANCH');

-- --------------------------------------------------------

--
-- Table structure for table `staff_borrow_and_return_books_record`
--

DROP TABLE IF EXISTS `staff_borrow_and_return_books_record`;
CREATE TABLE IF NOT EXISTS `staff_borrow_and_return_books_record` (
  `staffBARRecordID` int NOT NULL AUTO_INCREMENT,
  `borrowDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `bookISBN` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`staffBARRecordID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_borrow_and_return_books_record`
--

INSERT INTO `staff_borrow_and_return_books_record` (`staffBARRecordID`, `borrowDate`, `returnDate`, `bookISBN`, `staffCode`) VALUES
(1, '2023-04-07', '2023-04-13', '9781406321', 'CHOWTL'),
(2, '2023-04-07', '2023-04-13', '1590259458', 'CHANCH');

-- --------------------------------------------------------

--
-- Table structure for table `staff_lost_record`
--

DROP TABLE IF EXISTS `staff_lost_record`;
CREATE TABLE IF NOT EXISTS `staff_lost_record` (
  `StaffLostRecordID` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `bookID` int NOT NULL,
  `BookDetailsID` int NOT NULL,
  PRIMARY KEY (`StaffLostRecordID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_penalty_record`
--

DROP TABLE IF EXISTS `staff_penalty_record`;
CREATE TABLE IF NOT EXISTS `staff_penalty_record` (
  `staffPenaltyRecordID` int NOT NULL AUTO_INCREMENT,
  `dueDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `reason` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `penaltyCost` int NOT NULL,
  `bookISBN` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`staffPenaltyRecordID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_penalty_record`
--

INSERT INTO `staff_penalty_record` (`staffPenaltyRecordID`, `dueDate`, `returnDate`, `reason`, `penaltyCost`, `bookISBN`, `staffCode`) VALUES
(1, '2023-04-13', '2023-04-14', 'Forgot to bring back to school', 1, '9781406321', 'CHOWTL'),
(2, '2023-04-13', '2023-04-14', 'Forgot to bring back to school', 1, '1590259458', 'CHANCH');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `studnetID` int NOT NULL AUTO_INCREMENT,
  `studentRegNumber` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentEngName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentChiName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentSex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentDateOfBirth` date NOT NULL,
  `studentPlaceOfBirth` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentAddress` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `classNumber` int NOT NULL,
  `className` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentsRegCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`studnetID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studnetID`, `studentRegNumber`, `studentEngName`, `studentChiName`, `studentSex`, `studentDateOfBirth`, `studentPlaceOfBirth`, `studentAddress`, `classNumber`, `className`, `parentsRegCode`) VALUES
(1, 's20180001', 'CHAN Yi Shun', '陳以信', 'Male', '2011-08-14', 'Hong Kong', 'Hong Kong', 6, 'A', 'p20180001'),
(2, 's20180002', 'CHEUNG Tsz Yu', '張芷如', 'Female', '2011-07-15', 'Hong Kong', 'Hong Kong', 6, 'A', 'p20180002'),
(3, 's20180003', 'CHAN Ka Chun', '陳嘉俊', 'Male', '2011-11-28', 'Hong Kong', 'Hong Kong', 6, 'B', 'p20180003'),
(4, 's20180004', 'CHEUNG Ka Yan', '張家欣', 'Female', '2011-04-11', 'Hong Kong', 'Hong Kong', 6, 'B', 'p20180004'),
(5, 's20180005', 'CHAN Lok Hang', '陳樂行', 'Male', '2011-08-08', 'Hong Kong', 'Hong Kong', 6, 'C', 'p20180005'),
(6, 's20180006', 'CHEUNG Tin Yan', '張天恩', 'Female', '2011-08-31', 'Hong Kong', 'Hong Kong', 6, 'C', 'p20180006'),
(7, 's20180007', 'CHAN Ka Ho', '陳家豪', 'Male', '2011-10-27', 'Hong Kong', 'Hong Kong', 6, 'D', 'p20180007'),
(8, 's20180008', 'CHEUNG Mei Ling', '張美玲', 'Female', '2011-06-17', 'Hong Kong', 'Hong Kong', 6, 'D', 'p20180008'),
(9, 's20190001', 'CHAN Chun Kit', '陳俊傑', 'Male', '2012-09-14', 'Hong Kong', 'Hong Kong', 5, 'A', 'p20190001'),
(10, 's20190002', 'CHEUNG Hiu Ching', '張曉晴', 'Female', '2012-06-27', 'Hong Kong', 'Hong Kong', 5, 'A', 'p20190002'),
(11, 's20190003', 'CHAN Yu Hin', '陳宇軒', 'Male', '2012-04-29', 'Hong Kong', 'Hong Kong', 5, 'B', 'p20190003'),
(12, 's20190004', 'CHEUNG Ka Yi', '張嘉儀', 'Female', '2012-06-27', 'Hong Kong', 'Hong Kong', 5, 'B', 'p20190004'),
(13, 's20190005', 'CHAN Ho Yin', '陳浩賢', 'Male', '2012-09-04', 'Hong Kong', 'Hong Kong', 5, 'C', 'p20190005'),
(14, 's20190006', 'CHEUNG Sze Nga', '張詩雅', 'Female', '2012-06-24', 'Hong Kong', 'Hong Kong', 5, 'C', 'p20190005'),
(15, 's20190007', 'CHAN Yat Long', '陳逸朗', 'Male', '2012-08-24', 'Hong Kong', 'Hong Kong', 5, 'D', 'p20190006'),
(16, 's20190008', 'CHEUNG Tsz Ying', '張芷瑩', 'Female', '2012-09-12', 'Hong Kong', 'Hong Kong', 5, 'D', 'p20190008'),
(17, 's20200001', 'CHAN Sze Hang', '陳思行', 'Male', '2013-07-06', 'Hong Kong', 'Hong Kong', 4, 'A', 'p20200001'),
(18, 's20200002', 'CHEUNG Ka Man', '張嘉敏', 'Female', '2013-08-14', 'Hong Kong', 'Hong Kong', 4, 'A', 'p20200002'),
(19, 's20200003', 'CHAN Cheuk Him', '陳卓謙', 'Male', '2013-06-30', 'Hong Kong', 'Hong Kong', 4, 'B', 'p20200003'),
(20, 's20200004', 'CHEUNG Hoi Ting', '張凱婷', 'Female', '2013-08-16', 'Hong Kong', 'Hong Kong', 4, 'B', 'p20200004'),
(21, 's20200005', 'CHAN Ka Hei', '陳家熙', 'Male', '2013-09-13', 'Hong Kong', 'Hong Kong', 4, 'C', 'p20200005'),
(22, 's20200006', 'CHEUNG Lok Yan', '張樂恩', 'Female', '2013-07-27', 'Hong Kong', 'Hong Kong', 4, 'C', 'p20200006'),
(23, 's20200007', 'CHAN Chun Hei', '陳俊希', 'Male', '2013-04-22', 'Hong Kong', 'Hong Kong', 4, 'D', 'p20200007'),
(24, 's20200008', 'CHEUNG Sum Yau', '張心柔', 'Female', '2013-02-14', 'Hong Kong', 'Hong Kong', 4, 'D', 'p20200008'),
(26, 's20230001', '123', '123', 'male', '2023-05-16', 'Hong Kong', '123', 1, 'B', 'p20230001');

-- --------------------------------------------------------

--
-- Table structure for table `student_assessment_result`
--

DROP TABLE IF EXISTS `student_assessment_result`;
CREATE TABLE IF NOT EXISTS `student_assessment_result` (
  `studentAssessmentResultID` int NOT NULL AUTO_INCREMENT,
  `Grade` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mark` double NOT NULL,
  `subjectCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectDetailsName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentRegNumber` int NOT NULL,
  `assessmentType` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`studentAssessmentResultID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_assessment_result`
--

INSERT INTO `student_assessment_result` (`studentAssessmentResultID`, `Grade`, `Mark`, `subjectCode`, `subjectDetailsName`, `studentRegNumber`, `assessmentType`) VALUES
(1, 'B', 85, 'CHI', 'Reading', 201800001, 'P.1-6 Test'),
(2, 'A', 98, 'CHI', 'Reading', 201800002, 'P.1-6 Test');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendence_record_daily`
--

DROP TABLE IF EXISTS `student_attendence_record_daily`;
CREATE TABLE IF NOT EXISTS `student_attendence_record_daily` (
  `studentAttendenceRecordDailyID` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `attendTime` time DEFAULT NULL,
  `timeslot` time NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `studentRegNumber` int NOT NULL,
  PRIMARY KEY (`studentAttendenceRecordDailyID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendence_record_daily`
--

INSERT INTO `student_attendence_record_daily` (`studentAttendenceRecordDailyID`, `date`, `attendTime`, `timeslot`, `status`, `reason`, `studentRegNumber`) VALUES
(1, '2023-04-03', '07:35:50', '07:45:00', 'Present', NULL, 201800001),
(2, '2023-04-03', '07:40:25', '07:45:00', 'Present', NULL, 201800002);

-- --------------------------------------------------------

--
-- Table structure for table `student_attendence_record_monthly`
--

DROP TABLE IF EXISTS `student_attendence_record_monthly`;
CREATE TABLE IF NOT EXISTS `student_attendence_record_monthly` (
  `studentAttendRecordMonthlyID` int NOT NULL AUTO_INCREMENT,
  `month` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalTime` int NOT NULL,
  `presentTime` int DEFAULT NULL,
  `lateTime` int DEFAULT NULL,
  `earlyLeaveTime` int DEFAULT NULL,
  `absentTime` int DEFAULT NULL,
  `studentRegNumber` int NOT NULL,
  PRIMARY KEY (`studentAttendRecordMonthlyID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendence_record_monthly`
--

INSERT INTO `student_attendence_record_monthly` (`studentAttendRecordMonthlyID`, `month`, `totalTime`, `presentTime`, `lateTime`, `earlyLeaveTime`, `absentTime`, `studentRegNumber`) VALUES
(1, 'April', 5, 5, 0, 0, 0, 201800001),
(2, 'April', 5, 5, 0, 0, 0, 201800002);

-- --------------------------------------------------------

--
-- Table structure for table `student_borrow_and_return_books_record`
--

DROP TABLE IF EXISTS `student_borrow_and_return_books_record`;
CREATE TABLE IF NOT EXISTS `student_borrow_and_return_books_record` (
  `studentsBARRecordID` int NOT NULL AUTO_INCREMENT,
  `borrowDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `bookISBN` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentRegNumber` int NOT NULL,
  PRIMARY KEY (`studentsBARRecordID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_borrow_and_return_books_record`
--

INSERT INTO `student_borrow_and_return_books_record` (`studentsBARRecordID`, `borrowDate`, `returnDate`, `bookISBN`, `studentRegNumber`) VALUES
(1, '2023-04-07', '2023-04-13', '9781406321', 201800001),
(2, '2023-04-07', '2023-04-13', '1405201355', 201800002);

-- --------------------------------------------------------

--
-- Table structure for table `student_lost_record`
--

DROP TABLE IF EXISTS `student_lost_record`;
CREATE TABLE IF NOT EXISTS `student_lost_record` (
  `studentsLostRecordID` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `bookID` int NOT NULL,
  `bookDetailsID` int NOT NULL,
  PRIMARY KEY (`studentsLostRecordID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_penalty_record`
--

DROP TABLE IF EXISTS `student_penalty_record`;
CREATE TABLE IF NOT EXISTS `student_penalty_record` (
  `studentsPenaltyRecordID` int NOT NULL AUTO_INCREMENT,
  `dueDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `reason` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penaltyCost` int NOT NULL,
  `bookISBN` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentRegNumber` int NOT NULL,
  PRIMARY KEY (`studentsPenaltyRecordID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_penalty_record`
--

INSERT INTO `student_penalty_record` (`studentsPenaltyRecordID`, `dueDate`, `returnDate`, `reason`, `penaltyCost`, `bookISBN`, `studentRegNumber`) VALUES
(1, '2023-04-13', '2023-04-14', 'Forgot to bring back to school', 1, '9781406321', 201800001),
(2, '2023-04-13', '2023-04-14', 'Forgot to bring back to school', 1, '1405201355', 201800002);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `subjectID` int NOT NULL AUTO_INCREMENT,
  `subjectCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`subjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `subjectCode`, `subjectName`) VALUES
(1, 'CHI', 'Chinese'),
(2, 'ENG', 'English'),
(3, 'MATHS', 'Mathematics'),
(4, 'GS', 'General Studies');

-- --------------------------------------------------------

--
-- Table structure for table `subject_details`
--

DROP TABLE IF EXISTS `subject_details`;
CREATE TABLE IF NOT EXISTS `subject_details` (
  `subjectDetailsID` int NOT NULL AUTO_INCREMENT,
  `subjectDetailsName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjectCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`subjectDetailsID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_details`
--

INSERT INTO `subject_details` (`subjectDetailsID`, `subjectDetailsName`, `subjectCode`) VALUES
(1, 'Reading', 'CHI'),
(2, 'Writing', 'CHI'),
(3, 'Listening', 'CHI'),
(4, 'Speaking', 'CHI'),
(5, 'Reading', 'ENG'),
(6, 'Writing', 'ENG'),
(7, 'Listening', 'ENG'),
(8, 'Speaking', 'ENG');

-- --------------------------------------------------------

--
-- Table structure for table `teaching_plan`
--

DROP TABLE IF EXISTS `teaching_plan`;
CREATE TABLE IF NOT EXISTS `teaching_plan` (
  `teachingPlanID` int NOT NULL AUTO_INCREMENT,
  `details` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploadedFile` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subjectCode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffCode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`teachingPlanID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teaching_plan`
--

INSERT INTO `teaching_plan` (`teachingPlanID`, `details`, `uploadedFile`, `subjectCode`, `staffCode`) VALUES
(1, 'P.4 Lesson1', NULL, 'CHI', 'CHOWTL'),
(2, 'P.4 Lesson 2', NULL, 'CHI', 'CHOWTL'),
(3, 'P.4 Lesson 3', NULL, 'CHI', 'CHOWTL'),
(4, 'P.4 Lesson1', NULL, 'ENG', 'HOTC'),
(5, 'P.4 Lesson 2', NULL, 'ENG', 'HOTC'),
(6, 'P.4 Lesson 3', NULL, 'ENG', 'HOTC'),
(7, 'P.4 Lesson1', NULL, 'MATHS', 'YEUNGTL'),
(8, 'P.4 Lesson 2', NULL, 'MATHS', 'YEUNGTL'),
(9, 'P.4 Lesson 3', NULL, 'MATHS', 'YEUNGTL'),
(10, 'P.4 Lesson1', NULL, 'GS', 'LIWL'),
(11, 'P.4 Lesson 2', NULL, 'GS', 'LIWL'),
(12, 'P.4 Lesson 3', NULL, 'GS', 'LIWL');

-- --------------------------------------------------------

--
-- Table structure for table `useful_websites`
--

DROP TABLE IF EXISTS `useful_websites`;
CREATE TABLE IF NOT EXISTS `useful_websites` (
  `usefulWebsitesID` int NOT NULL AUTO_INCREMENT,
  `websiteTopic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `WebsitePictureLInk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `WebsiteDirectLink` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`usefulWebsitesID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `useful_websites`
--

INSERT INTO `useful_websites` (`usefulWebsitesID`, `websiteTopic`, `WebsitePictureLInk`, `WebsiteDirectLink`) VALUES
(1, '小校園 Small Campus', 'https://ibb.co/SXT97Tm', 'http://www.smallcampus.net/entrance/'),
(2, '每日一篇 Prof-ho Reading', 'https://ibb.co/HCDvY9k', 'http://www.prof-ho.com/reading/'),
(3, '現代教育數學網 Modern Education for Mathematics', 'https://ibb.co/Kss3PGV', 'http://pmaths.moderneducation.com.hk');

-- --------------------------------------------------------

--
-- Table structure for table `user_votes`
--

DROP TABLE IF EXISTS `user_votes`;
CREATE TABLE IF NOT EXISTS `user_votes` (
  `user_id` int DEFAULT NULL,
  `polling_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
