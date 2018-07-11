-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2018 at 12:04 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `chiefcomplain`
--

CREATE TABLE `chiefcomplain` (
  `ChiefComplainId` int(11) NOT NULL,
  `ChiefComplainName` varchar(200) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `ClinicId` int(11) NOT NULL,
  `ClinicName` varchar(200) DEFAULT NULL,
  `ClinicAddress` varchar(255) DEFAULT NULL,
  `ClinicContactNumber` varchar(150) DEFAULT NULL,
  `ClinicEmailAddress` varchar(150) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clinicclinictype`
--

CREATE TABLE `clinicclinictype` (
  `ClinicId` int(11) NOT NULL,
  `ClinicTypeId` int(11) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime(3) NOT NULL,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clinictype`
--

CREATE TABLE `clinictype` (
  `ClinicTypeId` int(11) NOT NULL,
  `ClinicType` varchar(255) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DoctorId` int(11) NOT NULL,
  `DoctorName` varchar(150) NOT NULL,
  `DoctorRegistrationNo` varchar(100) DEFAULT NULL,
  `DoctorAddress` varchar(250) DEFAULT NULL,
  `DoctorContactNo` varchar(20) DEFAULT NULL,
  `DoctorEmailAddress` varchar(100) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DoctorId`, `DoctorName`, `DoctorRegistrationNo`, `DoctorAddress`, `DoctorContactNo`, `DoctorEmailAddress`, `EntryBy`, `EntryDate`, `EditedBy`, `EditedDate`) VALUES
(1, 'Dr. Tito Khan', '123456', '245, Tejgon Indistrial Area, Dhaka-1206', '01920250777', 'shakiliscool@gmail.com', NULL, '2017-10-04 14:08:46', NULL, '2017-10-04 14:08:46'),
(2, 'Dr. Md Zillur Rahman', '123444', '245,Tejgon Industrial Area, Dhaka-1206', '01556874441', 'zillur@gmail.com', '1', '2017-10-10 13:45:47', 'admin', '2017-10-10 13:45:47'),
(3, 'Dr. Tito Khan-001', '123456', '245, Tejgon Indistrial Area, Dhaka-1206', '01920250777', 'shakiliscool@gmail.com', 'admin', '2017-10-10 15:55:36', NULL, '2017-10-10 15:55:36'),
(4, 'Dr. S M Akash', '123456', '245, Tejgon Indistrial Area, Dhaka-1206', '01920250456', 'shakiliscool@gmail.com', 'admin', '2017-10-10 17:52:51', 'admin', '2017-10-10 17:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `doctorclinic`
--

CREATE TABLE `doctorclinic` (
  `DoctorId` int(11) NOT NULL,
  `ClinicId` int(11) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctoreducation`
--

CREATE TABLE `doctoreducation` (
  `DoctorId` int(11) NOT NULL,
  `EducationId` int(11) NOT NULL,
  `EducationGradeId` int(11) NOT NULL,
  `EducationInstituteId` int(11) NOT NULL,
  `PassingYear` varchar(10) DEFAULT NULL,
  `Campus` varchar(250) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dragadvice`
--

CREATE TABLE `dragadvice` (
  `DragAdviceId` int(11) NOT NULL,
  `DragAdviceName` varchar(250) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE `drug` (
  `DrugId` int(11) NOT NULL,
  `DrugName` varchar(250) NOT NULL,
  `DrugSubcategoryId` int(11) NOT NULL,
  `DrugIsActive` int(3) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drugapplicationmethod`
--

CREATE TABLE `drugapplicationmethod` (
  `DrugApplicationMethodId` int(11) NOT NULL,
  `DrugApplicationMethodName` varchar(255) NOT NULL,
  `DrugApplicationMethodIsActive` int(3) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drugcategory`
--

CREATE TABLE `drugcategory` (
  `DrugCategoryId` int(11) NOT NULL,
  `DrugCategoryName` varchar(100) NOT NULL,
  `DrugCategoryIsActive` int(3) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drugcategory`
--

INSERT INTO `drugcategory` (`DrugCategoryId`, `DrugCategoryName`, `DrugCategoryIsActive`, `EntryBy`, `EntryDate`, `EditedBy`, `EditedDate`) VALUES
(1, 'Test', 1, 'admin', '2017-10-12 18:04:13', '0', '2017-10-12 18:04:13'),
(2, 'Abc', 1, 'admin', '2017-10-12 18:04:31', '0', '2017-10-12 18:04:31'),
(3, 'Pharma', 1, 'admin', '2017-10-12 18:04:45', 'admin', '2017-10-15 07:08:00'),
(4, 'Mobile-001', 0, 'admin', '2017-10-15 12:39:24', 'admin', '2017-10-15 07:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `drugform`
--

CREATE TABLE `drugform` (
  `DrugFormId` int(11) NOT NULL,
  `DrugFormName` varchar(250) NOT NULL,
  `DrugFormIsActive` int(11) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drugstrengthunit`
--

CREATE TABLE `drugstrengthunit` (
  `DrugStrengthUnitId` int(11) NOT NULL,
  `DrugStrengthUnitName` varchar(100) NOT NULL,
  `DrugStrengthUnitCode` varchar(10) NOT NULL,
  `DrugStrengthUnitIsActive` int(3) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drugstrengthunit`
--

INSERT INTO `drugstrengthunit` (`DrugStrengthUnitId`, `DrugStrengthUnitName`, `DrugStrengthUnitCode`, `DrugStrengthUnitIsActive`, `EntryBy`, `EntryDate`, `EditedBy`, `EditedDate`) VALUES
(1, 'ml', 'A01', 1, 'admin', '2017-10-15 14:03:37', '0', '2017-10-15 14:03:37'),
(2, 'gm', 'B01', 1, 'admin', '2017-10-15 14:03:49', '0', '2017-10-15 14:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `drugsubcategory`
--

CREATE TABLE `drugsubcategory` (
  `DrugSubcategoryId` int(11) NOT NULL,
  `DrugSubcategoryName` varchar(255) NOT NULL,
  `DrugCategoryId` int(11) NOT NULL,
  `DrugSubcategoryIsActive` int(3) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drugtype`
--

CREATE TABLE `drugtype` (
  `DrugTypeId` int(11) NOT NULL,
  `DrugTypeName` varchar(100) NOT NULL,
  `DrugTypeIsActive` int(11) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drugtype`
--

INSERT INTO `drugtype` (`DrugTypeId`, `DrugTypeName`, `DrugTypeIsActive`, `EntryBy`, `EntryDate`, `EditedBy`, `EditedDate`) VALUES
(1, 'Inj', 1, 'admin', '2017-10-12 13:03:53', '0', '2017-10-12 13:03:53'),
(2, 'Cap', 1, 'admin', '2017-10-12 13:04:17', '0', '2017-10-12 13:04:17'),
(3, 'Tab--01', 0, 'admin', '2017-10-12 14:03:56', 'admin', '2017-10-12 09:48:55'),
(4, 'Gel', 1, 'admin', '2017-10-12 14:10:47', '0', '2017-10-12 14:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `EducationId` int(11) NOT NULL,
  `EducationName` varchar(250) DEFAULT NULL,
  `EducationShortName` varchar(20) DEFAULT NULL,
  `EducationWeight` decimal(18,0) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `educationgrade`
--

CREATE TABLE `educationgrade` (
  `EducationGradeId` int(11) NOT NULL,
  `EducationMaxGrade` varchar(100) DEFAULT NULL,
  `EducationMinGrade` varchar(100) DEFAULT NULL,
  `EducationShortName` varchar(100) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `educationinstitute`
--

CREATE TABLE `educationinstitute` (
  `EducationInstituteId` int(11) NOT NULL,
  `EducationInstituteName` varchar(250) DEFAULT NULL,
  `EducationInstituteAddress` text,
  `EducationInstituteContactNo` varchar(100) DEFAULT NULL,
  `EducationInstituteEmail` varchar(100) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `intervalperiod`
--

CREATE TABLE `intervalperiod` (
  `IntervalPeriodId` int(11) NOT NULL,
  `IntervalPeriodName` varchar(50) NOT NULL,
  `IntervalPeriodIdentifier` varchar(50) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `ManufacturerId` int(11) NOT NULL,
  `ManufacturerName` varchar(250) NOT NULL,
  `ManufacturerPhone` varchar(20) NOT NULL,
  `ManufacturerEmail` varchar(100) NOT NULL,
  `ManufacturerWebsite` varchar(250) NOT NULL,
  `ManufacturerAddress` varchar(100) NOT NULL,
  `ManufacturerIsActive` int(3) NOT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturerdrug`
--

CREATE TABLE `manufacturerdrug` (
  `ManufacturerDrugId` int(11) NOT NULL,
  `ManufacturerId` int(11) NOT NULL,
  `DrugTypeId` int(11) NOT NULL,
  `DrugFormId` int(11) NOT NULL,
  `DrugId` int(11) NOT NULL,
  `ManufacturerDrugName` varchar(250) NOT NULL,
  `DrugStrengthUnitID` int(11) NOT NULL,
  `DrugStrengthUnit` decimal(18,2) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientId` int(11) NOT NULL,
  `PatientName` varchar(250) DEFAULT NULL,
  `PatientAddress` varchar(250) DEFAULT NULL,
  `PatientMobile` varchar(20) DEFAULT NULL,
  `PatientEmail` varchar(50) DEFAULT NULL,
  `PatientDBO` datetime DEFAULT CURRENT_TIMESTAMP,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientSex` tinyint(4) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `presdrugdetails`
--

CREATE TABLE `presdrugdetails` (
  `PresDrugDetailsId` int(11) NOT NULL,
  `PresNumber` int(11) NOT NULL,
  `ManufacturerDrugId` int(11) NOT NULL,
  `WhenConditionId` int(11) NOT NULL,
  `DrugApplicationMethodId` int(11) NOT NULL,
  `DragAdviceId` int(11) NOT NULL,
  `UOM` varchar(40) DEFAULT NULL,
  `Intervel` int(11) DEFAULT NULL,
  `IntervalPattern` varchar(100) DEFAULT NULL,
  `IntervalPeriodId` int(11) DEFAULT NULL,
  `MedacationDuration` int(11) DEFAULT NULL,
  `Comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `presexam`
--

CREATE TABLE `presexam` (
  `PresExamId` int(11) NOT NULL,
  `PresExamName` varchar(250) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `presexamdetails`
--

CREATE TABLE `presexamdetails` (
  `PresNumber` int(11) NOT NULL,
  `PresExamId` int(11) NOT NULL,
  `PresExamValue` varchar(250) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `presfollowup`
--

CREATE TABLE `presfollowup` (
  `FollowUpId` int(11) NOT NULL,
  `PresNumber` int(11) NOT NULL,
  `FollowupPresNumber` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `presinvestigation`
--

CREATE TABLE `presinvestigation` (
  `PresInvestigationId` int(11) NOT NULL,
  `PresInvestigationName` varchar(250) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `presinvestigationdetails`
--

CREATE TABLE `presinvestigationdetails` (
  `PresNumber` int(11) NOT NULL,
  `PresInvestigationId` int(11) NOT NULL,
  `Comment` varchar(300) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `presmaster`
--

CREATE TABLE `presmaster` (
  `PresNumber` int(11) NOT NULL,
  `DoctorId` int(11) DEFAULT NULL,
  `ClinicId` int(11) DEFAULT NULL,
  `PatientId` int(11) DEFAULT NULL,
  `PresDt` datetime DEFAULT CURRENT_TIMESTAMP,
  `NextVisitDt` datetime DEFAULT CURRENT_TIMESTAMP,
  `ChiefComplain` varchar(300) DEFAULT NULL,
  `Comment` varchar(300) DEFAULT NULL,
  `Advice` varchar(300) DEFAULT NULL,
  `CreatebyId` varchar(50) DEFAULT NULL,
  `EditbyId` int(11) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usermanager`
--

CREATE TABLE `usermanager` (
  `UserId` varchar(50) NOT NULL,
  `Password` varchar(250) DEFAULT NULL,
  `UserName` varchar(250) DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `UserPhone` varchar(100) DEFAULT NULL,
  `UserAddress` varchar(250) DEFAULT NULL,
  `IsAdmin` int(3) DEFAULT NULL,
  `DoctorId` int(11) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usermanager`
--

INSERT INTO `usermanager` (`UserId`, `Password`, `UserName`, `UserEmail`, `UserPhone`, `UserAddress`, `IsAdmin`, `DoctorId`, `EntryBy`, `EntryDate`, `EditedBy`, `EditedDate`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', 'Shakil Ahammad', 'shakil.ahammad@aci-bd.com', '01556804442', '245,Tejgon Industrial Area, Dhaka-1208.', 1, 1, '0', '2017-10-04 15:33:26', '0', '2017-10-04 15:33:26'),
('akash', '123', 'S M akash--1', 'akash@mail.com', '01556547784', '245, Tejgon Industrial Area', 1, 4, 'admin', '2017-10-10 17:53:45', 'admin', '2017-10-11 09:13:11'),
('akash-001', 'b0baee9d279d34fa1dfd71aadb908c3f', 'Zillur Khan-01', 'akash@mail.com', '01920250456', '245, Tejgon Industrial Area', 1, NULL, 'admin', '2017-10-11 16:05:56', '0', '2017-10-11 16:05:56'),
('sofi01', '96e79218965eb72c92a549dd5a330112', 'Sofi Mondol', 'sofi@gmail.com', '0144456778878', '245, Tejgon Industrial Area', NULL, NULL, 'admin', '2017-10-11 16:14:23', 'admin', '2017-10-11 10:15:29'),
('zillur', '96e79218965eb72c92a549dd5a330112', 'Zillur Khan', 'zillur@gmail.com', '0155687414145', '245, Tejgon Industrial Area', 1, 2, '0', '2017-10-10 14:04:21', 'admin', '2017-10-11 08:10:19'),
('zillur-001', 'b0baee9d279d34fa1dfd71aadb908c3f', 'Zillur Khan-001', 'zillur@gmail.com', '01559634557', '12345', 0, 3, 'admin', '2017-10-10 16:01:16', '0', '2017-10-10 16:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `whencondition`
--

CREATE TABLE `whencondition` (
  `WhenConditionId` int(11) NOT NULL,
  `WhenConditionName` varchar(250) DEFAULT NULL,
  `EntryBy` varchar(50) DEFAULT NULL,
  `EntryDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `EditedBy` varchar(50) DEFAULT NULL,
  `EditedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chiefcomplain`
--
ALTER TABLE `chiefcomplain`
  ADD PRIMARY KEY (`ChiefComplainId`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`ClinicId`);

--
-- Indexes for table `clinicclinictype`
--
ALTER TABLE `clinicclinictype`
  ADD KEY `fk_clinic_id` (`ClinicId`),
  ADD KEY `fk_clinictype_id` (`ClinicTypeId`);

--
-- Indexes for table `clinictype`
--
ALTER TABLE `clinictype`
  ADD PRIMARY KEY (`ClinicTypeId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DoctorId`);

--
-- Indexes for table `doctorclinic`
--
ALTER TABLE `doctorclinic`
  ADD KEY `fk_doctor_id` (`DoctorId`),
  ADD KEY `fk_clinic_id` (`ClinicId`);

--
-- Indexes for table `doctoreducation`
--
ALTER TABLE `doctoreducation`
  ADD KEY `fk_doctor_id` (`DoctorId`),
  ADD KEY `fk_education_id` (`EducationId`),
  ADD KEY `fk_educationGrade_id` (`EducationGradeId`),
  ADD KEY `fk_educationInstitute_id` (`EducationInstituteId`);

--
-- Indexes for table `dragadvice`
--
ALTER TABLE `dragadvice`
  ADD PRIMARY KEY (`DragAdviceId`);

--
-- Indexes for table `drug`
--
ALTER TABLE `drug`
  ADD PRIMARY KEY (`DrugId`),
  ADD UNIQUE KEY `DrugName` (`DrugName`),
  ADD KEY `fk_drugSubcategory_id` (`DrugSubcategoryId`);

--
-- Indexes for table `drugapplicationmethod`
--
ALTER TABLE `drugapplicationmethod`
  ADD PRIMARY KEY (`DrugApplicationMethodId`);

--
-- Indexes for table `drugcategory`
--
ALTER TABLE `drugcategory`
  ADD PRIMARY KEY (`DrugCategoryId`),
  ADD UNIQUE KEY `DrugCategoryName` (`DrugCategoryName`);

--
-- Indexes for table `drugform`
--
ALTER TABLE `drugform`
  ADD PRIMARY KEY (`DrugFormId`);

--
-- Indexes for table `drugstrengthunit`
--
ALTER TABLE `drugstrengthunit`
  ADD PRIMARY KEY (`DrugStrengthUnitId`);

--
-- Indexes for table `drugsubcategory`
--
ALTER TABLE `drugsubcategory`
  ADD PRIMARY KEY (`DrugSubcategoryId`),
  ADD UNIQUE KEY `DrugSubcategoryName` (`DrugSubcategoryName`),
  ADD KEY `fk_drugcategory_id` (`DrugCategoryId`);

--
-- Indexes for table `drugtype`
--
ALTER TABLE `drugtype`
  ADD PRIMARY KEY (`DrugTypeId`),
  ADD UNIQUE KEY `DrugTypeName` (`DrugTypeName`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`EducationId`);

--
-- Indexes for table `educationgrade`
--
ALTER TABLE `educationgrade`
  ADD PRIMARY KEY (`EducationGradeId`);

--
-- Indexes for table `educationinstitute`
--
ALTER TABLE `educationinstitute`
  ADD PRIMARY KEY (`EducationInstituteId`);

--
-- Indexes for table `intervalperiod`
--
ALTER TABLE `intervalperiod`
  ADD PRIMARY KEY (`IntervalPeriodId`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`ManufacturerId`);

--
-- Indexes for table `manufacturerdrug`
--
ALTER TABLE `manufacturerdrug`
  ADD PRIMARY KEY (`ManufacturerDrugId`),
  ADD KEY `fk_manufacturer_id` (`ManufacturerId`),
  ADD KEY `fk_drugType_id` (`DrugTypeId`),
  ADD KEY `fk_drugForm_id` (`DrugFormId`),
  ADD KEY `fk_drug_id` (`DrugId`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientId`);

--
-- Indexes for table `presdrugdetails`
--
ALTER TABLE `presdrugdetails`
  ADD PRIMARY KEY (`PresDrugDetailsId`),
  ADD KEY `fk_manufacturerDrug_id` (`ManufacturerDrugId`),
  ADD KEY `fk_whenConditionId_id` (`WhenConditionId`),
  ADD KEY `fk_drugApplicationMethod_id` (`DrugApplicationMethodId`),
  ADD KEY `fk_dragAdvice_id` (`DragAdviceId`),
  ADD KEY `fk_intervalPeriod_id` (`IntervalPeriodId`);

--
-- Indexes for table `presexam`
--
ALTER TABLE `presexam`
  ADD PRIMARY KEY (`PresExamId`);

--
-- Indexes for table `presexamdetails`
--
ALTER TABLE `presexamdetails`
  ADD PRIMARY KEY (`PresNumber`),
  ADD KEY `fk_presExam_id` (`PresExamId`);

--
-- Indexes for table `presfollowup`
--
ALTER TABLE `presfollowup`
  ADD PRIMARY KEY (`FollowUpId`),
  ADD KEY `fk_presNumber_id` (`PresNumber`);

--
-- Indexes for table `presinvestigation`
--
ALTER TABLE `presinvestigation`
  ADD PRIMARY KEY (`PresInvestigationId`);

--
-- Indexes for table `presinvestigationdetails`
--
ALTER TABLE `presinvestigationdetails`
  ADD PRIMARY KEY (`PresNumber`),
  ADD KEY `fk_presInvestigation_id` (`PresInvestigationId`);

--
-- Indexes for table `presmaster`
--
ALTER TABLE `presmaster`
  ADD PRIMARY KEY (`PresNumber`),
  ADD KEY `fk_doctor_id` (`DoctorId`),
  ADD KEY `fk_clinic_id` (`ClinicId`),
  ADD KEY `fk_patient_id` (`PatientId`),
  ADD KEY `fk_createby_id` (`CreatebyId`);

--
-- Indexes for table `usermanager`
--
ALTER TABLE `usermanager`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `usermanager_ibfk_1` (`DoctorId`);

--
-- Indexes for table `whencondition`
--
ALTER TABLE `whencondition`
  ADD PRIMARY KEY (`WhenConditionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chiefcomplain`
--
ALTER TABLE `chiefcomplain`
  MODIFY `ChiefComplainId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `ClinicId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clinictype`
--
ALTER TABLE `clinictype`
  MODIFY `ClinicTypeId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `DoctorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dragadvice`
--
ALTER TABLE `dragadvice`
  MODIFY `DragAdviceId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drug`
--
ALTER TABLE `drug`
  MODIFY `DrugId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drugapplicationmethod`
--
ALTER TABLE `drugapplicationmethod`
  MODIFY `DrugApplicationMethodId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drugcategory`
--
ALTER TABLE `drugcategory`
  MODIFY `DrugCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `drugform`
--
ALTER TABLE `drugform`
  MODIFY `DrugFormId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drugstrengthunit`
--
ALTER TABLE `drugstrengthunit`
  MODIFY `DrugStrengthUnitId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `drugsubcategory`
--
ALTER TABLE `drugsubcategory`
  MODIFY `DrugSubcategoryId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drugtype`
--
ALTER TABLE `drugtype`
  MODIFY `DrugTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `EducationId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `educationgrade`
--
ALTER TABLE `educationgrade`
  MODIFY `EducationGradeId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `educationinstitute`
--
ALTER TABLE `educationinstitute`
  MODIFY `EducationInstituteId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `intervalperiod`
--
ALTER TABLE `intervalperiod`
  MODIFY `IntervalPeriodId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `ManufacturerId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manufacturerdrug`
--
ALTER TABLE `manufacturerdrug`
  MODIFY `ManufacturerDrugId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PatientId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presdrugdetails`
--
ALTER TABLE `presdrugdetails`
  MODIFY `PresDrugDetailsId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presexam`
--
ALTER TABLE `presexam`
  MODIFY `PresExamId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presexamdetails`
--
ALTER TABLE `presexamdetails`
  MODIFY `PresNumber` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presfollowup`
--
ALTER TABLE `presfollowup`
  MODIFY `FollowUpId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presinvestigation`
--
ALTER TABLE `presinvestigation`
  MODIFY `PresInvestigationId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presinvestigationdetails`
--
ALTER TABLE `presinvestigationdetails`
  MODIFY `PresNumber` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presmaster`
--
ALTER TABLE `presmaster`
  MODIFY `PresNumber` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `whencondition`
--
ALTER TABLE `whencondition`
  MODIFY `WhenConditionId` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clinicclinictype`
--
ALTER TABLE `clinicclinictype`
  ADD CONSTRAINT `clinicclinictype_ibfk_1` FOREIGN KEY (`ClinicId`) REFERENCES `clinic` (`ClinicId`) ON DELETE CASCADE,
  ADD CONSTRAINT `clinicclinictype_ibfk_2` FOREIGN KEY (`ClinicTypeId`) REFERENCES `clinictype` (`ClinicTypeId`) ON DELETE CASCADE;

--
-- Constraints for table `doctorclinic`
--
ALTER TABLE `doctorclinic`
  ADD CONSTRAINT `doctorclinic_ibfk_1` FOREIGN KEY (`DoctorId`) REFERENCES `doctor` (`DoctorId`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctorclinic_ibfk_2` FOREIGN KEY (`ClinicId`) REFERENCES `clinic` (`ClinicId`) ON DELETE CASCADE;

--
-- Constraints for table `doctoreducation`
--
ALTER TABLE `doctoreducation`
  ADD CONSTRAINT `doctoreducation_ibfk_1` FOREIGN KEY (`DoctorId`) REFERENCES `doctor` (`DoctorId`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctoreducation_ibfk_2` FOREIGN KEY (`EducationId`) REFERENCES `education` (`EducationId`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctoreducation_ibfk_3` FOREIGN KEY (`EducationGradeId`) REFERENCES `educationgrade` (`EducationGradeId`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctoreducation_ibfk_4` FOREIGN KEY (`EducationInstituteId`) REFERENCES `educationinstitute` (`EducationInstituteId`) ON DELETE CASCADE;

--
-- Constraints for table `drug`
--
ALTER TABLE `drug`
  ADD CONSTRAINT `drug_ibfk_1` FOREIGN KEY (`DrugSubcategoryId`) REFERENCES `drugsubcategory` (`DrugSubcategoryId`) ON DELETE CASCADE;

--
-- Constraints for table `drugsubcategory`
--
ALTER TABLE `drugsubcategory`
  ADD CONSTRAINT `drugsubcategory_ibfk_1` FOREIGN KEY (`DrugCategoryId`) REFERENCES `drugcategory` (`DrugCategoryId`) ON DELETE CASCADE;

--
-- Constraints for table `manufacturerdrug`
--
ALTER TABLE `manufacturerdrug`
  ADD CONSTRAINT `manufacturerdrug_ibfk_1` FOREIGN KEY (`ManufacturerId`) REFERENCES `manufacturer` (`ManufacturerId`) ON DELETE CASCADE,
  ADD CONSTRAINT `manufacturerdrug_ibfk_2` FOREIGN KEY (`DrugTypeId`) REFERENCES `drugtype` (`DrugTypeId`) ON DELETE CASCADE,
  ADD CONSTRAINT `manufacturerdrug_ibfk_3` FOREIGN KEY (`DrugFormId`) REFERENCES `drugform` (`DrugFormId`) ON DELETE CASCADE,
  ADD CONSTRAINT `manufacturerdrug_ibfk_4` FOREIGN KEY (`DrugId`) REFERENCES `drug` (`DrugId`) ON DELETE CASCADE;

--
-- Constraints for table `presdrugdetails`
--
ALTER TABLE `presdrugdetails`
  ADD CONSTRAINT `presdrugdetails_ibfk_1` FOREIGN KEY (`ManufacturerDrugId`) REFERENCES `manufacturerdrug` (`ManufacturerDrugId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presdrugdetails_ibfk_2` FOREIGN KEY (`WhenConditionId`) REFERENCES `whencondition` (`WhenConditionId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presdrugdetails_ibfk_3` FOREIGN KEY (`WhenConditionId`) REFERENCES `whencondition` (`WhenConditionId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presdrugdetails_ibfk_4` FOREIGN KEY (`DrugApplicationMethodId`) REFERENCES `drugapplicationmethod` (`DrugApplicationMethodId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presdrugdetails_ibfk_5` FOREIGN KEY (`DragAdviceId`) REFERENCES `dragadvice` (`DragAdviceId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presdrugdetails_ibfk_6` FOREIGN KEY (`IntervalPeriodId`) REFERENCES `intervalperiod` (`IntervalPeriodId`) ON DELETE CASCADE;

--
-- Constraints for table `presexamdetails`
--
ALTER TABLE `presexamdetails`
  ADD CONSTRAINT `presexamdetails_ibfk_1` FOREIGN KEY (`PresExamId`) REFERENCES `presexam` (`PresExamId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presexamdetails_ibfk_2` FOREIGN KEY (`PresNumber`) REFERENCES `presmaster` (`PresNumber`) ON DELETE CASCADE;

--
-- Constraints for table `presfollowup`
--
ALTER TABLE `presfollowup`
  ADD CONSTRAINT `presfollowup_ibfk_1` FOREIGN KEY (`PresNumber`) REFERENCES `presmaster` (`PresNumber`) ON DELETE CASCADE;

--
-- Constraints for table `presinvestigationdetails`
--
ALTER TABLE `presinvestigationdetails`
  ADD CONSTRAINT `presinvestigationdetails_ibfk_1` FOREIGN KEY (`PresInvestigationId`) REFERENCES `presinvestigation` (`PresInvestigationId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presinvestigationdetails_ibfk_2` FOREIGN KEY (`PresNumber`) REFERENCES `presmaster` (`PresNumber`) ON DELETE CASCADE;

--
-- Constraints for table `presmaster`
--
ALTER TABLE `presmaster`
  ADD CONSTRAINT `presmaster_ibfk_1` FOREIGN KEY (`DoctorId`) REFERENCES `doctor` (`DoctorId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presmaster_ibfk_2` FOREIGN KEY (`ClinicId`) REFERENCES `clinic` (`ClinicId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presmaster_ibfk_3` FOREIGN KEY (`ClinicId`) REFERENCES `clinic` (`ClinicId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presmaster_ibfk_4` FOREIGN KEY (`PatientId`) REFERENCES `patient` (`PatientId`) ON DELETE CASCADE,
  ADD CONSTRAINT `presmaster_ibfk_5` FOREIGN KEY (`CreatebyId`) REFERENCES `usermanager` (`UserId`);

--
-- Constraints for table `usermanager`
--
ALTER TABLE `usermanager`
  ADD CONSTRAINT `usermanager_ibfk_1` FOREIGN KEY (`DoctorId`) REFERENCES `doctor` (`DoctorId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
