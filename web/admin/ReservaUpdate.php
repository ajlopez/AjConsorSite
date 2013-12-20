<?php
    include_once('../Configuration.inc.php');

	if (!$Page->Prefix)
		$Page->Prefix = '../';
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Validations.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	
	$DesdeFecha = DateMakeSql($DesdeFechaYear, $DesdeFechaMonth, $DesdeFechaDay);
	$HastaFecha = DateMakeSql($HastaFechaYear, $HastaFechaMonth, $HastaFechaDay);	
		
	if (empty($DesdeFecha))
		ErrorAdd('Debe ingresar Desde Fecha');		
	else if (!DateValidate($DesdeFechaYear, $DesdeFechaMonth, $DesdeFechaDay))
		ErrorAdd('Desde Fecha incorrecta');
	if (empty($DesdeHora))
		ErrorAdd('Debe ingresar Desde Hora');
		
	if (empty($HastaFecha))
		ErrorAdd('Debe ingresar Hasta Fecha');
	else if (!DateValidate($HastaFechaYear, $HastaFechaMonth, $HastaFechaDay))
		ErrorAdd('Hasta Fecha incorrecta');
	if (empty($HastaHora))
		ErrorAdd('Debe ingresar Hasta Hora');
		
	if ($DesdeFecha > $HastaFecha || ($DesdeFecha == $HastaFecha && $DesdeHora > $HastaHora))
		ErrorAdd('Rango Horario incorrecta');
		
	if (ErrorHas()) {
		include('ReservaForm.php');
		exit;
	}

	DbConnect();
	DbTransactionBegin();

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]reservas set
		DesdeFecha = '$DesdeFecha' , 
		DesdeHora = '$DesdeHora' , 
		HastaFecha = '$HastaFecha' , 
		HastaHora = '$HastaHora' , 
		IdUsoMultiple = $IdUsoMultiple , 
		IdUser = $IdUser 		";
		
	if (empty($Id))
	{
	}
	else
	{
	}

	if (!empty($Id))
		$sql .= " where Id=$Id";

	DbExecuteUpdate($sql);

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("ReservaLink");
	SessionRemove("ReservaLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
