document.addEventListener('DOMContentLoaded', () => {
    const presenceCtx = document.getElementById('presenceChart');
    const demandCtx = document.getElementById('demandChart');

    if (presenceCtx) {
        new Chart(presenceCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Confirmados', 'Cancelados', 'Sem resposta'],
                datasets: [{
                    data: [45, 18, 89],
                    backgroundColor: ['#22c55e', '#ef4444', '#38bdf8'],
                    borderColor: '#0b1220',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#cbd5e1',
                            boxWidth: 12,
                            padding: 16,
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0b1220',
                        titleColor: '#ffffff',
                        bodyColor: '#cbd5e1',
                        borderColor: '#2563eb',
                        borderWidth: 1
                    }
                }
            }
        });
    }

    if (demandCtx) {
        new Chart(demandCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Previsto', 'Confirmado', 'Cancelado'],
                datasets: [{
                    label: 'Refeições',
                    data: [152, 45, 18],
                    backgroundColor: ['#2563eb', '#22c55e', '#ef4444'],
                    borderRadius: 16,
                    barThickness: 28
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: { color: '#cbd5e1' },
                        grid: { display: false }
                    },
                    y: {
                        ticks: { color: '#cbd5e1' },
                        grid: {
                            color: 'rgba(148,163,184,0.12)'
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0b1220',
                        titleColor: '#ffffff',
                        bodyColor: '#cbd5e1',
                        borderColor: '#2563eb',
                        borderWidth: 1
                    }
                }
            }
        });
    }
});
