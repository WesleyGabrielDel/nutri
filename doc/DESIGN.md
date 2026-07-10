# Design System — App de Controle de Desperdício Escolar

Sistema de design para o aplicativo de apoio às merendeiras no planejamento de refeições e redução de desperdício de alimentos em escolas.

## Contexto de uso

Antes das cores, o motivo delas: o app será usado por merendeiras, geralmente em tablets ou celulares dentro da cozinha, muitas vezes com as mãos ocupadas, sob luz forte, com pouco tempo para ler texto longo. Isso significa:

- Leitura rápida à distância importa mais que sofisticação visual.
- Cor deve comunicar status sem depender de texto.
- Contraste alto é obrigatório (equipamentos variados, más condições de luz).
- Tom acolhedor, não clínico — é comida para crianças, não uma planilha de estoque.

---

## Paleta de cores

### Cor primária — Teal (verde-azulado)

Transmite confiança, controle e organização, sem cair no verde "sustentabilidade" clichê. Usada em ações principais, navegação e identidade da marca.

| Token       | Hex       | Uso                                  |
|-------------|-----------|---------------------------------------|
| `teal-900`  | `#04342C` | Texto sobre fundos claros de teal     |
| `teal-800`  | `#085041` | Texto principal, títulos de destaque  |
| `teal-600`  | `#0F6E56` | Botões primários, links, ícones ativos|
| `teal-400`  | `#1D9E75` | Estados hover, elementos secundários  |
| `teal-100`  | `#9FE1CB` | Fundos leves, badges                  |
| `teal-50`   | `#E1F5EE` | Fundo de cards e seções destacadas    |

### Cor de apoio — Âmbar

Remete a comida, calor e acolhimento. Cria contraste quente contra o teal frio e evita a sensação de aplicativo puramente administrativo.

| Token        | Hex       | Uso                                   |
|--------------|-----------|----------------------------------------|
| `amber-900`  | `#412402` | Texto sobre fundos claros de âmbar    |
| `amber-800`  | `#854F0B` | Texto de destaque secundário          |
| `amber-200`  | `#EF9F27` | Ícones, elementos de atenção suave    |
| `amber-100`  | `#FAC775` | Fundos de destaque, badges            |
| `amber-50`   | `#FAEEDA` | Fundo de seções de apoio              |

### Cores de estado (semáforo de desperdício)

Usadas exclusivamente para indicar status — nunca como cor de marca ou decoração. Este é o elemento mais importante da interface: precisa ser identificável sem leitura de texto.

| Estado             | Token      | Hex       | Significado                              |
|---------------------|------------|-----------|--------------------------------------------|
| Dentro do esperado  | `green-400`| `#639922` | Sobra de comida dentro da margem planejada|
| Atenção             | `amber-200`| `#EF9F27` | Sobra acima do esperado, revisar próximo pedido |
| Desperdício alto    | `red-400`  | `#E24B4A` | Ajuste urgente na quantidade preparada    |

Regra: cor de estado nunca deve ser reutilizada para outro propósito na interface (ex: não usar vermelho em botão de "excluir" se não for relacionado a desperdício, para não confundir o significado).

### Neutros — fundo e texto

Tons quentes (bege, não cinza-azulado), para combinar com o âmbar e manter a sensação acolhedora.

| Token            | Hex       | Uso                          |
|------------------|-----------|-------------------------------|
| `neutral-bg`     | `#F1EFE8` | Fundo geral do app            |
| `neutral-card`   | `#FFFFFF` | Fundo de cards e formulários  |
| `neutral-text-2` | `#5F5E5A` | Texto secundário, legendas    |
| `neutral-text-1` | `#2C2C2A` | Texto principal                |

---

## Contraste e acessibilidade

- Combinações validadas para WCAG AA: `teal-600` sobre branco, `amber-800` sobre `amber-50`, `neutral-text-1` sobre `neutral-bg`.
- Nunca depender apenas da cor para indicar estado — sempre acompanhar de ícone ou texto curto (ex: um círculo verde + a palavra "OK").
- Tamanho mínimo de fonte: 14px para texto de interface, 16px+ para números importantes (quantidade de refeições, sobras).

---

## Tipografia

Sistema simples, sem serifa, priorizando legibilidade em telas pequenas e em movimento.

| Nível         | Tamanho | Peso | Uso                          |
|----------------|---------|------|--------------------------------|
| Título         | 22px    | 500  | Cabeçalhos de tela             |
| Subtítulo      | 18px    | 500  | Seções dentro da tela          |
| Corpo          | 16px    | 400  | Texto padrão                   |
| Números-chave  | 24–32px | 500  | Quantidade de refeições, sobras|
| Legenda        | 13px    | 400  | Textos de apoio, timestamps    |

Apenas dois pesos (400 e 500) — evita inconsistência visual e mantém a interface leve.

---

## Componentes principais

### Indicador de status (semáforo)
Círculo colorido + rótulo curto. É o elemento central da tela principal, deve ser visível e compreensível em menos de 1 segundo de leitura.

### Cards de registro de refeição
Fundo branco, borda sutil, cantos arredondados (12px). Usados para exibir cada refeição do dia com quantidade preparada, servida e sobra.

### Botões
- Primário (teal-600): ação principal da tela, ex: "Registrar sobra".
- Secundário (borda, sem preenchimento): ações alternativas, ex: "Ver histórico".
- Nunca mais de um botão primário por tela.

### Badges de quantidade
Fundo em tom claro da cor de estado correspondente (ex: `amber-50` com texto `amber-800`), usados para sinalizar rapidamente quantidades em listas.

---

## Princípios de uso

1. **Cor comunica, não decora.** Toda cor de estado (verde/âmbar/vermelho) tem significado fixo em todo o app.
2. **Silêncio visual.** Poucas cores por tela — teal + âmbar + neutros, com estado aparecendo pontualmente.
3. **Números grandes, texto curto.** A cantina não tem tempo para ler parágrafos; priorizar dados numéricos com destaque visual.
4. **Contraste antes de estética.** Em caso de dúvida entre um tom mais bonito e um mais legível, escolher o mais legível.
5. **Consistência de significado.** Uma cor nunca deve significar coisas diferentes em telas diferentes.