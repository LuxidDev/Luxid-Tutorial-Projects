<?php

component('components/Card', function ($c) {
  $c->state(function () {
    return [
      'title' => 'Tailwind Demo',
      'content' => 'This card demonstrates Tailwind CSS styling!',
      'color' => 'blue'
    ];
  });

  $c->view(function ($state) {
    $colorClasses = [
      'blue' => 'bg-blue-500 hover:bg-blue-600',
      'green' => 'bg-green-500 hover:bg-green-600',
      'purple' => 'bg-purple-500 hover:bg-purple-600',
      'red' => 'bg-red-500 hover:bg-red-600'
    ];

    $buttonClass = $colorClasses[$state->color] ?? 'bg-gray-500 hover:bg-gray-600';
?>
    <div class="max-w-sm rounded-xl overflow-hidden shadow-lg bg-white/10 backdrop-blur-sm border border-white/20">
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2 text-white">@echo($state->title)</div>
        <p class="text-gray-300 text-base">@echo($state->content)</p>
      </div>
    </div>
<?php
  });
});
