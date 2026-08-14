<x-layouts::main title="Creeer een nieuw recept">
  <section class="recipes-create-page">
    <h1 class="recipes-page-title">Creeer een nieuw recept</h1>
    <div class="recipes-page-actions">
      <form action="/recipes/create" method="POST" class="recipes-create-form">
        <div class="recipes-create-form-label-input">
          <label for="name">Naam:</label>
          <input type="text" name="name" id="name" required>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="image_url">Afbeelding URL:</label>
          <input type="text" name="image_url" id="image_url" required>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="description">Beschrijving:</label>
          <textarea name="description" id="description" required></textarea>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="total_time">Totale tijd (in minuten):</label>
          <input type="number" name="total_time" id="total_time" required>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="serving_size">Aantal personen:</label>
          <input type="number" name="serving_size" id="serving_size" required>
        </div>
        <div class="recipes-create-form-label-input">
          <label for="steps">Stappen: <span>(1. doe dit, 2. doe dat)</span></label>
          <textarea name="steps" id="steps" required></textarea>
        </div>

        <div class="recipes-create-form-label-input">
          <div id="ingredient-list">
              <div class="ingredient-row">
                <select name="ingredients[0][ingredient_id]" class="ingredient-select">
                  @foreach ($ingredients as $ingredient)
                      <option value="{{ $ingredient->id }}">
                          {{ $ingredient->name }} ({{ $ingredient->unit }})
                      </option>
                  @endforeach
                </select>

                  <input
                      type="number"
                      step="0.01"
                      name="ingredients[0][amount]"
                      placeholder="Amount"
                  >
              </div>
          </div>

          <button type="button" id="add-ingredient">
              Add ingredient
          </button>
        </div>

        <button type="submit" class="recipes-create-button">Creeer recept</button>
      </form>
    </div>
  </section>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
  <script>
    let index = 1;

    document.getElementById('add-ingredient').addEventListener('click', function () {
        const row = document.querySelector('.ingredient-row').cloneNode(true);

        row.querySelector('select').name = `ingredients[${index}][ingredient_id]`;
        row.querySelector('input').name = `ingredients[${index}][amount]`;
        row.querySelector('input').value = '';

        document.getElementById('ingredient-list').appendChild(row);

        index++;
    });

    new TomSelect(".ingredient-select", {
    create: false,
    sortField: {
        field: "text",
        direction: "asc"
    }
    });

</script>
</x-layouts::main>