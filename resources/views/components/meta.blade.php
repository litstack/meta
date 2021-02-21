@isset($meta['title'])<meta name="title" content="{{ $meta['title'] }}"/>@endisset
@isset($meta['keywords'])<meta name="keywords" content="{{ $meta['keywords'] }}"/>@endisset
@isset($meta['description'])<meta name="description" content="{{ $meta['description'] }}"/>@endisset
<meta name="robots" content="index,follow"/> 
<meta name="revisit-after" content="7 days">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
@isset($meta['author'])<meta name="author" content="{{ $meta['author'] }}">@endisset
<meta name="url" content="{{ url()->current() }}">

<meta name="og_image" content="foo"/>

@isset($meta['title'])<meta property="og:title" content="{{ $meta['title'] }}"/>@endisset
@isset($meta['description'])<meta property="og:description" content="{{ $meta['description'] }}"/>@endisset
<meta property="og:type" content="foo"/>
<meta property="og:locale" content="en_us" />
<meta property="og:sitename" content="foo" />
<meta property="og:url" content="{{ url()->current() }}"/>
