<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11.01.2018
 * Time: 21:55
 */

namespace BtyBugHook\Membership\Http\Controllers;


use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Repository\BlogRepository;
use BtyBugHook\Membership\Services\GeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BlogController extends Controller
{
    private $blogRepositroy;
    private $generatorService;

    public function __construct(BlogRepository $blogRepository, GeneratorService $generatorService)
    {
        $this->blogRepositroy = $blogRepository;
        $this->generatorService = $generatorService;
    }

    public function getIndex()
    {
        return view('mbshp::blogs.index');
    }

    public function postCreate(
        Request $request
    )
    {
        return $this->generatorService->generate($request->title);
        $this->blogRepositroy->create([
            'title' => $request->title,
            'slug' => str_slug($request->title,"_"),
            'author_id' => \Auth::id()
        ]);

        return \Response::json(['error' => false]);
    }
}