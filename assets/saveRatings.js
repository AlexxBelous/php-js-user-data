export function initRateYo() {
    $("#rateYo").rateYo({
        starWidth: "30px",
        ratedFill: "gold",
        fullStar: false,
        onSet: function (rating) {
            alert("Than you for you rating: " + rating)
            saveRating(rating);
        },
    });
}

function saveRating(rating) {
    const data = {
        type: "starrating",
        articleid: "1221",
        userrating: rating
    };

    fetch("ajax.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            alert("Thank you for your rating!");
        })
        .catch(error => {
            console.error("ErrorMy:", error);
        });
}
