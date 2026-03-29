<?php

namespace Luxid\Framework;

class Kernel
{

  public static function postCreateProject($event = null)
  {
    $projectRoot = getcwd();
    $vendorDir = $projectRoot . '/vendor';

    // Try to get vendor dir from Composer event if available
    if ($event !== null && method_exists($event, 'getComposer')) {
      try {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        $projectRoot = dirname($vendorDir);
      } catch (\Throwable $e) {
        // Fallback to current directory
      }
    }

    // Setup Rocket ORM
    self::setupRocket($vendorDir, $projectRoot);

    // Setup Nova directory structure
    self::setupNova($vendorDir, $projectRoot);

    // Setup Juice CLI
    self::setupJuiceCli($vendorDir, $projectRoot);

    echo PHP_EOL;
    echo "==========================================" . PHP_EOL;
    echo "🚀 Luxid Framework installed successfully!" . PHP_EOL;
    echo "==========================================" . PHP_EOL;
    echo PHP_EOL;
    echo "🍋 To get started:" . PHP_EOL;
    echo "   1. cd into your newly created Luxid Application" . PHP_EOL;
    echo "   2. Configure your .env file" . PHP_EOL;
    echo "   3. Run: php juice serve" . PHP_EOL;
    echo PHP_EOL;
    echo "✨ Nova reactive components are ready!" . PHP_EOL;
    echo "   Components are located in the 'nova' directory" . PHP_EOL;
    echo "   Edit nova/pages/Welcome.nova.php to customize your welcome page" . PHP_EOL;
    echo PHP_EOL;
    echo "📚 Documentation: https://luxid.dev/docs" . PHP_EOL;
    echo "🐛 Report issues: https://github.com/luxid/framework/issues" . PHP_EOL;
    echo PHP_EOL;
  }

