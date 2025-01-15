document.querySelectorAll("input[type=radio][name=answer]").forEach(function (radio) {
    radio.addEventListener("click", function () {
        const val = this.value;
        saveAnswer(val);

        if (val === 'No') {
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

const btnFormAnswer = document.getElementById("btnFormAnswer");
btnFormAnswer.addEventListener("click", saveWhyAnswer);

function saveWhyAnswer() {
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
            alert("Thank you for  answer: " + data);
            document.getElementById("whyanswer").style.display = 'none';
        })
        .catch((error) => {
            console.error("Error: ", error)
        })
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("explainwhy").style.display = 'none';
})