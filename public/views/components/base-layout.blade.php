{{-- Component Stylesheets --}}
@foreach ($component->stylesheets as $stylesheet)
    <link rel="stylesheet" href="{{$stylesheet}}">
@endforeach

{{-- Component Content --}}
{!! $component->content !!}