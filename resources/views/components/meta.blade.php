@isset($title)
    <meta name="title" content="{{ $title }}"/>
@endisset
@isset($keywords)<meta name="keywords" content="{{ $keywords }}"/>@endisset
@isset($description)<meta name="description" content="{{ $description }}"/>@endisset
<meta name="robots" content="index,follow"/> 
<meta name="revisit-after" content="7 days">
@isset($author)<meta name="author" content="{{ $author }}">@endisset
<meta name="url" content="{{ url()->current() }}">

@isset($image)
    @if ($image->first())
        <meta name="og:image" content="{{ $image->getFullUrl() }}"/>
    @endif
@endisset

@isset($title)<meta property="og:title" content="{{ $title }}"/>@endisset
@isset($description)<meta property="og:description" content="{{ $description }}"/>@endisset
<meta property="og:locale" content="{{ app()->getLocale() }}" />
<meta property="og:url" content="{{ url()->current() }}"/>
