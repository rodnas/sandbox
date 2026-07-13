@servers(["staging" => "root@staging.forge.hu -p 22000", "web" => "root@forge.hu -p 22000"])

@task("staging", ["on" => "staging"])

	cd /var/www/staging.forge.hu
	git pull origin {{ $branch }}
	composer install --no-dev
	php artisan migrate
	./version.sh {{ $branch }} {{ $build }} {{ $commit }} > storage/app/version.txt

@endtask

@task("deploy", ["on" => "web"])

	cd /var/www/milliomosok.hu
	git pull origin {{ $branch }}
	composer install --no-dev
	cp /var/www/staging.milliomosok.hu/storage/app/version.txt /var/www/milliomosok.hu/storage/app/version.txt

@endtask
