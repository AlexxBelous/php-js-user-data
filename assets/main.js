$("input:radio[name=answer]").click(function () {
    var val = $(this).val();
    saveAnswer(val);
})

function saveAnswer(answer) {
    $.post("ajax.php", {
        type: "yesno",
        articleid: "1221",
        result: answer
    }).done(function (data) {
        alert("Thank you " + data)
    })
}