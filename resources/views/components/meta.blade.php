
{{-- Default --}}
{{-- <link rel="canonical" href="{{ route('home') }}"/> --}}
<meta name="robots" content="index,follow"/> 
<meta name="revisit-after" content="7 days">
<meta name="url" content="{{ url()->current() }}">
@isset($color)<meta name="theme-color" content="{{ $color }}">@endisset
@isset($author)<meta name="author" content="{{ $author }}">@endisset
@isset($title)<meta name="title" content="{{ $title }}"/>@endisset

<meta x-if="$color" x-bind:content="$color">

{{-- Google / Search Engine Tags --}}
@isset($keywords)<meta name="keywords" content="{{ $keywords }}"/>@endisset
@isset($description)<meta name="description" content="{{ $description }}"/>@endisset
@isset($title)<meta name="name" content="{{ $title }}"/>@endisset

{{-- Facebook Meta Tags --}}
<meta property="og:type" content="website">
<meta property="og:locale" content="{{ app()->getLocale() }}" />
<meta property="og:url" content="{{ url()->current() }}"/>
@if($hasImage())<meta name="og:image" content="{{ $image->getFullUrl() }}"/>@endif
@isset($title)<meta property="og:title" content="{{ $title }}"/>@endisset
@isset($description)<meta property="og:description" content="{{ $description }}"/>@endisset

{{-- Twitter Meta Tags --}}
<meta name="twitter:card" content="summary_large_image">
@isset($title)<meta property="twitter:title" content="{{ $title }}"/>@endisset
@isset($description)<meta property="twitter:description" content="{{ $description }}"/>@endisset
@if($hasImage())<meta name="twitter:image" content="{{ $image->getFullUrl() }}"/>@endif

