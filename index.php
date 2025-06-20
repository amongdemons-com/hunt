<?php 
session_start();
include "data/config.php"; 

// Set session user_id if posted
if (isset($_POST['user_id'])) {
    $_SESSION['user_id'] = $_POST['user_id'];

    $uid = $_SESSION['user_id'];
    $mysqli = new mysqli($hostname, $username, $password, $database);
    if ($mysqli->connect_error) {
        echo json_encode(['error' => 'db']);
        exit;
    }
    $stmt = $mysqli->prepare("SELECT username, xp, hp, attack FROM users WHERE id = ?");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $stmt->bind_result($username, $xp, $hp, $attack);
    if ($stmt->fetch()) {
        // Save user info in session
        $_SESSION['username'] = $username;
        $_SESSION['xp'] = $xp;
        $_SESSION['hp'] = $hp;
        $_SESSION['attack'] = $attack;

        //echo json_encode(['username' => $username, 'xp' => $xp, 'hp' => $hp, 'attack' => $attack]);
    } else {
        //echo json_encode(['username' => '', 'xp' => 0, 'hp' => 0, 'attack' => 0]);
    }
    $stmt->close();
    $mysqli->close();
}
?>
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="data/main.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
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
                        <span id="xp"><?php echo isset($_SESSION['hp']) ? htmlspecialchars($_SESSION['hp']) : ''; ?></span> / <span id="xp_max">100</span>
                    </div>
                    <div class="p-2">
                        <h3>Health:</h3>
                        <span id="hp"><?php echo isset($_SESSION['hp']) ? htmlspecialchars($_SESSION['hp']) : ''; ?></span> / <span id="hp_max">100</span>
                    </div>
                    <div class="p-2">
                        <h3>Attack:</h3>
                        <span id="attack">
                            <?php echo isset($_SESSION['attack']) ? htmlspecialchars($_SESSION['attack']) : ''; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-2 w-100">
                <h1 class="text-center">Among Demons Hunt</h1>
                <p class="text-center">This is a placeholder for the game content. The game will be developed in the future.</p>
                <div class="text-center">
                    <img src="/data/img/amongdemons_logo_250x250.png" alt="Among Demons Logo" class="img-fluid">
                </div>
            </div>
        </div>
    </main>
    <script>
    function loadUserInfo(uid) {
        if (!uid.match(/^\d+$/)) {
            document.getElementById('username').textContent = '';
            document.getElementById('xp').textContent = '0';
            document.getElementById('hp').textContent = '0';
            document.getElementById('attack').textContent = '0';
            return;
        }
        fetch('?ajax_user=' + encodeURIComponent(uid))
            .then(r => r.json())
            .then(data => {
                document.getElementById('username').textContent = data.username || '';
                document.getElementById('xp').textContent = data.xp || 0;
                document.getElementById('hp').textContent = data.hp || 0;
                document.getElementById('attack').textContent = data.attack || 0;
            });
    }
    </script>
  </body>
</html>