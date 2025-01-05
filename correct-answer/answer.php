<?php
// Code PHP
$type = $_POST['type'];
if ($type == 'yesno') {
    yesNoLog();
} else if($type == 'whyanswer') {
    whyAnswer();
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
        $sql = "INSERT INTO `yesno` (`articleid`, `result`) VALUES (?, ?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function whyAnswer()
{
    $articleid = $_POST['articleid'];
    $result = $_POST['result'];
    try {
        $host = 'mysql';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = 'root';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "INSERT INTO `whyanswerlog` (`articleid`, `result`) VALUES (?, ?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}




?>



<!--Script JS-->

<script>
 document.querySelectorAll("input[type=radio][name=answer]").forEach(function (radio) {
    radio.addEventListener("click", function () {
        const val = this.value;
        saveAnswer(val);

        if (val === "No") {
            findOutWhy();
        }
    });
});


function saveAnswer(answer) {
    const data = new FormData();
    data.append("type", "yesno");
    data.append("articleid", "1221");
    data.append("result", answer);

    fetch("ajax.php", {
        method: "POST",
        body: data,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then((data) => {
            alert("Thank you! " + data);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}


function findOutWhy() {
    document.getElementById("explainwhy").style.display = "block";
}


function saveWhyAnswer() {
    const answer = document.getElementById("whyanswer").value;
    const data = new FormData();
    data.append("type", "whyanswer");
    data.append("articleid", "1221");
    data.append("result", answer);

    fetch("ajax.php", {
        method: "POST",
        body: data,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then((data) => {
            alert("Thank you for your comments!");
            document.getElementById("explainwhy").style.display = "none";
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("explainwhy").style.display = "none";
});

</script>



































<!-----------------------for__part__2 Code PHP-------------------->

<?php

else if ($type == 'whyanswer') {
whyAnswer();
}

function whyAnswer() {
    $articleid = $_POST['articleid'];
    $result = $_POST['result'];
    try {
        $host = 'mysql';
        $dbname = 'bookexamples';
        $user = 'root';
        $pass = 'root';
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $sql = "INSERT INTO `whyanswerlog` (`articleid`, `result`) VALUES (?, ?);";
        $sth = $DBH->prepare($sql);
        $sth->bindParam(1, $articleid, PDO::PARAM_INT);
        $sth->bindParam(2, $result, PDO::PARAM_STR);
        $sth->execute();
    } catch (PDOException $e) {
        echo $e;
    }
}

?>

<!--Script JQUERY-->


<script>
  if (val == 'No') {
        findOutWhy();
    }



  function findOutWhy() {
    $("#explainwhy").show();
}

function saveWhyAnswer() {
    var answer = document.getElementById('whyanswer').value;
    $.post("ajax.php", {
        type: "whyanswer", articleid: "1221", result: answer
    }).done(function (data) {
        alert('Thank you for your comments!');
        document.getElementById('whyanswer').value = ''
    });
}

$(function () {
    $("#explainwhy").hide();
});
</script>


<!--Script JS-->



