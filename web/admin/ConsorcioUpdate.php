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

	DbConnect();
	DbTransactionBegin();

	if (empty($Codigo))
		ErrorAdd('Debe ingresar C�digo');
	if (empty($Nombre))
		ErrorAdd('Debe ingresar Nombre');
		
	if (ErrorHas()) {
		DbDisconnect();
		include('ConsorcioForm.php');
		exit;
	}

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]consorcios set
		Nombre = '$Nombre' , 
        Codigo = '$Codigo' , 
		Domicilio = '$Domicilio' , 
		Ciudad = '$Ciudad' , 
		Provincia = '$Provincia' , 
		Pais = '$Pais' , 
		Notas = '$Notas' 		";
		
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

	$Link = SessionGet("ConsorcioLink");
	SessionRemove("ConsorcioLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
