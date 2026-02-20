  
**FINANCE QUEST**

Sistema de Finanças Pessoais Gamificado

Especificação Técnica v1.0

Stack: Laravel \+ Filament \+ Livewire \+ SQLite

Integração: brapi.dev

*Documento de Arquitetura e Modelagem de Dados*

1\. Introdução e Visão do Produto	3  
2\. Análise de Entidades e Identificação de Gaps	4  
2.1 Entidades Originais Propostas	4  
2.2 Gaps Identificados e Entidades Complementares	4  
3\. Modelagem Completa das Entidades	6  
3.1 User (Usuário)	6  
3.2 Conta (Conta Bancária/Carteira)	7  
3.3 Cartao (Cartão de Crédito)	8  
3.4 Categoria e Subcategoria	9  
3.5 Transacao (Transação Financeira)	10  
3.6 Investimento e Ativos	11  
4\. Sistema de Gamificação	13  
4.1 Nivel (Sistema de Níveis)	13  
4.2 Conquista (Achievements)	14  
4.3 Desafio (Challenges)	15  
5\. Entidades de Apoio Complementares	16  
6\. Integração com brapi.dev	17  
7\. Fluxo de Dados e Integrações	18  
8\. Diagrama de Relacionamentos	19  
9\. Próximos Passos e Recomendações	20

*Dica: Clique com botão direito no sumário e selecione 'Atualizar Campo' para sincronizar os números de página.*

# **1\. Introdução e Visão do Produto**

O Finance Quest é um sistema de gestão financeira pessoal que utiliza técnicas de gamificação para engajar usuários no controle de suas finanças. A premissa central é transformar a gestão financeira, frequentemente vista como uma tarefa tediosa e complexa, em uma jornada divertida e recompensadora. O sistema permite que usuários monitorem suas receitas e despesas, realizem investimentos em diferentes modalidades (CDB, Caixinhas, Ações), e acompanhem a evolução de seu patrimônio ao longo do tempo.

A gamificação é implementada através de um sistema de pontos de experiência (XP), níveis, conquistas (achievements), desafios periódicos e missões que incentivam comportamentos financeiros saudáveis. Por exemplo, o usuário pode ganhar XP por registrar todas as transações do mês, manter uma taxa de economia acima de determinado percentual, ou diversificar seus investimentos. Esse mecanismo de recompensas cria um ciclo de feedback positivo que motiva o usuário a manter hábitos financeiros disciplinados.

O sistema será construído utilizando Laravel como framework backend, Filament para a área administrativa, Livewire para componentes reativos no frontend, e SQLite como banco de dados inicial, permitindo fácil migração para PostgreSQL ou MySQL no futuro. A integração com a API brapi.dev fornecerá dados de cotações de ações e taxas de referência como SELIC, fundamentais para o cálculo de rentabilidade de investimentos e projeções financeiras.

# **2\. Análise de Entidades e Identificação de Gaps**

A análise das entidades inicialmente propostas revelou importantes lacunas que precisam ser preenchidas para um sistema completo e funcional. As entidades originais contemplam aspectos essenciais da gestão financeira, mas não abordam elementos cruciais para a gamificação, controle de cartões de crédito, planejamento de orçamentos, e rastreamento de metas financeiras. A seguir, detalhamos os gaps identificados e as entidades complementares propostas.

## **2.1 Entidades Originais Propostas**

* User \- Usuário do sistema com autenticação  
* Contas \- Contas bancárias e carteiras  
* Investimentos \- CDB, Caixinhas, Ações  
* Transações \- Movimentações financeiras  
* Tipos Transações \- Classificação: Receita, Despesa, Transferência, Estorno  
* Categoria e Subcategorias \- Organização das transações

## **2.2 Gaps Identificados e Entidades Complementares**

**Gap 1 \- Controle de Cartões de Crédito:** O sistema original menciona transações de cartão de crédito mas não possui uma entidade para gerenciar os cartões em si. É fundamental ter uma entidade Cartao que armazene informações como limite, dia de fechamento, dia de vencimento, e que permita controlar a fatura atual e o limite disponível. Isso permite funcionalidades como alertas de limite, acompanhamento de fatura fechada vs. aberta, e controle de gastos por cartão.

