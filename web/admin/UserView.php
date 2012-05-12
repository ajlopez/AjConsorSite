<?
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
	$DateTimeInsert = $rs['DateTimeInsert'];
	$DateTimeUpdate = $rs['DateTimeUpdate'];
	$DateTimeLastLogin = $rs['DateTimeLastLogin'];
	$LoginCount = $rs['LoginCount'];
	$Verified = $rs['Verified'];
	$Notas = $rs['Notas'];


	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<center>

<p>
<a href="UserList.php">Usuarios</a>
&nbsp;
&nbsp;
<a href="UserForm.php?Id=<? echo $Id; ?>">Update</a>
&nbsp;
&nbsp;
<a href="UserDelete.php?Id=<? echo $Id; ?>">Delete</a>
</p>

<p>

<table cellspacing=1 cellpadding=2 class="form" width="80%">
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Código",$UserName);
	FieldStaticGenerate("Nombre",$FirstName);
	FieldStaticGenerate("Apellido",$LastName);
	FieldStaticGenerate("Correo Electrónico",$Email);
	FieldStaticGenerate("Género",$Genre);
	FieldStaticGenerate("Es Administrador",$IsAdministrator);
	FieldStaticGenerate("Fecha/Hora Creación",$DateTimeInsert);
	FieldStaticGenerate("Fecha/Hora Ultima Actualización",$DateTimeUpdate);
	FieldStaticGenerate("Fecha/Hora Ultimo Ingreso",$DateTimeLastLogin);
	FieldStaticGenerate("Cantidad de Ingresos",$LoginCount);
	FieldStaticGenerate("Verificado",$Verified);
	FieldStaticGenerate("Notas",$Notas);
?>
</table>


</center>


<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
