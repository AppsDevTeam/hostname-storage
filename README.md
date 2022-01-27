# Tracy System info

Extends information in "System info" in Tracy panel.

composer:
```
composer require adt/tracy-system-info
```

neon:
```
extensions:
	tracySystemInfo: ADT\TracySystemInfo\DI\TracySystemInfoExtension

tracySystemInfo:
	storageFile: %wwwDir%/../system-info.json
```

makefile:
```
set-system-info:
	$(APP) tracy-system-info:set "{\"Instance\":"$(RUN_ARGS)"}"
```

deploy.php:
```
host('master.1')
	->set('instance', 1);

host('master.2')
	->set('instance', 2);

...

run("make set-system-info -- {{instance}}");
```
