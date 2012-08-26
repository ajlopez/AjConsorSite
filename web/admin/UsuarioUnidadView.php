<?
	$Page->Title = 'Usuario Unidad';
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
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctions.inc.php');

	DbConnect();
	
	SessionPut('UsuarioUnidadLink',PageCurrent());

	if (!isset($Id))
		PageExit();

	$rs = UsuarioUnidadGetById($Id);
	$IdUser = $rs['IdUser'];
	$IdConsorcio = $rs['IdConsorcio'];
	$IdUnidad = $rs['IdUnidad'];

	$TranslationIdUser = "<a href='UserView.php?Id=".$IdUser. "'>".TranslateDescription("$Cfg[SqlPrefix]users",$IdUser,"UserName","Id")."</a>";
	$TranslationIdConsorcio = "<a href='ConsorcioView.php?Id=".$IdConsorcio. "'>".TranslateDescription("$Cfg[SqlPrefix]consorcios",$IdConsorcio,"Nombre","Id")."</a>";
	$TranslationIdUnidad = "<a href='UnidadView.php?Id=".$IdUnidad. "'>".TranslateDescription("$Cfg[SqlPrefix]unidades",$IdUnidad,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="UsuarioUnidadList.php">Usuarios Unidades</a>
&nbsp;
&nbsp;
<a href="UsuarioUnidadForm.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="UsuarioUnidadDelete.php?Id=<? echo $Id; ?>&IdUnidad=<? echo $IdUnidad ?>">Elimina</a>
</div>

<?
	TableOpen('','600px');
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Usuario",$TranslationIdUser);
	FieldStaticGenerate("Consorcio",$TranslationIdConsorcio);
	FieldStaticGenerate("Unidad",$TranslationIdUnidad);
	TableClose();
?>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
