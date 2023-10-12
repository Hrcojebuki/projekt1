<!DOCTYPE html>
<html>

<head>
    <title><?php echo TITLE; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./public/css/style.css" rel="stylesheet">
    <link href="./public/vendor/css/bootstrap@5.2.1.min.css" rel="stylesheet">
    <script defer src="./public/vendor/js/bootstrap@5.2.1.bundle.min.js"></script>
    <script defer src="./public/vendor/js/moment@2.29.4.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?page=welcome">Project I</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php 
                        $sites = NULL;

                        if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])){
                            $sites = Permissions::get_pages_show($_SESSION['role']);
                        } else $sites = ["welcome"];

                        foreach ($sites as $file) {
                            $current = isset($_GET["page"]) && $file == $_GET["page"] ? "active":"";
                            $file_c = ucfirst($file);
                            echo "<li class='nav-item'><a class='nav-link {$current}' aria-current='page' href='index.php?page={$file}'>{$file_c}</a></li>";
                        }
                    ?>
                </ul>

                <div class="col-md-3 text-end">
                    <?php
                    if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])) {
                        echo "<a type='button' href='./index.php?page=auth&method=logout' class='btn btn-outline-primary me-2'>Log out</a>";
                    } else {
                        echo "<a type='button' href='./index.php?page=auth' class='btn btn-outline-primary me-2'>Log in</a>";
                    }?>
                 </div>
            </div>
        </div>
    </nav>