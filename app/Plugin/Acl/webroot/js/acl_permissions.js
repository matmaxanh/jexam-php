/**
 * AclPermissions
 *
 * for AclPermissionsController (acl plugin)
 */
var AclPermissions = {};

/**
 * functions to execute when document is ready
 *
 * @return void
 */
AclPermissions.documentReady = function() {
	AclPermissions.baseUrl = $('table').data('base-url');
	AclPermissions.permissionToggle();
	AclPermissions.tableToggle();
	$('table tr:has(div.controller)').addClass('controller-row');
};

/**
 * Toggle permissions (enable/disable)
 *
 * @return void
 */
AclPermissions.permissionToggle = function() {
	$('img.permission-toggle').unbind();
	$('img.permission-toggle').click(function() {
		var $this = $(this);
		var acoId = $this.data('aco-id');
		var aroId = $this.data('aro-id');

		// show loader
		$this.attr('src', AclPermissions.baseUrl + 'img/ajax/circle_small.gif');

		// prepare loadUrl
		var loadUrl = AclPermissions.baseUrl + 'admin/acl/acl_permissions/toggle/';
		loadUrl    += acoId+'/'+aroId+'/';

		// now load it
		var target = $this.parent();
		$.post(loadUrl, null, function(data, textStatus, jqXHR) {
			target.html(data);
			AclPermissions.permissionToggle();
		});

		return false;
	});
};

/**
 * Toggle table rows (collapsible)
 *
 * @return void
 */
AclPermissions.tableToggle = function() {
	$('table div.controller').click(function() {
		$('.controller-'+ $(this).text().toLowerCase()).toggle();
		if ($(this).hasClass('expand')) {
			$(this).removeClass('expand');
			$(this).addClass('collapse');
		} else {
			$(this).removeClass('collapse');
			$(this).addClass('expand');
		}
	});
};

/**
 * document ready
 *
 * @return void
 */
$(document).ready(function() {
	AclPermissions.documentReady();
});