**Gap 2 \- Sistema de Gamificação:** A proposta menciona gamificação mas não define as entidades necessárias. O mínimo indispensável inclui: Nivel (para progressão do usuário), Conquista (achievements desbloqueáveis), UserConquista (relacionamento usuário-conquista com data de desbloqueio), Desafio (metas temporárias com prazos), UserDesafio (progresso do usuário em cada desafio), e um registro de MovimentacaoXP para rastrear ganhos de pontos.

**Gap 3 \- Planejamento e Orçamentos:** Para um sistema financeiro robusto, é essencial permitir que o usuário defina orçamentos por categoria. A entidade Orcamento permite definir limites mensais para categorias específicas (ex: R$ 500 para alimentação), enquanto OrcamentoRealizacao rastreia quanto foi gasto em cada período, gerando alertas quando o limite está próximo de ser atingido.

**Gap 4 \- Metas Financeiras:** Usuários frequentemente têm objetivos financeiros específicos como juntar uma reserva de emergência, comprar um carro, ou fazer uma viagem. A entidade Meta permite definir esses objetivos com valor alvo, prazo, e acompanhamento de progresso. Isso também se conecta com a gamificação, pois alcançar metas pode gerar XP e conquistas.

**Gap 5 \- Faturas e Parcelamentos:** Compras parceladas no cartão de crédito precisam ser rastreadas individualmente. A entidade Fatura representa cada ciclo de fatura do cartão, enquanto Parcela rastreia cada parcela de uma compra, permitindo visualizar compromissos futuros e impacto no fluxo de caixa.

**Gap 6 \- Ativos Financeiros:** Para investimentos em ações, é necessário rastrear não apenas o investimento total, mas cada posição individual. A entidade Ativo representa o ativo financeiro (ação, fundo imobiliário, etc.), Posicao rastreia a quantidade e preço médio de cada ativo que o usuário possui, e Dividendo registra os proventos recebidos. Isso permite cálculos precisos de rentabilidade e dividendos.

**Gap 7 \- Tags e Etiquetas:** Além de categorias, é útil permitir que usuários etiquetem transações de forma flexível. A entidade Tag permite criar etiquetas personalizadas e TransacaoTag faz o relacionamento N:N. Isso permite, por exemplo, marcar todas as transações de uma viagem específica ou de um projeto pessoal.

**Gap 8 \- Recorrência:** Muitas transações são recorrentes (aluguel, streaming, salário). A entidade Recorrencia define padrões de repetição para transações, e TransacaoRecorrente materializa cada instância da recorrência. Isso evita o usuário ter que cadastrar manualmente toda vez.

# **3\. Modelagem Completa das Entidades**

## **3.1 User (Usuário)**

A entidade User é o núcleo central do sistema, estendendo a classe Authenticatable do Laravel. Além dos campos padrão de autenticação, inclui campos específicos para gamificação como nível atual, pontos de experiência acumulados, e sequência de dias consecutivos de uso (streak). O streak é particularmente importante para gamificação, pois incentiva o usuário a acessar o sistema diariamente.

| Campo | Tipo | Descrição |
| ----- | ----- | ----- |
| id | bigint PK | Identificador único do usuário |
| name | string(255) | Nome completo do usuário |
| email | string(255) U | E-mail único para autenticação |
| password | string(255) | Senha hasheada (bcrypt/argon2) |
| avatar | string(500) N | Caminho para foto de perfil |
| xp\_total | integer D:0 | Pontos de experiência acumulados |
| nivel\_id | bigint FK N | Nível atual do usuário |
| streak\_dias | integer D:0 | Dias consecutivos de acesso |
| ultimo\_acesso | timestamp N | Data/hora do último login |
| moeda\_padrao | string(3) D:'BRL' | Código ISO da moeda principal |
| timezone | string(50) D:'America/Sao\_Paulo' | Fuso horário do usuário |

