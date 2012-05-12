<?
	$Page->Title = 'Consorcio';
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
	include_once($Page->Prefix.'includes/ConsorcioFunctions.inc.php');
	include_once($Page->Prefix.'includes/UnidadFunctions.inc.php');
	include_once($Page->Prefix.'includes/DocumentoConsorcioFunctions.inc.php');

	DbConnect();
	
	SessionPut('ConsorcioLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = ConsorcioGetById($Id);
	$Nombre = $rs['Nombre'];
	$Domicilio = $rs['Domicilio'];
	$Ciudad = $rs['Ciudad'];
	$Provincia = $rs['Provincia'];
	$Pais = $rs['Pais'];
	$Notas = $rs['Notas'];


	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<center>

<p>
<a href="ConsorcioList.php">Consorcios</a>
&nbsp;
&nbsp;
<a href="ConsorcioForm.php?Id=<? echo $Id; ?>">Update</a>
&nbsp;
&nbsp;
<a href="ConsorcioDelete.php?Id=<? echo $Id; ?>">Delete</a>
</p>

<p>

<table cellspacing=1 cellpadding=2 class="form" width="80%">
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Domicilio",$Domicilio);
	FieldStaticGenerate("Ciudad",$Ciudad);
	FieldStaticGenerate("Provincia",$Provincia);
	FieldStaticGenerate("País",$Pais);
	FieldStaticGenerate("Notas",$Notas);
?>
</table>


</center>

<center>
<h2>Unidades</h2>
<div>
<a href='UnidadForm.php?IdConsorcio=<?=$Id?>'>New Unidad...</a>
</div>

<br />

<div>
<?
	$rsUnidades = UnidadGetByConsorcio($Id);

	$titles = array('Id', 'Nombre', 'Piso', 'Nro/Letra', 'Notas');

	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rsUnidades)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"UnidadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Piso']);
		DatumGenerate($reg['Numero']);
		DatumGenerate($reg['Notas']);
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsUnidades);
?>
</div>
<center>
<h2>Documentos de Consorcio</h2>
<div>
<a href='DocumentoConsorcioForm.php?IdConsorcio=<?=$Id?>'>New Documento de Consorcio...</a>
</div>

<br />

<div>
<?
	$rsDocumentosConsorcio = DocumentoConsorcioGetByConsorcio($Id);

	$titles = array('Id', 'Nombre', 'Descripción', 'Nombre de Archivo', 'Código Interno', 'Notas');

	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rsDocumentosConsorcio)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"DocumentoConsorcioView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Descripcion']);
		DatumGenerate($reg['NombreArchivo']);
		DatumGenerate($reg['Uuid']);
		DatumGenerate($reg['Notas']);
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsDocumentosConsorcio);
?>
</div>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
