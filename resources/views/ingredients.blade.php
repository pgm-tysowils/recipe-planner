<x-layouts::main title="ingrediënten">
  <section class="ingredients-page">
    <div class="ingredients-page-actions">
      <h1>Ingrediënten</h1>
      <a href="{{ route('ingredients.create') }}" class="btn btn-primary">Voeg een ingrediënt toe</a>
    </div>

    @if ($ingredients->isEmpty())
      <p>Je hebt nog geen ingrediënten toegevoegd. Voeg er een toe om te beginnen!</p>
    @else
      <?php 
        $aThird = ceil(count($ingredients) / 3);
      ?>
      <div class="ingredients-list-grid">
        <ul class="ingredients-list">
          @for ($i = 0; $i < count($ingredients); $i++)
            @if ($i % $aThird === 0 && $i !== 0)
              </ul>
              <ul class="ingredients-list">
            @endif
            <li>
              <span>{{ $ingredients[$i]['name'] }} ({{ $ingredients[$i]['weight'] }} {{ $ingredients[$i]['unit'] }})</span>
            </li>
          @endfor
        </ul>
      </div>
    @endif
  </section>
</x-layouts::main>