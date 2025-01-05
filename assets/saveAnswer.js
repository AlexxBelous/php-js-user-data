export function saveAnswer(answer) {
    const data = new FormData();
    data.append("type", "yesno");
    data.append("articleid", "1221");
    data.append("result", answer);
    fetch("ajax.php", {
        method: "POST",
        body: data
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            alert('Thank you! ' + data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}