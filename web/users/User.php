<?
	$Page->Title = 'Mis Datos';
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

	include_once($Page->Prefix.'includes/Users.inc.php');
	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');
	include_once($Page->Prefix.'includes/UsuarioUnidadFunctions.inc.php');

	DbConnect();
	
	SessionPut('UserLink',PageCurrent());

    $Id = UserId();

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

<div class="actions">
<a href="UserForm.php">Actualiza Datos</a>
&nbsp;
&nbsp;
<a href="UserPassword.php">Cambia Contraseña</a>
</div>

<?
	TableOpen();
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Código",$UserName);
	FieldStaticGenerate("Nombre",$FirstName);
	FieldStaticGenerate("Apellido",$LastName);
	FieldStaticGenerate("Correo Electrónico",$Email);
	TableClose();
?>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
