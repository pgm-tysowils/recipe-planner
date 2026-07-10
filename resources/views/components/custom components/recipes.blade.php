<div class="recipes-component">
  <div class="recipes-list">
    @if (!isset($recipes) || count($recipes) === 0)
      <p class="no-recipes">Geen recepten gevonden.</p>
    @endif
    @foreach ($recipes as $recipe)
      <div class="recipe-card">
        <img src="{{ $recipe['image_url'] }}" alt="{{ $recipe['name'] }}" class="recipe-image">
        <h3>{{ $recipe['name'] }}</h3>
        @if (isset($isHome) && $isHome)
          <p>{{ \Illuminate\Support\Str::words($recipe['description'], 10, '...') }}</p>
        @else
          <p>{{ $recipe['description'] }}</p>
        @endif
        <a href="/recipes/{{ $recipe['id'] }}" class="recipe-button">Bekijk recept</a>
      </div>
    @endforeach
  </div>
</div>