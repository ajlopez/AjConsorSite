<?
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
	
	$Page->Title = "Nuevos Documentos de Consorcio";
	$IsNew = 1;

	$rsIdConsorcio1 = TranslateQuery("$Cfg[SqlPrefix]consorcios","Nombre as Nombre");
	$rsIdConsorcio2 = TranslateQuery("$Cfg[SqlPrefix]consorcios","Nombre as Nombre");
	$rsIdConsorcio3 = TranslateQuery("$Cfg[SqlPrefix]consorcios","Nombre as Nombre");
	$rsIdConsorcio4 = TranslateQuery("$Cfg[SqlPrefix]consorcios","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="DocumentoConsorcioList.php">Documentos de Consorcio</a>
&nbsp;
&nbsp;
</div>

<?
	ErrorRender();
?>

<form action="DocumentoConsorcioUpdateEx.php" method=post enctype="multipart/form-data">
<div class='row-fluid'>

<?
	echo "<div style='float:left'>\n";
	TableOpen();
	
	FieldTextGenerate("Nombre1", "Nombre", $Nombre1, 30, False);
	FieldMemoGenerate("Descripcion1", "Descripción", $Descripcion1, 10, 30, False);
	FieldFileGenerate("Archivo1", "Archivo");
	FieldComboRsGenerate("IdConsorcio1", "Consorcio", $rsIdConsorcio1, $IdConsorcio1,"Id","Nombre", false, False);
	FieldMemoGenerate("Notas1", "Notas", $Notas1, 10, 30, False);
	
	TableClose();
	echo "</div>\n";
	
	echo "<div style='float:left'>\n";
	TableOpen();

	FieldTextGenerate("Nombre2", "Nombre", $Nombre2, 30, False);
	FieldMemoGenerate("Descripcion2", "Descripción", $Descripcion2, 10, 30, False);
	FieldFileGenerate("Archivo2", "Archivo");
	FieldComboRsGenerate("IdConsorcio2", "Consorcio", $rsIdConsorcio2, $IdConsorcio2,"Id","Nombre", false, False);
	FieldMemoGenerate("Notas2", "Notas", $Notas2, 10, 30, False);
	
	TableClose();
	echo "</div>\n";
	
	echo "</div>\n";
	
	echo "<br/>\n";
	echo "<br/>\n";
	
	echo "<div class='row-fluid'>\n";	
	
	echo "<div style='float:left'>\n";
	TableOpen();

	FieldTextGenerate("Nombre3", "Nombre", $Nombre3, 30, False);
	FieldMemoGenerate("Descripcion3", "Descripción", $Descripcion3, 10, 30, False);
	FieldFileGenerate("Archivo3", "Archivo");
	FieldComboRsGenerate("IdConsorcio3", "Consorcio", $rsIdConsorcio3, $IdConsorcio3,"Id","Nombre", false, False);
	FieldMemoGenerate("Notas3", "Notas", $Notas3, 10, 30, False);
	
	TableClose();
	echo "</div>\n";
	
	echo "<div style='float:left'>\n";
	TableOpen();

	FieldTextGenerate("Nombre4", "Nombre", $Nombre4, 30, False);
	FieldMemoGenerate("Descripcion4", "Descripción", $Descripcion4, 10, 30, False);
	FieldFileGenerate("Archivo4", "Archivo");
	FieldComboRsGenerate("IdConsorcio4", "Consorcio", $rsIdConsorcio4, $IdConsorcio4,"Id","Nombre", false, False);
	FieldMemoGenerate("Notas4", "Notas", $Notas4, 10, 30, False);
	
	TableClose();
	echo "</div>\n";
	echo "</div>\n";
	
    echo "<div>\n";	
	TableOpen();
	
	FieldOkGenerate();
	
	TableClose();
	echo "</div>";
?>

</form>
</div>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
