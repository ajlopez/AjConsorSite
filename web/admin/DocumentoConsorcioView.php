<?
	$Page->Title = 'Documento de Consorcio';
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
	include_once($Page->Prefix.'includes/DocumentoConsorcioFunctions.inc.php');

	DbConnect();
	
	SessionPut('DocumentoConsorcioLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = DocumentoConsorcioGetById($Id);
	$Nombre = $rs['Nombre'];
	$Descripcion = $rs['Descripcion'];
	$NombreArchivo = $rs['NombreArchivo'];
	$Uuid = $rs['Uuid'];
	$IdConsorcio = $rs['IdConsorcio'];
	$Notas = $rs['Notas'];

	$TranslationIdConsorcio = "<a href='ConsorcioView.php?Id=".$IdConsorcio. "'>".TranslateDescription("$Cfg[SqlPrefix]consorcios",$IdConsorcio,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="DocumentoConsorcioList.php">Documentos de Consorcio</a>
&nbsp;
&nbsp;
<a href="DocumentoConsorcioForm.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="DocumentoConsorcioDelete.php?Id=<? echo $Id; ?>">Elimina</a>
</div>

<?
	TableOpen('','80%');
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Descripción",$Descripcion);
	FieldStaticGenerate("Nombre de Archivo",$NombreArchivo);
	FieldStaticGenerate("Código Interno",$Uuid);
	FieldStaticGenerate("Consorcio",$TranslationIdConsorcio);
	FieldStaticGenerate("Notas",$Notas);
	TableClose();

	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
