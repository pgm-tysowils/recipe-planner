<x-layouts::main title="Recepten">
  <section class="recipes-page">
    <div class="recipes-page-header">
      <h1 class="recipes-page-title">Recepten</h1>
      <div class="recipes-page-actions">
        <form action="/recipes" method="GET" class="recipes-search-form">
          <label class="recipes-search-label">
            <input @if(request('ready')) checked @endif type="checkbox" name="ready" class="recipes-search-checkbox">
            Kan direct gemaakt worden
          </label>
          <button type="submit" class="recipes-search-button">Zoeken</button>
        </form>
        <a href="{{ route('recipe.create') }}" class="recipes-create-button">Nieuw recept</a>
      </div>
    </div>
    @include('components.custom components.recipes', ['recipes' => $recipes])
  </section>
</x-layouts::main>