*Tabela 1: Estrutura da entidade User*

## **3.2 Conta (Conta Bancária/Carteira)**

A entidade Conta representa qualquer repositório de dinheiro do usuário, incluindo contas correntes, poupanças, contas digitais, e carteiras de dinheiro físico. O campo tipo permite diferenciar entre diferentes tipos de conta, enquanto saldo\_atual é mantido como um campo calculado que pode ser atualizado via transações ou ajustado manualmente. O campo ativo permite desativar contas sem perder o histórico.

| Campo | Tipo | Descrição |
| ----- | ----- | ----- |
| id | bigint PK | Identificador único |
| user\_id | bigint FK | Dono da conta |
| nome | string(100) | Nome identificador (ex: Nubank, Itaú) |
| tipo | enum | corrente, poupanca, digital, carteira, investimento |
| saldo\_inicial | decimal(15,2) D:0 | Saldo no momento do cadastro |
| saldo\_atual | decimal(15,2) D:0 | Saldo calculado automaticamente |
| cor | string(7) N | Cor hexadecimal para UI (ex: \#8B5CF6) |
| icone | string(50) N | Nome do ícone (ex: bank, wallet) |
| instituicao | string(100) N | Nome da instituição financeira |
| ativo | boolean D:true | Se a conta está ativa |

*Tabela 2: Estrutura da entidade Conta*

## **3.3 Cartao (Cartão de Crédito)**

A entidade Cartao gerencia os cartões de crédito do usuário, fundamentais para controle de gastos e planejamento financeiro. Os campos dia\_fechamento e dia\_vencimento permitem calcular automaticamente quando cada compra entrará na fatura e quando precisará ser paga. O limite\_total representa o limite do cartão, enquanto limite\_utilizado é atualizado automaticamente com base nas transações. O campo conta\_vinculada\_id permite vincular o cartão a uma conta bancária de débito automático.

| Campo | Tipo | Descrição |
| ----- | ----- | ----- |
| id | bigint PK | Identificador único |
| user\_id | bigint FK | Dono do cartão |
| nome | string(100) | Nome identificador (ex: Nubank Ultravioleta) |
| limite\_total | decimal(15,2) | Limite total do cartão |
| limite\_utilizado | decimal(15,2) D:0 | Valor já gasto no ciclo atual |
| dia\_fechamento | tinyint | Dia do mês que a fatura fecha (1-31) |
| dia\_vencimento | tinyint | Dia do mês que a fatura vence (1-31) |
| conta\_vinculada\_id | bigint FK N | Conta para débito automático |
| bandeira | string(20) | Visa, Mastercard, Elo, etc. |
| ativo | boolean D:true | Se o cartão está ativo |

*Tabela 3: Estrutura da entidade Cartao*

## **3.4 Categoria e Subcategoria**

As categorias organizam as transações em grupos lógicos, facilitando análises e relatórios. O sistema suporta uma hierarquia de até dois níveis (categoria e subcategoria), o que é suficiente para a maioria dos casos de uso. Categorias podem ser do sistema (padrão para todos os usuários) ou personalizadas pelo usuário. O campo natureza indica se a categoria é usada para receitas, despesas, ou ambos.

| Campo | Tipo | Descrição |
| ----- | ----- | ----- |
| id | bigint PK | Identificador único |
| user\_id | bigint FK N | NULL \= categoria do sistema |
| categoria\_pai\_id | bigint FK N | NULL \= categoria principal |
| nome | string(50) | Nome da categoria |
| natureza | enum | receita, despesa, ambas |
| cor | string(7) N | Cor hexadecimal para UI |
| icone | string(50) N | Nome do ícone (Lucide/FontAwesome) |
| ordem | integer D:0 | Ordem de exibição |
| ativo | boolean D:true | Se a categoria está ativa |

*Tabela 4: Estrutura da entidade Categoria*

## **3.5 Transacao (Transação Financeira)**

A entidade Transacao é o coração do sistema financeiro, registrando todas as movimentações de dinheiro. Cada transação possui um tipo (receita, despesa, transferência, estorno) e pode estar vinculada a uma conta bancária ou a um cartão de crédito. Transações de cartão podem ser parceladas, sendo que cada parcela gera um registro na entidade Parcela. O campo status permite controlar transações pendentes, confirmadas, ou canceladas.

| Campo | Tipo | Descrição |
| ----- | ----- | ----- |
| id | bigint PK | Identificador único |
| user\_id | bigint FK | Dono da transação |
| conta\_id | bigint FK N | Conta de origem/destino |
| cartao\_id | bigint FK N | Cartão de crédito (se aplicável) |
| categoria\_id | bigint FK | Categoria da transação |
| tipo | enum | receita, despesa, transferencia, estorno |
| descricao | string(255) | Descrição da transação |
| valor | decimal(15,2) | Valor da transação (sempre positivo) |
| data\_transacao | date | Data em que a transação ocorreu |
| data\_efetivacao | date N | Data em que foi efetivamente paga/recebida |
| status | enum | pendente, confirmada, cancelada |
| parcelas | integer D:1 | Número de parcelas (1 \= à vista) |
| conta\_destino\_id | bigint FK N | Para transferências: conta destino |
| transacao\_origem\_id | bigint FK N | Para estornos: transação original |
| observacoes | text N | Notas adicionais |
| localizacao | string(200) N | Estabelecimento ou local |

*Tabela 5: Estrutura da entidade Transacao*

## **3.6 Investimento e Ativos**

O módulo de investimentos é estruturado em múltiplas entidades para suportar diferentes tipos de aplicação financeira. A entidade Investimento representa um 'container' para cada tipo de investimento do usuário (um CDB específico, uma caixinha de economia, uma carteira de ações). Para investimentos em renda variável, a entidade Posicao rastreia cada posição individual, enquanto Dividendo registra os proventos recebidos. A entidade Ativo contém os dados de mercado obtidos via brapi.dev.

### **3.6.1 Investimento**

| Campo | Tipo | Descrição |
| ----- | ----- | ----- |
| id | bigint PK | Identificador único |
| user\_id | bigint FK | Dono do investimento |
| conta\_id | bigint FK N | Conta vinculada (opcional) |
| nome | string(100) | Nome do investimento |
| tipo | enum | cdb, caixinha, acoes, fii, cripto, tesouro, fundo |
| valor\_investido | decimal(15,2) | Valor total aportado |
| valor\_atual | decimal(15,2) | Valor atual (calculado ou manual) |
| taxa\_retorno | decimal(8,4) N | Taxa de rendimento (% CDI, SELIC, etc.) |
| data\_inicio | date | Data do primeiro aporte |
| data\_vencimento | date N | Data de vencimento (se aplicável) |
| liquidez | enum | diaria, carescida, vencimento |
| ativo | boolean D:true | Se o investimento está ativo |

*Tabela 6: Estrutura da entidade Investimento*

### **3.6.2 Ativo (Dados de Mercado)**

| Campo | Tipo | Descrição |
| ----- | ----- | ----- |
| id | bigint PK | Identificador único |
| codigo | string(10) U | Ticker do ativo (ex: PETR4) |
| nome | string(200) | Nome da empresa/fundo |
| tipo | enum | acao, fii, etf, bdr, cripto |
| preco\_atual | decimal(15,4) | Último preço fechamento |
| variacao\_dia | decimal(8,4) N | Variação percentual do dia |
| dividend\_yield | decimal(8,4) N | Dividend yield anual (%) |
| p\_l | decimal(10,2) N | Índice Preço/Lucro |
| ultimo\_update | timestamp | Data/hora da última atualização |

*Tabela 7: Estrutura da entidade Ativo*

# **4\. Sistema de Gamificação**

O sistema de gamificação é construído sobre quatro pilares fundamentais: níveis de progressão, conquistas desbloqueáveis, desafios temporários, e missões recorrentes. Cada pilar serve a um propósito específico na engajamento do usuário. Os níveis proporcionam uma sensação de progressão de longo prazo, as conquistas celebram marcos específicos, os desafios criam urgência e objetivos de curto prazo, e as missões estabelecem hábitos financeiros saudáveis.

## **4.1 Nivel (Sistema de Níveis)**

O sistema de níveis segue uma progressão exponencial, onde cada nível subsequente requer mais XP para ser alcançado. Isso garante que novos usuários sintam progresso rápido inicialmente, enquanto usuários mais experientes continuam desafiados. Cada nível possui um nome temático relacionado ao universo financeiro, criando uma narrativa de evolução do usuário de 'Aprendiz' a 'Mestre das Finanças'.

| Nível | Nome | XP Necessário | Recompensa |
| :---: | ----- | ----- | ----- |
| 1 | Aprendiz | 0 | Avatar básico |
| 2 | Iniciante | 100 | Cor de tema |
| 5 | Poupador | 500 | Badge 'Econômico' |
| 10 | Investidor | 1.500 | Relatórios avançados |
| 15 | Trader | 3.000 | Ícones premium |
| 20 | Estrategista | 6.000 | Simulador de cenários |
| 30 | Mestre | 15.000 | Título especial |

*Tabela 8: Progressão de níveis e recompensas*

## **4.2 Conquista (Achievements)**

Conquistas são marcos específicos que o usuário pode desbloquear ao realizar determinadas ações ou atingir certos objetivos. Cada conquista possui um identificador único, nome, descrição, ícone, e valor em XP concedido ao ser desbloqueada. Conquistas podem ser divididas em categorias como finanças (relacionadas a transações), investimento (relacionadas a aplicações), disciplina (relacionadas a hábitos), e social (se houver funcionalidades sociais no futuro).

| Conquista | Descrição | XP |
| ----- | ----- | ----- |
| Primeiro Passo | Registrar primeira transação | 25 XP |
| Organizador | Categorizar 50 transações | 50 XP |
| Poupança Ferroz | Economizar 20% por 3 meses | 200 XP |
| Investidor Iniciante | Realizar primeiro investimento | 100 XP |
| Diversificador | Ter 3 tipos de investimento | 150 XP |
| Semana Perfeita | Acessar 7 dias seguidos | 75 XP |
| Mês sem Estouro | Não estourar orçamento por 30 dias | 300 XP |
| Dividend Hunter | Receber primeiro dividendo | 100 XP |

*Tabela 9: Exemplos de conquistas*

## **4.3 Desafio (Challenges)**

Desafios são objetivos temporários com prazo definido que oferecem recompensas ao serem completados. Podem ser diários, semanais, ou mensais, com dificuldade e recompensas escalonadas. Desafios diários incentivam o acesso regular ao sistema, enquanto desafios mensais promovem objetivos mais significativos. O sistema pode gerar desafios automaticamente com base no perfil financeiro do usuário, criando experiências personalizadas.

| Periodicidade | Exemplo de Desafio | XP | Prazo |
| ----- | ----- | ----- | ----- |
| Diário | Registrar todas as transações do dia | 10 XP | 24h |
| Diário | Não gastar com lazer hoje | 15 XP | 24h |
| Semanal | Economizar 10% da receita semanal | 50 XP | 7 dias |
| Semanal | Revisar todas as categorias | 30 XP | 7 dias |
| Mensal | Manter taxa de poupança \> 20% | 200 XP | 30 dias |
| Mensal | Não estourar nenhum orçamento | 150 XP | 30 dias |

*Tabela 10: Exemplos de desafios por periodicidade*

# **5\. Entidades de Apoio Complementares**

## **5.1 Orcamento (Budget)**

Orçamentos permitem que o usuário defina limites de gastos por categoria em cada período (geralmente mensal). O sistema acompanha automaticamente o valor gasto em cada categoria e alerta quando o usuário está próximo do limite. Orçamentos podem ser definidos como valores fixos ou percentuais da receita, e podem ter periodicidade diferente (mensal, quinzenal, etc.).

## **5.2 Meta (Financial Goal)**

Metas financeiras são objetivos de médio a longo prazo que o usuário deseja alcançar, como formar uma reserva de emergência, juntar dinheiro para um carro, ou pagar uma viagem. Cada meta possui um valor alvo, prazo, e pode ser vinculada a uma conta específica ou a um investimento. O sistema mostra o progresso da meta e pode calcular automaticamente quanto o usuário precisa poupar por mês para alcançá-la.

## **5.3 Recorrencia (Recurring Transaction)**

A entidade Recorrencia define padrões para transações que se repetem periodicamente, como salário, aluguel, streaming, ou mensalidades. O sistema pode gerar automaticamente as transações correspondentes a cada período, evitando que o usuário precise cadastrá-las manualmente. Recorrências podem ter data de início e fim definidas, ou serem indefinidas até o usuário cancelar.

## **5.4 Fatura (Credit Card Bill)**

Cada fatura de cartão de crédito é representada pela entidade Fatura, que agrega todas as compras do período e permite controle total do que será pago. O sistema calcula automaticamente o total da fatura com base nas transações do período, mostra o valor mínimo de pagamento, e permite registrar o pagamento da fatura (total ou parcial). Faturas podem ser pagas em múltiplas parcelas se necessário.

# **6\. Integração com brapi.dev**

A API brapi.dev fornece dados de mercado financeiro brasileiro de forma gratuita, incluindo cotações de ações, fundos imobiliários, ETFs, e taxas de referência como SELIC. Como o sistema não requer dados em tempo real, a estratégia de atualização é otimizada para minimizar chamadas à API e garantir dados suficientemente atualizados para as necessidades do usuário.

## **6.1 Estratégia de Atualização**

**Taxa SELIC:** Atualização semanal (toda segunda-feira). A SELIC é definida pelo Copom e raramente muda fora das reuniões ordinárias, que ocorrem a cada 45 dias. Uma atualização semanal é mais que suficiente para manter os cálculos de rentabilidade de CDBs e investimentos atrelados à SELIC precisos.

**Cotações de Ações:** Atualização mensal (primeiro dia de cada mês). Como o foco é acompanhamento de investimentos de longo prazo, não há necessidade de dados diários. A atualização mensal permite calcular a rentabilidade da carteira, verificar dividendos recebidos, e ajustar o valor atual dos investimentos. Usuários que desejam atualização mais frequente podem acionar manualmente.

**Dividendos:** Verificação quinzenal para próximos pagamentos. O sistema consulta a API para verificar se há dividendos ou JCP previstos para as ações que o usuário possui, permitindo projeção de receitas futuras.

## **6.2 Endpoints Utilizados**

* GET /quote/{ticker} \- Preço atual e variação de um ativo específico  
* GET /quote/list \- Lista de ativos com filtros por tipo  
* GET /treasury \- Taxas do tesouro direto incluindo SELIC  
* GET /dividends/{ticker} \- Histórico e previsão de dividendos  
* GET /earnings/{ticker} \- Resultados e eventos corporativos

# **7\. Fluxo de Dados e Integrações**

## **7.1 Fluxo de Transação**

Quando uma transação é registrada, o sistema executa uma série de operações em cascata para garantir a integridade dos dados e disparar os mecanismos de gamificação. Primeiro, a transação é validada e persistida no banco. Se for uma transação de cartão de crédito parcelada, o sistema gera automaticamente os registros de parcelas. Em seguida, o saldo da conta ou limite do cartão é atualizado. O sistema então verifica se a transação contribui para algum desafio ativo, atualiza o orçamento da categoria correspondente, e calcula o XP ganho. Finalmente, verifica se a transação desbloqueia alguma conquista.

## **7.2 Fluxo de Gamificação**

O sistema de gamificação opera em resposta a eventos do sistema. Cada evento (registro de transação, login diário, alcançar meta, etc.) dispara listeners que calculam o XP correspondente, verificam progresso em desafios, e checam conquistas. Quando o usuário acumula XP suficiente para subir de nível, o sistema atualiza automaticamente o nível e notifica o usuário. Conquistas desbloqueadas são registradas com timestamp e o XP é creditado. Desafios completados são marcados como concluídos e o XP é creditado, gerando novos desafios para substituir os completados.

# **8\. Diagrama de Relacionamentos**

O diagrama a seguir ilustra os principais relacionamentos entre as entidades do sistema. Cada usuário pode ter múltiplas contas, cartões, investimentos e metas. Cada conta pode ter múltiplas transações, assim como cada cartão. Transações pertencem a uma categoria e podem ter múltiplas tags. Investimentos podem ter múltiplas posições e dividendos. O sistema de gamificação conecta-se ao usuário através dos níveis e conquistas.

**RELACIONAMENTOS PRINCIPAIS:**

1. User → Conta: 1:N (um usuário, múltiplas contas)  
2. User → Cartao: 1:N (um usuário, múltiplos cartões)  
3. User → Investimento: 1:N (um usuário, múltiplos investimentos)  
4. User → Transacao: 1:N (um usuário, múltiplas transações)  
5. Conta → Transacao: 1:N (uma conta, múltiplas transações)  
6. Cartao → Transacao: 1:N (um cartão, múltiplas transações)  
7. Cartao → Fatura: 1:N (um cartão, múltiplas faturas mensais)  
8. Categoria → Subcategoria: 1:N (auto-relacionamento)  
9. Categoria → Transacao: 1:N (uma categoria, múltiplas transações)  
10. Transacao → Parcela: 1:N (uma transação, múltiplas parcelas)  
11. Transacao → Tag: N:N (via tabela pivô TransacaoTag)  
12. Investimento → Posicao: 1:N (para ações/FIIs)  
13. Ativo → Posicao: 1:N (um ativo, múltiplas posições de usuários)  
14. Ativo → Dividendo: 1:N (um ativo, múltiplos dividendos)  
15. User → Nivel: N:1 (múltiplos usuários, um nível atual)  
16. User → Conquista: N:N (via UserConquista)  
17. User → Desafio: N:N (via UserDesafio)  
18. User → Orcamento: 1:N (um usuário, múltiplos orçamentos)  
19. User → Meta: 1:N (um usuário, múltiplas metas)

# **9\. Próximos Passos e Recomendações**

Com a estrutura de entidades definida, os próximos passos para implementação do Finance Quest incluem a criação das migrations do Laravel, definição dos Models com seus relacionamentos, implementação dos Filament Resources para a área administrativa, e desenvolvimento dos componentes Livewire para a interface do usuário. A seguir, apresentamos uma ordem sugerida de implementação.

## **9.1 Fase 1 \- Fundação (Semanas 1-2)**

1. Configurar projeto Laravel com Filament e Livewire  
2. Criar migrations e models das entidades core (User, Conta, Cartao, Categoria, Transacao)  
3. Implementar Filament Resources para CRUD básico  
4. Configurar autenticação e perfis de usuário

## **9.2 Fase 2 \- Funcionalidades Financeiras (Semanas 3-4)**

1. Implementar módulo de investimentos com entities Investimento, Ativo, Posicao, Dividendo  
2. Criar sistema de faturas e parcelamento  
3. Implementar orçamentos e metas  
4. Desenvolver transações recorrentes

## **9.3 Fase 3 \- Gamificação (Semanas 5-6)**

1. Implementar sistema de níveis e XP  
2. Criar conquistas e sistema de desbloqueio  
3. Desenvolver desafios diários, semanais e mensais  
4. Integrar gamificação com ações financeiras

## **9.4 Fase 4 \- Integração e Polimento (Semanas 7-8)**

1. Integrar com brapi.dev para dados de mercado  
2. Criar dashboard com métricas e gráficos  
3. Implementar notificações e alertas  
4. Testes automatizados e refinamento de UX