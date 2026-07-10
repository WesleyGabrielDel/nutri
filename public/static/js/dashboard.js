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

    if (window.Chart) {
        Chart.defaults.font.family = "'Plus Jakarta Sans', 'Segoe UI', sans-serif";
        Chart.defaults.font.weight = '500';
        Chart.defaults.color = '#5F5E5A';
    }

    if (presenceCtx) {
        presenceChart = new Chart(presenceCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Confirmados', 'Cancelados', 'Sem resposta'],
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: ['#639922', '#E24B4A', '#EF9F27'],
                    borderColor: '#FFFFFF',
                    borderWidth: 3,
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
                            color: '#5F5E5A',
                            boxWidth: 12,
                            padding: 16,
                            font: { size: 13, weight: '500' }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#FFFFFF',
                        titleColor: '#085041',
                        bodyColor: '#2C2C2A',
                        borderColor: '#E2DFD5',
                        borderWidth: 1,
                        padding: 12
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
                    backgroundColor: ['#0F6E56', '#639922', '#E24B4A'],
                    borderRadius: 8,
                    barThickness: 28
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: { color: '#5F5E5A', font: { size: 13, weight: '500' } },
                        grid: { display: false }
                    },
                    y: {
                        ticks: { color: '#5F5E5A', font: { size: 13, weight: '500' } },
                        grid: {
                            color: 'rgba(95,94,90,0.10)'
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#FFFFFF',
                        titleColor: '#085041',
                        bodyColor: '#2C2C2A',
                        borderColor: '#E2DFD5',
                        borderWidth: 1,
                        padding: 12
                    }
                }
            }
        });
    }

    setupUserMenu();
    connectDashboardWebSocket();
    fetchData();
});

function connectDashboardWebSocket() {
    const socketUrl = 'ws://127.0.0.1:8000/ws';
    const ws = new WebSocket(socketUrl);

    ws.addEventListener('open', () => {
        console.log('WebSocket conectado ao servidor Python.');
    });

    ws.addEventListener('message', (event) => {
        const message = event.data;
        if (message === 'dados_atualizados') {
            console.log('Atualização recebida via WebSocket:', message);
            fetchData(true);
        } else {
            console.warn('Mensagem WebSocket desconhecida:', message);
        }
    });

    ws.addEventListener('close', () => {
        console.warn('WebSocket desconectado. Tentando reconectar em 3s...');
        setTimeout(connectDashboardWebSocket, 3000);
    });

    ws.addEventListener('error', (error) => {
        console.error('Erro no WebSocket:', error);
    });
}

async function fetchData(animate = false) {
    const response = await request(API_BASE_URL, 'POST', {
        body: JSON.stringify({
            route: 'get-data'
        })
    });

    if (response.success === false) {
        console.log("Ocorreu um erro: ", response.message);
        return;
    }

    setData(response, animate);
}

function updateMetricText(element, newText, animate) {
    if (!element) return;
    const oldText = element.textContent?.trim() || '';
    if (oldText === newText) {
        return;
    }
    element.textContent = newText;
    if (animate) {
        element.classList.remove('pulse-change');
        void element.offsetWidth;
        element.classList.add('pulse-change');
    }
}

function setData(data, animate = false) {
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

    if (totalMeals) updateMetricText(totalMeals, String(total), animate);
    if (confirmedMeals) updateMetricText(confirmedMeals, String(confirmed), animate);
    if (cancelledMeals) updateMetricText(cancelledMeals, String(cancelled), animate);
    if (foodForecast) updateMetricText(foodForecast, String(data.predicted_food_kg), animate);
    if (estimatedCost) updateMetricText(estimatedCost, `R$ ${revenue.toFixed(2).replace('.', ',')}`, animate);
    if (occupancyValue) updateMetricText(occupancyValue, `${occupancyRate}%`, animate);

    updateWasteStatus(cancelled, confirmed, total);

    if (presenceChart) {
        presenceChart.data.datasets[0].data = [confirmed, cancelled, pending];
        presenceChart.update();
    }

    if (demandChart) {
        demandChart.data.datasets[0].data = [total, confirmed, cancelled];
        demandChart.update();
    }
}

function updateWasteStatus(cancelled, confirmed, total) {
    const cancelledLabel = document.getElementById('cancelledLabel');
    const forecastLabel = document.getElementById('forecastLabel');
    const totalMealsDot = document.getElementById('totalMealsDot');

    if (total <= 0) return;

    const cancelRate = cancelled / total;

    function setLabel(labelEl, state, word) {
        if (!labelEl) return;
        labelEl.classList.remove('ok', 'attn', 'bad');
        labelEl.classList.add(state);
        const dot = labelEl.querySelector('.status-dot');
        if (dot) {
            dot.classList.remove('ok', 'attn', 'bad');
            dot.classList.add(state);
        }
        const node = labelEl.lastChild;
        if (node && node.nodeType === Node.TEXT_NODE) {
            node.textContent = ' ' + word;
        }
    }

    if (cancelRate >= 0.25) {
        setLabel(cancelledLabel, 'bad', 'Alto');
    } else if (cancelRate >= 0.10) {
        setLabel(cancelledLabel, 'attn', 'Atenção');
    } else {
        setLabel(cancelledLabel, 'ok', 'OK');
    }

    const coverage = confirmed / total;
    if (forecastLabel) {
        if (coverage >= 0.7) setLabel(forecastLabel, 'ok', 'No esperado');
        else if (coverage >= 0.4) setLabel(forecastLabel, 'attn', 'Atenção');
        else setLabel(forecastLabel, 'bad', 'Rever');
    }

    if (totalMealsDot) {
        totalMealsDot.classList.remove('ok', 'attn', 'bad');
        totalMealsDot.classList.add(coverage >= 0.5 ? 'ok' : 'attn');
    }
}