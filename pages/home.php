<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/pages/home.php">Sunrise Files</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/modulos/logout.php">Exit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="container">
            <h2 class="text-center mb-4">File Upload</h2>
            <div class="card">
                <div class="card-body">
                    <?php
                    // Verifica se o formulário foi submetido
                    if (isset($_POST['submit'])) {
                        // Diretório de destino para salvar os arquivos
                        $uploadDir = '../files/';

                        // Verifica se o diretório de destino existe. Se não, cria o diretório.
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0777, true);
                        }

                        // Verifica se um arquivo foi selecionado
                        if (isset($_FILES['file'])) {
                            $file = $_FILES['file'];

                            // Verifica se não ocorreu algum erro durante o upload
                            if ($file['error'] === 0) {
                                $fileName = $file['name'];
                                $fileSize = $file['size'];
                                $fileTmp = $file['tmp_name'];

                                // Gera um nome aleatório para a pasta de destino
                                $randomName = generateRandomString(16);

                                // Cria a pasta de destino com o nome aleatório
                                $destinationDir = $uploadDir . $randomName . '/';
                                mkdir($destinationDir, 0777, true);

                                // Move o arquivo para a pasta de destino
                                $destination = $destinationDir . $fileName;
                                move_uploaded_file($fileTmp, $destination);

                                // Redireciona para a mesma página, evitando o reenvio do arquivo ao atualizar
                                header('Location: /pages/home.php');
                                exit;
                            } else {
                                echo '<div class="alert alert-danger" role="alert">An error occurred while uploading the file.</div>';
                            }
                        }
                    }

                    // Função para gerar uma string aleatória com o comprimento especificado
                    function generateRandomString($length)
                    {
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, strlen($characters) - 1)];
                        }
                        return $randomString;
                    }
                    ?>

                    <form method="POST" action="/pages/home.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="file" class="form-label">Select a file:</label>
                            <input type="file" id="file" name="file" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
            <h2 class="text-center mb-4">File Management</h2>
            <div class="card">
                <div class="card-body">
                    <?php
                    // Diretório de destino para salvar os arquivos
                    $uploadDir = '../files/';

                    // Verifica se o diretório de destino existe
                    if (!is_dir($uploadDir)) {
                        echo '<div class="alert alert-warning" role="alert">No files have been uploaded yet..</div>';
                    } else {
                        // Lista as pastas (pasta aleatória) no diretório
                        $folders = scandir($uploadDir);

                        if (count($folders) <= 2) {
                            echo '<div class="alert alert-warning" role="alert">No files have been uploaded yet.</div>';
                        } else {
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-bordered table-hover">';
                            echo '<thead><tr><th>File name</th><th>Size</th><th>Actions</th></tr></thead>';
                            echo '<tbody>';

                            foreach ($folders as $folder) {
                                if ($folder !== '.' && $folder !== '..') {
                                    $folderPath = $uploadDir . $folder;
                                    $files = scandir($folderPath);

                                    foreach ($files as $file) {
                                        if ($file !== '.' && $file !== '..') {
                                            $filePath = $folderPath . '/' . $file;
                                            $fileSize = formatSizeUnits(filesize($filePath));

                                            echo '<tr>';
                                            echo '<td>' . $file . '</td>';
                                            echo '<td>' . $fileSize . '</td>';
                                            echo '<td><a target="_blank" href="https://demo.sunrise-studio.site/download.php?path=' . $folder . '&file=' . $file . '" class="btn btn-primary btn-sm">Link</a> <button class="btn btn-danger btn-sm" onclick="deleteFile(\'' . $folderPath . '\', \'' . $file . '\')">Delete</button></td>';
                                            echo '</tr>';
                                        }
                                    }
                                }
                            }

                            echo '</tbody></table>';
                            echo '</div>';
                        }
                    }

                    function formatSizeUnits($bytes)
                    {
                        if ($bytes >= 1073741824) {
                            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                        } elseif ($bytes >= 1048576) {
                            $bytes = number_format($bytes / 1048576, 2) . ' MB';
                        } elseif ($bytes >= 1024) {
                            $bytes = number_format($bytes / 1024, 2) . ' KB';
                        } elseif ($bytes > 1) {
                            $bytes = $bytes . ' bytes';
                        } elseif ($bytes == 1) {
                            $bytes = $bytes . ' byte';
                        } else {
                            $bytes = '0 bytes';
                        }

                        return $bytes;
                    }
                    ?>

                    <script>
                        function deleteFile(folderPath, fileName) {
                            if (confirm('Tem certeza de que deseja deletar o arquivo?')) {
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', '../modulos/delete_file.php', true);
                                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                xhr.onreadystatechange = function () {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        var response = JSON.parse(xhr.responseText);
                                        if (response.success) {
                                            window.location.reload();
                                        } else {
                                            alert('Ocorreu um erro ao deletar o arquivo.');
                                        }
                                    }
                                };
                                xhr.send('folderPath=' + encodeURIComponent(folderPath) + '&fileName=' + encodeURIComponent(fileName));
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Impede o reenvio do formulário ao atualizar a página (pressionar F5)
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>