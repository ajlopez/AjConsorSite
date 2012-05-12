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

	DbConnect();
	DbTransactionBegin();

	if (ErrorHas()) {
		DbDisconnect();
		include('DocumentoConsorcioForm.php');
		exit;
	}

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]documentosconsorcio set
		Nombre = '$Nombre' , 
		Descripcion = '$Descripcion' , 
		NombreArchivo = '$NombreArchivo' , 
		IdConsorcio = $IdConsorcio , 
		Notas = '$Notas' 		";
		
	if (empty($Id))
	{
		$Uuid = uniqid();
		$sql .= ", Uuid = '$Uuid'";
	}
	else
	{
	}

	if (!empty($Id))
		$sql .= " where Id=$Id";

	DbExecuteUpdate($sql);

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("DocumentoConsorcioLink");
	SessionRemove("DocumentoConsorcioLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
