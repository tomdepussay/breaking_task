Welcome file
Welcome file

# Breaking Task

  

## Installer

  

Etape pour installer le projet

  

Cloner le projet :

```bash

git  clone  https://github.com/tomdepussay/breaking_task.git

cd  breaking_task

```

  

Modifier le fichier vite.config.js, avec l'url de votre site (localhost ou IP de la VM) :

```javascript

hmr: {

host: 'localhost',

},

```

  

```bash

cp  .env.example  .env

composer  install

./vendor/bin/sail  up  -d

./vendor/bin/sail  artisan  key:generate

./vendor/bin/sail  artisan  migrate

./vendor/bin/sail  npm  install

./vendor/bin/sail  npm  run  dev

```

## Déploiement
Le projet est disponible sur https://breaking-task.fr/
Breaking Task
Installer
Etape pour installer le projet

Cloner le projet :


git  clone  https://github.com/tomdepussay/breaking_task.git

cd  breaking_task

Modifier le fichier vite.config.js, avec l’url de votre site (localhost ou IP de la VM) :


hmr: {

host: 'localhost',

},


cp  .env.example  .env

composer  install

./vendor/bin/sail  up  -d

./vendor/bin/sail  artisan  key:generate

./vendor/bin/sail  artisan  migrate

./vendor/bin/sail  npm  install

./vendor/bin/sail  npm  run  dev

Déploiement
Le projet est disponible sur https://breaking-task.fr/

Markdown 642 bytes 75 words 59 lines Ln 59, Col 54HTML 465 characters 66 words 19 paragraphs
