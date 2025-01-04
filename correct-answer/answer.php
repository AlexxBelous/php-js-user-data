<?php
// Code PHP
$type = $_POST['type'];
if ($type == 'yesno') {
    yesNoLog();
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

?>







<!--Script JQUERY-->

<script>
    // Устанавливаем обработчик события click для всех радио-кнопок с именем "answer"
    $("input:radio[name=answer]").click(function () {
        // Получаем значение выбранной радио-кнопки
        var val = $(this).val();
        // Передаем значение выбранного ответа в функцию saveAnswer
        saveAnswer(val);
    });

    // Функция для сохранения ответа
    function saveAnswer(answer) {
        // Отправляем POST-запрос на сервер
        $.post(
            "ajax.php",            // URL для отправки запроса
            {                      // Данные, отправляемые на сервер
                type: "yesno",     // Тип ответа (например, да/нет)
                articleid: "1221", // Идентификатор статьи
                result: answer     // Ответ пользователя
            }
        )
            .done(function (data) {    // Выполняется, если запрос успешно обработан
                // Показываем сообщение об успешной отправке данных
                alert('Thank you!' + data);
            });
    }

</script>







<!--Script JS-->

<script>
    // Находим все радио-кнопки с типом input[type=radio] и именем answer
    document.querySelectorAll("input[type=radio][name=answer]").forEach(function (radio) {
        // Добавляем обработчик события click для каждой найденной радио-кнопки
        radio.addEventListener("click", function () {
            // Получаем значение выбранной радио-кнопки
            const val = this.value;
            // Передаем значение в функцию saveAnswer для сохранения
            saveAnswer(val);
        });
    });

    // Функция для сохранения ответа
    function saveAnswer(answer) {
        // Создаем объект FormData для отправки данных
        const data = new FormData();
        data.append("type", "yesno");       // Тип ответа (например, да/нет)
        data.append("articleid", "1221");  // Идентификатор статьи
        data.append("result", answer);     // Значение ответа пользователя

        // Отправляем запрос на сервер с помощью fetch
        fetch("ajax.php", {
            method: "POST", // Метод запроса - POST
            body: data      // Тело запроса содержит объект FormData
        })
            .then(response => response.text()) // Преобразуем ответ сервера в текст
            .then(data => {
                // Если запрос успешен, показываем сообщение с данными от сервера
                alert('Thank you! ' + data);
            })
            .catch(error => {
                // В случае ошибки выводим сообщение в консоль
                console.error('Error:', error);
            });
    }


</script>
