<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

trait ApiResponsesTrait
{
    /**
     * Return success response
     */
    public function successResponse($data, $code): JsonResponse
    {
        return response()->json($data, $code);
    }

    /**
     * Return error response
     */
    protected function errorResponse(mixed $message, int $code): JsonResponse
    {
        return response()->json([
            'error' => $message,
            'code' => $code,
        ], $code);
    }

    /**
     * Method to return all data
     */
    protected function showAll(Collection $collection, int $code = 200): JsonResponse
    {
        if ($collection->isEmpty()) {
            return $this->successResponse($collection, $code);
        }
        $transformer = $collection->first()->transformer;
        $collection = $this->filterData($collection, $transformer);
        $collection = $this->sortData($collection, $transformer);
        $collection = $this->paginate($collection);
        $collection = $this->transformData($collection, $transformer);

        return $this->successResponse($collection, $code);
    }

    /**
     * Method to return single data
     */
    protected function showOne(Model $instance, int $code = 200): JsonResponse
    {
        $transformer = $instance->transformer ?? null;
        $instance = $this->transformData($instance, $transformer);

        return $this->successResponse($instance, $code);
    }

    /**
     * Method to return filter data
     */
    protected function filterData(Collection $collection, $transformer): Collection
    {
        foreach (request()->query() as $query => $value) {
            $attribute = $transformer::originalAttribute($query);
            if (isset($attribute, $value)) {
                $collection = $collection->where($attribute, $value);
            }
        }

        return $collection;
    }

    /**
     * Method to return sort data
     */
    protected function sortData(Collection $collection, $transformer): Collection
    {
        if (request()->has('sort_by')) {
            $attribute = $transformer::originalAttribute(request()->sort_by);
            $collection = $collection->sortBy->{$attribute};
        }

        return $collection;
    }

    /**
     * Method to return paginate data
     */
    protected function paginate(Collection $collection): LengthAwarePaginator
    {
        $rules = [
            'per_page' => 'integer|min:2|max:100',
        ];
        Validator::validate(request()->all(), $rules);
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        if (request()->has('per_page')) {
            $perPage = (int) request()->per_page;
        }
        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPage(),
        ]);

        $paginated->appends(request()->all());

        return $paginated;
    }

    /**
     * Method to return transform data
     */
    protected function transformData($data, $transformer): ?array
    {
        $transformation = fractal($data, new ($transformer));

        return $transformation->toArray();
    }
}
