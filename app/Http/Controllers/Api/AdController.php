<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\AdRepository;
use App\Http\Resources\AdResource;
use App\Models\Ad;

class AdController extends Controller
{
    protected $adRepository;

    public function __construct(AdRepository $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    /**
     * List All Ads.
     *
     * returns a Pagination of Ads 10 per page
     *
     * @group Ads
     *
     * @queryParam category_id [integer] Request Category Id
     * @queryParam tag [string] Request Tag Name
     *
     * @response 200 {
     * data": [
     *  "data": [
     *    {
     *        "id": 5,
     *        "category_id": 3,
     *        "type_id": 2,
     *        "title": "ad 2",
     *        "description": "description 2",
     *        "start_date": "2021-03-15"
     *    },
     *    {
     *        "id": 7,
     *        "category_id": 3,
     *        "type_id": 1,
     *        "title": "ad 3",
     *        "description": "description 3",
     *        "start_date": "2021-05-20"
     *    }
     *  ],
     *  "links": {
     *      "first": "http://127.0.0.1:8000/api/ad/list?page=1",
     *      "last": "http://127.0.0.1:8000/api/ad/list?page=1",
     *      "prev": null,
     *      "next": null
     *  },
     *  "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "links": [
     *        {
     *            "url": null,
     *            "label": "&laquo; Previous",
     *            "active": false
     *        },
     *        {
     *            "url": "http://127.0.0.1:8000/api/ad/list?page=1",
     *            "label": "1",
     *            "active": true
     *        },
     *        {
     *            "url": null,
     *            "label": "Next &raquo;",
     *            "active": false
     *        }
     *    ],
     *    "path": "http://127.0.0.1:8000/api/ad/list",
     *    "per_page": 10,
     *    "to": 2,
     *    "total": 2
     *  }
     *  }
     */
    public function index(Request $request)
    {
        $ads = $this->adRepository->index($request);

        return $ads;
    }

    /**
     * Store New Category
     *
     *
     * @group Category Requests
     *
     * @urlParam id [integer] required ad id
     * @bodyParam user_id [integer] required Request User Id
     * @bodyParam category_id [integer] required Request Category Id
     * @bodyParam type_id [integer] required Request Type Id
     * @bodyParam title [string] required Request Ad Title
     * @bodyParam description [string] required Request Ad Description
     * @bodyParam start_date [date] required Request Ad Start Date
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
             'user_id' => 'required',
             'category_id' => 'required',
             'type_id' => 'required',
             'title' => 'required',
             'description' => 'required',
             'start_date' => 'required',
          ]);

          // store the ad
          $store = $this->adRepository->store($request);

          return response()->json([
             'message' => "Ad Saved Successfully"
           ], 200);

     }

     /**
      * List Ad Data.
      *
      * @urlParam id [integer] required ad id
      * @group Ad
      *
      * @response 200 {
      *     "data": {
      *        "id": 1,
      *        "user_id": 1,
      *        "category_id": 1,
      *        "type_id": 1,
      *        "title": "title 1",
      *        "description": "description 1",
      *        "start_date": "2021-09-15"
      *    }
      * }
      */
     public function show(Ad $ad)
     {
         return new AdResource($ad);
     }

     /**
      * Update Ad
      *
      * @group Ad Requests
      *
      * @urlParam id [integer] required ad id
      * @bodyParam user_id [integer] Request User Id
      * @bodyParam category_id [integer] Request Category Id
      * @bodyParam type_id [integer] Request Type Id
      * @bodyParam title [string] Request Ad Title
      * @bodyParam description [string] Request Ad Description
      * @bodyParam start_date [date] Request Ad Start Date
      *
      * @response 200 {
      *	   "message": "Ad Updated Successfully"
      * }
      *
      */
      public function update(Ad $ad, Request $request)
      {

          // update the ad
          $update = $this->adRepository->update($ad);

          return response()->json([
            'message' => "Ad Updated Successfully"
          ], 200);

      }

      /**
       * Destroy Ad
       *
       * @group Ad Requests
       *
       * @urlParam id [integer] required ad id
       *
       * @response 200 {
       *	   "message": "Ad Deleted Successfully"
       * }
       */
       public function destroy(Ad $ad)
       {
            $destroy = $this->adRepository->destroy($ad);

              return response()->json([
                 'message' => "Ad Deleted Successfully"
               ], 200);
       }

}
