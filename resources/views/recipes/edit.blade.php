<x-layouts::main title="Creeer een nieuw recept">
  <section class="recipes-create-page">
    <h1 class="recipes-page-title">Creeer een nieuw recept</h1>
    <div class="recipes-page-actions">
      <form action="/recipes/{{$recipe->id}}" method="POST" class="recipes-create-form">
        <div class="recipes-create-form-label-input">
          <label for="name">Naam:</label>
          <input type="text" name="name" id="name" value="{{$recipe->name}}" required>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="image_url">Afbeelding URL:</label>
          <input type="text" name="image_url" id="image_url" value="{{$recipe->image_url}}" required>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="description">Beschrijving:</label>
          <textarea name="description" id="description" required>{{$recipe->description}}</textarea>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="total_time">Totale tijd (in minuten):</label>
          <input type="number" name="total_time" id="total_time" value="{{$recipe->total_time}}" required>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="serving_size">Aantal personen:</label>
          <input type="number" name="serving_size" id="serving_size" value="{{$recipe->servings}}" required>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="steps">Stappen: <span>(1. doe dit, 2. doe dat)</span></label>
          <textarea name="steps" id="steps" required>{{$recipe->steps}}</textarea>
        </div>
        <div class="recipes-create-form-label-input">
          <div id="ingredient-list">
          @foreach($recipe->ingredients as $index => $ingredient)
              <div class="ingredient-row">
                  <select name="ingredients[{{ $index }}][ingredient_id]">
                      @foreach($allIngredients as $item)
                          <option value="{{ $item->id }}"
                              @selected($item->id == $ingredient->id)>
                              {{ $item->name }} ({{ $item->unit }})
                          </option>
                      @endforeach
                  </select>
                  <input
                      type="number"
                      step="0.01"
                      name="ingredients[{{ $index }}][amount]"
                      value="{{ $ingredient->pivot->weight }}"
                  >
                  <button type="button" class="remove-ingredient">
                      Remove
                  </button>
              </div>
          @endforeach
          </div>
          <button type="button" id="add-ingredient">
              Add ingredient
          </button>
        </div>
        <button type="submit" class="recipes-create-button">Pas recept aan</button>
      </form>
    </div>
  </section>
  <script>
    let index = {{ count($recipe->ingredients ?? []) }};

    document.getElementById('add-ingredient').addEventListener('click', function () {
    
    let row;
      if (index == 0) {
        row = document.createElement('div');
        row.classList.add('ingredient-row');

        const select = document.createElement('select');
        select.name = `ingredients[${index}][ingredient_id]`;

        @foreach ($allIngredients as $ingredient)
            const option{{ $ingredient->id }} = document.createElement('option');
            option{{ $ingredient->id }}.value = "{{ $ingredient->id }}";
            option{{ $ingredient->id }}.textContent = "{{ $ingredient->name }} ({{ $ingredient->unit }})";
            select.appendChild(option{{ $ingredient->id }});
        @endforeach

        const input = document.createElement('input');
        input.type = 'number';
        input.step = '0.01';
        input.name = `ingredients[${index}][amount]`;

        const button = document.createElement('button');
        button.type = 'button';
        button.classList.add('remove-ingredient');
        button.textContent = 'Remove';

        row.appendChild(select);
        row.appendChild(input);
        row.appendChild(button);
      } else {
        row = document.querySelector('.ingredient-row').cloneNode(true);
      }

        // reset values
        row.querySelector('input').value = '';

        // reset select to first option
        row.querySelector('select').selectedIndex = 0;

        // rename fields properly
        row.querySelector('select').name = `ingredients[${index}][ingredient_id]`;
        row.querySelector('input').name = `ingredients[${index}][amount]`;

        document.getElementById('ingredient-list').appendChild(row);

        index++;
    });

    document.getElementById('ingredient-list').addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-ingredient')) {
        const removedIndex = Array.from(document.querySelectorAll('.ingredient-row')).indexOf(e.target.closest('.ingredient-row'));
        for (i = removedIndex + 1; i < index; i++) {
            const row = document.querySelector(`.ingredient-row:nth-child(${i + 1})`);
            row.querySelector('select').name = `ingredients[${i - 1}][ingredient_id]`;
            row.querySelector('input').name = `ingredients[${i - 1}][amount]`;
        }
        e.target.closest('.ingredient-row').remove();
        index--;
    }});
  </script>
</x-layouts::main>