/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : jexam

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-09-28 00:10:00
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tb_acos`
-- ----------------------------
DROP TABLE IF EXISTS `tb_acos`;
CREATE TABLE `tb_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_acos
-- ----------------------------
INSERT INTO tb_acos VALUES ('1', null, null, null, 'controllers', '1', '160');
INSERT INTO tb_acos VALUES ('2', '1', null, null, 'Classrooms', '2', '13');
INSERT INTO tb_acos VALUES ('3', '2', null, null, 'admin_index', '3', '4');
INSERT INTO tb_acos VALUES ('4', '2', null, null, 'admin_grid', '5', '6');
INSERT INTO tb_acos VALUES ('5', '2', null, null, 'admin_view', '7', '8');
INSERT INTO tb_acos VALUES ('6', '2', null, null, 'admin_add', '9', '10');
INSERT INTO tb_acos VALUES ('7', '2', null, null, 'admin_edit', '11', '12');
INSERT INTO tb_acos VALUES ('8', '1', null, null, 'Courses', '14', '25');
INSERT INTO tb_acos VALUES ('9', '8', null, null, 'admin_index', '15', '16');
INSERT INTO tb_acos VALUES ('10', '8', null, null, 'admin_grid', '17', '18');
INSERT INTO tb_acos VALUES ('11', '8', null, null, 'admin_view', '19', '20');
INSERT INTO tb_acos VALUES ('12', '8', null, null, 'admin_add', '21', '22');
INSERT INTO tb_acos VALUES ('13', '8', null, null, 'admin_edit', '23', '24');
INSERT INTO tb_acos VALUES ('14', '1', null, null, 'Exams', '26', '35');
INSERT INTO tb_acos VALUES ('15', '14', null, null, 'index', '27', '28');
INSERT INTO tb_acos VALUES ('16', '14', null, null, 'add', '29', '30');
INSERT INTO tb_acos VALUES ('17', '14', null, null, 'excute', '31', '32');
INSERT INTO tb_acos VALUES ('18', '14', null, null, 'view', '33', '34');
INSERT INTO tb_acos VALUES ('19', '1', null, null, 'Grades', '36', '45');
INSERT INTO tb_acos VALUES ('20', '19', null, null, 'admin_index', '37', '38');
INSERT INTO tb_acos VALUES ('21', '19', null, null, 'admin_grid', '39', '40');
INSERT INTO tb_acos VALUES ('22', '19', null, null, 'admin_add', '41', '42');
INSERT INTO tb_acos VALUES ('23', '19', null, null, 'admin_edit', '43', '44');
INSERT INTO tb_acos VALUES ('24', '1', null, null, 'Pages', '46', '49');
INSERT INTO tb_acos VALUES ('25', '24', null, null, 'display', '47', '48');
INSERT INTO tb_acos VALUES ('26', '1', null, null, 'Profile', '50', '55');
INSERT INTO tb_acos VALUES ('27', '26', null, null, 'admin_view', '51', '52');
INSERT INTO tb_acos VALUES ('28', '26', null, null, 'admin_edit', '53', '54');
INSERT INTO tb_acos VALUES ('29', '1', null, null, 'Questions', '56', '65');
INSERT INTO tb_acos VALUES ('30', '29', null, null, 'admin_add', '57', '58');
INSERT INTO tb_acos VALUES ('31', '29', null, null, 'admin_index', '59', '60');
INSERT INTO tb_acos VALUES ('32', '29', null, null, 'admin_grid', '61', '62');
INSERT INTO tb_acos VALUES ('33', '29', null, null, 'admin_edit', '63', '64');
INSERT INTO tb_acos VALUES ('34', '1', null, null, 'Roles', '66', '75');
INSERT INTO tb_acos VALUES ('35', '34', null, null, 'admin_index', '67', '68');
INSERT INTO tb_acos VALUES ('36', '34', null, null, 'admin_add', '69', '70');
INSERT INTO tb_acos VALUES ('37', '34', null, null, 'admin_edit', '71', '72');
INSERT INTO tb_acos VALUES ('38', '34', null, null, 'admin_delete', '73', '74');
INSERT INTO tb_acos VALUES ('39', '1', null, null, 'Settings', '76', '79');
INSERT INTO tb_acos VALUES ('40', '39', null, null, 'admin_index', '77', '78');
INSERT INTO tb_acos VALUES ('41', '1', null, null, 'Subjects', '80', '89');
INSERT INTO tb_acos VALUES ('42', '41', null, null, 'admin_index', '81', '82');
INSERT INTO tb_acos VALUES ('43', '41', null, null, 'admin_grid', '83', '84');
INSERT INTO tb_acos VALUES ('44', '41', null, null, 'admin_add', '85', '86');
INSERT INTO tb_acos VALUES ('45', '41', null, null, 'admin_edit', '87', '88');
INSERT INTO tb_acos VALUES ('46', '1', null, null, 'Tests', '90', '105');
INSERT INTO tb_acos VALUES ('47', '46', null, null, 'index', '91', '92');
INSERT INTO tb_acos VALUES ('48', '46', null, null, 'view', '93', '94');
INSERT INTO tb_acos VALUES ('49', '46', null, null, 'admin_index', '95', '96');
INSERT INTO tb_acos VALUES ('50', '46', null, null, 'admin_grid', '97', '98');
INSERT INTO tb_acos VALUES ('51', '46', null, null, 'admin_view', '99', '100');
INSERT INTO tb_acos VALUES ('52', '46', null, null, 'admin_add', '101', '102');
INSERT INTO tb_acos VALUES ('53', '46', null, null, 'admin_edit', '103', '104');
INSERT INTO tb_acos VALUES ('54', '1', null, null, 'Users', '106', '133');
INSERT INTO tb_acos VALUES ('55', '54', null, null, 'login', '107', '108');
INSERT INTO tb_acos VALUES ('56', '54', null, null, 'logout', '109', '110');
INSERT INTO tb_acos VALUES ('57', '54', null, null, 'dashboard', '111', '112');
INSERT INTO tb_acos VALUES ('58', '54', null, null, 'admin_login', '113', '114');
INSERT INTO tb_acos VALUES ('59', '54', null, null, 'admin_logout', '115', '116');
INSERT INTO tb_acos VALUES ('60', '54', null, null, 'admin_dashboard', '117', '118');
INSERT INTO tb_acos VALUES ('61', '54', null, null, 'admin_index', '119', '120');
INSERT INTO tb_acos VALUES ('62', '54', null, null, 'admin_grid', '121', '122');
INSERT INTO tb_acos VALUES ('63', '54', null, null, 'admin_add', '123', '124');
INSERT INTO tb_acos VALUES ('64', '54', null, null, 'admin_edit', '125', '126');
INSERT INTO tb_acos VALUES ('65', '54', null, null, 'admin_import', '127', '128');
INSERT INTO tb_acos VALUES ('66', '54', null, null, 'admin_download_template', '129', '130');
INSERT INTO tb_acos VALUES ('67', '54', null, null, 'admin_export_score', '131', '132');
INSERT INTO tb_acos VALUES ('68', '1', null, null, 'AclActions', '134', '147');
INSERT INTO tb_acos VALUES ('69', '68', null, null, 'admin_index', '135', '136');
INSERT INTO tb_acos VALUES ('70', '68', null, null, 'admin_add', '137', '138');
INSERT INTO tb_acos VALUES ('71', '68', null, null, 'admin_edit', '139', '140');
INSERT INTO tb_acos VALUES ('72', '68', null, null, 'admin_delete', '141', '142');
INSERT INTO tb_acos VALUES ('73', '68', null, null, 'admin_move', '143', '144');
INSERT INTO tb_acos VALUES ('74', '68', null, null, 'admin_generate', '145', '146');
INSERT INTO tb_acos VALUES ('75', '1', null, null, 'AclPermissions', '148', '153');
INSERT INTO tb_acos VALUES ('76', '75', null, null, 'admin_index', '149', '150');
INSERT INTO tb_acos VALUES ('77', '75', null, null, 'admin_toggle', '151', '152');
INSERT INTO tb_acos VALUES ('78', '1', null, null, 'ToolbarAccess', '154', '159');
INSERT INTO tb_acos VALUES ('79', '78', null, null, 'history_state', '155', '156');
INSERT INTO tb_acos VALUES ('80', '78', null, null, 'sql_explain', '157', '158');

