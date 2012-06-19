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
	include_once($Page->Prefix . 'includes/ConsorcioFunctions.inc.php');

	DbConnect();
    
    $IdUser = UserId();
    
    $where = "IdConsorcio in (Select Distinct IdConsorcio from userunidades whereConsorcios where IdUser = $IdUser)";
    $order = "Id desc";

	$rs = DocumentoConsorcioGetListView($where, $order);

	$titles = array('Nombre', 'Descripción', 'Archivo', 'Consorcio', '');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<?		
	TableOpen($titles);

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Descripcion']);
		DatumGenerate($reg['NombreArchivo']);
		$ColumnDescription = ConsorcioTranslate($reg['IdConsorcio']);
		DatumGenerate($ColumnDescription);
		DatumLinkGenerate('Bajar Documento', "DocumentoDownload.php?Uuid=".$reg['Uuid']);
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
