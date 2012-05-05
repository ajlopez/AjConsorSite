<?
	$Page->Title = "Ingreso de Usuario";
	$Page->Prefix = '../';
	include_once($Page->Prefix.'includes/Header.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
?>

<center>

<p>
Por favor, ingrese su c&oacute;digo de usuario y su contrase&ntilde;a.
</p>

<p>

<form action="loginvalidate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form">
<?
	FieldTextGenerate("UserName","Código de Usuario",$Codigo,16);
	FieldPasswordGenerate("Password","Contraseña",$Contrasenia,16);
?>
</table>
<input type="submit" value="Aceptar">
</form>

</p>

<p>
Si no es usuario, puede <a href="Register.php">registrarse</a> gratuitamente en l&iacute;nea.
</p>

</center>

<?
	include_once($Page->Prefix.'includes/footer.inc.php');
?>

