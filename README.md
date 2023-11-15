Installation


create database db_dilg_web
git init
git remote add origin https://git.dilg.gov.ph/istms-appdev/dilg-web-ext.git

git pull origin master
php init (dev)
run migrations


Migrations
<ul>
    <li>php yii migrate --migrationPath="vendor/niksko12/yii2-user/migrations" --interactive=0;
    <li>php yii migrate --migrationPath="vendor/yiisoft/yii2/rbac/migrations" --interactive=0;
    <li>php yii migrate --migrationPath="vendor/niksko12/yii2-audit-log/migrations" --interactive=0;
    <li>php yii migrate --migrationPath="vendor/akesandiego/yii2-attachments/migrations" --interactive=0;
    <li>php yii migrate --interactive=0;
</ul>