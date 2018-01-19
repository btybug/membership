<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11.01.2018
 * Time: 21:55
 */

namespace BtyBugHook\Membership\Http\Controllers;


use App\Http\Controllers\Controller;
use Btybug\btybug\Models\Painter\Painter;
use Btybug\Console\Repository\FieldsRepository;
use Btybug\Console\Repository\FormsRepository;
use Btybug\Console\Repository\FrontPagesRepository;
use BtyBugHook\Membership\Database\CreatePostsTable;
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

        return redirect()->back()->with('message', 'Blog activated');
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

        return redirect()->back()->with('message', 'Blog deactivated');
    }

    public function getDelete(
        $id,
        FrontPagesRepository $frontPagesRepository,
        FormsRepository $formsRepository,
        FieldsRepository $fieldsRepository
    )
    {

        $blog = $this->blogRepositroy->findOrFail($id);
        $form = $formsRepository->findAllByMultiple([
            'fields_type' => str_replace("-","_",$blog->slug),
        ]);

        $fields = $fieldsRepository->findAllByMultiple([
            'table_name' => str_replace("-","_",$blog->slug),
        ]);
        $page = $frontPagesRepository->findOneByMultiple([
            'module_id' => 'sahak.avatar/membership',
            'slug' => "all_" . $blog->slug,
        ]);
        try {
            if ($page) {
                $child = $frontPagesRepository->findBy('parent_id', $page->id);
                Painter::findByVariation($child->template)->variations(false)->deleteVariation($child->template);
                Painter::findByVariation($page->template)->variations(false)->deleteVariation($page->template);
                $child->delete();
                $page->delete();
                if(count($form)){
                    $form->delete();
                }
                if(count($fields)){
                    $fields->delete();
                }
            }
            $blog->delete();
            CreatePostsTable::down($blog->slug);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
        return redirect()->back();
    }
}