<?
	$Page->Title = 'UsoMultiple';
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
	include_once($Page->Prefix.'includes/UsoMultipleFunctions.inc.php');
	include_once($Page->Prefix.'includes/ReservaFunctions.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');

	DbConnect();
	
	SessionPut('UsoMultipleLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = UsoMultipleGetById($Id);
	$Nombre = $rs['Nombre'];
	$Codigo = $rs['Codigo'];
	$IdConsorcio = $rs['IdConsorcio'];
	$Notas = $rs['Notas'];

	$TranslationIdConsorcio = "<a href='ConsorcioView.php?Id=".$IdConsorcio. "'>".TranslateDescription("$Cfg[SqlPrefix]consorcios",$IdConsorcio,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="UsoMultipleList.php">UsoMultiples</a>
&nbsp;
&nbsp;
<a href="UsoMultipleForm.php?Id=<? echo $Id; ?>">Update</a>
&nbsp;
&nbsp;
<a href="UsoMultipleDelete.php?Id=<? echo $Id; ?>">Delete</a>
</div>

<?
	TableOpen('', '80%');
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Codigo",$Codigo);
	FieldStaticGenerate("Consorcio",$TranslationIdConsorcio);
	FieldStaticGenerate("Notas",$Notas);
	TableClose();
?>


<h2>Reservas</h2>
<div class="actions">
<a href='ReservaForm.php?IdUsoMultiple=<?=$Id?>'>New Reserva...</a>
</div>

<br />

<div>
<?
	$rsReservas = ReservaGetByUsoMultiple($Id);

	$titles = array('Id', 'DesdeFecha', 'DesdeHora', 'HastaFecha', 'HastaHora', 'Usuario');

	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rsReservas)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"ReservaView.php?Id=".$reg['Id']);
		DatumGenerate($reg['DesdeFecha']);
		DatumGenerate($reg['DesdeHora']);
		DatumGenerate($reg['HastaFecha']);
		DatumGenerate($reg['HastaHora']);
		$ColumnDescription = UserTranslate($reg['IdUser']);
		DatumLinkGenerate($ColumnDescription, "UserView.php?Id=".$reg['IdUser']);
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsReservas);
?>
</div>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
