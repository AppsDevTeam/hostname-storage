# hostname-storage

composer:
```
composer require adt/hostname-storage
```

makefile:

```
savehostname:
	$(APP) app:savehostname $(RUN_ARGS)
```

deploy:

```
host('master.1')
	->set('instance', 1);

host('master.2')
	->set('instance', 2);

...

run('make savehostname -- {{instance}}');

```