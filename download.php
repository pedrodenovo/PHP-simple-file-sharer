<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Download Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <style>
        /* Styles for the download card */
        .download-card {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .download-card h2 {
            margin-bottom: 20px;
        }

        .download-card .btn-download {
            display: block;
            width: 100%;
        }
    </style>
    <script>
        function redirectToSite() {
            window.open("https://demo.sunrise-studio.site/files/<?= $_GET['path'] ?>/<?= $_GET['file'] ?>", "_blank");
            window.location.href = "https://demo.sunrise-studio.site/download.php";
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/pages/home.php">Sunrise Files</a>
        </div>
    </nav>
    <?php
    if (isset($_GET['file']) && isset($_GET['path'])) {
        ?>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <script type="text/javascript">
                        atOptions = {
                            'key': '366b8eea6a1814812a6a90fa348709d8',
                            'format': 'iframe',
                            'height': 250,
                            'width': 300,
                            'params': {}
                        };
                        document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://revelationschemes.com/366b8eea6a1814812a6a90fa348709d8/invoke.js"></scr' + 'ipt>');
                    </script>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="text-center download-card">
                        <?php
                        echo '<h2>' . $_GET['file'] . '</h2>'; ?>
                        <a class="btn btn-primary btn-download" target="_blank" onclick="redirectToSite()">Download</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Your text</h1>
                    <p class="lead text-body-secondary">
                    </p>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <script type="text/javascript">
                        atOptions = {
                            'key': '366b8eea6a1814812a6a90fa348709d8',
                            'format': 'iframe',
                            'height': 250,
                            'width': 300,
                            'params': {}
                        };
                        document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://revelationschemes.com/366b8eea6a1814812a6a90fa348709d8/invoke.js"></scr' + 'ipt>');
                    </script>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="text-center download-card">
                        <h2>Thank you for downloading this file!</h2>
                    </div>
                </div>
            </div>
        </div>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Your text</h1>
                    <p class="lead text-body-secondary">
                    </p>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
</body>

</html>