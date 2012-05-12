<?
	include_once($Page->Prefix.'includes/Users.inc.php');
?>
<br>

<center>

<?
function MenuLeftOpen($title)
{
?>
<p>
<table class="menu" cellspacing=1 cellpadding=2 width="95%">
<tr>
<td align=center class="menutitle">
<? echo $title; ?>
</td>
</tr>
</tr>
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
<br>

</p>

<?
}
?>

<?

	MenuLeftOpen($Cfg['SiteName']);
	MenuLeftOption('Main','index.php');
	MenuLeftClose();

	MenuLeftOpen('Entities');
	MenuLeftOption('Consorcios','admin/ConsorcioList.php');
	MenuLeftOption('Unidades','admin/UnidadList.php');
	MenuLeftOption('Documentos de Consorcio','admin/DocumentoConsorcioList.php');
	MenuLeftOption('Usuarios','admin/UserList.php');
	MenuLeftClose();

	if (UserIdentified()) {
		MenuLeftOpen(UserName());
		MenuLeftOption('My Page', 'users/User.php');
		If (UserIsAdministrator()) {
			MenuLeftOption('Administrator','admin/index.php');
		}
		MenuLeftOption('Logout','users/Logout.php');
		MenuLeftClose();
	}
	else {
		MenuLeftOpen('Users');
		MenuLeftOption('Login','users/Login.php');
		MenuLeftOption('Register','users/Register.php');
		MenuLeftClose();
	}
?>
