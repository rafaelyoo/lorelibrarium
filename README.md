# Lorelibrarium

Sistema de gerenciamento e organização de livros, autores e assuntos relacionados.

---

## 🚀 Requisitos

### 🐳 Docker

Docker é necessário para criar ambientes isolados para o projeto.

- Para instalar no **Linux**:

  ```bash
  curl -fsSL https://get.docker.com -o get-docker.sh
  sudo sh get-docker.sh
  ```

- Mais detalhes e guias para outros sistemas:  
  👉 [Docker Docs - Instalação](https://docs.docker.com/get-docker/)

---

### 📦 NPM

NPM é usado para gerenciar dependências de frontend.

- Para instalar no **Linux**:

  ```bash
  sudo apt update
  sudo apt install nodejs npm
  ```

- Mais informações e instruções para outros sistemas:  
  👉 [Node.js Download](https://nodejs.org/en/download/)

---

### 🐘 PHP

PHP é necessário para rodar a aplicação (recomendado PHP 8+).

- Para instalar no **Linux**:

  ```bash
  sudo apt update
  sudo apt install php php-cli php-mbstring php-xml php-zip php-curl
  ```

- Mais informações e guias para outros sistemas:  
  👉 [PHP.net Downloads](https://www.php.net/downloads)

---

### 🎼 Composer

Composer é o gerenciador de dependências do PHP.

- Para instalar no **Linux**:

  ```bash
  curl -sS https://getcomposer.org/installer | php
  sudo mv composer.phar /usr/local/bin/composer
  ```

- Mais informações e instruções para outros sistemas:  
  👉 [Composer Download](https://getcomposer.org/download/)

---

## ⚙️ Comandos para subir o ambiente local

```bash
# Suba os containers do Docker
docker-compose up -d

# Instale as dependências do PHP dentro da pasta lorelibrarium
cd lorelibrarium
composer install

# Instale as dependências do frontend
npm install

# Renomei o arquivo .env.example para .env
cp .env.example .env

# Rode as migrações
docker exec -it lorelibrarium_app php artisan migrate

# Rode o comando para gerar a chave
docker exec -it lorelibrarium_app php artisan key:generate

# Dê permissão na pasta
sudo chown -R $USER:docker lorelibrarium/
sudo chmod -R 777 lorelibrarium/storage
sudo chmod -R 777 lorelibrarium/bootstrap

# Rode o "npm run dev" na pasta do projeto lorelibrarium
npm run dev

# Para rodar os testes 
docker exec -e XDEBUG_MODE=coverage -it lorelibrarium_app php artisan test --coverage
```

- Instruções para utilização do sistema:  
  👉 [Tutorial](https://docs.google.com/document/d/1I8ssy0piHXLHgi3QbrcYreBoHla9vqKNPUqUt0-_YOI/edit?usp=sharing)