/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : apjj

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 08/07/2020 23:12:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'Administator', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2020-07-08 22:58:13', '2020-07-06 22:27:34');

-- ----------------------------
-- Table structure for attempt
-- ----------------------------
DROP TABLE IF EXISTS `attempt`;
CREATE TABLE `attempt`  (
  `attempt_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mhs_nim` bigint(20) NULL DEFAULT NULL,
  `session_id` bigint(20) NULL DEFAULT NULL,
  `attempt_score` decimal(5, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`attempt_id`) USING BTREE,
  INDEX `mhs_nim`(`mhs_nim`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `attempt_ibfk_1` FOREIGN KEY (`mhs_nim`) REFERENCES `mhs` (`mhs_nim`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `attempt_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for attemptdetail
-- ----------------------------
DROP TABLE IF EXISTS `attemptdetail`;
CREATE TABLE `attemptdetail`  (
  `attemptdetail_id` bigint(20) NOT NULL,
  `attempt_id` bigint(20) NULL DEFAULT NULL,
  `exercise_id` bigint(20) NULL DEFAULT NULL,
  `exerciseanswer_id` bigint(20) NULL DEFAULT NULL,
  `right_answer` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`attemptdetail_id`) USING BTREE,
  INDEX `attempt_id`(`attempt_id`) USING BTREE,
  INDEX `exercise_id`(`exercise_id`) USING BTREE,
  INDEX `exercise_answer_id`(`exerciseanswer_id`) USING BTREE,
  CONSTRAINT `attemptdetail_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `attempt` (`attempt_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `attemptdetail_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`exercise_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `attemptdetail_ibfk_3` FOREIGN KEY (`exerciseanswer_id`) REFERENCES `exerciseanswer` (`exerciseanswer_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for attendance
-- ----------------------------
DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance`  (
  `attendance_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `session_id` bigint(20) NULL DEFAULT NULL,
  `mhs_nim` bigint(20) NULL DEFAULT NULL,
  `attended` tinyint(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`attendance_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `mhs_nim`(`mhs_nim`) USING BTREE,
  CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`mhs_nim`) REFERENCES `mhs` (`mhs_nim`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for classes
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes`  (
  `class_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `class_program` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `class_guide` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `class_status` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`class_code`) USING BTREE,
  INDEX `class_program`(`class_program`) USING BTREE,
  INDEX `class_guide`(`class_guide`) USING BTREE,
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`class_program`) REFERENCES `prodi` (`prodi_code`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`class_guide`) REFERENCES `dosen` (`dosen_code`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of classes
-- ----------------------------
INSERT INTO `classes` VALUES ('C1', 'P1', 'D123', '', NULL, NULL);

-- ----------------------------
-- Table structure for classmember
-- ----------------------------
DROP TABLE IF EXISTS `classmember`;
CREATE TABLE `classmember`  (
  `classmember_id` int(20) NOT NULL AUTO_INCREMENT,
  `class_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mhs_nim` bigint(20) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`classmember_id`) USING BTREE,
  INDEX `class_code`(`class_code`) USING BTREE,
  INDEX `mhs_nim`(`mhs_nim`) USING BTREE,
  CONSTRAINT `classmember_ibfk_1` FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `classmember_ibfk_2` FOREIGN KEY (`mhs_nim`) REFERENCES `mhs` (`mhs_nim`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of classmember
-- ----------------------------
INSERT INTO `classmember` VALUES (1, 'C1', 0, NULL, NULL);
INSERT INTO `classmember` VALUES (2, 'C1', 123435, NULL, NULL);
INSERT INTO `classmember` VALUES (3, 'C1', 11172520, NULL, NULL);
INSERT INTO `classmember` VALUES (4, 'C1', 11172526, NULL, NULL);

-- ----------------------------
-- Table structure for dosen
-- ----------------------------
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen`  (
  `dosen_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dosen_firstname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dosen_lastname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dosen_birthdate` date NULL DEFAULT NULL,
  `dosen_email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dosen_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`dosen_code`) USING BTREE,
  UNIQUE INDEX `idx1_dosen_code`(`dosen_code`) USING BTREE,
  INDEX `dosen_email`(`dosen_email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dosen
-- ----------------------------
INSERT INTO `dosen` VALUES ('D123', 'Adam', 'Dosen', '2020-06-24', 'adam@mail.com', '1234', NULL, NULL);
INSERT INTO `dosen` VALUES ('D124', 'Marul', 'yanto', '2020-06-25', 'marul@mail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-06-24 01:26:59', NULL);
INSERT INTO `dosen` VALUES ('D125', 'aaa', 'aaa', '2020-06-25', 'asd@mail.com', '39cebfad161e838026b367a33659e709a3bc8b6b', '2020-06-24 01:27:40', NULL);
INSERT INTO `dosen` VALUES ('D126', 'aaaa', 'aaa', '2020-06-25', 'asd@mail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2020-06-24 01:28:45', NULL);
INSERT INTO `dosen` VALUES ('D127', 'asd', 'asd', '0000-00-00', 'asd@mail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-06-24 01:29:13', NULL);
INSERT INTO `dosen` VALUES ('D128', 'asd', '123', '0000-00-00', 'asd@mail.com', 'f10e2821bbbea527ea02200352313bc059445190', '2020-06-24 01:34:35', NULL);

-- ----------------------------
-- Table structure for exercise
-- ----------------------------
DROP TABLE IF EXISTS `exercise`;
CREATE TABLE `exercise`  (
  `exercise_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `materi_id` bigint(20) NULL DEFAULT NULL,
  `question` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `question_picture` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`exercise_id`) USING BTREE,
  INDEX `materi_id`(`materi_id`) USING BTREE,
  CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`materi_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exerciseanswer
-- ----------------------------
DROP TABLE IF EXISTS `exerciseanswer`;
CREATE TABLE `exerciseanswer`  (
  `exerciseanswer_id` bigint(20) NOT NULL,
  `exercise_id` bigint(20) NULL DEFAULT NULL,
  `answer_text` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `answer_right` tinyint(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`exerciseanswer_id`) USING BTREE,
  INDEX `exercise_id`(`exercise_id`) USING BTREE,
  CONSTRAINT `exerciseanswer_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`exercise_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lecture
-- ----------------------------
DROP TABLE IF EXISTS `lecture`;
CREATE TABLE `lecture`  (
  `lecture_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `class_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `matkul_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dosen_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lecture_status` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`lecture_id`) USING BTREE,
  INDEX `class_code`(`class_code`) USING BTREE,
  INDEX `matkul_code`(`matkul_code`) USING BTREE,
  INDEX `dosen_code`(`dosen_code`) USING BTREE,
  CONSTRAINT `lecture_ibfk_1` FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `lecture_ibfk_2` FOREIGN KEY (`matkul_code`) REFERENCES `matkul` (`matkul_code`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `lecture_ibfk_3` FOREIGN KEY (`dosen_code`) REFERENCES `dosen` (`dosen_code`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lecture
-- ----------------------------
INSERT INTO `lecture` VALUES (5, 'C1', 'MK1', 'D123', '1', NULL, NULL);
INSERT INTO `lecture` VALUES (6, 'C1', 'MK1', 'D125', '', NULL, NULL);

-- ----------------------------
-- Table structure for lectureperiod
-- ----------------------------
DROP TABLE IF EXISTS `lectureperiod`;
CREATE TABLE `lectureperiod`  (
  `lectureperiod_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lecture_id` bigint(20) NULL DEFAULT NULL,
  `class_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dosen_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `start_day` tinyint(4) NULL DEFAULT NULL,
  `start_hour` time(4) NULL DEFAULT NULL,
  `end_hour` time(4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`lectureperiod_id`) USING BTREE,
  INDEX `lecture_id`(`lecture_id`) USING BTREE,
  INDEX `start_day`(`start_day`) USING BTREE,
  INDEX `start_hour`(`start_hour`, `end_hour`) USING BTREE,
  INDEX `end_hour`(`end_hour`) USING BTREE,
  INDEX `class_code`(`class_code`, `dosen_code`) USING BTREE,
  INDEX `dosen_code`(`dosen_code`) USING BTREE,
  CONSTRAINT `lectureperiod_ibfk_1` FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`lecture_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lectureperiod
-- ----------------------------
INSERT INTO `lectureperiod` VALUES (1, 5, 'C1', 'D123', 1, '23:43:00.0000', '12:43:00.0000', NULL, NULL);
INSERT INTO `lectureperiod` VALUES (2, 6, 'C1', 'D125', 3, '13:42:00.0000', '14:42:00.0000', NULL, NULL);

-- ----------------------------
-- Table structure for materi
-- ----------------------------
DROP TABLE IF EXISTS `materi`;
CREATE TABLE `materi`  (
  `materi_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `matkul_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `materi_title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `materi_content` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `materi_chapter` tinyint(4) NULL DEFAULT NULL,
  `materi_attachment` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`materi_id`) USING BTREE,
  INDEX `matkul_code`(`matkul_code`) USING BTREE,
  CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`matkul_code`) REFERENCES `matkul` (`matkul_code`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for matkul
-- ----------------------------
DROP TABLE IF EXISTS `matkul`;
CREATE TABLE `matkul`  (
  `matkul_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `matkul_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `matkul_sks` tinyint(4) NULL DEFAULT NULL,
  `matkul_status` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`matkul_code`) USING BTREE,
  INDEX `matkul_code`(`matkul_code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of matkul
-- ----------------------------
INSERT INTO `matkul` VALUES ('MK1', 'Sistem Informasi', 4, '', NULL, NULL);

-- ----------------------------
-- Table structure for mhs
-- ----------------------------
DROP TABLE IF EXISTS `mhs`;
CREATE TABLE `mhs`  (
  `mhs_nim` bigint(20) NOT NULL,
  `mhs_firstname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mhs_lastname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mhs_birthdate` date NULL DEFAULT NULL,
  `mhs_email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mhs_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `mhs_status` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`mhs_nim`) USING BTREE,
  INDEX `mhs_email`(`mhs_email`) USING BTREE,
  INDEX `mhs_firstname`(`mhs_firstname`, `mhs_lastname`) USING BTREE,
  INDEX `mhs_lastname`(`mhs_lastname`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mhs
-- ----------------------------
INSERT INTO `mhs` VALUES (0, 'asdas', 'asdasd', '0000-00-00', 'asda@mail.com', 'f10e2821bbbea527ea02200352313bc059445190', '1', '2020-06-24 02:07:28', '2020-07-06 22:42:44');
INSERT INTO `mhs` VALUES (123435, 'asdasd', 'asdasd', '0000-00-00', 'asda@mail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1', '2020-06-24 02:08:18', '2020-07-06 22:42:44');
INSERT INTO `mhs` VALUES (11172520, 'maruls', 'adam', '1999-05-04', 'main@mail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1', NULL, '2020-07-06 22:42:44');
INSERT INTO `mhs` VALUES (11172526, 'first', 'last', '1999-01-01', '@mail.com', '12345678', '', NULL, '2020-07-06 22:43:30');

-- ----------------------------
-- Table structure for prodi
-- ----------------------------
DROP TABLE IF EXISTS `prodi`;
CREATE TABLE `prodi`  (
  `prodi_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `prodi_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`prodi_code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prodi
-- ----------------------------
INSERT INTO `prodi` VALUES ('P1', 'Program 1');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `session_id` bigint(20) NOT NULL,
  `lecture_id` bigint(20) NULL DEFAULT NULL,
  `materi_id` bigint(20) NULL DEFAULT NULL,
  `session_start` datetime(0) NULL DEFAULT NULL,
  `session_end` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`session_id`) USING BTREE,
  INDEX `lecture_id`(`lecture_id`) USING BTREE,
  INDEX `materi_id`(`materi_id`) USING BTREE,
  CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`lecture_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`materi_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `setting_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `setting_detail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `setting_valuetype` tinyint(4) NULL DEFAULT NULL,
  `setting_value` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`setting_code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for silabus
-- ----------------------------
DROP TABLE IF EXISTS `silabus`;
CREATE TABLE `silabus`  (
  `silabus_id` bigint(20) NOT NULL,
  `matkul_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `silabus_from` datetime(0) NULL DEFAULT NULL,
  `silabus_until` datetime(0) NULL DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`silabus_id`) USING BTREE,
  INDEX `matkul_code`(`matkul_code`) USING BTREE,
  CONSTRAINT `silabus_ibfk_1` FOREIGN KEY (`matkul_code`) REFERENCES `matkul` (`matkul_code`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`  (
  `task_id` bigint(20) NOT NULL,
  `lecture_id` bigint(20) NULL DEFAULT NULL,
  `task_title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `task_description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `task_attachment` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `task_startdate` datetime(0) NULL DEFAULT NULL,
  `task_duedate` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`task_id`) USING BTREE,
  INDEX `lecture_id`(`lecture_id`) USING BTREE,
  INDEX `task_startdate`(`task_startdate`, `task_duedate`) USING BTREE,
  INDEX `task_duedate`(`task_duedate`) USING BTREE,
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`lecture_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for taskapply
-- ----------------------------
DROP TABLE IF EXISTS `taskapply`;
CREATE TABLE `taskapply`  (
  `taskapply_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `task_id` bigint(20) NULL DEFAULT NULL,
  `mhs_nim` bigint(20) NULL DEFAULT NULL,
  `taskapply_answer` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `taskapply_attachment` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `taskapply_score` decimal(5, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`taskapply_id`) USING BTREE,
  INDEX `task_id`(`task_id`) USING BTREE,
  INDEX `mhs_nim`(`mhs_nim`) USING BTREE,
  CONSTRAINT `taskapply_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `taskapply_ibfk_2` FOREIGN KEY (`mhs_nim`) REFERENCES `mhs` (`mhs_nim`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
