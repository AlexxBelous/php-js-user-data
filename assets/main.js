import {saveAnswer} from "./saveAnswer.js";
import {saveWhyAnswer} from "./saveWhyAnswer.js";
import {initRateYo} from "./saveRatings.js";

document.querySelectorAll("input[type=radio][name=answer]").forEach(function (radio) {
    radio.addEventListener("click", function () {
        const val = this.value;
        saveAnswer(val);

        if (val === 'No') {
            showForm();
        }
        if (val === 'Yes') {
            showStars();
        }
    });
});


function showForm() {
    document.getElementById("explainwhy").style.display = "block";
}

const btnFormAnswer = document.getElementById("btnFormAnswer");
btnFormAnswer.addEventListener("click", saveWhyAnswer);



function showStars() {
    const ratingsContainer = document.getElementById("ratingsContainer");
    ratingsContainer.style.display = "block";
    initRateYo();
}


