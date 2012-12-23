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
	include_once($Page->Prefix.'includes/UnidadFunctionsEx.inc.php');
	include_once($Page->Prefix.'includes/DocumentoConsorcioFunctions.inc.php');
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctions.inc.php');
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
<a href="ConsorcioForm.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="ConsorcioDelete.php?Id=<? echo $Id; ?>">Elimina</a>
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
<h2>Unidades</h2>
<div class="actions">
<a href='UnidadForm.php?IdConsorcio=<?=$Id?>'>Nueva Unidad</a>
</div>

<br />

<div>
<?
	$rsUnidades = UnidadGetByConsorcio($Id);

	$titles = array('Código', 'Nombre', 'Piso', 'Nro/Letra', 'Notas', 'Usuarios');

	TableOpen($titles);

	while ($reg=DbNextRow($rsUnidades)) {
		RowOpen();
        $IdUnidad = $reg['Id'];
		DatumLinkGenerate($reg['Codigo'],"UnidadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Piso']);
		DatumGenerate($reg['Numero']);
		DatumGenerate($reg['Notas']);
		$rsUnidadUsuarios = UsuarioUnidadGetByUnidad($reg['Id']);
		$datum = '';
		while ($regusu=DbNextRow($rsUnidadUsuarios)) {
			$userid = $regusu['IdUser'];
			$username = UserTranslate($userid);
			if ($datum)
				$datum .= "<br/>";
			$datum .= "<a href='UserView.php?Id=$userid'>$username</a>";
		}
		DbFreeResult($rsUnidadUsuarios);
        if (!$datum) {
            $datum .= "<a href='UserForm.php?IdConsorcio=$Id&IdUnidad=$IdUnidad&Back=consorcio'>Nuevo usuario...</a>";
        }
		DatumGenerate($datum);
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsUnidades);
?>
</div>

<h2>Documentos de Consorcio</h2>
<div class="actions">
<a href='DocumentoConsorcioForm.php?IdConsorcio=<?=$Id?>'>Nuevo Documento de Consorcio</a>
</div>

<br />

<div>
<?
	$rsDocumentosConsorcio = DocumentoConsorcioGetList("IdConsorcio = $Id", "Nombre desc");

	$titles = array('Id', 'Nombre', 'Descripción', 'Nombre de Archivo', 'Código Interno', 'Notas');

	TableOpen($titles);

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
<h2>Usuarios de Unidades</h2>
<div class="actions">
<a href='UsuarioUnidadForm.php?IdConsorcio=<?=$Id?>'>Asigna Usuario Existente a Unidad</a>
</div>

<br />

<div>
<?
	$rsUsuarioUnidades = UsuarioUnidadGetByConsorcio($Id);

	$titles = array('Id', 'Unidad', 'Nombre', 'Usuario');

	TableOpen($titles);

	while ($reg=DbNextRow($rsUsuarioUnidades)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"UsuarioUnidadView.php?Id=".$reg['Id']);
		$ColumnDescription = UnidadTranslateToCodigo($reg['IdUnidad']);
		DatumLinkGenerate($ColumnDescription, "UnidadView.php?Id=".$reg['IdUnidad']);
		$ColumnDescription = UnidadTranslate($reg['IdUnidad']);
		DatumGenerate($ColumnDescription);
		$ColumnDescription = UserTranslate($reg['IdUser']);
		DatumLinkGenerate($ColumnDescription, "UserView.php?Id=".$reg['IdUser']);
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsUsuarioUnidades);
?>
</div>

<h2>Usos Múltiples</h2>
<div class="actions">
<a href='UsoMultipleForm.php?IdConsorcio=<?=$Id?>'>Nuevo Uso Múltiple...</a>
</div>

<br />

<div>
<?
	$rsUsoMultiples = UsoMultipleGetByConsorcio($Id);

	$titles = array('Código', 'Nombre', 'Notas');

	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rsUsoMultiples)) {
		RowOpen();
		DatumLinkGenerate($reg['Codigo'],"UsoMultipleView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Notas']);
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsUsoMultiples);
?>
</div>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
