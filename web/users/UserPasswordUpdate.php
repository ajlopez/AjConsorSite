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

	DbConnect();
    
	if (empty($Password))
		ErrorAdd('Debe ingresar Contraseña Actual');
	if (empty($NewPassword))
		ErrorAdd('Debe ingresar Nueva Contraseña');
	if (empty($NewPassword2))
		ErrorAdd('Debe reingresar Nueva Contraseña');
	if ($NewPassword <> $NewPassword2)
		ErrorAdd('No coinciden Nuevas Contraseñas');
        
    $UserId = UserId();

    $sql = "Select *, Password('$Password') as Password2 from $Cfg[SqlPrefix]users where Id = $UserId";
	$res = mysql_query($sql);

	if (!$res || mysql_num_rows($res)==0) {
		ErrorAdd('Usuario inexistente');
	}

	$user = mysql_fetch_object($res);
	mysql_free_result($res);

	if ($user->Password != $user->Password2) {
		ErrorAdd('Contraseña incorrecta');
	}

	if (ErrorHas()) {
        DbDisconnect();
		include('UserPassword.php');
		exit;
	}

	DbTransactionBegin();
    
    $Id = UserId();

	$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]users set
		Password = Password('$NewPassword') ";
		
	$DateTimeUpdate = date('Y-m-d H:i:s');
	$sql .= ", DateTimeUpdate = '$DateTimeUpdate'";

	$sql .= " where Id=$UserId";

	DbExecuteUpdate($sql);

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
