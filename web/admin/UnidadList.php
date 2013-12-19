<?php
    include_once('../Configuration.inc.php');
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

	$titles = array('Código', 'Nombre', 'Piso', 'Nro/Letra', 'Consorcio', 'Notas');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="actions">
<a href="UnidadForm.php">Nueva Unidad...</a>
</div>

<?php
	TableOpen($titles);

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate($reg['Codigo'],"UnidadView.php?Id=".$reg['Id']);
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

<?php
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
