<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Actualiza Usuario Unidad';
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
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctions.inc.php');
	include_once($Page->Prefix.'includes/UnidadFunctions.inc.php');

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
	$rsIdUnidad = UnidadGetList('IdConsorcio = ' . $IdConsorcio, 'Codigo');

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="UsuarioUnidadList.php">Usuarios Unidades</a>
&nbsp;
&nbsp;
<?php
	if (!$IsNew) {
?>
<a href="UsuarioUnidadView.php?Id=<?php echo $Id; ?>">Usuario Unidad</a>
&nbsp;
&nbsp;
<?php
	}
?>
</div>


<?php
	ErrorRender();
?>

<form action="UsuarioUnidadUpdate.php" method=post>

<?php
	TableOpen('', '400px');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldComboRsGenerate("IdUser", "Usuario", $rsIdUser, $IdUser,"Id","UserName", false, False);
	FieldComboRsGenerate("IdUnidad", "Unidad", $rsIdUnidad, $IdUnidad,"Id","Nombre", false, False);
	FieldHiddenGenerate('IdConsorcio', $IdConsorcio);

	FieldOkGenerate();
	
	TableClose();

	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
