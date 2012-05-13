<?
	$Page->Title = 'Unidades';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/UnidadFunctions.inc.php');
	include_once($Page->Prefix . 'includes/ConsorcioFunctions.inc.php');

	SessionPut('UnidadLink',PageCurrent());

	DbConnect();

	$rs = UnidadGetListView();

	$titles = array('Id', 'Nombre', 'Piso', 'Nro/Letra', 'Consorcio', 'Notas');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<center>

<p>
<a href="UnidadForm.php">Nueva Unidad...</a>
<p>

<?		
	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"UnidadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Piso']);
		DatumGenerate($reg['Numero']);
		$ColumnDescription = ConsorcioTranslate($reg['IdConsorcio']);
		DatumLinkGenerate($ColumnDescription, "ConsorcioView.php?Id=".$reg['IdConsorcio']);
		DatumGenerate($reg['Notas']);
		RowClose();
	}

	TableClose();
?>

</center>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
