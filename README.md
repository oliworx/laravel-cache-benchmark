# Laravel cache benchmark

A simple tool to benchmark several Laravel cache stores

## Purpose
Benchmark the performance of Laravel cache stores - in DEV and PROD environments.

## Setup
Copy the file `cache-benchmark.php` to the directory of your Laravel application.

### optional configuration
Edit the file `cache-benchmark.php` to change parameters acording to your needs:

    $cacheStores = ['array', 'memcached', 'redis', 'database', 'file'];
    $readToWriteRatio = 20;
    $numItems = 100;

## Usage
Within the directory of your Laravel application run

    php artisan tinker cache-benchmark.php

The resulting output is something like this:

    Psy Shell v0.9.12 (PHP 7.4.2 — cli) by Justin Hileman
    array: 0.133 seconds, 15815 queries/sec
    memcached: 0.517 seconds, 4061 queries/sec
    redis: 0.736 seconds, 2853 queries/sec
    database: 2.122 seconds, 990 queries/sec
    file: 2.461 seconds, 853 queries/sec
    
## License
MIT License: <https://kurmis.mit-license.org>
