<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Post request",
 *      description="Store Post request body data",
 *      type="object",
 *      required={"title", "content"},
 * )
 */
class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     *  @OA\Property( property="title", type="string", example="Post title", description="Title of the post" ),
     *  @OA\Property( property="content", type="string", example="Post content", description="Content of the post" ),
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255|unique:posts,title,'.$this->id,
            'content' => 'required',
        ];
    }
}
