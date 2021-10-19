<?php 
	if (!session_id()) {
		session_start();
	}

	$ini = parse_ini_file('config.ini');
	$page = 'single-view'; 
	$title = preg_replace('(.*\/)', '', $_GET['view_name']);
	$username = $_GET['username'];
	$url = $ini['app_server_url'] . "/trusted?username=" . $username . "&target_site=";
	$view_name = $_GET['view_name'];
	$auth = $_SESSION['auth'] ? $_SESSION['auth'] : 0;
	$site_id = $_GET['site_id'];
	$token = $_GET['token'];
?>

<?php include_once('./includes/header.php'); ?>
<?php include_once('./includes/navbar.php'); ?>

<?php
	if ($auth == 0) {
		$_SESSION['auth'] = 1;
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_HTTPHEADER => array(
		    'Accept: application/json',
		    'Content-Type: application/xml'
		  )
		));

		$return = curl_exec($curl);
		curl_close($curl);
	}
?>

  	
    <div class="container m-tp-25 m-bt-50 wrapper flex-grow-1" >
    	<h1 class="white-text text-center"><?php echo $title; ?></h1>
    	<div class="row justify-content-center">
    		<?php  if($auth == 0) : ?>
	          <iframe class="m-tp-25" src="<?php echo $ini['app_server_url']; ?>/trusted/<?php echo $return; ?>/views/<?php echo str_replace('/sheets', '', $view_name); ?>?iframeSizedToWindow=true&amp;:embed=y&amp;:showAppBanner=false&amp;:display_count=no&amp;:showVizHome=no" width="900" height="700"></iframe>
	        <?php  else: ?>
	          <iframe class="m-tp-25" src="<?php echo $ini['app_server_url']; ?>/views/<?php echo str_replace('/sheets', '', $view_name); ?>?iframeSizedToWindow=true&amp;:embed=y&amp;:showAppBanner=false&amp;:display_count=no&amp;:showVizHome=no" width="900" height="700"></iframe>
	        <?php  endif; ?>
    	</div>
      </div>
    </div>

<?php include_once('./includes/footer.php'); ?>