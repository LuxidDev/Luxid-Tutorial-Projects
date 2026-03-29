<?php

function getDatabaseDSN(): string
{
  if (isset($_ENV['DB_DSN'])) {
    $dsn = $_ENV['DB_DSN'];
    $dsn = trim($dsn, '"\'');
    return $dsn;
  }

  $dbname = $_ENV['DB_NAME'] ?? 'luxid';
  $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
  $port = $_ENV['DB_PORT'] ?? '3306';

  $sockets = [
    '/run/mysqld/mysqld.sock',
    '/var/run/mysqld/mysqld.sock',
    '/tmp/mysql.sock',
  ];

  foreach ($sockets as $socket) {
    if (file_exists($socket)) {
      return "mysql:unix_socket={$socket};dbname={$dbname}";
    }
  }

  return "mysql:host={$host};port={$port};dbname={$dbname}";
}

return [
  'db' => [
    'dsn' => getDatabaseDSN(),
    'user' => $_ENV['DB_USER'] ?? 'root',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
  ],
  'userClass' => \App\Entities\User::class,

  // Rocket ORM settings
  'rocket' => [
    'cache' => [
      'enabled' => true,
      'path' => __DIR__ . '/../storage/framework/rocket',
    ],
    'migrations' => [
      'path' => __DIR__ . '/../migrations',
    ],
    'seeds' => [
      'path' => __DIR__ . '/../seeds',
    ],
  ],
];
