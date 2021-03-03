# Litstack Meta

Edit default meta-fields inside your crud-models and forms and receive them in your blade templates.

## Installation

The package can be installed via composer and will autoregister.

```bash
composer require litstack/meta
```

You can now publish and migrate the migration for your meta model:

```shell
php artisan vendor:publish --provider="Litstack\Meta\MetaServiceProvider" --tag=migrations
php artisan migrate
```

## Usage

Start by perparing your Crud-Model by using the `HasMeta` Trait:

```php
use Litstack\Meta\Traits\HasMeta;

class Post extends Model
{
    use HasMeta;
}
```

> Forms don't need further setup

In order to display the form in litstack edit your model-config:

```php
use Litstack\Meta\Traits\CrudHasMeta;

class PostConfig extends CrudConfig
{
    use CrudHasMeta;

    // …

    public function show(CrudShow $page)
    {
        $this->meta($page);
    }
}
```

To display the meta-fields in your template, simply use the `<x-lit-meta />` component and pass it the `metaFields` of your model.

```php
@extends('app')

@section('meta')
    <x-lit-meta :meta="$post->metaFields()" />
@endsection
```

And in your main template:

```php
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
</head>
```

## Default Values / Customizing / Overriding

You can set default values or customize and override them by providing a `metaFields()` method in your model:

```php
/**
 * Return the meta fields for this model.
 *
 * @return array
 */
public function metaFields(): array
{
    return [
        'title'       => 'Awesome Blog: ' . $this->meta->title,
        'description' => $this->meta->tescription ?: 'Default description',
        'keywords'    => $this->meta->teywords ?: 'Default Keywords',
        'image'       => $this->image, // image will be set as og image
    ];
}
```
