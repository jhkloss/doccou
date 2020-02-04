$(document).ready(function () {
    let ctx = document.getElementById('myChart');

    $.ajax({
        method: 'POST',
        url: '/charts/general',
        success: function (response) {
            generalChart(response);
        },
        }
    );

    function generalChart(data)
    {
        new Chart(ctx, {
            type: 'bar',
            responsive: true,
            data: {
                labels: ['Users', 'Courses', 'Tasks', 'Containers'],
                datasets: [{
                    label: 'Doccou general data',
                    data: JSON.parse(data),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }
});

