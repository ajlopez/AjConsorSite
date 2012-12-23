<?
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

	if (empty($UserName))
		ErrorAdd('Debe ingresar Código');
		
	if (empty($Id)) {
		if (empty($Password))
			ErrorAdd('Debe ingresar Contraseña');
		if (empty($Password2))
			ErrorAdd('Debe ingreser Reingreso de Contraseña');
		if ($Password <> $Password2)
			ErrorAdd('No coinciden las Contraseñas');
	}
	
	if (empty($FirstName))
		ErrorAdd('Debe ingresar Nombre');
	if (empty($LastName))
		ErrorAdd('Debe ingresar Apellido');
        
	if (ErrorHas()) {
		include('UserForm.php');
		exit;
	}

	DbConnect();
	DbTransactionBegin();

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]users set
		UserName = '$UserName' , 
		FirstName = '$FirstName' , 
		LastName = '$LastName' , 
		Email = '$Email' , 
		Genre = '$Genre' , 
		IsAdministrator = '$IsAdministrator' , 
		NoReserva = '$NoReserva' ,
		Verified = '$Verified' , 
		Notas = '$Notas' 		";
		
	if (empty($Id))
	{
		$sql .= ", Password = Password('$Password') ";	
		$DateTimeInsert = date('Y-m-d H:i:s');
		$sql .= ", DateTimeInsert = '$DateTimeInsert'";
	}
	else
	{
		$DateTimeUpdate = date('Y-m-d H:i:s');
		$sql .= ", DateTimeUpdate = '$DateTimeUpdate'";
	}

	if (!empty($Id))
		$sql .= " where Id=$Id";

	DbExecuteUpdate($sql);
    
    if (empty($Id)) {
        $NewIdUser = DbLastId();
        if ($IdUnidad && $IdConsorcio) {
            $sql = "insert $Cfg[SqlPrefix]userunidades set
                IdUser = $NewIdUser , 
                IdConsorcio = $IdConsorcio , 
                IdUnidad = $IdUnidad 		";
            DbExecuteUpdate($sql);
        }
    }

	DbTransactionCommit();
	DbDisconnect();
    
    if ($Back == 'consorcio' && $IdConsorcio)
        PageRedirect("admin/ConsorcioView.php?Id=$IdConsorcio");

    if ($Back == 'unidad' && $IdUnidad)
        PageRedirect("admin/UnidadView.php?Id=$IdUnidad");

	$Link = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
