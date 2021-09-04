<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * List All Categories.
     *
     * returns a Pagination of Categories 10 per page
     *
     * @group Categories
     *
     * @response 200 {
     * data": [
     *  {
     *        "id": 2,
     *        "category": "category 2"
     *    },
     *    {
     *        "id": 1,
     *        "category": "category 1"
     *    }
     * ],
     * "links": {
     *    "first": "http://127.0.0.1:8000/api/category/list?page=1",
     *    "last": "http://127.0.0.1:8000/api/category/list?page=1",
     *    "prev": null,
     *    "next": null
     * },
     * "meta": {
     *  "current_page": 1,
     *    "from": 1,
     *    "last_page": 1,
     *    "links": [
     *        {
     *            "url": null,
     *            "label": "&laquo; Previous",
     *            "active": false
     *        },
     *        {
     *          "url": "http://127.0.0.1:8000/api/category/list?page=1",
     *          "label": "1",
     *          "active": true
     *      },
     *      {
     *          "url": null,
     *          "label": "Next &raquo;",
     *          "active": false
     *      }
     *  ],
     *  "path": "http://127.0.0.1:8000/api/category/list",
     *  "per_page": 10,
     *  "to": 2,
     *  "total": 2
     * }
     * }
     */
    public function index()
    {
        $categories = $this->categoryRepository->index();
        return $categories;
    }

    /**
     * Store New Category
     *
     * @group Category Requests
     *
     * @bodyParam category [string] required Request Category Name
     *
     * @response 200 {
     *	   "message": "Category Saved Successfully"
     * }
     *
     * @response 400 {
     *  "message": "Category Field Is Required"
     * }
     */
     public function store(Request $request)
     {
         // validate the request
         $request->validate([
             'category' => 'required',
         ]);

         // store the tag
         $store = $this->categoryRepository->store($request);

         return response()->json([
            'message' => "Category Saved Successfully"
         ], 200);

     }

     /**
      * List Category Data.
      *
      * @group Category
      *
      * @urlParam id [integer] required ad id
      *
      * @response 200 {
      *     "data": {
      *        "id": 1,
      *        "category": "category 1"
      *    }
      * }
      */
     public function show(Category $category)
     {
         return new CategoryResource($category);
     }

     /**
      * Update Category
      *
      * @group Category Requests
      *
      * @urlParam id [integer] required ad id
      * @bodyParam category [string] Request Category Name
      *
      * @response 200 {
      *	   "message": "Category Updated Successfully"
      * }
      *
      */
      public function update(Category $category, Request $request)
      {
          // update the category
          $update = $this->categoryRepository->update($category);

          return response()->json([
              'message' => "Category Updated Successfully"
          ], 200);
      }

      /**
       * Destroy Category
       *
       * @group Category Requests
       *
       * @urlParam id [integer] required ad id
       *
       * @response 200 {
       *	   "message": "Category Deleted Successfully"
       * }
       */
       public function destroy(Category $category)
       {
            $destroy = $this->categoryRepository->destroy($category);

            return response()->json([
               'message' => "Category Deleted Successfully"
             ], 200);
       }

}
