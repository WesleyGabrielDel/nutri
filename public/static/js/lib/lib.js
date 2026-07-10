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

        let data;
        const text = await response.text();
        try {
            data = JSON.parse(text);
        } catch {
            data = `===================================== Erro Interno do Servidor ===================================== ${text}`;
        }

        if (!response.ok) {
            return { success: false, message: data?.message || data || "Erro na requisição" };
        }
        return data;
    } catch (error) {
        return { success: false, message: `Erro de conexão com o servidor.\n${error}` };
    }
}