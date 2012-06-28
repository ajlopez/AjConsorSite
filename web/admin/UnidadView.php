<?
	$Page->Title = 'Unidad';
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
	include_once($Page->Prefix.'includes/UnidadFunctions.inc.php');
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctions.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');

	DbConnect();
	
	SessionPut('UnidadLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = UnidadGetById($Id);
    $Codigo = $rs['Codigo'];
	$Nombre = $rs['Nombre'];
	$Piso = $rs['Piso'];
	$Numero = $rs['Numero'];
	$IdConsorcio = $rs['IdConsorcio'];
	$Notas = $rs['Notas'];

	$TranslationIdConsorcio = "<a href='ConsorcioView.php?Id=".$IdConsorcio. "'>".TranslateDescription("$Cfg[SqlPrefix]consorcios",$IdConsorcio,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="UnidadList.php">Unidades</a>
&nbsp;
&nbsp;
<a href="UnidadForm.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="UnidadDelete.php?Id=<? echo $Id; ?>">Elimina</a>
</div>

<?
	TableOpen('','80%');
	FieldStaticGenerate("Código",$Codigo);
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Piso",$Piso);
	FieldStaticGenerate("Nro/Letra",$Numero);
	FieldStaticGenerate("Consorcio",$TranslationIdConsorcio);
	FieldStaticMemoGenerate("Notas",$Notas);
	TableClose();
?>

<h2>Usuarios de la Unidad</h2>
<div class="actions">
<a href='UsuarioUnidadForm.php?IdUnidad=<?=$Id?>'>Nuevo Usuario de Unidad</a>
</div>

<br />

<div>
<?
	$rsUsuarioUnidades = UsuarioUnidadGetByUnidad($Id);

	$titles = array('Id', 'Usuario');

	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rsUsuarioUnidades)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"UsuarioUnidadView.php?Id=".$reg['Id']);
		$ColumnDescription = UserTranslate($reg['IdUser']);
		DatumLinkGenerate($ColumnDescription, "UserView.php?Id=".$reg['IdUser']);
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsUsuarioUnidades);
?>
</div>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
