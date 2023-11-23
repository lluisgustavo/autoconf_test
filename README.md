# Autoconf Teste Técnico - Laravel, Breeze, InertiaJS, Tailwind

Este projeto é um teste técnico para uma entrevista na Autoconf. O objetivo é demonstrar proficiência na construção de uma aplicação web usando PHP, Laravel e Banco de Dados. Eu decidi utilizar Breeze, InertiaJS, Tailwind, PostgreSQL e seguir o formato de commits convencionais para mensagens de commit.

## Sumário

-   [Objetivos do Projeto](#objetivos-do-projeto)
-   [Tech Stack](#tech-stack)
-   [Práticas de Desenvolvimento](#praticas-de-desenvolvimento)
-   [Configuração/Primeiros Passos](#configuracaoprimeiros-passos)

## Objetivos do Projeto

O objetivo deste projeto é avaliar as habilidades em desenvolvimento web backend de PHP e Laravel.
Não houve intenção de criar uma solução excessivamente complexa, mas sim demonstrar habilidades sólidas de desenvolvimento.

## Tech Stack

-   [PHP](https://www.php.net/): O PHP é uma linguagem de script de propósito geral muito popular, especialmente adequada para o desenvolvimento web. Rápida, flexível e pragmática.
-   [Laravel](https://laravel.com/): Um framework de aplicação web PHP.
-   [Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze): Um starter kit leve do Laravel para autenticação.
-   [InertiaJS](https://inertiajs.com/): uma abordagem para construir aplicativos da web de página única (SPA) de maneira mais simplificada.
-   [Tailwind CSS](https://tailwindcss.com/): Um framework CSS altamente personalizável que fornece classes utilitárias para construir rapidamente componentes de interface do usuário.
-   [PostgreSQL](https://www.postgresql.org/): Sistema de gerenciamento de banco de dados relacional open source.
-   [Conventional Commits](https://www.conventionalcommits.org/): Uma especificação para escrever mensagens de commit padronizadas.
-   [K UI Breeze Starter](https://github.com/Kamona-WD/kui-laravel-breeze): Um layout utilizado.

## Práticas de Desenvolvimento

-   Conventional Commits: Este projeto segue o formato [Conventional Commits](https://www.conventionalcommits.org/) para mensagens de commit. Isso ajuda a gerar um histórico de commits claro e padronizado.

-   Repository & Service Pattern: A ideia do Repository & Service Pattern é manter a lógica de negócios (services) e o acesso ao banco de dados (repositories) da sua aplicação separadas, mantendo nossos controllers mais legíveis.

## Configuração/Primeiros Passos

To create the app, we will be utilizing the Marvel API. Follow the steps below to set up your development environment:

1. Clone o repositório:

```
git clone https://github.com/lluisgustavo/autoconf_test.git
```

2. Instale as dependências do composer:

```
cd autoconf_test
composer install
```

3. Instale as dependências do NPM:

```
npm install
```

4. Copie o arquivo `.env.example` e renomeie para `.env`:

```
cp .env.example .env
```

5. Configure as variáveis de ambiente conforme suas configurações do banco de dados:

6. Gere a chave de aplicativo:

```
php artisan key:generate
```

7. Execute as migrations:

```
php artisan migrate
```

8. Crie o link do storage para o public:

```
php artisan storage:link
```

9. Compile os Assets do NPM:

```
npm run dev
```

ou

```
npm run build
```

10. Inicie o servidor:

```
php artisan serve
```

Se você deseja criar rapidamente um usuário padrão para fins de teste, pode usar o seguinte comando Artisan:

```
php artisan db:seed
```

Isso criará um usuário com o email test@example.com e a senha password.

Se preferir, você pode registrar um novo usuário através da página de registro.

11. Acesse o aplicativo em [http://localhost:8000](http://localhost:8000).
