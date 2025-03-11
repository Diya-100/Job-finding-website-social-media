document.addEventListener("DOMContentLoaded", function () {
    // Sample Data for Chart
    const ctx = document.getElementById('userChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'New Users Per Month',
                data: [120, 150, 180, 250, 300],
                backgroundColor: '#007bff'
            }]
        }
    });
});
