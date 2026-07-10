<x-layouts::main title="{{ $recipe['name'] }}">
  <section class="recipe-page">
    <div class="recipe-header">
      <h1>{{$recipe['name']}}</h1>
      <a href="/recipes/{{$recipe['id']}}/edit" class="edit-recipe-button">Bewerk recept</a>
    </div>
    <img src="{{ $recipe['image_url'] }}" alt="{{ $recipe['name'] }}" class="recipe-image">
    <div class="recipe-description">
      <h3>Beschrijving:</h3>
      <p>{{ $recipe['description'] }}</p>
    </div>
    <div class="recipe-steps">
      <h2>Stappen</h2>
      <ol>
        @foreach ($recipe['steps'] as $step)
          <li>{{ $step }}</li>
        @endforeach
      </ol>
    </div>
    <div class="recipe-ingredients">
      <h2>Ingrediënten</h2>
      <ul>
        @foreach ($recipe['ingredients'] as $ingredient)
          <li>{{ $ingredient['name'] }} - {{ $ingredient['pivot']['weight'] }} {{ $ingredient['unit'] }}</li>
        @endforeach
      </ul>
    </div>
  </section>
</x-layouts::main>