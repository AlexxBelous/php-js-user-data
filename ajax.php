<?php

$type = $_POST['type'];
if ($type == 'yesno') {
    yesNoLog();
} else if ($type == 'whyanswer') {
    whyAnswerLog();
}


function yesNoLog()
{
    $articleid = $_POST['articleid'];
    $result = $_POST['result'];
    try {
        $host = 'mysql';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = 'root';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "insert into `yesno` (`articleid`, `result`) values (?, ?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function whyAnswerLog()
{
    $articlesid = $_POST['articleid'];
    $result = $_POST['result'];

    try {
        $host = 'mysql';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = 'root';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "insert into `whyanswerlog` (`articleid`, `result`) values (?, ?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articlesid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>