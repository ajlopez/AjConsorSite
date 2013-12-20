<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Reserva';
	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/ReservaFunctions.inc.php');

	DbConnect();
	
	SessionPut('ReservaLink',PageCurrent());

	if (!isset($Id))
		PageExit();

	$rs = ReservaGetById($Id);
	$DesdeFecha = $rs['DesdeFecha'];
	$DesdeHora = $rs['DesdeHora'];
	$HastaFecha = $rs['HastaFecha'];
	$HastaHora = $rs['HastaHora'];
	$IdUsoMultiple = $rs['IdUsoMultiple'];
	$IdUser = $rs['IdUser'];

	$TranslationIdUsoMultiple = "<a href='UsoMultipleView.php?Id=".$IdUsoMultiple. "'>".TranslateDescription("$Cfg[SqlPrefix]usomultiples",$IdUsoMultiple,"Nombre","Id")."</a>";
	$TranslationIdUser = "<a href='UserView.php?Id=".$IdUser. "'>".TranslateDescription("$Cfg[SqlPrefix]users",$IdUser,"UserName","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="ReservaList.php">Reservas</a>
&nbsp;
&nbsp;
<a href="ReservaForm.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="ReservaDelete.php?Id=<?php echo $Id; ?>">Elimina</a>
</div>

<?php
	TableOpen('', '80%');
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Desde Fecha",$DesdeFecha);
	FieldStaticGenerate("Desde Hora",$DesdeHora);
	FieldStaticGenerate("Hasta Fecha",$HastaFecha);
	FieldStaticGenerate("Hasta Hora",$HastaHora);
	FieldStaticGenerate("Uso Múltiple",$TranslationIdUsoMultiple);
	FieldStaticGenerate("Usuario",$TranslationIdUser);
	TableClose();
?>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
