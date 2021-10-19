<header id="site-header">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"><img src="./images/logo.jpeg" alt="logo"></a>
      <?php if ($page != 'login') : ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      <?php endif; ?>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php if ($page == 'single-view') : ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./dashboard.php?username=<?php echo $username; ?>&site_id=<?php echo $site_id; ?>&token=<?php echo urlencode($token); ?>">Dashboard</a>
          </li>
        <?php endif; ?>
        <?php if ($page != 'login') : ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./logout.php">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</header><!-- /header -->
