new Chart(document.getElementById('myChart'), {
    type: 'pie',
    data: {
                labels: labels,//contoh doang
                datasets: [{
                    label: 'Jumlah',
                    data: data,//fiktif 
                    borderWidth: 1
                }]
            },

    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

