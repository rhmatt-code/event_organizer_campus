document.addEventListener('DOMContentLoaded', function() {
    const eventsData = [
        { title: "Workshop React JS Dasar", attendees: 50, registered: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45] }, // 45/50 (90%)
        { title: "Seminar Artificial Intelligence", attendees: 150, registered: Array(82).fill(1) }, // 82/150 (~54%)
        { title: "Meetup Komunitas Developer", attendees: 75, registered: Array(70).fill(1) }, // 70/75 (~93%)
        { title: "Bootcamp UI/UX Design", attendees: 30, registered: Array(10).fill(1) }, // 10/30 (~33%)
        { title: "Lomba Coding Nasional 2025", attendees: 200, registered: Array(30).fill(1) }, // 30/200 (15%)
    ];
    
    const totalParticipants = eventsData.reduce((acc, curr) => acc + curr.registered.length, 0);
    document.getElementById('total-participants').textContent = `Total: ${totalParticipants} Peserta`;

    const processedData = eventsData.map(event => {
        const count = event.registered.length;
        const capacity = event.attendees;
        const fillRate = (count / capacity) * 100;
        
        return {
            fullName: event.title,
            shortName: event.title.length > 20 ? event.title.substring(0, 20) + "..." : event.title,
            count: count,
            capacity: capacity,
            fillRate: fillRate
        };
    });

    processedData.sort((a, b) => b.count - a.count);

    const backgroundColors = processedData.map(item => {
        if (item.fillRate >= 80) return "#059669";
        if (item.fillRate >= 50) return "#d97706";
        if (item.fillRate >= 20) return "#eab308";
        return "#6366f1";
    });

    const ctx = document.getElementById('eventChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: processedData.map(d => d.shortName),
            datasets: [{
                label: 'Jumlah Peserta',
                data: processedData.map(d => d.count),
                backgroundColor: backgroundColors,
                borderRadius: 4,
                borderSkipped: false,
                barPercentage: 0.6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#111827',
                    bodyColor: '#4b5563',
                    borderColor: '#fcd34d',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        title: function(tooltipItems) {
                            return processedData[tooltipItems[0].dataIndex].fullName;
                        },
                        label: function(context) {
                            const item = processedData[context.dataIndex];
                            return [
                                `Terdaftar: ${item.count} Peserta`,
                                `Kapasitas: ${item.capacity} Peserta`,
                                `Fill Rate: ${item.fillRate.toFixed(1)}%`
                            ];
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e2e8f0',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        font: { size: 12 },
                        color: '#64748b'
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Peserta',
                        color: '#64748b'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: { size: 11 },
                        color: '#64748b',
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            }
        }
    });
});