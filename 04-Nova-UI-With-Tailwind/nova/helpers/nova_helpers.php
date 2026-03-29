<?php

use Luxid\Nova\Slot;

if (!function_exists('nova_layout')) {
  /**
   * Render a page with a layout
   */
  function nova_layout(string $page, array $props = [], string $layout = 'AppLayout'): string
  {
    Slot::start('content');
    echo nova('pages/' . $page, $props);
    Slot::end();

    return nova('layouts/' . $layout, $props);
  }
}

if (!function_exists('nova_component')) {
  /**
   * Render a component
   */
  function nova_component(string $name, array $props = []): string
  {
    return nova('components/' . $name, $props);
  }
}
