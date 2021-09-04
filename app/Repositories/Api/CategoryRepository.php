<?php

namespace App\Repositories\Api;

use App\Repositories\BaseRepository;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Category
     */
    public function index(){
        $categories = CategoryResource::collection(Category::orderBy('id', 'desc')->paginate(10));
        return $categories;
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Category
     */
    public function store($request)
    {
        $category = Category::create(request(['category']));
    }

    /**
     * @param Category $category
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Category
     */
    public function update($category)
    {
        $category->update(request(['category']));
    }

    /**
     * @param Category $category
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Category
     */
    public function destroy($category)
    {
        $category->delete();
    }
}
