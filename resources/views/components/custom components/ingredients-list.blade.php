<div class="ingredients-list-component">
    <h3>Ingrediënten</h3>

    @if ($ingredients->count() > 0)
        @if ($isHome)
            <?php 
                $index = 0; 
            ?>
            <div class="ingredients-list-columns">
                <ul class="ingredients-list">
                    @foreach ($ingredients as $ingredient)
                        @if ($index % 5 === 0 && $index !== 0)
                            </ul>
                            <ul class="ingredients-list">
                        @endif
                        <li class="ingredient-item">
                            {{ $ingredient['name'] }} - 
                            {{ $ingredient['weight'] }} 
                            {{ $ingredient['unit'] }}
                        </li>
                        <?php $index++; ?>
                    @endforeach
                </ul>
            </div>
        @else
        <ul class="ingredients-list">
            @foreach ($ingredients as $ingredient)
                <li>
                    {{ $ingredient['name'] }} - 
                    {{ $ingredient['weight'] }} 
                    {{ $ingredient['unit'] }}
                </li>
            @endforeach
        </ul>
        @endif
    @else
        <p>Er zijn geen ingredienten in je bezit.</p>
    @endif
</div>