<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {


	public $uses = array('User', 'Role', 'Category', 'UserCategory', 'Classroom', 'Log', 'Grade', 'Test', 'Course');
    public $helpers = array('Layout');

    function beforeFilter() {
        parent::beforeFilter();
    }

    /*
     * login method
     *
     * @return void
     */

    public function login() {
        $this->layout = 'static';
        $this->set('title_for_layout', __('Login'));
        if(!$this->__login()){
		Common::setFlash(__('Username or password is invalid.'));
	  }
    }

    /*
     * logout method
     *
     * @return void
     */

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    /*
     * dashboard method
     * 
     * @return void
     */

    public function dashboard() {
        
    }

    /*
     * admin_login method
     *
     * @return void
     */

    public function admin_login() {
        $this->set('title_for_layout', __('Admin Login'));
        $this->layout = 'admin_login';
        if(!$this->__login()){
		Common::setFlash(__('Username or password is invalid.'));
	  }
    }

    /*
     * admin_logout method
     *
     * @return void
     */

    public function admin_logout() {
        $this->redirect($this->Auth->logout());
    }

    public function admin_dashboard() {
        $pageTitle = __('Dashboard');
        $this->set(compact('pageTitle'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->__getGridData();
    }

    public function admin_grid() {
        $this->layout = 'ajax';
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'delete':
                    if (isset($_POST['user'])) {
                        $userIds = explode(",", $_POST['user']);
                        $this->User->updateAll(array(
                            'is_deleted' => STATUS_ACTIVE,
                            'deleted_at' => '"' . date('Y-m-d H:i:s') . '"',
                                ), array('User.id' => $userIds));
                    }
                    break;
            }
        }
        $this->__getGridData();
        $this->render('/Elements/backend/user_grid');
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                Common::setFlash(__('The user has been saved'), 'success');
                if ($this->request->data['User']['task'] == 'save2new') {
                    $this->redirect(array('action' => 'add'));
                } else {
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                Common::setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //if empty password, don't check password confirm
            if (isset($this->request->data['User']['passwd']) && empty($this->request->data['User']['passwd']) && isset($this->request->data['User']['passwd_confirm'])) {
                unset($this->request->data['User']['passwd']);
                unset($this->request->data['User']['passwd_confirm']);
            }

            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                Common::setFlash(__('The user has been saved'), 'success');
                if ($this->request->data['User']['task'] == 'save2new') {
                    $this->redirect(array('action' => 'add'));
                } else {
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                Common::setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $roles = $this->User->Role->find('list');

        $this->set(compact('roles'));
    }

    /*
     * import data from excel file
     */

    public function admin_import() {
        App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel' . DS . 'PHPExcel.php'));
        App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel' . DS . 'PHPExcel' . DS . 'IOFactory.php'));

        if ($this->request->is('post')) {
            $data = $this->request->data['User'];
            
            // Get course info
            $courseInfo = $this->Classroom->find('first', array(
            	'conditions' => array('Classroom.id' => $data['classroom']),
                'contain' => array('Course'),
                'fields' => array('Course.year_from', 'Course.max_code')
            ));
            
            try {
                // Check file not empty and file is .xls or .xlsx
                if (!isset($data['file']) || !in_array($data['file']['type'], array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))) {
                    throw new Exception(__('File upload is invalid.'));
                }
                // Get extension of file
                $ext = pathinfo($data['file']['name'], PATHINFO_EXTENSION);
                
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($data['file']['tmp_name']);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($data['file']['tmp_name']);
                } catch (Exception $e) {
                    $this->log('Error loading file "' . pathinfo($data['file']['tmp_name'], PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }

                // Get data from sheet
                $sheet = $objPHPExcel->getSheet(0);

                // Get highest row and column
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Init number success
                $successCount = 0;
                $users = array();

                // Check template file upload
                $headerData = $sheet->rangeToArray('A1:' . $highestColumn . '1');
                $arrayHeader = Configure::read('Constant.headerExcel');
                $validate = true;

                foreach ($headerData[0] as $headerRow) {
                    if (!in_array($headerRow, $arrayHeader)) {
                        $validate = false;
                    }
                }

                if (!$validate) {
                    // Template excel is invalid
                    throw new Exception(__('The template of uploaded file is invalid.'));
                }
                
                // Create new name to store file in folder "webroot/files"
                $newName = date('YmdHis') . '.' . $ext;

                if (!move_uploaded_file($data['file']['tmp_name'], WWW_ROOT . 'files' . DS . $newName)) {
                    throw new Exception(__('File upload unsuccessful.'));
                }
                
                //generate random traction
                $transaction = uniqid();

                $newMaxCode = $courseInfo['Course']['max_code'] + 1;
                
                //  Loop through each row of the worksheet in turn
                for ($row = 2; $row <= $highestRow; $row++) {
                    //  Read a row of data into an array
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row);

                    // Mapping data with header
                    foreach ($rowData[0] as $key => $value) {
                        $dataImport[$headerData[0][$key]] = $value;
                    }

                    //  Insert row data array into database
                    $this->User->create();

                    $dateOfBirth = str_replace('/', '-', PHPExcel_Style_NumberFormat::toFormattedString($dataImport[HEADER_BIRTHDAY], "M/D/YYYY"));

                    $dataUser = array(
                        'User' => array(
                            'username' => $this->__genUsername($courseInfo['Course']['year_from'], $newMaxCode),
                            'fullname' => $dataImport[HEADER_FULLNAME],
                            'birthday' => date('Y-m-d', strtotime($dateOfBirth)),
                            'gender' => array_search($dataImport[HEADER_GENDER], Configure::read('Constant.gender')),
                            'role_id' => ROLE_ID_EXAMINEE,
                            'status' => STATUS_ACTIVE,
                            'class_id' => $data['classroom'],
                            'transaction_id' => $transaction
                        )
                    );

                    if ($this->User->save($dataUser)) {
                        $users[] = $dataUser;
                        $successCount++;
                        
                        // Import success => Increase Course.max_code
                        if ($this->Course->save(array(
                            'Course' => array(
                    	        'id' => $courseInfo['Course']['id'],
                                'max_code' => $newMaxCode,
                            ))
                        )) {
                        	$newMaxCode++;
                        }
                    } else {
                        Common::setFlash(__('Import user error. Line ' . $row));
                        break;
                    }
                }

                // Save logs
                $this->Log->create();
                $dataLog = array(
                    'Log' => array(
                        'action' => 'Import User',
                        'transaction_id' => $transaction,
                        'target' => 'tb_users',
                        'description' => 'Total imported pupils: ' . $successCount
                    )
                );
                $this->Log->save($dataLog);

                $this->set(compact('successCount', 'users'));
            } catch (Exception $e) {
                Common::setFlash($e->getMessage());
            }
        }

        $classes = $this->Classroom->find('list');

        $this->set(compact('classes'));
    }

    /*
     * download template file
     */

    public function admin_download_template() {
        App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel' . DS . 'PHPExcel.php'));

        $objPHPExcel = new PHPExcel();

        $arrayHeader = Configure::read('Constant.headerExcel');
        $arraySampleData = Configure::read('Constant.sampleExcel');

        // Set data to excel
        $objPHPExcel->setActiveSheetIndex(0)->fromArray($arrayHeader, null, 'A1')->fromArray($arraySampleData, null, 'A2');

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Danh sach hoc sinh');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="template.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
	            
	    $this->autoRender = false;
	}
	
	public function admin_export_score() {
	    App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel' . DS . 'PHPExcel.php'));
	    if ($this->request->is('post')) {

	    }
	    
	    $tests = $this->Test->find('list', array('conditions' => array('status' => 1)));
	    $classes = $this->Classroom->find('list');
	    $grades = $this->Grade->find('list');
	    
	    $this->set(compact('classes', 'grades', 'tests'));
	}

    /*
     * get grid data for index page
     * 
     * @param boolean $hasPagination
     * @return void
     */
    private function __getGridData($hasPagination = true) {
        $conditions = array('User.is_deleted' => STATUS_DISABLE);

        //filter by teacher
        if (isset($this->request->query['type'])) {
            switch ($this->request->query['type']) {
                case 'teacher':
                    $conditions['User.role_id'] = 3;
                    break;
                case 'pupil':
                    $conditions['User.role_id'] = 4;
                    break;
            }
        }

        if (isset($_GET['limit'])) {
            $limit = $_GET['limit'];
        } else {
            $limit = Configure::read('Setting.rows_per_page');
        }

        if ($hasPagination) {
            $this->paginate = array(
                'paramType' => 'querystring',
                'contain' => array('Role'),
                'conditions' => $conditions,
                'limit' => $limit,
            );
            $users = $this->paginate();
        } else {
            $users = $this->User->find('all', array(
                'contain' => array('Role'),
                'conditions' => $conditions,
            ));
        }

        $userIds = array();
        foreach ($users as $user) {
            $userIds[] = $user['User']['id'];
        }
        $this->set(compact('users', 'userIds'));
    }

    private function __login() {
        if ($this->request->is('post') && $this->Auth->login()) {
		return $this->redirect($this->Auth->loginRedirect);
        }
	  return false;
    }

    private function __genUsername($yearFrom, $maxCode) {
        return $yearFrom . sprintf('%0' . (int) 5 . 's', $maxCode);
    }
}
