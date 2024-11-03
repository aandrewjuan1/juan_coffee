# Enable `mod_rewrite` in Apache

MVC design yung ginamit ko sir para sa app na to, so need niya ng URL routing which is by default hindi naka siya naka-on. 

Hindi po siya gagana if di naka enable yung mod_rewrite sa apache, so may kailangang baguhin sa config.

Make sure din sir na yung name ng project or folder na ilalagay niyo sa htdocs is "juan_coffee"
## Steps to enable routing:

1. Open XAMPP then go to Apache configuration file: `httpd.conf` (located between Admin and Logs in XAMPP Control Panel).
2. Find the line: `#LoadModule rewrite_module modules/mod_rewrite.so`.
3. Remove the `#` at the beginning to uncomment it and enable `mod_rewrite`.
4. Restart Apache from the XAMPP Control Panel.
