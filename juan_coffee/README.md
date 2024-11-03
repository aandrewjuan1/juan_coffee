# Enable `mod_rewrite` in Apache

MVC design yung ginamit ko sir para sa app na to, so need niya ng URL routing which is by default hindi naka siya naka-on. 

Hindi po siya gagana if di naka enable yung mod_rewrite sa apache, so may kailangang baguhin sa config.

Make sure din sir na yung name ng project or folder na ilalagay niyo sa htdocs is "juan_coffee"
## Steps to enable routing:

1. Open XAMPP then go to Apache configuration file: `httpd.conf` (located between Admin and Logs in XAMPP Control Panel).
2. Find the line: `#LoadModule rewrite_module modules/mod_rewrite.so`.
3. Remove the `#` at the beginning to uncomment it and enable `mod_rewrite`.
4. Restart Apache from the XAMPP Control Panel.

# Setup Instructions

## Creating a `.htaccess` file

To set up proper URL routing, directory access control, and security settings for this project, please create a `.htaccess` file in the root directory of the project and paste the following code into it.

### .htaccess Content

```apache
# Enable the Rewrite Engine
RewriteEngine On

# Disable directory listing
Options -Indexes

# Block access to specific file types
<FilesMatch "\.(env|htaccess|htpasswd|ini|log|sh|json)$">
    Order allow,deny
    Deny from all
</FilesMatch>

# Block access to sensitive directories (adjust these paths based on your structure)
RewriteRule ^app/ - [F,L]

# If the request is for a file or directory that exists, do nothing
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

# Otherwise, redirect the request to index.php
RewriteRule ^(.*)$ index.php [QSA,L]
