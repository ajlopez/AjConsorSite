<?
	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');

	include_once($Page->Prefix.'includes/Users.inc.php');
	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/DocumentoConsorcioFunctions.inc.php');

	DbConnect();
    
	if (!isset($Uuid))
		PageExit();
       
    $where = "Uuid = '$Uuid'";

	$rs = DbNextRow(DocumentoConsorcioGetList($where));
	$NombreArchivo = $rs['NombreArchivo'];
    
    $ext = pathinfo($NombreArchivo, PATHINFO_EXTENSION);
    $filename = $Uuid . '.' . $ext;
    $filename = '../files/' . $filename;
    
    header('Content-Description: File Transfer');
    header("Content-disposition: attachment; filename=$NombreArchivo");
    header('Content-Type: application/octet-stream');
	header("Pragma: no-cache");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);    
?>