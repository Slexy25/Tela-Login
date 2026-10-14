# Full Stack Login — PHP + MySQL

Projeto inspirado na captura de tela fornecida. **Não é extração do código original do vídeo.**

## Tecnologias
HTML, CSS, JavaScript, PHP 8+ (PDO) e MySQL/MariaDB.

## Instalação no XAMPP
1. Copie a pasta `fullstack-login` para `C:\xampp\htdocs\`.
2. No painel do XAMPP, inicie **Apache** e **MySQL**.
3. Abra `http://localhost/phpmyadmin`, selecione **Importar** e importe `database.sql`.
4. Confira usuário, senha e banco em `config/database.php` (padrão XAMPP: `root` sem senha).
5. Acesse `http://localhost/fullstack-login/`.
6. Use **Register** para criar uma conta. A conta é criada como `user`.
7. Entre com e-mail/senha em **Login**. Usuários são direcionados a `user.php`.

## Como ter um administrador
Por segurança, o formulário público **não permite escolher `admin`**. Para testes locais, cadastre um usuário normalmente e depois execute no phpMyAdmin (aba SQL), substituindo o e-mail:

```sql
USE fullstack_login;
UPDATE users SET role = 'admin' WHERE email = 'seuemail@exemplo.com';
```

Depois saia e entre de novo. A conta será encaminhada para `admin.php`.

## Arquivos
- `index.php`: layout e formulários
- `assets/style.css`: visual responsivo
- `assets/app.js`: alternar entre login e cadastro
- `register.php`: cadastra com hash de senha
- `login.php`: confere senha e cria sessão
- `admin.php`, `user.php`: páginas restritas por perfil
- `logout.php`: encerra sessão
- `config/database.php`: conexão MySQL via PDO
- `database.sql`: estrutura do banco

## Segurança / produção
O projeto contém hash de senha (`password_hash`), consultas preparadas, tokens CSRF nos formulários, proteção de rotas e regeneração de sessão após login. Para publicar na internet, configure HTTPS, credenciais fora da pasta pública, cookies seguros, limites de tentativas de login, logs e tratamento de recuperação de senha. É um projeto didático para ambiente local.
