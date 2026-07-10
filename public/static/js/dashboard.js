import { request, API_BASE_URL } from "./lib/lib.js";

let presenceChart;

function setupUserMenu() {
    const userMenu = document.querySelector('.user-menu');
    const userTrigger = document.querySelector('.user-trigger');
    const logoutBtn = document.getElementById('logout-btn');

    if (!userMenu || !userTrigger || !logoutBtn) {
        return;
    }

    userTrigger.addEventListener('click', (event) => {
        event.stopPropagation();
        userMenu.classList.toggle('open');
    });

    document.addEventListener('click', (event) => {
        if (!userMenu.contains(event.target)) {
            userMenu.classList.remove('open');
        }
    });

    logoutBtn.addEventListener('click', async () => {
        await request(API_BASE_URL, 'POST', {
            body: JSON.stringify({ route: 'logout' })
        });

        window.location.reload();
    });
}
let demandChart;

document.addEventListener('DOMContentLoaded', () => {
    const presenceCtx = document.getElementById('presenceChart');
    const demandCtx = document.getElementById('demandChart');

    if (presenceCtx) {
        presenceChart = new Chart(presenceCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Confirmados', 'Cancelados', 'Sem resposta'],
                datasets: [{
                    data: [0, 0, 0],
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
        demandChart = new Chart(demandCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Previsto', 'Confirmado', 'Cancelado'],
                datasets: [{
                    label: 'Refeições',
                    data: [0, 0, 0],
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

    setupUserMenu();
    fetchData();
});

async function fetchData() {
    const response = await request(API_BASE_URL, 'POST', {
        body: JSON.stringify({
            route: 'get-data'
        })
    });

    if (response.success === false) {
        console.log("Ocorreu um erro: ", response.message);
        return;
    }

    setData(response);
}

function setData(data) {
    const confirmed = data.yes;
    const cancelled = data.not;
    const total = data.quantity;
    const pending = data.pending;

    const totalMeals = document.getElementById('totalMeals');
    const confirmedMeals = document.getElementById('confirmedMeals');
    const cancelledMeals = document.getElementById('cancelledMeals');
    const foodForecast = document.getElementById('foodForecast');
    const estimatedCost = document.getElementById('estimatedCost');
    const revenueValue = document.getElementById('revenueValue');
    const occupancyValue = document.getElementById('occupancyValue');

    const responseCount = confirmed + cancelled + pending;
    const occupancyRate = responseCount > 0
        ? Math.min(100, Math.round(((confirmed / responseCount) * 0.75 + (confirmed / Math.max(total, 1)) * 0.25) * 100))
        : 0;
    const revenue = Number(confirmed || 0) * 12.5;

    if (totalMeals) totalMeals.textContent = total;
    if (confirmedMeals) confirmedMeals.textContent = confirmed;
    if (cancelledMeals) cancelledMeals.textContent = cancelled;
    if (foodForecast) foodForecast.textContent = data.predicted_food_kg;
    if (estimatedCost) estimatedCost.textContent = data.predicted_cost;
    if (revenueValue) revenueValue.textContent = `R$ ${revenue.toFixed(2).replace('.', ',')}`;
    if (occupancyValue) occupancyValue.textContent = `${occupancyRate}%`;

    if (presenceChart) {
        presenceChart.data.datasets[0].data = [confirmed, cancelled, pending];
        presenceChart.update();
    }

    if (demandChart) {
        demandChart.data.datasets[0].data = [total, confirmed, cancelled];
        demandChart.update();
    }
}