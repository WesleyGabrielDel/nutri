
    const form = document.querySelector('form');
    const botaoConfirmar = document.querySelector('button[type="submit"]');

    botaoConfirmar.addEventListener('click', function(event) {
        event.preventDefault();

        const opcaoSelecionada = document.querySelector('input[name="opcao_comida"]:checked');
        const repetirAutomatico = document.getElementById('repetir').checked;

        if (!opcaoSelecionada) {
            alert('Por favor, selecione uma das opções de refeição antes de confirmar!');
            return;
        }

        const nomeRefeicao = opcaoSelecionada.closest('label').querySelector('span').innerText;

        const dadosFormulario = {
            refeicao: nomeRefeicao,
            repetirAutomaticamente: repetirAutomatico,
            dataEnvio: new Date().toLocaleDateString('pt-BR')
        };

        console.log('Dados enviados com sucesso:', dadosFormulario);

        alert(`Sucesso!\n\nSua escolha: "${nomeRefeicao}" foi confirmada.\nRepetição automática: ${repetirAutomatico ? 'Ativada ✅' : 'Desativada ❌'}`);
    });
