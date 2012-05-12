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

	DbConnect();
	
	SessionPut('UnidadLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = UnidadGetById($Id);
	$Nombre = $rs['Nombre'];
	$Piso = $rs['Piso'];
	$Numero = $rs['Numero'];
	$IdConsorcio = $rs['IdConsorcio'];
	$Notas = $rs['Notas'];

	$TranslationIdConsorcio = "<a href='ConsorcioView.php?Id=".$IdConsorcio. "'>".TranslateDescription("$Cfg[SqlPrefix]consorcios",$IdConsorcio,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<center>

<p>
<a href="UnidadList.php">Unidades</a>
&nbsp;
&nbsp;
<a href="UnidadForm.php?Id=<? echo $Id; ?>">Update</a>
&nbsp;
&nbsp;
<a href="UnidadDelete.php?Id=<? echo $Id; ?>">Delete</a>
</p>

<p>

<table cellspacing=1 cellpadding=2 class="form" width="80%">
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Piso",$Piso);
	FieldStaticGenerate("Nro/Letra",$Numero);
	FieldStaticGenerate("Consorcio",$TranslationIdConsorcio);
	FieldStaticGenerate("Notas",$Notas);
?>
</table>


</center>


<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
