<?php
// API routes (JSON responses)

use App\Actions\HealthCheckAction;

// Health check endpoint
route('api.health')
  ->get('/api/health')
  ->uses(HealthCheckAction::class, 'index')
  ->open();

// Example API endpoints (commented out - uncomment as needed)
// route('users.index')
//     ->get('/api/users')
//     ->uses(UserApiAction::class, 'index')
//     ->secure();
