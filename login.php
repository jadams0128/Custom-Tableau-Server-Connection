<?php
	ob_start();

	$ini = parse_ini_file('config.ini');

	// grab recaptcha library
	require_once "./recaptchalib.php";

	// your secret key
	$secret = "6LfgAc4cAAAAAEoDGpg6v5Xwrqhgl5QQKqUY3nrt";
	 
	// empty response
	$response = null;
	 
	// check secret key
	$reCaptcha = new ReCaptcha($secret);

	// if submitted check response
	if ($_POST["g-recaptcha-response"]) {
	    $response = $reCaptcha->verifyResponse(
	        $_SERVER["REMOTE_ADDR"],
	        $_POST["g-recaptcha-response"]
	    );
	}


	if ($response != null && $response->success) {
	  	if(isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$url = $ini['app_server_url'] . '/api/3.13/auth/signin';
			$input_data = '<tsRequest>
			      <credentials name="' . $username . '" password="' . $password . '" >
			        <site contentUrl="" />
			      </credentials>
			  </tsRequest>';
	      
	      	
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
				CURLOPT_POSTFIELDS => $input_data,
				CURLOPT_HTTPHEADER => array(
				  'Accept: application/json',
				  'Content-Type: application/xml'
				),
			));

			$return = curl_exec($curl);
			$response = json_decode($return);
			curl_close($curl);
			unset($curl);

			$msg = '';

			if (isset($response->error)) {
				$msg = $response->error->detail;
				header('Location: ./index.php?message=' . $msg);
				ob_end_flush();
			}else{
				$site_id = $response->credentials->site->id;
				$token = $response->credentials->token;
				
				header('Location: ' . "/dashboard.php?username=" . $username . "&site_id=" . $site_id . "&token=" . urlencode($token));
				ob_end_flush();
			}
	  	}
	} else {
		if ($response == null) {
			$msg = "Please make sure captcha box is checked!";
		}
		header('Location: ./index.php?message=' . $msg);
	}
?>