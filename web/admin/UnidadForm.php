<?
	$Page->Title = 'Actualiza Unidad';
	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/UnidadFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = UnidadGetById($Id);
		$Nombre = $rs['Nombre'];
		$Piso = $rs['Piso'];
		$Numero = $rs['Numero'];
		$IdConsorcio = $rs['IdConsorcio'];
		$Notas = $rs['Notas'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Unidad";
		$IsNew = 1;
	}

	$rsIdConsorcio = TranslateQuery("$Cfg[SqlPrefix]consorcios","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<center>

<p>
<a href="UnidadList.php">Unidades</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="UnidadView.php?Id=<? echo $Id; ?>">Unidad</a>
&nbsp;
&nbsp;
<?
	}
?>
</p>


<?
	ErrorRender();
?>

<p>

<form action="UnidadUpdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form">
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, False);
	FieldTextGenerate("Piso", "Piso", $Piso, 30, False);
	FieldTextGenerate("Numero", "Nro/Letra", $Numero, 30, False);
	FieldComboRsGenerate("IdConsorcio", "Consorcio", $rsIdConsorcio, $IdConsorcio,"Id","Nombre", false, False);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);

	FieldOkGenerate();
?>
</table>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

</center>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>