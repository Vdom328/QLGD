<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                '2023/01',
                '2023/02',
                '2023/03',
                '2023/04',
                '2023/05',
                '2023/06',
                '2023/07',
                '2023/08',
                '2023/09',
                '2023/10',
                '2023/11',
                '2023/12'
            ],
            datasets: [{
                    label: '2022年',
                    data: [2000000, 2000, 20000, 200000, 20000, 343434, 2000, 20000, 200000, 200000, 20000,
                        1000000
                    ],
                    backgroundColor: "rgba(16, 182, 175, 1)",
                    barPercentage: 0.6,
                    hoverBackgroundColor: "rgba(16, 182, 175, 1)",
                },
                {
                    label: '2023年',
                    data: [2000000, 2000, 20000, 200000, 20000, 343434, 2000, 20000, 200000, 200000, 20000,
                        1000000
                    ],
                    backgroundColor: "rgba(244, 191, 99, 1)",
                    barPercentage: 0.6,
                    hoverBackgroundColor: "rgba(244, 191, 99, 1)",
                }
            ]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        title: function(tooltipItem) {},
                        label: function(tooltipItem, data) {},
                    }
                },
                legend: {
                    align: 'end',
                    title: {
                        position: 'end'
                    }
                },
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    position: 'top',
                    ticks: {
                        font: {
                            size: calFont()
                        },

                    },

                },
                x: {
                    position: 'right',
                    ticks: {
                        font: {
                            size: calFont()
                        },
                    }
                }
            },
        },
    });

    function calFont() {
        if ($(window).width() <= 576) {
            return 6;
        } else {
            return 12;
        }
    }
</script>
