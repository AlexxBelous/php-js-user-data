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








<!-------------------Main.js---------------------------->

<script>
    import {saveAnswer} from "./saveAnswer.js";
    import {saveWhyAnswer} from "./saveWhyAnswer.js";

    document.querySelectorAll("input[type=radio][name=answer]").forEach(function (radio) {
        radio.addEventListener("click", function () {
            const val = this.value;
            saveAnswer(val)

            if (val === 'No') {
                showForm();
            }
        });
    });


    function showForm() {
        document.getElementById("explainwhy").style.display = "block";
    }

    const btnFormAnswer = document.getElementById("btnFormAnswer");
    btnFormAnswer.addEventListener("click", saveWhyAnswer);


</script>














<!--------------------------saveWhyAnswer.js-------------------------------->
<script>
    export function saveWhyAnswer() {
        const answerForm = document.getElementById("whyanswer").value;
        console.log(answerForm);
        const data = new FormData();
        data.append("type", "whyanswer");
        data.append("articleid", "1221");
        data.append("result", answerForm);
        fetch("ajax.php", {
            method: "POST",
            body: data
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Error HTTP status: ${response.status}`)
                }
                return response.text();
            })
            .then((data) => {
                alert("Thank you for entering your message in the form.");
                document.getElementById("explainwhy").style.display = 'none';
            })
            .catch((error) => {
                console.error("Error: ", error)
            })
    }
</script>
