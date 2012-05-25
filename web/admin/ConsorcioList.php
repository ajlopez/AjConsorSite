<?
	$Page->Title = 'Consorcios';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/ConsorcioFunctions.inc.php');

	SessionPut('ConsorcioLink',PageCurrent());

	DbConnect();

	$rs = ConsorcioGetListView();

	$titles = array('Id', 'Nombre', 'Domicilio', 'Ciudad', 'Provincia', 'País', 'Notas');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="actions">
<a href="ConsorcioForm.php">Nuevo Consorcio...</a>
</div>

<?		
	TableOpen($titles);

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"ConsorcioView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Domicilio']);
		DatumGenerate($reg['Ciudad']);
		DatumGenerate($reg['Provincia']);
		DatumGenerate($reg['Pais']);
		DatumGenerate($reg['Notas']);
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
