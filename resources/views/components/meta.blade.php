@isset($meta['title'])<meta name="title" content="{{ $meta['title'] }}"/>@endisset
@isset($meta['keywords'])<meta name="keywords" content="{{ $meta['keywords'] }}"/>@endisset
@isset($meta['description'])<meta name="description" content="{{ $meta['description'] }}"/>@endisset
<meta name="robots" content="index,follow"/> 
<meta name="revisit-after" content="7 days">
@isset($meta['author'])<meta name="author" content="{{ $meta['author'] }}">@endisset
<meta name="url" content="{{ url()->current() }}">

@isset($meta['image'])<meta name="og_image" content="{{ $meta['image']->getFullUrl() }}"/>@endisset

@isset($meta['title'])<meta property="og:title" content="{{ $meta['title'] }}"/>@endisset
@isset($meta['description'])<meta property="og:description" content="{{ $meta['description'] }}"/>@endisset
<meta property="og:locale" content="{{ app()->getLocale() }}" />
<meta property="og:url" content="{{ url()->current() }}"/>
