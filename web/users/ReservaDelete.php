<?
	if (!$Page->Prefix)
		$Page->Prefix = '../';
	include_once('./Security.inc.php');
	
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'includes/Users.inc.php');

	if (!isset($Id))
		PageExit();

	$IdUser = UserId();
	$sql = "delete from $Cfg[SqlPrefix]reservas where Id = $Id and IdUser = $IdUser";

	DbConnect();
	DbExecuteUpdate($sql);
	DbDisconnect();

	$Link = SessionGet("ReservaDeleteLink");
	SessionRemove("ReservaDeleteLink");

	PageAbsoluteRedirect("ReservaListEx.php?FechaDesde=$DesdeFecha");

	exit;
?>
