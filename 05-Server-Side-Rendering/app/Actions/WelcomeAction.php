<?php

namespace App\Actions;

use App\Actions\LuxidAction;
use Luxid\Nodes\Nova;

class WelcomeAction extends LuxidAction
{
  public function index()
  {
    // Renders Welcome page with default layout
    return Nova::render('Welcome', [
      'title' => 'Welcome to Luxid Framework',
      'version' => '0.5.0',
      'phpVersion' => PHP_VERSION,
    ]);
  }
}
