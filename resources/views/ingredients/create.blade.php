<x-layouts::main title="ingredienten toevoegen/aanpassen">
<section class="ingredients-create-page">
  <div class="container">
      <h1>Manage Stock</h1>
      <form method="POST" action="/ingredients/store">
      @csrf

      <div id="ingredient-list">
          <?php $index = 0; ?>
          @foreach ($userStock as $stockItem)
          <div class="ingredient-row">

                <select name="stock[{{ $index }}][ingredient_id]">
                    @foreach ($allIngredients as $ingredient)
                        <option value="{{ $ingredient->id }}"
                            @if($ingredient->id == $stockItem['id']) selected @endif>
                            {{ $ingredient->name }} ({{ $ingredient->unit }})
                        </option>
                    @endforeach
                </select>

                <input
                    type="number"
                    step="0.01"
                    name="stock[{{ $index }}][amount]"
                    value="{{ $stockItem['weight'] }}"
                >

                <button type="button" class="remove-ingredient">
                    Remove
                </button>

                </div>
              <?php $index++; ?>
          @endforeach
      </div>

      <button type="button" id="add-ingredient">
          Add ingredient
      </button>

      <button type="submit">
          Save Stock
      </button>

    </form>
    </div>
</section>

  <script>
    let index = {{ count($userStock ?? []) }};

    document.getElementById('add-ingredient').addEventListener('click', function () {

    let row;
      if (index == 0) {
        row = document.createElement('div');
        row.classList.add('ingredient-row');

        const select = document.createElement('select');
        select.name = `stock[${index}][ingredient_id]`;

        @foreach ($allIngredients as $ingredient)
            const option{{ $ingredient->id }} = document.createElement('option');
            option{{ $ingredient->id }}.value = "{{ $ingredient->id }}";
            option{{ $ingredient->id }}.textContent = "{{ $ingredient->name }} ({{ $ingredient->unit }})";
            select.appendChild(option{{ $ingredient->id }});
        @endforeach

        const input = document.createElement('input');
        input.type = 'number';
        input.step = '0.01';
        input.name = `stock[${index}][amount]`;

        row.appendChild(select);
        row.appendChild(input);
      } else {
        row = document.querySelector('.ingredient-row').cloneNode(true);
      }

        // reset values
        row.querySelector('input').value = '';

        // reset select to first option
        row.querySelector('select').selectedIndex = 0;

        // rename fields properly
        row.querySelector('select').name = `stock[${index}][ingredient_id]`;
        row.querySelector('input').name = `stock[${index}][amount]`;

        document.getElementById('ingredient-list').appendChild(row);

        index++;
    });

    document.getElementById('ingredient-list').addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-ingredient')) {
        e.target.closest('.ingredient-row').remove();
    }
});
  </script>
</x-layouts::main>