<?
	$Page->Title = 'Actualiza Consorcio';
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
	include_once($Page->Prefix.'includes/ConsorcioFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = ConsorcioGetById($Id);
        $Codigo = $rs['Codigo'];
		$Nombre = $rs['Nombre'];
		$Domicilio = $rs['Domicilio'];
		$Ciudad = $rs['Ciudad'];
		$Provincia = $rs['Provincia'];
		$Pais = $rs['Pais'];
		$Notas = $rs['Notas'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Consorcio";
		$IsNew = 1;
	}


	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="ConsorcioList.php">Consorcios</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="ConsorcioView.php?Id=<? echo $Id; ?>">Consorcio</a>
&nbsp;
&nbsp;
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="ConsorcioUpdate.php" method=post>

<?
	TableOpen();
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Codigo", "Código", $Codigo, 6, True);
	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, True);
	FieldTextGenerate("Domicilio", "Domicilio", $Domicilio, 30, False);
	FieldTextGenerate("Ciudad", "Ciudad", $Ciudad, 30, False);
	FieldTextGenerate("Provincia", "Provincia", $Provincia, 30, False);
	FieldTextGenerate("Pais", "País", $Pais, 30, False);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);

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
