<?php
    include_once('../Configuration.inc.php');
	$Page->Title = 'Actualiza Documento de Consorcio';
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
	include_once($Page->Prefix.'includes/DocumentoConsorcioFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = DocumentoConsorcioGetById($Id);
		$Nombre = $rs['Nombre'];
		$Descripcion = $rs['Descripcion'];
		$NombreArchivo = $rs['NombreArchivo'];
		$IdConsorcio = $rs['IdConsorcio'];
		$Notas = $rs['Notas'];
        $Uuid = $rs['Uuid'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Documento de Consorcio";
		$IsNew = 1;
	}

	$rsIdConsorcio = TranslateQuery("$Cfg[SqlPrefix]consorcios","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="DocumentoConsorcioList.php">Documentos de Consorcio</a>
&nbsp;
&nbsp;
<?php
	if (!$IsNew) {
?>
<a href="DocumentoConsorcioView.php?Id=<?php echo $Id; ?>">Documento de Consorcio</a>
&nbsp;
&nbsp;
<?php
	}
?>
</div>

<?php
	ErrorRender();
?>

<form action="DocumentoConsorcioUpdate.php" method=post enctype="multipart/form-data">

<?php
	TableOpen();
	
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, False);
	FieldMemoGenerate("Descripcion", "Descripción", $Descripcion, 10, 30, False);
	FieldFileGenerate("Archivo", "Archivo");
	FieldComboRsGenerate("IdConsorcio", "Consorcio", $rsIdConsorcio, $IdConsorcio,"Id","Nombre", false, False);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);

	FieldOkGenerate();
	
	TableClose();
?>

<?php
	if (!$IsNew) 
    {
		FieldIdGenerate($Id);
        FieldHiddenGenerate("Uuid", $Uuid);
    }
?>

</form>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
