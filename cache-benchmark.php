<?php

$cacheStores = ['array', 'memcached', 'redis', 'database', 'file'];
$readToWriteRatio = 20;
$numItems = 100;

function benchmarkCacheStore($cacheStore, $readToWriteRatio, $dataSet)
{
    $tStart = microtime(true);

    foreach ($dataSet as $cacheKey => $value) {
        cache()->store($cacheStore)->put($cacheKey, $value, 1000);
        for ($j = 0; $j < $readToWriteRatio; $j++) {
            cache()->store($cacheStore)->get($cacheKey);
        }
    }

    return microtime(true) - $tStart;
}

/**
 * @param int $items
 * @return array
 */
function prepareData(int $items)
{
    $data = [];
    for ($i = 0; $i < $items; $i++) {
        $cacheKey = 'some-cache-key-' . $i;
        $value = str_repeat(md5($i), 5);
        $data[$cacheKey] = $value;
    }

    return $data;
}

$dataSet = prepareData($numItems);
$numCacheQueries = $numItems * (1 + $readToWriteRatio);

foreach ($cacheStores as $cacheStore) {
    echo $cacheStore . ': ';

    try {
        $time = benchmarkCacheStore($cacheStore, $readToWriteRatio, $dataSet);
        echo(round($time, 3) . " seconds, " . round($numCacheQueries / $time) . " queries/sec\n");
    } catch (Exception $e) {
        echo " n/a\n";
    }
}

exit;
