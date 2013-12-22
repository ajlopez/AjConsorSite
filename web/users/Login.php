<?php
    include_once('../Configuration.inc.php');

	$Page->Title = "Ingreso de Usuario";
	$Page->Prefix = '../';

	include_once($Page->Prefix.'includes/Configuration.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	
	if ($Cfg['UserLogin'])
		PageAbsoluteRedirect($Cfg['UserLogin']);
	
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	
	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div>
Ingrese su c&oacute;digo de usuario y su contrase&ntilde;a.
</div>

<?php
	ErrorRender();
?>


<form action="LoginValidate.php" method=post>

<?php
	TableOpen();
	FieldTextGenerate("UserName","Código de Usuario",$Codigo,16);
	FieldPasswordGenerate("Password","Contraseña",$Contrasenia,16);
	FieldOkGenerate();
	TableClose();
?>
</form>

<p>
Si no es usuario, puede <a href="Register.php">registrarse</a> gratuitamente en l&iacute;nea.
</p>

</center>

<?php
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>