-- ----------------------------
-- Table structure for `tb_aros`
-- ----------------------------
DROP TABLE IF EXISTS `tb_aros`;
CREATE TABLE `tb_aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_aros
-- ----------------------------
INSERT INTO tb_aros VALUES ('1', null, 'Role', '1', null, '1', '2');
INSERT INTO tb_aros VALUES ('2', null, 'Role', '2', null, '3', '4');
INSERT INTO tb_aros VALUES ('3', null, 'Role', '3', null, '5', '6');
INSERT INTO tb_aros VALUES ('4', null, 'Role', '4', null, '7', '8');

-- ----------------------------
-- Table structure for `tb_aros_acos`
-- ----------------------------
DROP TABLE IF EXISTS `tb_aros_acos`;
CREATE TABLE `tb_aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_aros_acos
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_classrooms`
-- ----------------------------
DROP TABLE IF EXISTS `tb_classrooms`;
CREATE TABLE `tb_classrooms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `course_id` int(20) DEFAULT NULL,
  `teacher_id` bigint(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_classrooms
-- ----------------------------
INSERT INTO tb_classrooms VALUES ('1', 'Lớp 6A', null, null, '9', '2013-09-22 16:54:03', '2013-09-25 15:25:18');

-- ----------------------------
-- Table structure for `tb_courses`
-- ----------------------------
DROP TABLE IF EXISTS `tb_courses`;
CREATE TABLE `tb_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `year_from` int(11) DEFAULT NULL,
  `year_to` int(11) DEFAULT NULL,
  `max_code` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_courses
-- ----------------------------
INSERT INTO tb_courses VALUES ('1', 'test1', '2010', '2010', '0', '2013-09-25 16:14:46', '2013-09-25 16:17:58');

-- ----------------------------
-- Table structure for `tb_difficulties`
-- ----------------------------
DROP TABLE IF EXISTS `tb_difficulties`;
CREATE TABLE `tb_difficulties` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `difficulty_1` int(4) NOT NULL DEFAULT '0' COMMENT '% cau hoi co do kho la 1',
  `difficulty_2` int(4) NOT NULL DEFAULT '0' COMMENT '% cau hoi co do kho la 2',
  `difficulty_3` int(4) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_difficulties
-- ----------------------------
INSERT INTO tb_difficulties VALUES ('1', '30', '30', '40', '2013-03-31 16:04:56', '2013-03-31 16:04:53');

-- ----------------------------
-- Table structure for `tb_exams`
-- ----------------------------
DROP TABLE IF EXISTS `tb_exams`;
CREATE TABLE `tb_exams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` bigint(20) DEFAULT NULL,
  `subject_id` int(10) NOT NULL,
  `name` tinytext NOT NULL,
  `description` text,
  `duration` int(10) NOT NULL,
  `question_number` tinyint(2) NOT NULL,
  `answer_per_question` int(10) NOT NULL DEFAULT '4' COMMENT 'answer number per question',
  `difficulty` int(11) NOT NULL,
  `pass_score` decimal(2,0) NOT NULL,
  `max_score` decimal(2,0) DEFAULT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '0: disabled, 1: active, 2: completed; 3: deleted',
  `password_code` varchar(255) DEFAULT NULL,
  `done_test_number` int(10) NOT NULL DEFAULT '0',
  `average_score` float DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_exams
-- ----------------------------
INSERT INTO tb_exams VALUES ('2', '1', '2', 'Kiểm tra giữa học kỳ', 'bababa', '840', '20', '4', '0', '5', null, '1', null, '0', null, '2013-09-27 16:45:51', '2013-09-27 16:45:51');

-- ----------------------------
-- Table structure for `tb_exam_qtypes`
-- ----------------------------
DROP TABLE IF EXISTS `tb_exam_qtypes`;
CREATE TABLE `tb_exam_qtypes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `exam_id` bigint(20) NOT NULL,
  `question_type_id` bigint(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_exam_qtypes
-- ----------------------------
INSERT INTO tb_exam_qtypes VALUES ('2', '2', '2', '2013-09-27 16:45:51', '2013-09-27 16:45:51');

-- ----------------------------
-- Table structure for `tb_grades`
-- ----------------------------
DROP TABLE IF EXISTS `tb_grades`;
CREATE TABLE `tb_grades` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_grades
-- ----------------------------
INSERT INTO tb_grades VALUES ('1', 'Khối lớp 6', '2013-09-22 16:17:37', '2013-09-22 16:35:03');
INSERT INTO tb_grades VALUES ('3', 'Khối lớp 7', '2013-09-22 16:35:12', '2013-09-22 16:35:12');

-- ----------------------------
-- Table structure for `tb_images`
-- ----------------------------
DROP TABLE IF EXISTS `tb_images`;
CREATE TABLE `tb_images` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `path` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_images
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_logs`
-- ----------------------------
DROP TABLE IF EXISTS `tb_logs`;
CREATE TABLE `tb_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_logs
-- ----------------------------
INSERT INTO tb_logs VALUES ('1', 'Import User', '524526383c458', 'tb_users', 'Total imported pupils: 8', '2013-09-27 06:31:20');
INSERT INTO tb_logs VALUES ('2', 'Import User', '52453201118b3', 'tb_users', 'Total imported pupils: 8', '2013-09-27 07:21:37');

-- ----------------------------
-- Table structure for `tb_questions`
-- ----------------------------
DROP TABLE IF EXISTS `tb_questions`;
CREATE TABLE `tb_questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) DEFAULT '1',
  `question_type_id` int(10) NOT NULL COMMENT 'The question type',
  `content` text COMMENT 'The question text',
  `answer` text,
  `score` float DEFAULT NULL,
  `difficulty` tinyint(2) unsigned DEFAULT NULL COMMENT 'The difficulty of the question',
  `status` tinyint(2) unsigned DEFAULT '1',
  `order` int(10) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_questions
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_question_types`
-- ----------------------------
DROP TABLE IF EXISTS `tb_question_types`;
CREATE TABLE `tb_question_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT 'may be one out of: ''raw_text'', ''multiple_one'', ''multiple_many'', ''match'', ''true_false'', ''empty_spaces''',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_question_types
-- ----------------------------
INSERT INTO tb_question_types VALUES ('1', 'Single answer', '2012-11-20 16:06:52', '2012-11-20 16:06:54');
INSERT INTO tb_question_types VALUES ('2', 'Multiple answers', '2012-11-20 16:07:02', '2012-11-20 16:07:05');

-- ----------------------------
-- Table structure for `tb_roles`
-- ----------------------------
DROP TABLE IF EXISTS `tb_roles`;
CREATE TABLE `tb_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_roles
-- ----------------------------
INSERT INTO tb_roles VALUES ('1', 'Superadmin', null, '1', '2', '2012-12-17 15:36:02', '2013-04-28 16:02:24');
INSERT INTO tb_roles VALUES ('2', 'Admin', null, '3', '4', '2012-12-12 07:45:34', '2012-12-12 07:45:34');
INSERT INTO tb_roles VALUES ('3', 'Teacher', null, '5', '6', '2012-12-12 07:45:42', '2012-12-12 07:45:42');
INSERT INTO tb_roles VALUES ('4', 'Pupil', null, '7', '8', '2012-12-17 15:38:30', '2012-12-17 15:38:33');

-- ----------------------------
-- Table structure for `tb_settings`
-- ----------------------------
DROP TABLE IF EXISTS `tb_settings`;
CREATE TABLE `tb_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_settings
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_subjects`
-- ----------------------------
DROP TABLE IF EXISTS `tb_subjects`;
CREATE TABLE `tb_subjects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(2) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_subjects
-- ----------------------------
INSERT INTO tb_subjects VALUES ('1', null, '1', '6', 'Môn Toán', '', '1', '2013-09-25 14:56:05', '2013-09-25 14:56:05');
INSERT INTO tb_subjects VALUES ('2', '1', '2', '3', 'Toán lớp 6', '', '1', '2013-09-25 14:56:25', '2013-09-27 15:46:32');
INSERT INTO tb_subjects VALUES ('3', '1', '4', '5', 'Toán lớp 7', '', '1', '2013-09-25 14:56:34', '2013-09-25 14:56:34');

-- ----------------------------
-- Table structure for `tb_tests`
-- ----------------------------
DROP TABLE IF EXISTS `tb_tests`;
CREATE TABLE `tb_tests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `examinee_id` bigint(20) NOT NULL,
  `exam_id` bigint(20) NOT NULL,
  `start_time` bigint(20) DEFAULT NULL,
  `end_time` bigint(20) DEFAULT NULL,
  `finish_time` bigint(20) DEFAULT NULL,
  `done_question_number` int(10) DEFAULT NULL,
  `score` float(11,0) NOT NULL DEFAULT '0',
  `is_completed` tinyint(1) DEFAULT '0',
  `is_qualified` tinyint(1) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `is_passed` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`,`score`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_tests
-- ----------------------------
INSERT INTO tb_tests VALUES ('1', '3', '1', '1374191412', '1374192612', null, null, '0', '0', null, '0', '2013-07-18 23:50:12', '2013-07-18 23:50:12', '0');
INSERT INTO tb_tests VALUES ('2', '3', '1', '1374538712', '1374539912', null, '1', '0', '0', null, '0', '2013-07-23 00:18:32', '2013-07-23 00:22:23', '0');
INSERT INTO tb_tests VALUES ('3', '3', '1', '1374773639', '1374774839', null, '0', '0', '0', null, '0', '2013-07-25 17:33:59', '2013-07-25 18:02:21', '0');
INSERT INTO tb_tests VALUES ('4', '3', '1', '1374939077', '1374940277', null, '1', '0', '0', null, '0', '2013-07-27 15:31:17', '2013-07-27 15:36:20', '0');
INSERT INTO tb_tests VALUES ('5', '3', '1', '1374941421', '1374942621', null, null, '0', '0', null, '0', '2013-07-27 16:10:21', '2013-07-27 16:10:21', '0');
INSERT INTO tb_tests VALUES ('6', '3', '1', '1376922955', '1376924155', null, null, '0', '0', null, '0', '2013-08-19 14:35:55', '2013-08-19 14:35:55', '0');

-- ----------------------------
-- Table structure for `tb_test_questions`
-- ----------------------------
DROP TABLE IF EXISTS `tb_test_questions`;
CREATE TABLE `tb_test_questions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `test_id` bigint(20) NOT NULL,
  `original_qid` bigint(20) NOT NULL,
  `order_number` int(4) NOT NULL DEFAULT '1' COMMENT 'sequence number of',
  `input_type` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `option_choices` text NOT NULL,
  `answer` text NOT NULL,
  `user_choice` text,
  `score` int(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_test_questions
-- ----------------------------
INSERT INTO tb_test_questions VALUES ('1', '1', '14', '1', 'radio', '<p>なつは まいにち______へ およぎに いきます。</p>\r\n', '{\"a\":\"\\u30d7\\u30fc\\u30eb\",\"b\":\"\\u3048\\u304d\",\"c\":\"\\u30c6\\u30fc\\u30d6\\u30eb\",\"d\":\"\\u307f\\u305b\"}', 'a', null, '1', '2013-07-18 23:50:12', '2013-07-18 23:50:12');
INSERT INTO tb_test_questions VALUES ('2', '1', '4', '2', 'radio', '<p>&nbsp;わたしは_____あさ７じにおきます。</p>\r\n', '{\"a\":\"\\u305f\\u3044\\u3078\\u3093\",\"b\":\"\\u305f\\u3044\\u3066\\u3044\",\"c\":\"\\u3060\\u3093\\u3060\\u3093\",\"d\":\"\\u3060\\u3044\\u3076\"}', 'b', null, '1', '2013-07-18 23:50:12', '2013-07-18 23:50:12');
INSERT INTO tb_test_questions VALUES ('3', '1', '10', '3', 'radio', '<p>「ゆうびんきょくは　どこですか。」「この　みちを　＿＿＿＿いって　ください。すぐ　そこですよ。」</p>\r\n', '{\"a\":\"\\u3061\\u3087\\u3063\\u3068\",\"b\":\"\\u307e\\u3063\\u3059\\u3050\",\"c\":\"\\u306f\\u3058\\u3081\\u306b\",\"d\":\"\\u307e\\u3048\\u306b\"}', 'b', null, '1', '2013-07-18 23:50:12', '2013-07-18 23:50:12');
INSERT INTO tb_test_questions VALUES ('4', '1', '17', '4', 'radio', '<p>わたしは_____あさ７じにおきます &nbsp;</p>\r\n', '{\"a\":\"\\u3060\\u3044\\u3076\",\"b\":\"\\u305f\\u3044\\u3066\\u3044\",\"c\":\"\\u305f\\u3044\\u3078\\u3093\",\"d\":\"\\u3060\\u3093\\u3060\\u3093\"}', 'b', null, '1', '2013-07-18 23:50:12', '2013-07-18 23:50:12');
INSERT INTO tb_test_questions VALUES ('5', '1', '13', '5', 'radio', '<p>かぜを_____、かいしゃをやすみました。&nbsp;</p>\r\n', '{\"a\":\"\\u3072\\u3044\\u3066\",\"b\":\"\\u3084\\u3063\\u3066 \",\"c\":\"\\u306a\\u3063\\u3066\",\"d\":\"\\u3075\\u3044\\u3066\"}', 'a', null, '1', '2013-07-18 23:50:12', '2013-07-18 23:50:12');
INSERT INTO tb_test_questions VALUES ('6', '2', '3', '1', 'radio', '<p>きのうのパーティーでやまださんに_____あいました。</p>\r\n', '{\"a\":\"\\u306f\\u3058\\u3081\\u3066\",\"b\":\"\\u306f\\u3058\\u3081\",\"c\":\"\\u306f\\u3058\\u3081\\u304b\\u3089\",\"d\":\"\\u306f\\u3058\\u3081\\u306e\"}', 'a', 'a', '1', '2013-07-23 00:18:32', '2013-07-23 00:22:23');
INSERT INTO tb_test_questions VALUES ('7', '2', '20', '2', 'radio', '<p>このへやはストーブがついていて、____です。</p>\r\n', '{\"a\":\"\\u3042\\u305f\\u305f\\u304b\\u3044\",\"b\":\"\\u3042\\u305f\\u3089\\u3057\\u3044\",\"c\":\"\\u3059\\u305a\\u3057\\u3044\",\"d\":\"\\u3064\\u3081\\u305f\\u3044\"}', 'a', null, '1', '2013-07-23 00:18:32', '2013-07-23 00:18:32');
INSERT INTO tb_test_questions VALUES ('8', '2', '18', '3', 'radio', '<p>あの_____をわたって、だいがくへいきます。</p>\r\n', '{\"a\":\"\\u307e\\u3069\",\"b\":\"\\u306f\\u3057\",\"c\":\"\\u3084\\u307e\",\"d\":\"\\u3082\\u3093\"}', 'b', null, '1', '2013-07-23 00:18:32', '2013-07-23 00:18:32');
INSERT INTO tb_test_questions VALUES ('9', '2', '7', '4', 'radio', '<p>「はじめまして。どうぞ よるしく。」「______。」</p>\r\n', '{\"a\":\"\\u3053\\u3061\\u3089\\u3053\\u305d\",\"b\":\"\\u3057\\u3064\\u308c\\u3044\\u3057\\u307e\\u3057\\u305f\",\"c\":\"\\u3059\\u307f\\u307e\\u305b\\u3093\\u3067\\u3057\\u305f\",\"d\":\"\\u304a\\u3052\\u3093\\u304d\\u3067\"}', 'a', null, '1', '2013-07-23 00:18:32', '2013-07-23 00:18:32');
INSERT INTO tb_test_questions VALUES ('10', '2', '10', '5', 'radio', '<p>「ゆうびんきょくは　どこですか。」「この　みちを　＿＿＿＿いって　ください。すぐ　そこですよ。」</p>\r\n', '{\"a\":\"\\u306f\\u3058\\u3081\\u306b\",\"b\":\"\\u307e\\u3048\\u306b\",\"c\":\"\\u307e\\u3063\\u3059\\u3050\",\"d\":\"\\u3061\\u3087\\u3063\\u3068\"}', 'c', null, '1', '2013-07-23 00:18:32', '2013-07-23 00:18:32');
INSERT INTO tb_test_questions VALUES ('11', '3', '17', '1', 'radio', '<p>わたしは_____あさ７じにおきます &nbsp;</p>\r\n', '{\"a\":\"\\u305f\\u3044\\u3066\\u3044\",\"b\":\"\\u305f\\u3044\\u3078\\u3093\",\"c\":\"\\u3060\\u3044\\u3076\",\"d\":\"\\u3060\\u3093\\u3060\\u3093\"}', 'a', null, '1', '2013-07-25 17:33:59', '2013-07-25 17:33:59');
INSERT INTO tb_test_questions VALUES ('12', '3', '4', '2', 'radio', '<p>&nbsp;わたしは_____あさ７じにおきます。</p>\r\n', '{\"a\":\"\\u305f\\u3044\\u3078\\u3093\",\"b\":\"\\u305f\\u3044\\u3066\\u3044\",\"c\":\"\\u3060\\u3044\\u3076\",\"d\":\"\\u3060\\u3093\\u3060\\u3093\"}', 'b', null, '1', '2013-07-25 17:33:59', '2013-07-25 17:33:59');
INSERT INTO tb_test_questions VALUES ('13', '3', '16', '3', 'radio', '<p>たなかさんはきょうはあおいズボンを_____います</p>\r\n', '{\"a\":\"\\u304b\\u3076\\u3063\\u3066\",\"b\":\"\\u306f\\u3044\\u3063\\u3066\",\"c\":\"\\u304b\\u3051\\u3066\",\"d\":\"\\u304d\\u3066\"}', 'b', null, '1', '2013-07-25 17:33:59', '2013-07-25 17:33:59');
INSERT INTO tb_test_questions VALUES ('14', '3', '10', '4', 'radio', '<p>「ゆうびんきょくは　どこですか。」「この　みちを　＿＿＿＿いって　ください。すぐ　そこですよ。」</p>\r\n', '{\"a\":\"\\u307e\\u3048\\u306b\",\"b\":\"\\u3061\\u3087\\u3063\\u3068\",\"c\":\"\\u307e\\u3063\\u3059\\u3050\",\"d\":\"\\u306f\\u3058\\u3081\\u306b\"}', 'c', null, '1', '2013-07-25 17:33:59', '2013-07-25 17:33:59');
INSERT INTO tb_test_questions VALUES ('15', '3', '6', '5', 'radio', '<p>ゆうびんきょくへ いって、はがきと______を かいます。</p>\r\n', '{\"a\":\"\\u3056\\u3063\\u3057\",\"b\":\"\\u3057\\u3093\\u3076\\u3093\",\"c\":\"\\u304d\\u3063\\u3066\",\"d\":\"\\u304d\\u3063\\u3076\"}', 'c', null, '1', '2013-07-25 17:33:59', '2013-07-25 17:33:59');
INSERT INTO tb_test_questions VALUES ('16', '4', '16', '1', 'radio', '<p>たなかさんはきょうはあおいズボンを_____います</p>\r\n', '{\"a\":\"\\u304b\\u3051\\u3066\",\"b\":\"\\u304b\\u3076\\u3063\\u3066\",\"c\":\"\\u306f\\u3044\\u3063\\u3066\",\"d\":\"\\u304d\\u3066\"}', 'c', 'd', '1', '2013-07-27 15:31:18', '2013-07-27 15:36:20');
INSERT INTO tb_test_questions VALUES ('17', '4', '9', '2', 'radio', '<p>わたしは　うたが　へたです。でも、うたは＿＿＿＿。</p>\r\n', '{\"a\":\"\\u308a\\u3063\\u3071\\u3067\\u3059\",\"b\":\"\\u3058\\u3087\\u3046\\u305a\\u3067\\u3059\",\"c\":\"\\u3058\\u3087\\u3046\\u3076\\u3067\\u3059\",\"d\":\"\\u3059\\u304d\\u3067\\u3059\"}', 'd', null, '1', '2013-07-27 15:31:18', '2013-07-27 15:31:18');
INSERT INTO tb_test_questions VALUES ('18', '4', '3', '3', 'radio', '<p>きのうのパーティーでやまださんに_____あいました。</p>\r\n', '{\"a\":\"\\u306f\\u3058\\u3081\\u306e\",\"b\":\"\\u306f\\u3058\\u3081\\u304b\\u3089\",\"c\":\"\\u306f\\u3058\\u3081\\u3066\",\"d\":\"\\u306f\\u3058\\u3081\"}', 'c', null, '1', '2013-07-27 15:31:18', '2013-07-27 15:31:18');
INSERT INTO tb_test_questions VALUES ('19', '4', '7', '4', 'radio', '<p>「はじめまして。どうぞ よるしく。」「______。」</p>\r\n', '{\"a\":\"\\u3057\\u3064\\u308c\\u3044\\u3057\\u307e\\u3057\\u305f\",\"b\":\"\\u3059\\u307f\\u307e\\u305b\\u3093\\u3067\\u3057\\u305f\",\"c\":\"\\u3053\\u3061\\u3089\\u3053\\u305d\",\"d\":\"\\u304a\\u3052\\u3093\\u304d\\u3067\"}', 'c', null, '1', '2013-07-27 15:31:18', '2013-07-27 15:31:18');
INSERT INTO tb_test_questions VALUES ('20', '4', '18', '5', 'radio', '<p>あの_____をわたって、だいがくへいきます。</p>\r\n', '{\"a\":\"\\u3084\\u307e\",\"b\":\"\\u3082\\u3093\",\"c\":\"\\u306f\\u3057\",\"d\":\"\\u307e\\u3069\"}', 'c', null, '1', '2013-07-27 15:31:18', '2013-07-27 15:31:18');
INSERT INTO tb_test_questions VALUES ('21', '5', '8', '1', 'radio', '<p>&nbsp;____でほんをかります。</p>\r\n', '{\"a\":\"\\u3059\\u307f\\u307e\\u305b\\u3093\\u3067\\u3057\\u305f\",\"b\":\"\\u307b\\u3093\\u3084\",\"c\":\"\\u3053\\u3061\\u3089\\u3053\\u305d\",\"d\":\"\\u3057\\u3064\\u308c\\u3044\\u3057\\u307e\\u3057\\u305f\"}', 'c', null, '1', '2013-07-27 16:10:21', '2013-07-27 16:10:21');
INSERT INTO tb_test_questions VALUES ('22', '5', '15', '2', 'radio', '<p>&nbsp;とりがたくさんそらを____います。 &nbsp;</p>\r\n', '{\"a\":\"\\u3055\\u3093\\u307d\\u3057\\u3066\",\"b\":\"\\u306f\\u3057\\u3063\\u3066\",\"c\":\"\\u306e\\u307c\\u3063\\u3066\",\"d\":\"\\u3068\\u3093\\u3067\"}', 'd', null, '1', '2013-07-27 16:10:21', '2013-07-27 16:10:21');
INSERT INTO tb_test_questions VALUES ('23', '5', '13', '3', 'radio', '<p>かぜを_____、かいしゃをやすみました。&nbsp;</p>\r\n', '{\"a\":\"\\u3084\\u3063\\u3066 \",\"b\":\"\\u306a\\u3063\\u3066\",\"c\":\"\\u3075\\u3044\\u3066\",\"d\":\"\\u3072\\u3044\\u3066\"}', 'd', null, '1', '2013-07-27 16:10:21', '2013-07-27 16:10:21');
INSERT INTO tb_test_questions VALUES ('24', '5', '17', '4', 'radio', '<p>わたしは_____あさ７じにおきます &nbsp;</p>\r\n', '{\"a\":\"\\u305f\\u3044\\u3078\\u3093\",\"b\":\"\\u3060\\u3093\\u3060\\u3093\",\"c\":\"\\u3060\\u3044\\u3076\",\"d\":\"\\u305f\\u3044\\u3066\\u3044\"}', 'd', null, '1', '2013-07-27 16:10:21', '2013-07-27 16:10:21');
INSERT INTO tb_test_questions VALUES ('25', '5', '11', '5', 'radio', '<p>わたしはゆうべともだちに_____をかきました。</p>\r\n', '{\"a\":\"\\u3066\\u304c\\u307f\",\"b\":\"\\u3067\\u3093\\u308f\",\"c\":\"\\u304d\\u3063\\u3066\",\"d\":\"\\u3075\\u3046\\u3068\\u3046\"}', 'a', null, '1', '2013-07-27 16:10:21', '2013-07-27 16:10:21');
INSERT INTO tb_test_questions VALUES ('26', '6', '3', '1', 'radio', '<p>きのうのパーティーでやまださんに_____あいました。</p>\r\n', '{\"a\":\"\\u306f\\u3058\\u3081\",\"b\":\"\\u306f\\u3058\\u3081\\u304b\\u3089\",\"c\":\"\\u306f\\u3058\\u3081\\u3066\",\"d\":\"\\u306f\\u3058\\u3081\\u306e\"}', 'c', null, '1', '2013-08-19 14:35:56', '2013-08-19 14:35:56');
INSERT INTO tb_test_questions VALUES ('27', '6', '15', '2', 'radio', '<p>&nbsp;とりがたくさんそらを____います。 &nbsp;</p>\r\n', '{\"a\":\"\\u306f\\u3057\\u3063\\u3066\",\"b\":\"\\u3068\\u3093\\u3067\",\"c\":\"\\u306e\\u307c\\u3063\\u3066\",\"d\":\"\\u3055\\u3093\\u307d\\u3057\\u3066\"}', 'b', null, '1', '2013-08-19 14:35:56', '2013-08-19 14:35:56');
INSERT INTO tb_test_questions VALUES ('28', '6', '9', '3', 'radio', '<p>わたしは　うたが　へたです。でも、うたは＿＿＿＿。</p>\r\n', '{\"a\":\"\\u3058\\u3087\\u3046\\u3076\\u3067\\u3059\",\"b\":\"\\u3058\\u3087\\u3046\\u305a\\u3067\\u3059\",\"c\":\"\\u308a\\u3063\\u3071\\u3067\\u3059\",\"d\":\"\\u3059\\u304d\\u3067\\u3059\"}', 'd', null, '1', '2013-08-19 14:35:56', '2013-08-19 14:35:56');
INSERT INTO tb_test_questions VALUES ('29', '6', '20', '4', 'radio', '<p>このへやはストーブがついていて、____です。</p>\r\n', '{\"a\":\"\\u3042\\u305f\\u3089\\u3057\\u3044\",\"b\":\"\\u3059\\u305a\\u3057\\u3044\",\"c\":\"\\u3064\\u3081\\u305f\\u3044\",\"d\":\"\\u3042\\u305f\\u305f\\u304b\\u3044\"}', 'd', null, '1', '2013-08-19 14:35:56', '2013-08-19 14:35:56');
INSERT INTO tb_test_questions VALUES ('30', '6', '10', '5', 'radio', '<p>「ゆうびんきょくは　どこですか。」「この　みちを　＿＿＿＿いって　ください。すぐ　そこですよ。」</p>\r\n', '{\"a\":\"\\u307e\\u3063\\u3059\\u3050\",\"b\":\"\\u307e\\u3048\\u306b\",\"c\":\"\\u3061\\u3087\\u3063\\u3068\",\"d\":\"\\u306f\\u3058\\u3081\\u306b\"}', 'a', null, '1', '2013-08-19 14:35:56', '2013-08-19 14:35:56');

-- ----------------------------
-- Table structure for `tb_users`
-- ----------------------------
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE `tb_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `portrait_url` text,
  `language` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` int(2) DEFAULT NULL,
  `class_id` bigint(20) DEFAULT NULL,
  `activation_key` varchar(60) DEFAULT NULL,
  `login_count` int(10) DEFAULT '0',
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_users
-- ----------------------------
INSERT INTO tb_users VALUES ('1', '2', 'admin', 'admin', '9031748b0b548448bf2e8cff510358ccd3e11142', 'admin@gmail.com', null, null, null, null, null, null, '0', null, null, '1', '0', null, null, '2013-01-04 23:02:59', null);
INSERT INTO tb_users VALUES ('9', '3', 'giao vien', 'gv', '9031748b0b548448bf2e8cff510358ccd3e11142', 'gv@gmail.com', null, null, null, null, null, null, '0', '0000-00-00 00:00:00', null, '1', '0', null, '0000-00-00 00:00:00', '2013-09-22 15:39:47', null);
INSERT INTO tb_users VALUES ('18', '4', '', '', '', '', null, null, '2000-02-16', '0', '1', null, '0', null, null, '1', '0', null, '2013-09-27 07:21:37', '2013-09-27 07:21:37', '52453201118b3');
INSERT INTO tb_users VALUES ('19', '4', '', '', '', '', null, null, '2001-07-13', '0', '1', null, '0', null, null, '1', '0', null, '2013-09-27 07:21:37', '2013-09-27 07:21:37', '52453201118b3');
INSERT INTO tb_users VALUES ('20', '4', '', '', '', '', null, null, '2001-06-20', '0', '1', null, '0', null, null, '1', '0', null, '2013-09-27 07:21:37', '2013-09-27 07:21:37', '52453201118b3');
INSERT INTO tb_users VALUES ('21', '4', '', '', '', '', null, null, '2009-08-08', '0', '1', null, '0', null, null, '1', '0', null, '2013-09-27 07:21:37', '2013-09-27 07:21:37', '52453201118b3');
INSERT INTO tb_users VALUES ('22', '4', '', '', '', '', null, null, '2001-06-17', '0', '1', null, '0', null, null, '1', '0', null, '2013-09-27 07:21:37', '2013-09-27 07:21:37', '52453201118b3');
INSERT INTO tb_users VALUES ('23', '4', '', '', '', '', null, null, '2001-05-06', '0', '1', null, '0', null, null, '1', '0', null, '2013-09-27 07:21:37', '2013-09-27 07:21:37', '52453201118b3');
INSERT INTO tb_users VALUES ('24', '4', '', '', '', '', null, null, '2001-12-03', '0', '1', null, '0', null, null, '1', '0', null, '2013-09-27 07:21:37', '2013-09-27 07:21:37', '52453201118b3');
INSERT INTO tb_users VALUES ('25', '4', '', '', '', '', null, null, '2000-03-15', '0', '1', null, '0', null, null, '1', '0', null, '2013-09-27 07:21:37', '2013-09-27 07:21:37', '52453201118b3');

-- ----------------------------
-- Table structure for `tb_user_subjects`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user_subjects`;
CREATE TABLE `tb_user_subjects` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `subject_id` bigint(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_user_subjects
-- ----------------------------
INSERT INTO tb_user_subjects VALUES ('1', '3', '3', '2012-11-30 16:36:07', '2012-11-30 16:36:10');
INSERT INTO tb_user_subjects VALUES ('17', '2', '5', '2013-06-18 09:38:50', '2013-06-18 09:38:50');
