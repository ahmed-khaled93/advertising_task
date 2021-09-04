<?php

namespace App\Repositories\Api;

use App\Repositories\BaseRepository;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Support\Facades\DB;

/**
 * Class AdRepository.
 */
class AdRepository extends BaseRepository
{
    public function model()
    {
        return Ad::class;
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Ad
     */
    public function index($request)
    {
        // get all ads
        $ads = DB::table('ads');

        // filter by category if requested
        if($request->category_id)
        $ads->where('category_id', $request->category_id);

        // filter by tag if requested
        if($request->tag)
        $ads->join('tags', 'tags.ad_id', '=', 'ads.id')
            ->where('tag', $request->tag)
            ->select('ads.*');

        return AdResource::collection($ads->paginate(10));

    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Ad
     */
    public function store($request)
    {
        $ad = Ad::create(request([
          'user_id', 'category_id', 'type_id', 'title', 'description', 'start_date'
        ]));
    }

    /**
     * @param Ad $ad
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Ad
     */
    public function update($ad)
    {
        $ad->update(request([
          'user_id', 'category_id', 'type_id', 'title', 'description', 'start_date'
        ]));
    }

    /**
     * @param Ad $ad
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Ad
     */
    public function destroy($ad)
    {
        $ad->delete();
    }
}
