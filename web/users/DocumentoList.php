<?
	$Page->Title = 'Mis Documentos';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');

	include_once($Page->Prefix . 'includes/Users.inc.php');
	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/DocumentoConsorcioFunctions.inc.php');
	include_once($Page->Prefix . 'includes/DocumentoConsorcioFunctionsEx.inc.php');
	include_once($Page->Prefix . 'includes/ConsorcioFunctions.inc.php');

	DbConnect();
    
    $IdUser = UserId();
    
    $where = "documentos.IdConsorcio in (Select Distinct IdConsorcio from $Cfg[SqlPrefix]userunidades where IdUser = $IdUser)";
    $order = "consorcios.Nombre, documentos.Nombre desc";

	$rs = DocumentoConsorcioGetExtendedListView($where, $order);

	$titles = array('Consorcio', 'Nombre de Documento', 'Descripción', 'Archivo', '');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<?		
	TableOpen($titles);

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumGenerate($reg['NombreConsorcio']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Descripcion']);
		DatumGenerate($reg['NombreArchivo']);
		DatumLinkGenerate('Bajar Documento', "DocumentoDownload.php?Uuid=".$reg['Uuid']);
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
