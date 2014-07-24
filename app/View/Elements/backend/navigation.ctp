<div id="sidebar-shortcuts">
    <div id="sidebar-shortcuts-large">
        <button class="btn btn-small btn-success">
            <i class="icon-signal"></i>
        </button>

        <button class="btn btn-small btn-info">
            <i class="icon-pencil"></i>
        </button>

        <button class="btn btn-small btn-warning">
            <i class="icon-group"></i>
        </button>

        <button class="btn btn-small btn-danger">
            <i class="icon-cogs"></i>
        </button>
    </div>

    <div id="sidebar-shortcuts-mini">
        <span class="btn btn-success"></span>

        <span class="btn btn-info"></span>

        <span class="btn btn-warning"></span>

        <span class="btn btn-danger"></span>
    </div>
</div>
<?php
$menus = array(
    array('title' => '<i class="icon-home"></i><span class="hidden-tablet">&nbsp;' . __('Dashboard') . '</span>', 'url' => array('controller' => 'users', 'action' => 'dashboard')),
    array('title' => '<i class="icon-user"></i><span class="hidden-tablet">&nbsp;' . __('Manage teacher') . '</span>', 'url' => array('controller' => 'users', 'action' => 'index', '?' => array('type' => 'teacher'))),
    array('title' => '<i class="icon-user"></i><span class="hidden-tablet">&nbsp;' . __('Manage pupil'), 'url' => array('controller' => 'users', 'action' => 'index', '?' => array('type' => 'pupil'))),
    
    array('title' => '<i class="icon-building"></i><span class="hidden-tablet">&nbsp;' . __('Manage class'), 'url' => array('controller' => 'classrooms', 'action' => 'index')),
    array('title' => '<i class="icon-sitemap"></i><span class="hidden-tablet">&nbsp;' . __('Manage grade'), 'url' => array('controller' => 'grades', 'action' => 'index')),
    array('title' => '<i class="icon-calendar-empty"></i><span class="hidden-tablet">&nbsp;' . __('Manage course'), 'url' => array('controller' => 'courses', 'action' => 'index')),
    
    
    array('title' => '<i class="icon-th-large"></i><span class="hidden-tablet">&nbsp;' . __('Subject'), 'url' => array('controller' => 'subjects', 'action' => 'index')),
    
    array('title' => '<i class="icon-list-alt"></i><span class="hidden-tablet">&nbsp;' . __('Exam'), 'url' => array('controller' => 'exams', 'action' => 'index')),
    array('title' => '<i class="icon-question-sign"></i><span class="hidden-tablet">&nbsp;' . __('Question'), 'url' => array('controller' => 'questions', 'action' => 'index')),
    
    array('title' => '<i class="icon-th"></i><span class="hidden-tablet">&nbsp;' . __('Role') . '</span>', 'url' => array('controller' => 'roles', 'action' => 'index')),
    array('title' => '<i class="icon-lock"></i><span class="hidden-tablet">&nbsp;' . __('Permission'), 'url' => array('plugin' => 'acl', 'controller' => 'acl_permissions', 'action' => 'index')),
);
echo $this->Layout->adminMenus($menus, array('htmlAttributes' => array('class' => 'nav nav-list')));
?>
<div id="sidebar-collapse">
    <i class="icon-double-angle-left"></i>
</div>
