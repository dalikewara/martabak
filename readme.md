# Introduction

[Martabak](http://dalikewara.com/project/janggelan) is not a Content Management System (CMS) application like WordPress, Joomla, Drupal, etc. [Martabak](http://dalikewara.com/project/janggelan) runs for Website Manager that helping you to build your own Website/Application by doing something unexpected such as coding.

### Features (0.0.1 Z Rev 2)

- Routes registrar.

- Layouts generator.

- Home builder.

- Contents creator.

- Text editor with CodeMirror to generate syntax highlight. So, you can enjoy in coding.

### System Requirements

- PHP 7

- PDO PHP Extension

### How To Install

Martabak can be difficult to installed. So, please follow the instructions bellow carefully to can install Martabak.

- At the first, you will download Martabak file installation, then extract it into your folder
  or directory.

- You will found Martabak default files and directories. Place them into your root server.

- Go to the 'backend' folder, open installation.config, enter your data (username, password, etc) there,
  then save it.

- Go to the 'backend/config/database.php, enter your database configurations there (ignore auto_connect
  and pdo_fetch_style), then save it. You have to create new database based on your configuration.

- If you have done with the settings and configurations above, you can access your site or Martabak now.
  Normally, Martabak runs on the 'public' folder. If you are using localhost, you can set the 'public' folder as
  a server/document root (example in PHP: php -S localhost:8888 public). If you are using realtime/online
  server (shared hosting, etc), place the contents of the 'public' folder into your server/document root
  (can be 'public_html' or 'www'). After that, run your site or Martabak with browser (your '/'). It will processing
  installation automatically. Wait until the installation finished.

- If everything goes fine without errors, you will see messages that indicate your installation has been done perfectly.

- After that, please go to 'backend/mvc/requests.php', comment (recommended) or delete the installation route,
  and uncomment the Martabak system routes, then save it.

- Access your site or Martabak again, and now you have able to using Martabak. Just enjoy it.

Optional instructions.

- For better security, after you install Martabak, delete your installation.config. Or, you can move it to
  your saved place.

- Martabak turn off all errors reporting by default for better security. You can turn it on in
  'backend/config/debug.php'.

### Author

[Dali Kewara](http://dalikewara.com) [<dalikewara@windowslive.com>](mailto:dalikewara@windowslice.com)

### Powered By

[Martabak](http://dalikewara.com/project/janggelan) is powered by [Janggelan](http://dalikewara.com/project/janggelan), a simple and unexpected PHP Framework.

### License

[Martabak](http://dalikewara.com/project/janggelan) is an open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
