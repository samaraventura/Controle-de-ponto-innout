# ⏱️ Controle de Ponto - InNout

Sistema web desenvolvido em **PHP puro** com estrutura **MVC**, para controle de ponto, autenticação de usuários e geração de relatórios mensais e gerenciais.

## 💡 Funcionalidades

- Registro de entrada e saída por usuário
- Login e logout com validação de sessão
- Relatórios mensais e gerenciais
- Visualização de horas trabalhadas e faltas
- Controle de usuários (cadastro e edição)
- Templates reutilizáveis com cabeçalho, rodapé e menu

## 🛠 Tecnologias utilizadas

- PHP (sem framework)
- MySQL (com dump `db.sql`)
- HTML5 / CSS3
- JavaScript (básico)
- Estrutura MVC (Model-View-Controller)

## 📁 Estrutura de Pastas

├── public/ # Arquivos públicos (index.php, .htaccess)
├── src/
│ ├── config/ # Arquivos de configuração
│ ├── controllers/ # Lógica da aplicação
│ ├── models/ # Acesso aos dados e regras
│ ├── views/ # Arquivos de visualização
│ ├── exceptions/ # Exceções personalizadas
│ └── helpers/ # Funções auxiliares
├── extras/db.sql # Script do banco de dados
└── .env # Arquivo de variáveis ambiente
