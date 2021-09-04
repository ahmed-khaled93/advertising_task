<?php

namespace App\Repositories\Api;

use App\Repositories\BaseRepository;
use App\Http\Resources\TagResource;
use App\Models\Tag;

/**
 * Class TagRepository.
 */
class TagRepository extends BaseRepository
{
    public function model()
    {
        return Tag::class;
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Tag
     */
    public function index(){
        $tags = TagResource::collection(Tag::orderBy('id', 'desc')->paginate(10));
        
        return $tags;
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Tag
     */
    public function store($request)
    {
        $tag = Tag::create(request(['tag', 'ad_id']));
    }

    /**
     * @param Tag $tag
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Tag
     */
    public function update($tag)
    {
        $tag->update(request(['tag', 'ad_id']));
    }

    /**
     * @param Tag $tag
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Tag
     */
    public function destroy($tag)
    {
        $tag->delete();
    }
}
