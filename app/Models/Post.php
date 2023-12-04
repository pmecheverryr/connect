<?php

namespace App\Models;

use App\Scopes\PostScope;
use App\Transformers\PostTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Post_id",
 *     format="int64",
 *     title="Id",
 *     default=1,
 *     description="ID",
 * )
 *
 * @property int $id
 *
 * @OA\Schema(
 *     schema="Post_title", format="string", title="Title", default="Title blog", description="Title"
 * )
 *
 * @property string $title
 *
 * @OA\Schema(
 *     schema="Post_content", format="string", title="Content", default="Content blog", description="Content of Blog"
 * )
 *
 * @property string $content
 *
 * @OA\Schema(
 *     schema="Post_status", format="boolean", title="Status", default="0", description="Status of Blog"
 * )
 *
 * @property bool $status
 *
 * @OA\Schema(
 *     schema="Post_author_id", format="integer", title="Author", default="1", description="Author of Blog"
 * )
 * @OA\Schema(
 *     schema="Post_author_name", format="string", title="Author", default="Author Spain", description="Author of Blog"
 * )
 *
 * @property int $author_id
 *  @OA\Schema(
 *      schema="Post_author_by", format="string", title="Author", default="Author Spain", description="Author of Blog"
 *  )
 *
 *  @OA\Schema(
 *
 *   @OA\Xml(name="Post"),
 *
 *   @OA\Property(property="id", ref="#/components/schemas/Post_id"),
 *   @OA\Property(property="title", ref="#/components/schemas/Post_title"),
 *   @OA\Property(property="content", ref="#/components/schemas/Post_content"),
 *   @OA\Property(property="status", ref="#/components/schemas/Post_status"),
 *   @OA\Property(property="author_id", ref="#/components/schemas/Post_author_id"),
 * )
 */
class Post extends Model
{
    use HasFactory;

    public string|PostTransformer $transformer = PostTransformer::class;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new PostScope());

        static::creating(function ($model) {
            $model->author_id = Auth::id();
        });
    }

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
