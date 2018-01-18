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
        $this->blogRepositroy->create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'author_id' => \Auth::id(),
            'status' => 1
        ]);

        $this->generatorService->generate($request->title);

        return \Response::json(['error' => false]);
    }

    public function getActivate(
        Request $request,
        $id
    )
    {
        $blog = $this->blogRepositroy->findOrFail($id);

        $blog->update([
           'status' => true
        ]);

        return redirect()->back()->with('message','Blog activated');
    }

    public function getDeactivate(
        Request $request,
        $id
    )
    {
        $blog = $this->blogRepositroy->findOrFail($id);

        $blog->update([
            'status' => false
        ]);

        return redirect()->back()->with('message','Blog deactivated');
    }

    public function getDelete($id, FrontPagesRepository $frontPagesRepository)
    {
        $blog = $this->blogRepositroy->find($id);
        $page=$frontPagesRepository->findOneByMultiple([
            'module_id'=>'sahak.avatar/membership',
            'slug' => "all_" . $blog->slug,
        ]);
        $child=$frontPagesRepository->findBy('parent_id',$page->id);
        Painter::findByVariation($child->template)->variations(true)->deleteVariation($child->template);
        Painter::findByVariation($page->template)->variations(true)->deleteVariation($page->template);
        $child->delete();
        $page->delete();
        CreatePostsTable::down($blog->slug);
        return redirect()->back();
    }
}