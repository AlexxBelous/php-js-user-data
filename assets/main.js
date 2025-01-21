import {saveAnswer} from "./saveAnswer.js";
document.querySelectorAll("input[type=radio][name=answer]").forEach(function (radio) {
    radio.addEventListener("click", function () {
        const val = this.value;
        saveAnswer(val)
    });
});
