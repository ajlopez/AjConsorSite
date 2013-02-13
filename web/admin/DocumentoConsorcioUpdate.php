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
	{
		$Uuid = uniqid();
    }
    
    if ($_FILES['Archivo'] && $_FILES['Archivo']['name'])
    {
        $NombreArchivo = $_FILES['Archivo']['name'];
        $ext = pathinfo($NombreArchivo, PATHINFO_EXTENSION);
        if (empty($Uuid))
        {
            $Uuid = uniqid();
        }
        $filename = $Uuid . '.' . $ext;
        copy($_FILES['Archivo']['tmp_name'], '../files/' . $filename);
    }

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]documentosconsorcio set
		Nombre = '$Nombre' , 
		Descripcion = '$Descripcion' , ";

	if ($NombreArchivo)
		$sql .= "	NombreArchivo = '$NombreArchivo' , ";
	
	$sql .= " IdConsorcio = $IdConsorcio , 
		Notas = '$Notas' 		";
		
	if (empty($Id) || !empty($Uuid))
	{
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
