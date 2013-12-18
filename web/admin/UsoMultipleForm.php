<?php
    include_once('../Configuration.inc.php');
	$Page->Title = 'Actualiza Uso Múltiple';
	
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
	include_once($Page->Prefix.'includes/UsoMultipleFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = UsoMultipleGetById($Id);
		$Nombre = $rs['Nombre'];
		$Codigo = $rs['Codigo'];
		$IdConsorcio = $rs['IdConsorcio'];
		$Notas = $rs['Notas'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Uso Múltiple";
		$IsNew = 1;
	}

	$rsIdConsorcio = TranslateQuery("$Cfg[SqlPrefix]consorcios","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="UsoMultipleList.php">Usos Múltiples</a>
&nbsp;
&nbsp;
<?php
	if (!$IsNew) {
?>
<a href="UsoMultipleView.php?Id=<?php echo $Id; ?>">Uso Múltiple</a>
&nbsp;
&nbsp;
<?php
	}
?>
</div>


<?php
	ErrorRender();
?>

<form action="UsoMultipleUpdate.php" method=post>

<?php
	TableOpen();
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, True);
	FieldTextGenerate("Codigo", "Codigo", $Codigo, 30, True);
	FieldComboRsGenerate("IdConsorcio", "Consorcio", $rsIdConsorcio, $IdConsorcio,"Id","Nombre", false, False);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);

	FieldOkGenerate();
	TableClose();
?>

<?php
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
