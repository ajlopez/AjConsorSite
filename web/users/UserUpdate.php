<?
	if (!$Page->Prefix)
		$Page->Prefix = '../';
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Validations.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'includes/Users.inc.php');

	if (empty($FirstName))
		ErrorAdd('Debe ingresar Nombre');
	if (empty($LastName))
		ErrorAdd('Debe ingresar Apellido');

	if (ErrorHas()) {
		include('UserForm.php');
		exit;
	}

	DbConnect();
	DbTransactionBegin();
    
    $Id = UserId();

	$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]users set
		FirstName = '$FirstName' , 
		LastName = '$LastName' , 
		Email = '$Email' ";
		
	$DateTimeUpdate = date('Y-m-d H:i:s');
	$sql .= ", DateTimeUpdate = '$DateTimeUpdate'";

	$sql .= " where Id=$Id";

	DbExecuteUpdate($sql);

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
