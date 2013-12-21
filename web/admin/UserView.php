<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Usuario';
    
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
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');
	include_once($Page->Prefix.'includes/ConsorcioFunctions.inc.php');
	include_once($Page->Prefix.'includes/UnidadFunctions.inc.php');
	include_once($Page->Prefix.'includes/UnidadFunctionsEx.inc.php');
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctions.inc.php');

	DbConnect();
	
	SessionPut('UserLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = UserGetById($Id);
	$UserName = $rs['UserName'];
	$FirstName = $rs['FirstName'];
	$LastName = $rs['LastName'];
	$Email = $rs['Email'];
	$Genre = $rs['Genre'];
	$IsAdministrator = $rs['IsAdministrator'];
	$NoReserva = $rs['NoReserva'];
	$DateTimeInsert = $rs['DateTimeInsert'];
	$DateTimeUpdate = $rs['DateTimeUpdate'];
	$DateTimeLastLogin = $rs['DateTimeLastLogin'];
	$LoginCount = $rs['LoginCount'];
	$Verified = $rs['Verified'];
	$Notas = $rs['Notas'];


	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="UserList.php">Usuarios</a>
&nbsp;
&nbsp;
<a href="UserForm.php?Id=<?php echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="UserLoginAs.php?Id=<?php echo $Id; ?>">Ingresar como este Usuario</a>
&nbsp;
&nbsp;
<a href="UserPasswordForm.php?Id=<?php echo $Id; ?>">Cambia Contraseña</a>
&nbsp;
&nbsp;
<a href="UserDelete.php?Id=<?php echo $Id; ?>">Elimina</a>
</div>

<?php
	TableOpen();
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Código",$UserName);
	FieldStaticGenerate("Nombre",$FirstName);
	FieldStaticGenerate("Apellido",$LastName);
	FieldStaticGenerate("Correo Electrónico",$Email);
	FieldStaticGenerate("Género",$Genre);
	FieldStaticGenerate("Es Administrador",($IsAdministrator ? 'Sí' : 'No'));
	FieldStaticGenerate("Fecha/Hora Creación",$DateTimeInsert);
	FieldStaticGenerate("Fecha/Hora Ultima Actualización",$DateTimeUpdate);
	FieldStaticGenerate("Fecha/Hora Ultimo Ingreso",$DateTimeLastLogin);
	FieldStaticGenerate("Cantidad de Ingresos",$LoginCount);
	FieldStaticGenerate("Verificado",($Verified ? 'Sí' : 'No'));
	FieldStaticGenerate("Notas",$Notas);
	FieldStaticGenerate("Reserva SUM",($NoReserva ? 'No Puede' : 'Puede'));
	TableClose();
?>

<h2>Unidades del Usuario</h2>
<div class="actions">
<a href='UsuarioUnidadForm.php?IdUser=<?=$Id?>'>Asigna Unidad a Usuario</a>
</div>

<br />

<div>
<?php
	$rsUsuarioUnidades = UsuarioUnidadGetByUser($Id);

	$titles = array('Id', 'Consorcio', 'Unidad', 'Nombre', 'Usuario');

	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rsUsuarioUnidades)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"UsuarioUnidadView.php?Id=".$reg['Id']);
		$ColumnDescription = ConsorcioTranslate($reg['IdConsorcio']);
		DatumLinkGenerate($ColumnDescription, "ConsorcioView.php?Id=".$reg['IdConsorcio']);
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

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
