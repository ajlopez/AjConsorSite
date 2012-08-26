<?
	$Page->Title = 'Actualiza Reserva';
	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/ReservaFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = ReservaGetById($Id);
		$DesdeFecha = $rs['DesdeFecha'];
		$DesdeHora = $rs['DesdeHora'];
		$HastaFecha = $rs['HastaFecha'];
		$HastaHora = $rs['HastaHora'];
		$IdUsoMultiple = $rs['IdUsoMultiple'];
		$IdUser = $rs['IdUser'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nueva Reserva";
		$IsNew = 1;
	}
	
	if (!$DesdeFecha)
		$DesdeFecha = date('Y-m-d');
	if (!$HastaFecha)
		$HastaFecha = date('Y-m-d');

	$rsIdUsoMultiple = TranslateQuery("$Cfg[SqlPrefix]usomultiples","Nombre as Nombre");
	$rsIdUser = TranslateQuery("$Cfg[SqlPrefix]users","UserName as UserName");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="ReservaList.php">Reservas</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="ReservaView.php?Id=<? echo $Id; ?>">Reserva</a>
&nbsp;
&nbsp;
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="ReservaUpdate.php" method=post>

<?
	TableOpen();
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldDateGenerate("DesdeFecha", "Desde Fecha", $DesdeFecha, 30, True);
	FieldHourGenerate("DesdeHora", "Desde Hora", $DesdeHora, 30, True);
	FieldDateGenerate("HastaFecha", "Hasta Fecha", $HastaFecha, 30, True);
	FieldHourGenerate("HastaHora", "Hasta Hora", $HastaHora, 30, True);
	FieldComboRsGenerate("IdUsoMultiple", "Uso Múltiple", $rsIdUsoMultiple, $IdUsoMultiple,"Id","Nombre", false, False);
	FieldComboRsGenerate("IdUser", "Usuario", $rsIdUser, $IdUser,"Id","UserName", false, False);

	FieldOkGenerate();
	TableClose();
?>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
