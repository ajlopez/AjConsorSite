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
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctions.inc.php');
	include_once($Page->Prefix.'includes/UnidadFunctions.inc.php');

	if (!$Id && !$IdUnidad)
		PageRedirect(PageMain());

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = UsuarioUnidadGetById($Id);
		$IdUser = $rs['IdUser'];
		$IdUnidad = $rs['IdUnidad'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Usuario Unidad";
		$IsNew = 1;
	}
	
	$unidad = UnidadGetById($IdUnidad);
	$IdConsorcio = $unidad['IdConsorcio'];
			
	$rsIdUser = TranslateQuery("$Cfg[SqlPrefix]users","UserName as UserName");
	$rsIdUnidad = UnidadGetList('IdConsorcio = ' . $IdConsorcio, 'Codigo');

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="UnidadView.php?Id=<?= $IdUnidad ?>">Unidad</a>
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
</div>


<?
	ErrorRender();
?>

<form action="UsuarioUnidadUpdateEx.php" method=post>

<?
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

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
