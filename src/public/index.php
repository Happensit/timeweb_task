<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

spl_autoload_register(function ($className) {
    include sprintf("../%s.php", str_replace('\\', "/", $className));
});

$config = [
    'db' => [
        'dsn' => "pgsql:host=postgres;dbname=docker",
        'username' => 'docker',
        'password' => 'docker',
    ],
];

$api = new Api\Application($config);

$api->router->get('/products', function () use ($api) {
    $data = $api->db->query(
        'SELECT *, (price/100) as price, 0 as quantity FROM product'
    )->findAll();
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
});

$api->router->get('/import', function () use ($api) : void {
    $xml = file_get_contents($api->getStaticPath() . "/product.xml");
    $query = sprintf("
    INSERT INTO product 
    (SELECT 
      CAST(CAST(unnest(xpath('//item/sku/text()', xml)) as VARCHAR) as INTEGER) as sku,
      unnest(xpath('//item/name/text()', xml)) as name,
      unnest(xpath('//item/image/text()', xml)) as image,
      (CAST(CAST(unnest(xpath('//item/price/text()', xml)) as VARCHAR ) as NUMERIC) * 100) as price
    FROM unnest(xpath('//items', XMLPARSE(DOCUMENT convert_from('%s', 'UTF8')))) as xml
    ) ON CONFLICT(sku) DO UPDATE SET price = EXCLUDED.price;
", $xml);

    $api->db->execute($query);
});

$api->run();
