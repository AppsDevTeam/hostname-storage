# Tracy System info

Extends information in "System info" in Tracy panel.

composer:
```bash
composer require adt/tracy-system-info
```

neon:
```neon
extensions:
	tracySystemInfo: ADT\TracySystemInfo\DI\TracySystemInfoExtension

tracySystemInfo:
	storageFile: %wwwDir%/../tracy-system-info.neon
```


deploy.php:
```php
host('master.1')
	->set('instance', 1);

host('master.2')
	->set('instance', 2);

...

run("sudo de php www/index.php tracy-system-info:add Instance {{instance}}");
run("sudo de php www/index.php tracy-system-info:add MyKey MyValue");

run("sudo de php www/index.php tracy-system-info:add --git-commit");
run("sudo de php www/index.php tracy-system-info:add --git-branch");
run("sudo de php www/index.php tracy-system-info:add --git-tag");
run("sudo de php www/index.php tracy-system-info:add --git-message");
run("sudo de php www/index.php tracy-system-info:add --git-timestamp");
```
