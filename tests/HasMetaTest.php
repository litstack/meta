<?php

namespace Tests;

use Litstack\Meta\Metaable;
use Litstack\Meta\Traits\HasMeta;
use Mockery;
use PHPUnit\Framework\TestCase;

class HasMetaTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function test_getMetaAttribute_method()
    {
        $post = new DummyPost();

        $this->assertSame('bar author', $post->metaAuthor());
        $this->assertSame('foo title', $post->metaTitle());
        $this->assertSame('hello', $post->metaDescription());
        $this->assertSame('a b c', $post->metaKeywords());
    }
}

class DummyPost implements Metaable
{
    use HasMeta;

    protected $metaAttributes = [
        'author' => 'author',
    ];

    protected $defaultMetaAttributes = [
        'description' => 'hello',
    ];

    public $author = 'bar author';

    public $meta;

    public function __construct()
    {
        $this->meta = (object) [
            'title'       => 'foo title',
            'author'      => 'foo author',
            'description' => null,
            'keywords'    => null,
        ];
    }

    public function getAttribute($attribute)
    {
        return $this->{$attribute};
    }

    public function defaultMetaKeywords()
    {
        return 'a b c';
    }
}
