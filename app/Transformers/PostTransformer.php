<?php

namespace App\Transformers;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function transform(Post $post): array
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content,
            'status' => $post->status,
            'author_by' => $post->author->name ?? null,
            'created' => $post->created_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'title' => 'title',
            'content' => 'content',
            'status' => 'status',
            'author_by' => 'author->name',
            'created' => 'created_at',
        ];

        return $attributes[$index] ?? null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'id',
            'title' => 'title',
            'content' => 'content',
            'status' => 'status',
            'author->name' => 'author_by',
            'created' => 'created_at',
        ];

        return $attributes[$index] ?? null;
    }
}
