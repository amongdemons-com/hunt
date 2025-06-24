<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" class="h-100">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game - Among Demons</title>
    <meta name="description" content="We converted the first demon models into Stargaze NFTs. Owning a piece makes you a supporter of the Among Demons project.">
    <meta name="author" content="Among Demons">
    <meta property="og:image" content="https://amongdemons.com/nfts/demons/faq/learnmore_founders_collection.png" />
    <link rel="icon" href="/data/img/amongdemons.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="data/main.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="data/main.js"></script>
  </head>
  <body class="d-flex flex-column h-100">    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/data/img/amongdemons_logo_250x250.png" width="45" height="45" alt="Among Demons Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" method="post" action="">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" id="user_id" name="user_id" class="form-control" placeholder="User ID" aria-label="User ID" aria-describedby="basic-addon1" value="<?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : ''; ?>"/>
                    <button class="btn btn-primary" type="submit">Load</button>
                </div>
            </form>
            </div>
        </div>
    </nav>

    <main class="container-fluid flex-fill p-0">
        <div class="d-flex h-100">
            <div class="p-2 flex-shrink-1 border-end border-1 px-3">
                <h3>Resources</h3>
                <div class="d-flex flex-column mb-3">
                    <div class="p-2">
                        <span id="username"></span>
                    </div>
                    <div class="p-2">
                        <h3>Level:</h3>
                        <span id="xp">-</span> / <span id="xp_max">100</span>
                    </div>
                    <div class="p-2">
                        <h3>Health:</h3>
                        <span id="hp">-</span> / <span id="hp_max">100</span>
                    </div>
                    <div class="p-2">
                        <h3>Attack:</h3>
                        <span id="attack">
                            -
                        </span>
                    </div>
                </div>
            </div>
            <div class="py-2 ps-3 pe-2 w-100">
                <h3 class="">Among Demons Hunt</h3>
                <p class="">You can start the hunt by clicking the button below. This will simulate a hunt and update your resources.</p>
                <div class="card flex-row" style="width: 50%;">
                    <div style="height: 6rem; width: 6rem; overflow: hidden;" class="flex-shrink-1">
                        <img src="/nfts/demons/models/1.png" class="card-img-top" style="width: 100%; height: 100%; object-fit: cover; object-position: top; transform: scale(2) translateY(-10%); transform-origin: top;" alt="...">
                    </div>
                    <div class="card-body d-flex flex-row align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title fs-3 pe-3">
                                <span class="ad-legendary">Legendary</span>
                                Boof Nitza
                            </h5>
                            <div>
                                <span class="badge bg-secondary">Level 1</span>
                                <span class="badge bg-success">HP: 100</span>
                                <span class="badge bg-warning text-dark">Attack: 10</span>
                            </div>
                        </div>
                        <button class="btn btn-primary" id="start_hunt">Hunt</button>
                    </div>
                </div>


                <div id="hunt_status"></div>
            </div>
        </div>
    </main>
  </body>
</html>