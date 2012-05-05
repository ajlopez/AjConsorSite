<?
	$Page->Prefix = '../';
	include_once($Page->Prefix.'includes/connection.inc.php');
	include_once($Page->Prefix.'includes/users.inc.php');
	include_once($Page->Prefix.'includes/session.inc.php');
	include_once($Page->Prefix.'includes/validations.inc.php');
	include_once($Page->Prefix.'includes/errors.inc.php');

	if (empty($UserName))
		ErrorAdd('Debe ingresar Código');

	if (empty($Password))
		ErrorAdd('Debe ingresar Contraseña');

	if ($Password2 != $Password)
		ErrorAdd('No coinciden las contraseñas ingresadas');

	if (!DateValidate($DateBornYear,$DateBornMonth,$DateBornDay))
		$mensaje .= "Fecha de Nacimiento inválida<br>";
	else
		$DateBorn = DateMakeSql($DateBornYear,$DateBornMonth,$DateBornDay);

	if (!SexValidate($IdGenre))
		ErrorAdd('Debe ingresar Sexo');

	if (!$Email)
		ErrorAdd('Debe ingresar Email');

	if (!$IdCountry)
		ErrorAdd('Debe ingresar Pais');

	Connect();

	$sql = "Select * from users where UserName = '$UserName'";
	$res = mysql_query($sql);

	if ($res && mysql_num_rows($res)>0) {
		ErrorAdd('Usuario existente');
	}

	if (ErrorHas()) {
		Disconnect();
		include('register.php');
		exit;
	}

	mysql_free_result($res);

	$IdCountry += 0;
	$IdGenre += 0;

	$sql = "Insert users set UserName = '$UserName',
			Password = '$Password',
			FirstName = '$FirstName',
			LastName = '$LastName',
			Email = '$Email',
			IdCountry = $IdCountry,
			State = '$State',
			City = '$City',
			ZipCode = '$ZipCode',
			DateBorn = '$DateBorn',
			IdGenre = $IdGenre,
			Reference = '$Reference',
			Comments = '$Comments',
			DateTimeInsert = now()
			";

	mysql_query($sql);

	$user->Id = mysql_insert_id;
	$user->UserName = $UserName;
	$user->FirstName = $FirstName;
	$user->LastName = $LastName;

	UserLogin($user);

	Disconnect();

	$UserLink = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($UserLink);
	exit;
?>