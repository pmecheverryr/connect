<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponsesTrait;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Blog API",
 *      description="Documentation API Blog",
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Server",
 * ),
 *  @OA\SecurityScheme(
 *      type="http",
 *      description="Login with email and password to get the authentication token",
 *      name="Token based Based",
 *      in="header",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *      securityScheme="apiAuth",
 *  )
 * /
 */
class ApiController extends Controller
{
    use ApiResponsesTrait;
}
