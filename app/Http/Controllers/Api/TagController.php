<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\TagRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * List All Tags.
     *
     * returns a Pagination of tags 10 per page
     *
     * @group tags
     *
     * @response 200 {
     * data": [
     *  {
     *        "id": 2,
     *        "tag": "tag 2"
     *    },
     *    {
     *        "id": 1,
     *        "tag": "tag 1"
     *    }
     * ],
     * "links": {
     *    "first": "http://127.0.0.1:8001/api/tag/list?page=1",
     *    "last": "http://127.0.0.1:8001/api/tag/list?page=1",
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
     *          "url": "http://127.0.0.1:8001/api/tag/list?page=1",
     *          "label": "1",
     *          "active": true
     *      },
     *      {
     *          "url": null,
     *          "label": "Next &raquo;",
     *          "active": false
     *      }
     *  ],
     *  "path": "http://127.0.0.1:8001/api/tag/list",
     *  "per_page": 10,
     *  "to": 2,
     *  "total": 2
     * }
     * }
     */
    public function index(){
        $tags = $this->tagRepository->index();
        return $tags;
    }

    /**
     * Store New Tag
     *
     * @group Tag Requests
     *
     * @bodyParam ad_id [integer] required Request Ad Id
     * @bodyParam tag [string] required Request Tag Name
     *
     * @response 200 {
     *	   "message": "Tag Saved Successfully"
     * }
     *
     */
     public function store(Request $request)
     {
         // validate the request
         $request->validate([
             'ad_id' =>  'required',
             'tag'   =>  'required',
         ]);

         // store the tag
        $store = $this->tagRepository->store($request);

        return response()->json([
           'message' => "Tag Saved Successfully"
         ], 200);

     }

     /**
      * List Tag Data.
      *
      * @urlParam id [integer] required ad id
      *
      * @group Tag
      *
      * @response 200 {
      *     "data": {
      *        "id": 1,
      *        "ad_id": 1,
      *        "tag": "tag 1"
      *    }
      * }
      */
     public function show(Tag $tag)
     {
         return new TagResource($tag);
     }

     /**
      * Update Tag
      *
      * @group Tag Requests
      *
      * @urlParam id [integer] required ad id
      * @bodyParam ad_id [integer] Request Ad Id
      * @bodyParam tag [string] Request Tag Name
      *
      * @response 200 {
      *	   "message": "Tag Updated Successfully"
      * }
      *
      */
      public function update(Tag $tag, Request $request)
      {
         // update the ad
         $update = $this->tagRepository->update($tag);

         return response()->json([
            'message' => "Tag Updated Successfully"
          ], 200);
      }

      /**
       * Destroy Tag
       *
       * @group Tag Requests
       *
       * @urlParam id [integer] required ad id
       *
       * @response 200 {
       *	   "message": "Tag Deleted Successfully"
       * }
       */
       public function destroy(Tag $tag)
       {
            $destroy = $this->tagRepository->destroy($tag);

              return response()->json([
                 'message' => "Tag Deleted Successfully"
               ], 200);
       }

}
