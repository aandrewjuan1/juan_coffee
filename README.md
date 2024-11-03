# SETUP INSTRUCTIONS

1. MVC design yung ginamit ko sir para sa app na to, so need niya ng URL routing which is by default hindi naka siya naka-on sa XAMPP. May kailangan baguhin sa config.
2. Also, kailangan niyo rin po gumawa ng `.htaccess` file.
3. Lastly, Make sure din sir na yung name ng project or folder na ilalagay niyo sa htdocs is "juan_coffee"

## Steps to enable routing or `mod_rewrite` in Apache:

1. Open XAMPP then go to Apache configuration file: `httpd.conf` (located between Admin and Logs in XAMPP Control Panel).
2. Find the line: `#LoadModule rewrite_module modules/mod_rewrite.so`.
3. Remove the `#` at the beginning to uncomment it and enable `mod_rewrite`.
4. Restart Apache from the XAMPP Control Panel.

## After making the `.htaccess` file, paste this content:

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
