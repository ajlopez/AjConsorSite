<?
	include_once($Page->Prefix.'includes/Users.inc.php');
?>
<br>

<?
function MenuLeftOpen($title)
{
?>
<div>
<table class="menu" cellspacing=1 cellpadding=2>
<tr>
<td align=center class="menutitle">
<? echo $title; ?>
</td>
</tr>
<tr>
<td valign="top" class="menuoption">
<?
}

function MenuLeftOption($text,$link)
{
	global $Page;

	echo "&nbsp;";
	echo "<a target='_top' href='$Page->Prefix$link' class='menuoption'>$text</a>";
	echo "<br>\n";
}

function MenuLeftClose()
{
?>
</td>
</tr>
</table>

<br>

</div>

<?
}
?>

<?

	MenuLeftOpen($Cfg['SiteName']);
	MenuLeftOption('Principal','index.php');
	MenuLeftClose();

	MenuLeftOpen('Entidades');
	MenuLeftOption('Consorcios','admin/ConsorcioList.php');
	MenuLeftOption('Unidades','admin/UnidadList.php');
	MenuLeftOption('Documentos','admin/DocumentoConsorcioList.php');
	MenuLeftOption('Usuarios','admin/UserList.php');
	MenuLeftClose();

	if (UserIdentified()) {
		MenuLeftOpen(UserName());
		MenuLeftOption('Perfil', 'users/User.php');
		If (UserIsAdministrator()) {
			MenuLeftOption('Administrator','admin/index.php');
		}
		MenuLeftOption('Salir','users/Logout.php');
		MenuLeftClose();
	}
	else {
		MenuLeftOpen('Usuarios');
		MenuLeftOption('Ingreso','users/Login.php');
		MenuLeftOption('Registración','users/Register.php');
		MenuLeftClose();
	}
?>
