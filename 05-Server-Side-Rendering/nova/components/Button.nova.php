<?php

component('components/Button', function ($c) {
  $c->state(function () {
    return [
      'label' => 'Click Me',
      'type' => 'button',
      'variant' => 'primary',
      'disabled' => false
    ];
  });

  $c->actions([
    'click' => function (&$state) {
      // Handle click - can be overridden by parent
    }
  ]);

  $c->view(function ($state) {
    $variantClasses = [
      'primary' => 'btn-primary',
      'secondary' => 'btn-secondary',
      'danger' => 'bg-red-600 hover:bg-red-700 text-white'
    ];

    $class = $variantClasses[$state->variant] ?? 'btn-primary';
    $disabled = $state->disabled ? 'disabled' : '';

?>
    <button type="@echo($state->type)"
      class="@echo($class) px-6 py-3 rounded-lg font-semibold transition-all duration-200"
      @click="click"
      @echo($disabled)>
      @echo($state->label)
    </button>
<?php
  });
});
