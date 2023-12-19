<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php"><?php echo lang('Home_admin') ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#app-nav" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active"href="#"><?php echo lang('lang_category') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"href="#"><?php echo lang('Item') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"href="member.php"><?php echo lang('membars') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"href="#"><?php echo lang('statistics') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"href="#"><?php echo lang('LOGS') ?></a>
        </li>
        
      </ul>

      <li class="nav dropdown justify-content-end">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             mohamed
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="member.php?do=edit&userid=<?php echo $_SESSION['id'] ?>">Edit profile</a></li>
            <li><a class="dropdown-item" href="#">setting</a></li>
            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
          </ul>
        </li>
    </div>
  </div>
</nav>