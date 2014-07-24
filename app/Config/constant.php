<?php

/* ================ Role =============== */
define('ROLE_ID_SUPERADMIN', '2');
define('ROLE_ID_EXAMINEE', '4');

/* ================ Status ============= */
define('STATUS_DISABLE', 0);
define('STATUS_ACTIVE', 1);
define('STATUS_REGISTER', 2);
define('STATUS_COMPLETED', 3);

define('STATUS_QUESTION_CHECKED', 1);
define('STATUS_QUESTION_REJECT', 2);
define('STATUS_QUESTION_OPEN', 3);

define('STATUS_EXAM_DISABLED', 0);
define('STATUS_EXAM_ACTIVE', 1);
define('STATUS_EXAM_COMPLETED', 2);
define('STATUS_EXAM_DELETED', 3);

/* ================ Question =========== */
define('MIN_DIFFICULTY_QUESTION', 1);
define('MAX_DIFFICULTY_QUESTION', 3);
define('MIN_ANSWER_NUMBER', 4);
define('MIN_SCORE', 1);

/* ================ Gender =========== */
define('GENDER_MALE', 1);
define('GENDER_FEMALE', 2);

/* ================ Header excel =========== */
define('HEADER_STT', 'STT');
define('HEADER_FULLNAME', 'Ho va ten');
define('HEADER_BIRTHDAY', 'Ngay sinh');
define('HEADER_GENDER', 'Gioi tinh');

Configure::write('Constant.status', array(
    STATUS_ACTIVE => 'Active',
    STATUS_DISABLE => 'Disable'
));

Configure::write('Constant.status_task', array(
    STATUS_REGISTER => 'Registered',
    STATUS_ACTIVE => 'Open',
    STATUS_COMPLETED => 'Completed',
    STATUS_DISABLE => 'Close',
));

Configure::write('Constant.status_question', array(
    STATUS_QUESTION_OPEN => 'Open',
    STATUS_QUESTION_REJECT => 'Reject',
    STATUS_QUESTION_CHECKED => 'Checked',
));

Configure::write('Constant.status_exam', array(
    STATUS_EXAM_DISABLED => 'Disabled',
    STATUS_EXAM_ACTIVE => 'Active',
    STATUS_EXAM_COMPLETED => 'Completed',
    STATUS_EXAM_DELETED => 'Deleted'
));

Configure::write('Api.app_prefix', 'onlineworks_');

Configure::write('Constant.question_difficult', array(
    1 => 'Hard',
    2 => 'Normal',
    3 => 'Easy',
));

Configure::write('Constant.gender', array(
    GENDER_MALE => 'Male',
    GENDER_FEMALE => 'Female',
));

Configure::write('Constant.headerExcel', array(
    HEADER_STT,
    HEADER_FULLNAME,
    HEADER_BIRTHDAY,
    HEADER_GENDER,
));

Configure::write('Constant.sampleExcel', array(
    '1',
    'Trần Văn A',
    '20/12/1990',
    'Male',
));
?>