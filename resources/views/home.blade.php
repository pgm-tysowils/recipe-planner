<x-layouts::main title="Home">
  @include('components.custom components.home-section', [
    'sectionName' => 'planning-week',
    'title' => 'Week planning',
    'link' => '/planning',
    'buttonText' => 'Bekijk je planning',
    'component' => 'planning-week',
    'compdata' => ['planning' => $newPlanning, 'recipes' => $recipes, 'isHome' => true]
  ])

  @include('components.custom components.home-section', [
    'sectionName' => 'recipes',
    'title' => 'Kook met wat je al hebt',
    'link' => '/recipes?ready=on',
    'buttonText' => 'Bekijk alle recepten',
    'component' => 'recipes',
    'compdata' => ['recipes' => $recipes, 'isHome' => true]
  ])

  @include('components.custom components.home-section', [
    'sectionName' => 'ingredients-list',
    'title' => 'alle ingrediënten in één lijst',
    'link' => '/ingredients',
    'buttonText' => 'Bekijk je ingrediënten',
    'component' => 'ingredients-list',
    'compdata' => ['groceryList' => null, 'isHome' => true]
  ])
</x-layouts::main>