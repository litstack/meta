<?php

namespace Tests\Integration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Litstack\Meta\Components\MetaComponent;
use Litstack\Meta\Metaable;
use Litstack\Meta\Traits\HasMeta;
use Tests\IntegrationTestCase;

class MetaComponentForModelTest extends IntegrationTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author_id');
        });
        Schema::create('author', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    /** @test */
    public function test_component_with_metaable_model()
    {
        $author = DummyAuthorModel::create([
            'name' => 'rob',
        ]);
        $post = $author->posts()->create(['title' => 'foo']);

        $component = new MetaComponent($post);
        $this->assertSame('rob', $component->author);
    }
}

class DummyPostModel extends Model implements Metaable
{
    use HasMeta;

    public $table = 'posts';
    protected $fillable = ['title'];
    public $timestamps = false;

    protected $metaAttributes = [
        'author' => 'author.name',
    ];

    protected $defaultMetaAttributes = [
        'description' => 'hello',
    ];

    public function author()
    {
        return $this->belongsTo(DummyAuthorModel::class, 'author_id');
    }

    public function defaultMetaKeywords()
    {
        return 'a b c';
    }
}

class DummyAuthorModel extends Model
{
    public $table = 'author';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function posts()
    {
        return $this->hasMany(DummyPostModel::class, 'author_id');
    }
}