  private static function setupRocket(string $vendorDir, string $projectRoot): void
  {
    $rocketPath = $vendorDir . '/luxid/rocket';

    if (!is_dir($rocketPath)) {
      echo "⚠️  Rocket ORM not found. Skipping Rocket setup..." . PHP_EOL;
      return;
    }

    // Create migrations directory
    $migrationsDir = $projectRoot . '/migrations';
    if (!is_dir($migrationsDir)) {
      mkdir($migrationsDir, 0755, true);
      echo "✓ Created migrations directory" . PHP_EOL;
    }

    // Create seeds directory
    $seedsDir = $projectRoot . '/seeds';
    if (!is_dir($seedsDir)) {
      mkdir($seedsDir, 0755, true);
      echo "✓ Created seeds directory" . PHP_EOL;
    }

    // Create initial migration
    $migrationFile = $migrationsDir . '/m00001_create_users_table.php';
    if (!file_exists($migrationFile)) {
      $content = <<<'PHP'
<?php

use Rocket\Migration\Migration;
use Rocket\Migration\Rocket;

class m00001_create_users_table extends Migration
{
    public function up(): void
    {
        Rocket::table('users', function($column) {
            $column->id('id');
            $column->string('email')->unique();
            $column->string('password')->hidden();
            $column->string('firstname');
            $column->string('lastname');
            $column->timestamps();
        });
    }
    
    public function down(): void
    {
        Rocket::drop('users');
    }
}
PHP;
      file_put_contents($migrationFile, $content);
      echo "✓ Created initial user migration" . PHP_EOL;
    }

    // Create DatabaseSeeder
    $seederFile = $seedsDir . '/DatabaseSeeder.php';
    if (!file_exists($seederFile)) {
      $content = <<<'PHP'
<?php

namespace Seeds;

use Rocket\Seed\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
    }
}
PHP;
      file_put_contents($seederFile, $content);
      echo "✓ Created DatabaseSeeder" . PHP_EOL;
    }

    // Create UserSeeder
    $userSeederFile = $seedsDir . '/UserSeeder.php';
    if (!file_exists($userSeederFile)) {
      $content = <<<'PHP'
<?php

namespace Seeds;

use Rocket\Seed\Seeder;
use App\Entities\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = new User();
        $admin->email = 'admin@example.com';
        $admin->password = 'admin123';
        $admin->firstname = 'Admin';
        $admin->lastname = 'User';
        $admin->save();
        
        echo "  ✓ Created admin user\n";
        
        // Create 10 regular users
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->email = "user{$i}@example.com";
            $user->password = 'password123';
            $user->firstname = "User";
            $user->lastname = "{$i}";
            $user->save();
        }
        
        echo "  ✓ Created 10 regular users\n";
    }
}
PHP;
      file_put_contents($userSeederFile, $content);
      echo "✓ Created UserSeeder" . PHP_EOL;
    }

    // Create Rocket cache directory
    $cacheDir = $projectRoot . '/storage/framework/rocket';
    if (!is_dir($cacheDir)) {
      mkdir($cacheDir, 0755, true);
      echo "✓ Created Rocket cache directory" . PHP_EOL;
    }
  }

  private static function setupNova(string $vendorDir, string $projectRoot): void
  {
    $frameworkPath = $vendorDir . '/luxid/framework';
    $novaSource = $frameworkPath . '/nova';
    $novaTarget = $projectRoot . '/nova';

    if (is_dir($novaSource) && !is_dir($novaTarget)) {
      self::copyDirectory($novaSource, $novaTarget);
      echo "✓ Created Nova directory structure" . PHP_EOL;
    }

    // Copy nova.js to web directory
    $novaPackagePath = $vendorDir . '/luxid/nova';
    $sourceJs = $novaPackagePath . '/public/nova.js';
    $targetJs = $projectRoot . '/web/nova.js';

    if (file_exists($sourceJs) && !file_exists($targetJs)) {
      copy($sourceJs, $targetJs);
      echo "✓ Copied nova.js to web directory" . PHP_EOL;
    }

    // Ensure storage directory exists for cache
    $storagePath = $projectRoot . '/storage/framework/nova';
    if (!is_dir($storagePath)) {
      mkdir($storagePath, 0755, true);
      echo "✓ Created Nova cache directory" . PHP_EOL;
    }
  }

  private static function copyDirectory(string $source, string $destination): void
  {
    if (!is_dir($destination)) {
      mkdir($destination, 0755, true);
    }

    $files = scandir($source);
    foreach ($files as $file) {
      if ($file === '.' || $file === '..') continue;

      $srcPath = $source . '/' . $file;
      $dstPath = $destination . '/' . $file;

      if (is_dir($srcPath)) {
        self::copyDirectory($srcPath, $dstPath);
      } else {
        copy($srcPath, $dstPath);
      }
    }
  }

  private static function setupJuiceCli(string $vendorDir, string $projectRoot): void
  {
    // The juice file is in the ROOT of luxid/engine package
    $juiceSource = $vendorDir . '/luxid/engine/juice';

    // Also check Engine/juice as fallback (for consistency)
    $fallbackSource = $vendorDir . '/luxid/engine/Engine/juice';

    if (!file_exists($juiceSource) && file_exists($fallbackSource)) {
      $juiceSource = $fallbackSource;
    }

    $juiceTarget = $projectRoot . '/juice';

    // Check if juice file exists in engine
    if (!file_exists($juiceSource)) {
      echo "⚠️  Juice CLI not found in engine package" . PHP_EOL;
      echo "   Expected at: " . $juiceSource . PHP_EOL;

      // Debug: List engine directory contents
      $engineDir = $vendorDir . '/luxid/engine';
      if (is_dir($engineDir)) {
        echo PHP_EOL . "   Engine package contents:" . PHP_EOL;
        $items = scandir($engineDir);
        foreach ($items as $item) {
          if ($item !== '.' && $item !== '..') {
            $path = $engineDir . '/' . $item;
            echo "   - " . $item . " (" . (is_dir($path) ? "dir" : "file") . ")" . PHP_EOL;
          }
        }
      }
      return;
    }

    // Check if juice file already exists in project root
    if (file_exists($juiceTarget)) {
      echo "ℹ️  'juice' CLI already exists in project root" . PHP_EOL;
      echo "   Skipping creation..." . PHP_EOL;
    } else {
      // Copy juice file to project root
      if (copy($juiceSource, $juiceTarget)) {
        echo "✓ Created 'juice' CLI tool in project root" . PHP_EOL;
      } else {
        echo "⚠️  Could not copy juice to project root" . PHP_EOL;
        return;
      }
    }

    // Handle platform-specific setup
    if (self::isUnixLike()) {
      // Unix/Linux/macOS - make executable
      chmod($juiceTarget, 0755);
      echo "✓ Made 'juice' executable (Unix/Linux/macOS)" . PHP_EOL;

      // Also ensure vendor/bin/juice exists (Composer should handle this via "bin" config)
      $juiceVendorBin = $vendorDir . '/bin/juice';
      if (!file_exists($juiceVendorBin)) {
        echo "⚠️  juice not found in vendor/bin (Composer bin-dir)" . PHP_EOL;
        echo "   You can run: php vendor/luxid/engine/juice" . PHP_EOL;
      } else {
        echo "✓ juice available in vendor/bin" . PHP_EOL;
      }
    } else {
      // Windows - create batch file
      self::createWindowsBatchFile($projectRoot);
    }

    // Test if juice works
    echo PHP_EOL . "🔧 Testing juice CLI..." . PHP_EOL;
    exec('php ' . escapeshellarg($juiceTarget) . ' --version 2>&1', $output, $returnCode);
    if ($returnCode === 0) {
      echo "✅ juice CLI is working correctly!" . PHP_EOL;
    } else {
      echo "⚠️  juice CLI test failed (code: $returnCode)" . PHP_EOL;
      if (!empty($output)) {
        echo "   Output: " . implode(PHP_EOL . "   ", $output) . PHP_EOL;
      }
    }
  }

  private static function isUnixLike(): bool
  {
    return DIRECTORY_SEPARATOR === '/';
  }

  private static function createWindowsBatchFile(string $projectRoot): void
  {
    $batFile = $projectRoot . '/juice.bat';
    $batContent = '@echo off' . PHP_EOL;
    $batContent .= 'REM Luxid CLI Tool - Windows Batch Wrapper' . PHP_EOL;
    $batContent .= 'echo Luxid CLI Tool' . PHP_EOL;
    $batContent .= 'php "%~dp0juice" %*' . PHP_EOL;

    if (file_put_contents($batFile, $batContent)) {
      echo "✓ Created 'juice.bat' for Windows compatibility" . PHP_EOL;
      echo "  Windows users can run: juice.bat [command]" . PHP_EOL;
    }

    // Also create a PowerShell script for modern Windows
    $ps1File = $projectRoot . '/juice.ps1';
    $ps1Content = '#!/usr/bin/env pwsh' . PHP_EOL;
    $ps1Content .= 'Write-Host "Luxid CLI Tool" -ForegroundColor Cyan' . PHP_EOL;
    $ps1Content .= 'php "$PSScriptRoot/juice" $args' . PHP_EOL;

    if (file_put_contents($ps1File, $ps1Content)) {
      echo "✓ Created 'juice.ps1' for PowerShell users" . PHP_EOL;
    }
  }
}
