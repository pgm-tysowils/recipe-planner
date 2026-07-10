<x-layouts::main title="week planningen">
  <section class="planning-page">
    <h1>Week planningen</h1>
    @foreach ($planning as $week)
    <div class="planning-week">
      <div class="planning-header">
          <h3>{{ $week['weekTitle'] }}</h3>
        <a href="/planning/edit/{{$week['weekTitle']}}" class="planning-header-button">pas de planning aan</a>
      </div>
      @include('components.custom components.planning-week', [
      'planning' => $week
      ])
    </div>
    @endforeach
  </section>
</x-layouts::main>