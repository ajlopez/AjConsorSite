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

	if (empty($UserName))
		ErrorAdd('Debe ingresar C�digo');
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

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]users set
		UserName = '$UserName' , 
		FirstName = '$FirstName' , 
		LastName = '$LastName' , 
		Email = '$Email' , 
		Genre = '$Genre' , 
		IsAdministrator = '$IsAdministrator' , 
		Verified = '$Verified' , 
		Notas = '$Notas' 		";
		
	if (empty($Id))
	{
		$DateTimeInsert = date('Y-m-d H:i:s');
		$sql .= ", DateTimeInsert = '$DateTimeInsert'";
	}
	else
	{
		$DateTimeUpdate = date('Y-m-d H:i:s');
		$sql .= ", DateTimeUpdate = '$DateTimeUpdate'";
	}

	if (!empty($Id))
		$sql .= " where Id=$Id";

	DbExecuteUpdate($sql);

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
