<?php

namespace App\Providers;

use Luxid\Foundation\Application;
use Rocket\Connection\Connection;
use Rocket\Migration\Migrator;
use Rocket\Seed\SeederRunner;

class RocketServiceProvider
{
  protected Application $app;
  protected array $config;

  public function __construct(Application $app)
  {
    $this->app = $app;
    // Load config from file
    $configFile = $app::$ROOT_DIR . '/config/rocket.php';
    if (file_exists($configFile)) {
      $this->config = require $configFile;
    } else {
      $this->config = [];
    }
  }

  public function register(): void
  {
    // Register Rocket connection using database config
    $dbConfig = $this->getDatabaseConfig();

    if ($dbConfig) {
      Connection::initialize($dbConfig);
    }

    // Store the connection in the app container
    $this->app->db = Connection::getInstance();
  }

  public function boot(): void
  {
    // Boot logic - register commands, etc.
  }

  protected function getDatabaseConfig(): ?array
  {
    // Try to get database config from config file
    $configFile = $this->app::$ROOT_DIR . '/config/config.php';
    if (file_exists($configFile)) {
      $config = require $configFile;
      if (isset($config['db'])) {
        return $config['db'];
      }
    }

    // Fallback to environment variables
    return [
      'dsn' => $_ENV['DB_DSN'] ?? '',
      'user' => $_ENV['DB_USER'] ?? 'root',
      'password' => $_ENV['DB_PASSWORD'] ?? '',
    ];
  }
}
