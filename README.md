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


run("sudo de php www/index.php tracy-system-info:add Commit $(git log --format=\"%H\" -n 1)");
run("sudo de php www/index.php tracy-system-info:add Branch $(git rev-parse --abbrev-ref HEAD)");
run("sudo de php www/index.php tracy-system-info:add Tag $(git describe --tags --always)");
run("sudo de php www/index.php tracy-system-info:add Message \"$(git log -1 --pretty=%B)\"");
run("sudo de php www/index.php tracy-system-info:add --timestamp");
```
