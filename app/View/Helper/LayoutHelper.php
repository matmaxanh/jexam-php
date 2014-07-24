<?php
/**
 * Layout Helper
 *
 */
class LayoutHelper extends AppHelper {

/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Js',
	);

/**
 * Default Constructor
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = array()) {
		$this->helpers[] = 'Acl.Acl';
		parent::__construct($View, $settings);
	}

/**
 * Show flash message
 *
 * @return string
 */
	public function sessionFlash() {
		$messages = $this->Session->read('Message');
		$output = '';
		if (is_array($messages)) {
			foreach (array_keys($messages) as $key) {
				$output .= $this->Session->flash($key);
			}
		}
		return $output;
	}

/**
 * isLoggedIn
 *
 * if User is logged in
 *
 * @return boolean
 */
	public function isLoggedIn() {
		if ($this->Session->check('Auth.User.id')) {
			return true;
		} else {
			return false;
		}
	}


/**
 * Get Role ID
 *
 * @return integer
 */
	public function getRoleId() {
		if ($this->isLoggedIn()) {
			$roleId = $this->Session->read('Auth.User.role_id');
		} else {
			// Public
			$roleId = 3;
		}
		return $roleId;
	}


/** Generate Admin navigation base on access list.
 *
 * @param array $menus
 * @param array $options
 * @return string menu html tags
 */
	public function adminMenus($menus, $options = array()) {
		$options = Set::merge(array(
			'children' => true,
			'htmlAttributes' => array(
				'class' => 'nav',
			),
		), $options);

		$out = null;
		$currentRoleId = $this->getRoleId();
		foreach ($menus as $menu) {
			if ($currentRoleId != ROLE_ID_SUPERADMIN && !$this->Acl->linkIsAllowedByRoleId($currentRoleId, $menu['url'])) {
				continue;
			}
			
			if(!isset($menu['url']['plugin'])){
				$menu['url']['plugin'] = false;
			}
			
			if (isset($menu['children']) && !empty($menu['children'])) {
				$link = $this->Html->link($menu['title'].'&nbsp;<span class="caret"></span>', $menu['url'], array('escape'=> false, 'class'=> 'dropdown-toggle', 'data-toggle'=> 'dropdown'));
				$children = $this->adminMenus($menu['children'], array(
					'children' => true,
					'htmlAttributes' => array('class' => 'dropdown-menu')
				));
				$out  .= $this->Html->tag('li', $link . $children);
			} else {
				$link = $this->Html->link($menu['title'], $menu['url'], array('escape' => false));
				$out  .= $this->Html->tag('li', $link);
			}
		}
		return $this->Html->tag('ul', $out, $options['htmlAttributes']);
	}
	
	public function generateCategoryTree($categories, $selectedCategoryIds = array(), $maxLevel = 3, $parent = null, $level = 0){
		// Reset the flag each time the function is called
		$hasChildren = false;
		foreach($categories as $category){
			if ($category['Category']['parent_id'] != $parent){
				continue;
			}
			// Only print the wrapper ('<ul>') if this is the first child (otherwise just print the item)
			// Will be false each time the function is called again
			if ($hasChildren === false){
				// Switch the flag, start the list wrapper, increase the level count
				$hasChildren = true;
				$level++;
				echo '<ul>';
			}

			echo '<li>';
			echo '<label class="checkbox">';
			if(in_array($category['Category']['id'], $selectedCategoryIds)){
				$checked = true;
			}else{
				$checked = false;
			}
			echo $this->Form->checkbox('category.', array('escape'=>false, 'value'=> $category['Category']['id'], 'hiddenField' => false, 'checked'=> $checked));
			echo $category['Category']['name'];
			echo '</label>';

			// Repeat function, using the current item's key (id) as the parent_id argument
			// Gives us a nested list of subcategories
			if($level < $maxLevel){
				$this->generateCategoryTree($categories, $selectedCategoryIds, $maxLevel, $category['Category']['id'], $level);
			}

			// Close the item
			echo '</li>';
		}

		// If we opened the wrapper above, close it.
		if ($hasChildren === true){
			echo '</ul>';
		}
	}
	
	public function renderLink($title, $url, $option= array()){
		$option = array_merge(array('escape'=> false, 'class'=> 'btn btn-small'), $option);
		$currentRoleId = $this->getRoleId();
		if(($currentRoleId == ROLE_ID_SUPERADMIN) || 
			(isset($url['controller']) && isset($url['action']) && $this->Acl->linkIsAllowedByRoleId($currentRoleId, $url))){
			return $this->Html->link($title, $url, $option);		
		}
		return '';
	}

}
