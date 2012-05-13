<?
	$Page->Title = 'Actualiza Usuario Unidad';
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
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = UsuarioUnidadGetById($Id);
		$IdUser = $rs['IdUser'];
		$IdConsorcio = $rs['IdConsorcio'];
		$IdUnidad = $rs['IdUnidad'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Usuario Unidad";
		$IsNew = 1;
	}

	$rsIdUser = TranslateQuery("$Cfg[SqlPrefix]users","UserName as UserName");
	$rsIdConsorcio = TranslateQuery("$Cfg[SqlPrefix]consorcios","Nombre as Nombre");
	$rsIdUnidad = TranslateQuery("$Cfg[SqlPrefix]unidades","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<center>

<p>
<a href="UsuarioUnidadList.php">Usuarios Unidades</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="UsuarioUnidadView.php?Id=<? echo $Id; ?>">Usuario Unidad</a>
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

<form action="UsuarioUnidadUpdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form">
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldComboRsGenerate("IdUser", "Usuario", $rsIdUser, $IdUser,"Id","UserName", false, False);
	FieldComboRsGenerate("IdConsorcio", "Consorcio", $rsIdConsorcio, $IdConsorcio,"Id","Nombre", false, False);
	FieldComboRsGenerate("IdUnidad", "Unidad", $rsIdUnidad, $IdUnidad,"Id","Nombre", false, False);

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
