<?
	if (!$Page->Prefix)
		$Page->Prefix = '../';
	include_once('./Security.inc.php');
	
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');

	if (!isset($Id))
		PageExit();

	$sql = "delete from $Cfg[SqlPrefix]consorcios where Id = $Id";

	DbConnect();
	DbExecuteUpdate($sql);
	DbDisconnect();

	$Link = SessionGet("ConsorcioDeleteLink");
	SessionRemove("ConsorcioDeleteLink");

	if ($Link)
		PageAbsoluteRedirect($Link);
	else
		PageAbsoluteRedirect('ConsorcioList.php');

	exit;
?>
