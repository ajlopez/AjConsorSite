<?
	$Page->Title = 'Confirma Eliminar Consorcio';
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
	include_once($Page->Prefix.'includes/UnidadFunctionsEx.inc.php');
	include_once($Page->Prefix.'includes/DocumentoConsorcioFunctions.inc.php');
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctions.inc.php');
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctionsEx.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');
	include_once($Page->Prefix.'includes/UsoMultipleFunctions.inc.php');

	DbConnect();
	
	SessionPut('ConsorcioLink',PageCurrent());
	SessionPut('UnidadLink',PageCurrent());
	SessionPut('UsoMultipleLink',PageCurrent());

	if (!isset($Id))
		PageExit();

	$rs = ConsorcioGetById($Id);
    $Codigo = $rs['Codigo'];
	$Nombre = $rs['Nombre'];
	$Domicilio = $rs['Domicilio'];
	$Ciudad = $rs['Ciudad'];
	$Provincia = $rs['Provincia'];
	$Pais = $rs['Pais'];
	$Notas = $rs['Notas'];


	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="ConsorcioList.php">Consorcios</a>
&nbsp;
&nbsp;
<a href="ConsorcioView.php?Id=<? echo $Id; ?>">Cancela Elininación</a>
&nbsp;
&nbsp;
<a href="ConsorcioDelete.php?Id=<? echo $Id; ?>">Confirma Eliminación</a>
</div>
<?
	TableOpen('','80%');
	FieldStaticGenerate("Código",$Codigo);
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Domicilio",$Domicilio);
	FieldStaticGenerate("Ciudad",$Ciudad);
	FieldStaticGenerate("Provincia",$Provincia);
	FieldStaticGenerate("País",$Pais);
	FieldStaticGenerate("Notas",$Notas);
	TableClose();
?>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
