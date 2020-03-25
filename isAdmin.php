<?
	session_start();
  	
    include_once $_SERVER['DOCUMENT_ROOT'] . '/models/admins.php';

    $adminsClass = new Admins();
    $admin = $adminsClass->getOne(['name' => $_POST['name']]);

    if($admin['name'] === $_POST['name'] && $admin['password'] === $_POST['password']) {
    	$_SESSION['admin'] = "true";
    	echo 'true';
    } else {
        $_SESSION['admin'] = "false";
    	echo 'false';
    }
?>
