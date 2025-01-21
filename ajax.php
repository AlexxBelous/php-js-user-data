<?php

// Определяем тип входящих данных
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';


// Если запрос с JSON-данными
if (str_contains($contentType, 'application/json')) {
    $data = json_decode(file_get_contents('php://input'), true);
} else {
    // Если данные пришли через обычный POST (например, FormData)
    $data = $_POST;
}

// Проверяем, что данные получены и есть ключ 'type'
if (!isset($data['type'])) {
    echo json_encode(['status' => 'error', 'message' => 'Type is not defined']);
    die();
}

// Обрабатываем тип запроса
switch ($data['type']) {
    case 'yesno':
        yesNoLog($data);
        break;
    case 'whyanswer':
        whyAnswer($data);
        break;
    case 'starrating':
        starRatingLog($data);
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Unknown type']);
        break;
}

// Функция для обработки yesno
function yesNoLog($data)
{
    $articleid = $data['articleid'] ?? null;
    $result = $data['result'] ?? null;

    if (!$articleid || !$result) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid yesno data']);
        return;
    }

    try {
        $host = 'mysql';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = 'root';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        $sql = "INSERT INTO `yesno` (`articleid`, `result`) VALUES (?, ?)";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->execute();

        echo json_encode(['status' => 'success', 'message' => 'Yes or No saved']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

// Функция для обработки whyanswer
function whyAnswer($data)
{
    $articleid = $data['articleid'] ?? null;
    $result = $data['result'] ?? null;

    if (!$articleid || !$result) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid whyanswer data']);
        return;
    }

    try {
        $host = 'mysql';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = 'root';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        $sql = "INSERT INTO `whyanswerlog` (`articleid`, `result`) VALUES (?, ?)";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->execute();

        echo json_encode(['status' => 'success', 'message' => 'Why answer saved']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

// Функция для обработки starrating
function starRatingLog($data)
{
    $articleid = $data['articleid'] ?? null;
    $result = $data['userrating'] ?? null;

    // Проверка на валидность данных
    if (!$articleid || !is_numeric($result)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid starrating data']);
        return;
    }

    try {
        $host = 'mysql';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = 'root';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        // Подготовка и выполнение запроса
        $sql = "INSERT INTO `starratinglog` (`articleid`, `result`) VALUES (?, ?)";
        $sth = $DBH->prepare($sql);

        // Привязка параметров
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);  // articleid остается целым числом
        $sth->bindValue(2, $result); // передаем float напрямую, без указания типа

        $sth->execute();

        echo json_encode(['status' => 'success', 'message' => 'Star rating saved']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

