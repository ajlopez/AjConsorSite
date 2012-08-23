<?
	$Page->Title = 'UsoMultiples';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/UsoMultipleFunctions.inc.php');
	include_once($Page->Prefix . 'includes/ConsorcioFunctions.inc.php');

	SessionPut('UsoMultipleLink',PageCurrent());

	DbConnect();

	$rs = UsoMultipleGetListView();

	$titles = array('Id', 'Nombre', 'Codigo', 'Consorcio', 'Notas');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="actions">
<a href="UsoMultipleForm.php">New UsoMultiple...</a>
</div>

<?		
	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"UsoMultipleView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Codigo']);
		$ColumnDescription = ConsorcioTranslate($reg['IdConsorcio']);
		DatumLinkGenerate($ColumnDescription, "ConsorcioView.php?Id=".$reg['IdConsorcio']);
		DatumGenerate($reg['Notas']);
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
