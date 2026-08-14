<x-layouts::main title="Pas recept aan">
  <section class="recipes-create-page">
    <h1 class="recipes-page-title">Pas recept aan</h1>
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
                  <select name="ingredients[{{ $index }}][ingredient_id]" class="ingredient-select">
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
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
    let index = {{ count($recipe->ingredients ?? []) }};

    const ingredientList = document.getElementById('ingredient-list');
    const addIngredientButton = document.getElementById('add-ingredient');

    const tomSelectOptions = {
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    };

    // Initialize TomSelect on the ingredients that already exist
    document.querySelectorAll('.ingredient-select').forEach(select => {
        new TomSelect(select, tomSelectOptions);
    });

    addIngredientButton.addEventListener('click', function () {
        const row = document.createElement('div');
        row.classList.add('ingredient-row');

        // Create select
        const select = document.createElement('select');
        select.name = `ingredients[${index}][ingredient_id]`;
        select.classList.add('ingredient-select');

        @foreach ($allIngredients as $ingredient)
            const option{{ $ingredient->id }} = document.createElement('option');
            option{{ $ingredient->id }}.value = "{{ $ingredient->id }}";
            option{{ $ingredient->id }}.textContent = "{{ $ingredient->name }} ({{ $ingredient->unit }})";
            select.appendChild(option{{ $ingredient->id }});
        @endforeach

        // Create amount input
        const input = document.createElement('input');
        input.type = 'number';
        input.step = '0.01';
        input.name = `ingredients[${index}][amount]`;

        // Create remove button
        const button = document.createElement('button');
        button.type = 'button';
        button.classList.add('remove-ingredient');
        button.textContent = 'Remove';

        row.appendChild(select);
        row.appendChild(input);
        row.appendChild(button);

        ingredientList.appendChild(row);

        new TomSelect(select, tomSelectOptions);

        index++;
    });

    ingredientList.addEventListener('click', function (e) {
        if (!e.target.classList.contains('remove-ingredient')) {
            return;
        }

        e.target.closest('.ingredient-row').remove();

        document.querySelectorAll('.ingredient-row').forEach((row, i) => {
            row.querySelector('select').name =
                `ingredients[${i}][ingredient_id]`;

            row.querySelector('input').name =
                `ingredients[${i}][amount]`;
        });

        index = document.querySelectorAll('.ingredient-row').length;
    });
</script>
</x-layouts::main>