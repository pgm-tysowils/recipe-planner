<section class="home-{{ $sectionName }}">
  <div class="home-section-header">
    <h2 class="home-{{ $sectionName }}-title">{{ $title }}</h2>
    <a class="home-section-button" href="{{ $link }}">{{ $buttonText }}</a>
  </div>
  @include('components.custom components.' . $sectionName, $compdata)
</section>