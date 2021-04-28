<?php
  include 'config.php';

  $home = $root.'/liked/favs.php';
  $search = $root.'/search.php';
  $uploadSong = $root.'/upload-song.php';
  $uploadAlbum = $root.'/upload-album.php';
  $logout = $root.'/logout.php';

  $header_eles = '';

  $header_eles .= '<a class="navbar-brand flex-grow-1" href="' .$home. '">Music App</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <form class="d-flex mx-lg-auto" action="'.$search.'" method="POST">
    <input class="form-control me-2" name="searchBar" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" name="seacrhButton" type="submit">Search</button>
  </form>
  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="'.$uploadSong.'">Upload Song</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="'.$uploadAlbum.'">Upload Album</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="'.$logout.'">Logout</a>
      </li>
    </ul>
  </div>';

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <title>Music App</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <?php print("$header_eles") ?>
  </div>
</nav>
