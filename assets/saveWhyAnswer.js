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