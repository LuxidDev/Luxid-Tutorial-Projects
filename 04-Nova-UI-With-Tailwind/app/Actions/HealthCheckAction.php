<?php

namespace App\Actions;

use Luxid\Nodes\Response;

class HealthCheckerAction extends LuxidAction
{
  /**
   * Get /api/health
   */
  public function index()
  {
    return Response::json([
      'status' => 'healthy',
      'timestamp' => date('Y-m-d H:i:s'),
    ]);
  }
}
