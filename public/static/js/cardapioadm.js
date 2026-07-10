const API_BASE_URL = '../src/routes/router.php';

function readFileAsDataUrl(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = () => reject(new Error('Falha ao ler o arquivo.'));
        reader.readAsDataURL(file);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    console.log('cardapioadm.js carregado');
    const blocks = document.querySelectorAll('.imagem');
    const publishButton = document.querySelector('.publish-menu-btn');

    blocks.forEach(block => {
        const article = block.closest('.menu-editor');
        const input = block.querySelector('.image-input');
        const icon = block.querySelector('.fa-image');
        const labelText = block.querySelector('.upload-text');

        if (!input) {
            return;
        }

        input.addEventListener('change', async () => {
            const file = input.files && input.files[0];
            if (!file) {
                return;
            }

            try {
                const dataUrl = await readFileAsDataUrl(file);
                if (article) {
                    article.dataset.imageData = dataUrl;
                }
                block.dataset.imageData = dataUrl;

                let preview = block.querySelector('.image-preview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.className = 'image-preview';
                    preview.alt = 'Preview da imagem';
                    block.appendChild(preview);
                }

                preview.src = dataUrl;
                preview.style.maxWidth = '100%';
                preview.style.height = '100%';
                preview.style.objectFit = 'cover';
                preview.style.borderRadius = '12px';
                preview.style.marginTop = '12px';

                if (icon) {
                    icon.style.display = 'none';
                }

                if (labelText) {
                    labelText.textContent = 'Alterar imagem';
                }
            } catch (error) {
                console.error(error);
                window.alert('Erro ao carregar a imagem.');
            }
        });
    });

    if (!publishButton) {
        return;
    }

    publishButton.addEventListener('click', async () => {
        const articles = document.querySelectorAll('.menu-editor');
        const results = [];

        for (const article of articles) {
            const day = article.dataset.day?.trim();
            const item = article.querySelector('.item-title')?.value.trim() || '';
            const description = article.querySelector('.item-description')?.value.trim() || '';
            const imageData = article.dataset.imageData || null;

            if (!day || !item || !description) {
                window.alert(`Preencha dia, título e descrição para ${day || 'um dos dias'}.`);
                return;
            }

            const payload = {
                route: 'set-menu',
                day,
                item,
                description,
                image: imageData,
            };

            try {
                const response = await fetch(API_BASE_URL, {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const responseText = await response.text();
                let data = null;
                try {
                    data = JSON.parse(responseText);
                } catch (parseError) {
                    data = null;
                }

                if (!response.ok) {
                    const message = data && data.message
                        ? data.message
                        : responseText || 'Erro ao enviar o cardápio.';
                    console.log('Erro na resposta do servidor:', response.status, response.statusText, responseText);
                    window.alert(message);
                    return;
                }

                if (!data || data.status === 'error') {
                    const message = data && data.message
                        ? data.message
                        : responseText || 'Erro ao enviar o cardápio.';
                    console.log('Resposta inválida ou status de erro:', responseText);
                    window.alert(message);
                    return;
                }

                results.push(data);
            } catch (error) {
                console.error('Erro ao executar request set-menu:', error);
                window.alert('Falha ao enviar o cardápio.');
                return;
            }
        }

        if (results.length > 0) {
            window.alert('Cardápio enviado com sucesso.');
        }
    });
});
