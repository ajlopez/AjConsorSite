<?
	$Page->Prefix = '../';
	
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	
	include_once($Page->Prefix.'includes/Users.inc.php');
	include_once($Page->Prefix.'includes/EventoFunctionsEx.inc.php');

	if (empty($UserName))
		ErrorAdd('Debe ingresar Codigo');

	if (empty($Password))
		ErrorAdd('Debe ingresar Password');

	if (ErrorHas()) {
		if ($Cfg['UserLogin'])
			PageAbsoluteRedirect($Cfg['UserLogin'] . '?Error=' . $Errors[0] . '&UserName=' . $UserName);
		else 
			include('Login.php');
		exit;
	}

	DbConnect();

	$sql = "Select *, Password('$Password') as Password2 from $Cfg[SqlPrefix]users where UserName = '$UserName'";
	$res = mysql_query($sql);

	if (!$res || mysql_num_rows($res)==0) {
		DbDisconnect();
		ErrorAdd('Usuario inexistente');
		if ($Cfg['UserLogin'])
			PageAbsoluteRedirect($Cfg['UserLogin'] . '?Error=' . $Errors[0] . '&UserName=' . $UserName);
		else 
			include('Login.php');
		exit;
	}

	$user = mysql_fetch_object($res);
	mysql_free_result($res);

	if ($user->Password != $user->Password2) {
		DbDisconnect();
		ErrorAdd('Password incorrecta');
		if ($Cfg['UserLogin'])
			PageAbsoluteRedirect($Cfg['UserLogin'] . '?Error=' . $Errors[0] . '&UserName=' . $UserName);
		else 
			include('Login.php');
		exit;
	}

	UserLogin($user);

	EventoWrite('LIN');
	
	DbDisconnect();

	$UserLink = SessionGet("UserLink");
	SessionRemove("UserLink");

	//PageRedirect($UserLink);
	PageRedirect(PageMain());
	exit;
?>