<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Post resource",
 *     description="Post resource",
 *     type="object",
 *
 *     @OA\Xml(
 *      name="PostResource"
 *    )
 * )
 */
class PostResource extends JsonResponse
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper",
     *     property="data",
     *     type="object",
     *     @OA\Property(property="id", ref="#/components/schemas/Post_id"),
     *     @OA\Property(property="title", ref="#/components/schemas/Post_title"),
     *     @OA\Property(property="content", ref="#/components/schemas/Post_content"),
     *     @OA\Property(property="status", ref="#/components/schemas/Post_status"),
     *     @OA\Property(property="author_by", ref="#/components/schemas/Post_author_by"),
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'content' => $this->content ?? null,
            'status' => $this->status ?? null,
            'author_by' => $this->author_name ?? null,
        ];
    }
}
