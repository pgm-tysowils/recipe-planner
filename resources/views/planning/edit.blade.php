<x-layouts::main title="planning aanpassen">
<section class="planning-edit-page">
  <h1>{{ $planning['weekTitle'] }}</h1>

  <form method="POST" action="/planning/edit/{{$planning['weekTitle']}}">
      @csrf

      @foreach($planning['days'] as $day)

          <div class="planning-row">

              <label>{{ $day['dayTitle'] }}</label>

              <select name="days[{{ $day['dayTitle'] }}]">

                  <option value="">No recipe</option>

                  @foreach($recipes as $recipe)
                  <?php $isSelected = $recipe->id == $day['recipe_id']; 
                  ?>
                      @if ($isSelected)
                        <option
                            value="{{ $recipe->id }}"
                            selected
                        >
                            {{ $recipe->name }}
                        </option>
                      @else 
                        <option
                            value="{{ $recipe->id }}"
                        >
                            {{ $recipe->name }}
                        </option>
                      @endif
                  @endforeach

              </select>

          </div>

      @endforeach

      <button type="submit">
          Save week
      </button>

  </form>
</section>
</x-layouts::main>