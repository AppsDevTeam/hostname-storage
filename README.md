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
	storageFile: %wwwDir%/../system-info.json
```


deploy.php:
```php
host('master.1')
	->set('instance', 1);

host('master.2')
	->set('instance', 2);

...
		$run = 'sudo de php';
		run(<<<END
			$run php www/index.php env:$env tracy-system-info:set '{
				"Instance":     "{{instance}}",
				"Git commit":   "'$($run git rev-parse HEAD | tr -d '[:space:]')'",
				"Git branch":   "'$($run git rev-parse --abbrev-ref HEAD | tr -d '[:space:]')'",
				"Git tag":      "'$($run git describe --tags | tr -d '[:space:]')'",
				"Git message":  "'$($run git log -1 --pretty=%B | tr "\\n" " " | cut -c 1-32 | tr -d '[:space:]')'",
				"Deployed at":  "'$($run date '+%Y-%m-%d %H:%M:%S' | tr -d '[:space:]')'"
			}'
END
		);
```
