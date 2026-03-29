<?php
// Nova routes (HTML responses using Nova)

use App\Actions\WelcomeAction;

// Welcome page - main entry point
route('welcome')
  ->get('/')
  ->uses(WelcomeAction::class, 'index')
  ->open();

// Example: Dashboard (protected route - requires authentication)
// route('dashboard')
//     ->get('/dashboard')
//     ->uses(DashboardAction::class, 'index')
//     ->secure();
