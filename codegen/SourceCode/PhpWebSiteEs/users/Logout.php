<?
	$Page->Prefix = '../';
	include($Page->Prefix.'includes/pages.inc.php');
	include($Page->Prefix.'includes/users.inc.php');

	UserLogout();

	PageRedirect(PageMain());
?>