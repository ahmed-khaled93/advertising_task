<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * List Advertiser Ads.
     *
     * @urlParam id [integer] required user id (advertiser id)
     *
     * @group Ads
     *
     * @response 200 {
     *     "data": [
     *    {
     *          "id": 8,
     *          "user_id": 3,
     *          "category_id": 1,
     *          "type_id": 2,
     *          "title": "ad 6",
     *          "description": "description 6",
     *          "start_date": "2021-09-05"
     *      }
     *  ],
     *  "links": {
     *      "first": "http://127.0.0.1:8000/api/advertiser/ads?page=1",
     *      "last": "http://127.0.0.1:8000/api/advertiser/ads?page=1",
     *      "prev": null,
     *      "next": null
     *  },
     *  "meta": {
     *      "current_page": 1,
     *      "from": 1,
     *      "last_page": 1,
     *      "links": [
     *          {
     *              "url": null,
     *              "label": "&laquo; Previous",
     *              "active": false
     *          },
     *          {
     *              "url": "http://127.0.0.1:8000/api/advertiser/ads?page=1",
     *              "label": "1",
     *              "active": true
     *          },
     *          {
     *              "url": null,
     *              "label": "Next &raquo;",
     *              "active": false
     *          }
     *      ],
     *      "path": "http://127.0.0.1:8000/api/advertiser/ads",
     *      "per_page": 10,
     *      "to": 1,
     *      "total": 1
     *  }
     * }
     */
    public function ads(User $user)
    {
        return AdResource::collection($user->ads()->paginate(10));
    }

}
