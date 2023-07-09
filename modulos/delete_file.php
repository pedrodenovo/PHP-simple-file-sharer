<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os valores enviados na requisição
    $folderPath = $_POST['folderPath'];
    $fileName = $_POST['fileName'];

    // Verifique se a pasta e o arquivo existem antes de excluí-los
    if (is_dir($folderPath) && file_exists($folderPath . '/' . $fileName)) {
        // Exclua o arquivo
        unlink($folderPath . '/' . $fileName);
        // Exclua a pasta se estiver vazia
        if (count(scandir($folderPath)) <= 2) {
            rmdir($folderPath);
        }

        // Retorne uma resposta indicando que a exclusão foi bem-sucedida
        echo json_encode(['success' => true]);
    } else {
        // Retorne uma resposta indicando que ocorreu um erro ao excluir o arquivo
        echo json_encode(['success' => false]);
    }
}
?>