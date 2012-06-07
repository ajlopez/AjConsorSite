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

	if (empty($Nombre))
		ErrorAdd('Debe ingresar Nombre');
	
	if (ErrorHas()) {
		include('UnidadForm.php');
		exit;
	}

	DbConnect();
	DbTransactionBegin();

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]unidades set
		Nombre = '$Nombre' , 
		Piso = '$Piso' , 
		Numero = '$Numero' , 
		IdConsorcio = $IdConsorcio , 
		Notas = '$Notas' 		";
		
	if (empty($Id))
	{
	}
	else
	{
	}

	if (!empty($Id))
		$sql .= " where Id=$Id";

	DbExecuteUpdate($sql);

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("UnidadLink");
	SessionRemove("UnidadLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
