<?php
App::uses('AppModel', 'Model');
/**
 * Course Model
 *
 * @property Classroom $Classroom
 */
class Course extends AppModel {
    
    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    
    // The Associations below have been created with all possible keys, those that are not needed can be removed
    
    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Classroom' => array(
            'className' => 'Classroom',
            'foreignKey' => 'course_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '' 
        ) 
    );
    
    /**
     * validate Model
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'isUnique' => array(
        	   'rule' => 'isUnique',
                'message' => 'Course name was existed! Please enter another.'
            )
        ),
        'year_from' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty' 
            ),
            'validateYearRange' => array(
                'rule' => array(
                    'validateYearRange' 
                ),
                'message' => 'Year from must smaller than year to'
            ) 
        ),
        'year_to' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty' ,
            ),
            'validateYearRange' => array(
                'rule' => array(
                    'validateYearRange' 
                ),
                'message' => 'Year to must bigger than year from'
            ) 
        ) 
    );
    function validateYearRange($check) {
        foreach ($check as $k => $v) {
            $thisField = $k;
            if ($thisField == 'year_from' 
                && !empty($this->data['Course']['year_to'])
                && $this->data['Course']['year_to'] <= $v) {
                    return false;
            } elseif ( $thisField == 'year_to'
                && !empty($this->data['Course']['year_from'])
                && $this->data['Course']['year_from'] >= $v) {
                    return false;
            }
        }
        return true;
    }
}
