# Breaking Task

## Installer

Etape pour installer le projet

Cloner le projet :
```bash
git clone https://github.com/tomdepussay/breaking_task.git
cd breaking_task
```

Modifier le fichier vite.config.js, avec l'url de votre site (localhost ou IP de la VM) : 
```javascript
hmr: {
    host: 'localhost',
},
```

```bash
cp .env.example .env
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```
