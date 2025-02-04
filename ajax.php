<?php



$contentType = $_SERVER['CONTENT_TYPE'] ?? '';


if (str_contains($contentType, 'application/json')) {
    $data = json_decode(file_get_contents('php://input'), true);
} else {
    $data = $_POST;
}


$contentType = $_SERVER['CONTENT_TYPE'] ?? '';



if (str_contains($contentType, 'application/json')) {
    $data = json_decode(file_get_contents('php://input'), true);
} else {

    $data = $_POST;
}





if (!isset($data['type'])) {
    echo json_encode(['status' => 'error', 'message' => 'Type is not defined']);
    die();
}





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





function starRatingLog($data)
{
    $articleid = $data['articleid'] ?? null;
    $result = $data['userrating'] ?? null;


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


        $sql = "INSERT INTO `starratinglog` (`articleid`, `result`) VALUES (?, ?)";
        $sth = $DBH->prepare($sql);

        // Привязка параметров
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindValue(2, $result);

        $sth->execute();

        echo json_encode(['status' => 'success', 'message' => 'Star rating saved']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

