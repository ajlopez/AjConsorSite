<?
	$Page->Title = 'Mis Reservas';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/ReservaFunctions.inc.php');
	include_once($Page->Prefix . 'includes/UsoMultipleFunctions.inc.php');
	include_once($Page->Prefix . 'includes/UserFunctions.inc.php');
	include_once($Page->Prefix . 'includes/Users.inc.php');

	SessionPut('ReservaLink',PageCurrent());

	DbConnect();

	$rs = ReservaGetListView('IdUser = ' . UserId(), 'DesdeFecha, DesdeHora');

	$titles = array('', 'Desde Fecha', 'Desde Hora', 'Hasta Fecha', 'Hasta Hora', 'Uso Múltiple');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="actions">
<a href="ReservaForm.php">Nueva Reserva...</a>
</div>

<?		
	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate('Ver...',"ReservaView.php?Id=".$reg['Id']);
		DatumGenerate($reg['DesdeFecha']);
		DatumGenerate($reg['DesdeHora']);
		DatumGenerate($reg['HastaFecha']);
		DatumGenerate($reg['HastaHora']);
		$ColumnDescription = UsoMultipleTranslate($reg['IdUsoMultiple']);
		DatumLinkGenerate($ColumnDescription, "UsoMultipleView.php?Id=".$reg['IdUsoMultiple']);
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
