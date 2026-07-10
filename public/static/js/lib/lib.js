export const API_BASE_URL = "http://localhost/Nutriflow/src/routes/router.php";

const TOAST_LIMIT = 3;
const TOAST_QUEUE = [];

function ensureToastContainer() {
    let container = document.getElementById("nutriflow-toast-container");

    if (!container) {
        container = document.createElement("div");
        container.id = "nutriflow-toast-container";
        container.setAttribute("aria-live", "polite");
        container.setAttribute("aria-atomic", "true");
        document.body.appendChild(container);
    }

    return container;
}

function flushToastQueue() {
    const container = ensureToastContainer();
    const activeToasts = container.querySelectorAll('.nutriflow-toast').length;

    if (activeToasts >= TOAST_LIMIT || TOAST_QUEUE.length === 0) {
        return;
    }

    const nextToast = TOAST_QUEUE.shift();
    if (!nextToast) {
        return;
    }

    const toast = document.createElement("div");
    toast.className = `nutriflow-toast ${nextToast.type}`;

    const content = document.createElement("div");
    content.className = "nutriflow-toast__content";
    content.textContent = nextToast.message;
    toast.appendChild(content);

    container.appendChild(toast);

    requestAnimationFrame(() => {
        toast.classList.add("show");
    });

    window.setTimeout(() => {
        toast.classList.remove("show");
        window.setTimeout(() => {
            toast.remove();
            flushToastQueue();
        }, 250);
    }, 3200);
}

export function showToast(message, type = "info") {
    TOAST_QUEUE.push({ message, type });
    flushToastQueue();
}

export async function request(url, method = "GET", options = {}) {
    try {
        const headers = {
            "Content-Type": "application/json",
            ...(options.headers || {})
        };
        const response = await fetch(url, {
            method,
            credentials: "include",
            body: options.body,
            ...options,
            headers,
        });

        const text = await response.text();
        let data;
        try {
            data = JSON.parse(text);
        } catch {
            if (/Fatal error|Parse error|Warning|Notice/i.test(text)) {
                const match = text.match(/(?:Fatal error|Parse error|Warning|Notice):\s*([^\n<]+)/i);
                const reason = match ? match[1].trim() : "Erro interno no servidor (PHP).";
                return { status: "error", message: `Erro no servidor: ${reason}` };
            }
            return { status: "error", message: "Resposta inválida do servidor." };
        }

        if (!response.ok) {
            return data && typeof data === "object"
                ? { ...data, success: false }
                : { status: "error", message: "Erro na requisição." };
        }
        return data;
    } catch (error) {
        return { status: "error", message: `Erro de conexão com o servidor: ${error}` };
    }
}