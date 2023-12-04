<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use App\Transformers\PostTransformer;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class PostController extends ApiController
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware(
            'transform.input:'.PostTransformer::class)
            ->only(['store', 'update']);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/posts",
     *     operationId="getPostsList",
     *     tags={"Posts"},
     *     summary="Get list of posts",
     *     description="Returns list of posts",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/PostResource")
     *     ),
     *     @OA\RequestBody(ref="#/components/schemas/Post"),
     *     security={{ "apiAuth": {} }}
     * )
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $posts = Post::all();

            return $this->showAll($posts);
        }

        $posts = Post::paginate();

        return view('posts.index', compact('posts'));

    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/v1/posts/{id}",
     *     operationId="getPostById",
     *     tags={"Posts"},
     *     summary="Get a post by ID",
     *     description="Returns a single post",
     *
     *         @OA\Parameter(
     *          name="id",
     *          description="ID of the post",
     *          required=true,
     *          in="path",
     *
     *          @OA\Schema(type="integer")
     *     ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(ref="#/components/schemas/PostResource")
     *      ),
     *
     *      @OA\Response(
     *           response=204,
     *           description="Not found",
     *      ),
     *      security={{ "apiAuth": {} }}
     * )
     */
    public function show(Post $post): JsonResponse
    {
        return $this->showOne($post);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/v1/posts",
     *     operationId="storePost",
     *     tags={"Posts"},
     *     summary="Create a new post",
     *     description="Creates a new post and returns it",
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="Post data",
     *
     *         @OA\JsonContent(ref="#/components/schemas/PostRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Post created"
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     */
    public function store(PostRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if (! $validated) {
            return $this->errorResponse($validated, 400);
        }

        $post = Post::create($request->all());
        if ($post->id) {
            return $this->showOne($post, 201);
        }

        return $this->errorResponse('Error creating post', 204);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/posts/{id}",
     *     summary="Update an existing post",
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="Post ID",
     *         required=true,
     *         in="path",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="Post data",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Post updated successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     tags={"Posts"},
     *     security={{ "apiAuth": {} }}
     * )
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        $request->validated();
        $result = $post->update($request->all());

        if (! $result) {
            return $this->errorResponse('Error updating', 400);
        }

        return $this->showOne($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * @OA\Delete (
     *     path="/api/v1/posts/{id}",
     *     operationId="deletePost",
     *     tags={"Authors"},
     *     summary="Delete a post",
     *     description="Deletes a post",
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="Post ID",
     *          required=true,
     *          in="path",
     *
     *          @OA\Schema(type="integer")
     *      ),
     *
     *      @OA\Response(
     *           response=204,
     *           description="Successful operation",
     *
     *           @OA\JsonContent()
     *        ),
     *
     *       @OA\Response(
     *           response=401,
     *           description="Unauthenticated",
     *       ),
     *       @OA\Response(
     *           response=403,
     *           description="Forbidden"
     *       ),
     *       @OA\Response(
     *           response=404,
     *           description="Resource Not Found"
     *       ),
     *      tags={"Posts"},
     *      security={{ "apiAuth": {} }}
     *  )
     */
    public function destroy(Post $post): JsonResponse
    {
        $result = $post->delete();
        if ($result) {
            return $this->successResponse('Success deleting', 204);
        }

        return $this->errorResponse('Error deleting', 404);
    }
}
