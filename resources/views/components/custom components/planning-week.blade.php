<div>
  <div class="planning-inhoud">
    <?php $index = 1; ?>
    @foreach($planning['days'] as $day)
      <div class="planning-day grid-child{{ $index }}">
        <h5>{{ $day['dayTitle'] }}<h5>
        @if ($day['recipe'])
          <p>{{$day['recipe']}}</p>
        @endif
      </div>
      <?php $index++; ?>
    @endforeach
  </div>
  @if ($planning['missingIngredients'])
  <div class="grocery-list">
    <h4>Ingredienten die je mist:</h4>
    <ul class="grocery-list-grid">  
      @foreach($planning['missingIngredients'] as $ingredient)
        <li>{{ $ingredient['name'] }} - {{ $ingredient['weight'] }} {{ $ingredient['unit'] }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>