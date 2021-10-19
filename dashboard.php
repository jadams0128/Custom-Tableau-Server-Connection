<?php $page = 'dashboard';  $title = "Dashboards"; $ini = parse_ini_file('config.ini'); ?>

<?php include_once('./includes/header.php'); ?>
<?php include_once('./includes/navbar.php'); ?>

  <div class="container wrapper flex-grow-1" >
      <h1 class="m-tp-50 text-center">Tableau Dashboards</h1>
      <div class="row">
        <?php
          $username = $_GET['username'];
          $site_id = $_GET['site_id'];
          $token = $_GET['token'];
          $url = $ini['app_server_url'] . '/api/3.13/sites/' . $site_id . '/views';
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Accept: application/json',
              'Content-Type: application/xml',
              'X-Tableau-Auth: ' . $token . ''
            ),
          ));


          $return = curl_exec($curl);
          $response = json_decode($return);
          curl_close($curl);

        ?>
        <?php if(!isset($response->error)): ?>
          <?php foreach ($response->views->view as $key => $value): ?>
            <?php 
              $curl = curl_init();
              $url = $ini['app_server_url'] . '/api/3.13/sites/'. $site_id . '/views/' . $value->id . '/image';
              curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Accept: application/json',
                  'X-Tableau-Auth: ' . $token . ''
                ),
              ));

              $image_response = curl_exec($curl);
              curl_close($curl);
              $error_check = json_decode($image_response);
              $image = 'data:image/gif;base64,' . base64_encode($image_response);

            ?>

            <?php if (!isset($error_check->error)): ?>
              <div class="m-tp-25 view-card col-6 col-md-4 text-center">
                <h5><?php echo $value->name; ?></h5>
                <a href="/single-view.php?username=<?php echo $username; ?>&view_name=<?php echo $value->contentUrl; ?>&token=<?php echo $token; ?>&site_id=<?php echo $site_id; ?>">
                  <img src="<?php echo $image; ?>">
                </a>
              </div>
            <?php endif ?>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
  </div>

<?php include_once('./includes/footer.php'); ?>