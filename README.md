## Setup:
- open command line inside the project directory
- php composer.phar install
- vendor/bin/doctrine orm:schema-tool:update --force --dump-sql
- open index.php in the browser

- If you want this app to be served from root page (i.e. localhost), include this .htaccess file
```
#[www/.htaccess] when user is redirected transparently to <app_name>/ app (local .htaccess is not needed)
<IfModule mod_rewrite.c>
RewriteEngine on
RewriteCond %{ENV:REDIRECT_STATUS} ^$
RewriteRule ^(.*)$ app2/index.php/$1 [L]
</IfModule>
```
