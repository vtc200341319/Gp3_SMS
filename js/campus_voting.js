var modal = document.getElementById("myModal");

var span = document.getElementsByClassName("close")[0];

span.onclick = function () {
    modal.style.display = "none";
    if (myChart) {
        myChart.destroy();
    }
};

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
        if (myChart) {
            myChart.destroy();
        }
    }
};

var myChart;

function viewResults(pollingID, question, result1, result2, result3, result4, firstChoice, secondChoice, thirdChoice, fourthChoice) {
    document.getElementById("modal-question").innerText = question;

    var ctx = document.getElementById("resultChart").getContext("2d");
    if (myChart) {
        myChart.destroy();
    }
    myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: [firstChoice, secondChoice, thirdChoice, fourthChoice],
            datasets: [
                {
                    label: "Voting Results",
                    data: [result1, result2, result3, result4],
                    backgroundColor: [
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                    ],
                    borderColor: [
                        "rgba(75, 192, 192, 1)",
                        "rgba(255, 99, 132, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(153, 102, 255, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    modal.style.display = "block";
}
