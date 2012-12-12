<?
	$Page->Title = 'Documentos de Consorcio';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/DocumentoConsorcioFunctions.inc.php');
	include_once($Page->Prefix . 'includes/DocumentoConsorcioFunctionsEx.inc.php');
	include_once($Page->Prefix . 'includes/ConsorcioFunctions.inc.php');

	SessionPut('DocumentoConsorcioLink',PageCurrent());

	DbConnect();

	$rs = DocumentoConsorcioGetExtendedListView('','consorcios.Nombre, documentos.Nombre desc');

	$titles = array('Id', 'Consorcio', 'Nombre de Documento', 'Descripción', 'Nombre de Archivo', 'Código Interno', 'Notas');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="actions">
<a href="DocumentoConsorcioForm.php">Subir Documento de Consorcio</a>
&nbsp;&nbsp;
<a href="DocumentoConsorcioFormEx.php">Subir Varios Documentos de Consorcio</a>
</div>

<?		
	TableOpen($titles);

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"DocumentoConsorcioView.php?Id=".$reg['Id']);
		DatumLinkGenerate($reg['NombreConsorcio'], "ConsorcioView.php?Id=".$reg['IdConsorcio']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Descripcion']);
		DatumGenerate($reg['NombreArchivo']);
		DatumGenerate($reg['Uuid']);
		DatumGenerate($reg['Notas']);
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
