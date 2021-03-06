<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use Btybug\btybug\Models\Universal\Paginator;
use Btybug\Console\Models\Forms;
use Btybug\Console\Repository\FieldsRepository;
use Btybug\Console\Repository\FormsRepository;
use Btybug\Console\Services\FieldService;
use Btybug\Console\Services\FormService;
use Btybug\User\Repository\RoleRepository;
use BtyBugHook\Membership\Models\Post;
use Illuminate\Http\Request;
use Btybug\btybug\Models\Templates\Units;
use Btybug\Console\Repository\FrontPagesRepository;
use Btybug\btybug\Models\Migrations;
use Btybug\btybug\Repositories\AdminsettingRepository;
use BtyBugHook\Blog\Http\Requests\CreatePostRequest;
use BtyBugHook\Membership\Http\Requests\PostSettingsRequest;
use BtyBugHook\Membership\Repository\PostsRepository;
use BtyBugHook\Membership\Services\PostsService;
use Yajra\DataTables\DataTables;

class CarsController extends Controller
{
    public function __construct ()
    {

    }

    public function getIndex (PostsRepository $postsRepository)
    {
        return view('mbshp::cars.index');
    }

    public function getPosts (
        PostsRepository $postsRepository
    )
    {
        $posts = $postsRepository->getAll();

        return view('mbshp::cars.list', compact(['posts']));
    }

    public function getNewPost ()
    {
        return view('mbshp::cars.create');
    }

    public function postNewPost (
        CreatePostRequest $request,
        PostsService $postsService
    )
    {
        $result = $postsService->create($request->except("_token", 'image'), $request->file("image"));

        return redirect()->to('admin/membership/cars/posts')->with("message", "Post Successfully Created");
    }

    public function getSettings (
        FrontPagesRepository $pagesRepository,
        FormsRepository $formsRepository,
        AdminsettingRepository $adminsettingRepository
    )
    {
        $table = 'cars';
        $all = $pagesRepository->findBy('slug', 'all-posts');
        $single = $pagesRepository->findBy('slug', 'single-post');
        $createForms = $formsRepository->getFormsByFieldType($table, ['*'], true, 'new');
        $editForms = $formsRepository->getFormsByFieldType($table, ['*'], true, 'edit');
        $columns = \DB::select('SHOW COLUMNS FROM ' . $table);
        $this->data['default'] = ['NULL', 'USER_DEFINED', 'CURRENT_TIMESTAMP'];
        $this->data['tbtypes'] = Migrations::types();
        $this->data['engine'] = Migrations::engine();
        $this->data['table'] = $table;
        $this->data['columns'] = $columns;
        foreach ($columns as $column) {
            $after_columns[$column->Field] = $column->Field;
        }
        $this->data['after_columns'] = $after_columns;

        $settings = $adminsettingRepository->findOneByMultipleSettingsArray(['section' => 'btybug_blog', 'settingkey' => 'blog_settings']);

        return view('mbshp::cars.settings', compact(['all', 'single', 'createForms', 'editForms', 'settings']))->with($this->data);
    }

    public function getFormBulder ()
    {
        $form = null;

        //$data['form_fields'] = ($settings) ? json_decode($settings->value,true) : [];
        return view("mbshp::cars.form_bulder", compact('form'));
    }

    public function getEditFormBulder (
        $id,
        FormsRepository $formsRepository,
        FormService $formService
    )
    {
        $form = $formsRepository->findOrFail($id);
        $form->fields_json = $formService->fieldsJson($id, true);
        $form->unit_json = json_encode(ajaxExtract(json_decode($form->unit_json, true)));
        $fields = json_encode((count($form->form_fields)) ? $form->form_fields()->pluck('field_slug', 'field_slug')->toArray() : []);
        $html = $formService->render($id);

        return view("mbshp::cars.form_bulder", compact('form', 'fields', 'html'));
    }

    public function postFormBulder (
        Request $request,
        FormService $service
    )
    {
        $service->createOrUpdate($request->except('_token'));

        return redirect()->to('admin/blog/form-list')->with('message', 'Form successfully Saved');
    }

    public function getList (
        FormsRepository $formsRepository
    )
    {
        $pluginForms = $formsRepository->getFormsByFieldType('posts', ['core', 'plugin']);
        $forms = $formsRepository->getFormsByFieldType('posts', ['custom']);

        return view("mbshp::cars.form-list", compact('pluginForms', 'forms'));
    }


    public function postSettings (
        Request $request,
        FrontPagesRepository $pagesRepository,
        AdminsettingRepository $adminsettingRepository
    )
    {
        $adminsettingRepository->createOrUpdate(json_encode($request->only('posts_create_form', 'posts_edit_form', 'url_manager'), true), 'btybug_blog', 'blog_settings');
        $all = $pagesRepository->findBy('slug', 'all-posts');
        $single = $pagesRepository->findBy('slug', 'single-post');
        $pagesRepository->update($all->id, ['template' => $request->all_main_content]);
        $pagesRepository->update($single->id, ['template' => $request->single_main_content]);

        return redirect()->back();
    }

    public function unitRenderWithFields (
        Request $request,
        AdminsettingRepository $adminsettingRepository,
        FieldsRepository $fieldsRepository,
        FieldService $fieldService
    )
    {
        $fields = $request->get('fields', null);
        $data = [];
        $existing = [];
        if ($fields) {
            foreach ($fields as $k => $v) {
                $f = $fieldsRepository->find($k);
                if ($f) {

                    $existing['object'] = $f;
                    $existing['html'] = $fieldService->returnHtml($f);
                    $existing['field_data'] = get_field_data($f->id);

                    $data[] = $existing;
                }
            }

            return \Response::json(['error' => false, 'fields' => $data]);
        }

        return \Response::json(['message' => "Fields are invalid", 'error' => true]);
    }

    public function postFormFieldsSettings (Request $request, AdminsettingRepository $adminsettingRepository)
    {
        $data = $request->except('_token');
        $adminsettingRepository->createOrUpdate(json_encode($data, true), 'btybug_blog', 'form_field_settings');

        return redirect()->back();
    }

    public function getEditPost (
        $id,
        PostsRepository $postsRepository
    )
    {
        $post = $postsRepository->findOrFail($id);

        return view('mbshp::cars.edit', compact('post'));
    }

    public function postEditPos (
        $id,
        Request $request,
        PostsService $postsService
    )
    {
        $result = $postsService->update($request->except("_token", 'image'), $request->file("image"));

        return redirect()->to('admin/blog/posts')->with("message", "Post Successfully Edited");
    }

    public function getFieldsByTable (
        Request $request,
        FieldsRepository $fieldsRepository
    )
    {
        $fields = $fieldsRepository->getWhereNotExists($request->table, $request->fields);
        $html = \View("mbshp::cars._partials.field-list", compact('fields'))->render();

        return \Response::json(['html' => $html]);
    }

    public function getFormSettings (
        $id,
        RoleRepository $roleRepository,
        FormsRepository $formsRepository
    )
    {
        $form = $formsRepository->findOrFail($id);
        $formRoles = (count($form->form_roles)) ? $form->form_roles()->pluck('role_id', 'role_id')->toArray() : [];
        $roles = $roleRepository->getAll()->toArray();

        return view('mbshp::cars.forms.settings', compact('roles', 'form', 'formRoles'));
    }

    public function postFormSettings (
        $id,
        Request $request,
        FormService $formService
    )
    {
        $formService->saveSettings($id, $request);

        return redirect()->back()->with('message', 'Form settings are saved');
    }

    public function getMyFormsView (
        $id,
        FormsRepository $formsRepository,
        FormService $formService
    )
    {
        $form = $formsRepository->findOneByMultiple(['id' => $id, 'created_by' => 'plugin']);
        if (! $form) abort(404, "Form not found");

        return view('mbshp::cars.forms.view', compact('form'));
    }

    public function carsData ()
    {
        set_time_limit(-1);
        ini_set('memory_limit', '2048M');

        return DataTables::of(Post::query())->addColumn('actions', function ($post) {
            $url = url("admin/membership/cars/edit-post", $post->id);

            return "<a href='$url' class='btn btn-warning'><i class='fa fa-edit'></i></a>";
        }, 2)->addColumn('author', function ($post) {

            return BBGetUser($post->author_id);
        })->rawColumns(['actions'])->make(true);
    }

    public function createPosts ()
    {

        set_time_limit(-1);
        ini_set('memory_limit', '2048M');
        $data = [];
        for ($i = 0; $i < 500; $i++) {
            $data[$i]['author_id'] = 1;
            $data[$i]['title'] = str_random(5);
            $data[$i]['description'] = str_random(10);
            $data[$i]['image'] = 'images/posts/5a26da145b969.jpg';
            $data[$i]['slug'] = str_random(5);
            $data[$i]['status'] = 'published';
        }

        return \DB::table('posts')->insert($data);
    }

    public function appendPostScrollPaginator (PostsRepository $repository, Request $request)
    {

        $posts = json_decode($request->all_posts);

        $limit_per_page = isset($request->custom_limit_per_page) ? $request->custom_limit_per_page : 10;
        $col_md_x = isset($request->bootstrap_col) ? $request->bootstrap_col : "col-md-4";
        $settings_for_ajax = unserialize($request->settings_for_ajax);
        $all_posts = json_encode($posts);
        if (! count($posts) < $limit_per_page) {
            return \Response::json(["html" => '', 'all_posts' => $all_posts]);
        }
        $posts = new Paginator($limit_per_page, 6, 'bty-pagination-2', $posts);

        $html = \View::make('mbshp::cars._partials.render-for-post', compact('posts', 'col_md_x', 'settings_for_ajax'))->render();

        return \Response::json(["html" => $html, 'all_posts' => $all_posts]);
    }

    public function search (PostsRepository $repository, Request $request)
    {
        $term = $request->term;
        $search_by = json_decode($request->search_by);
        $settings_for_ajax = unserialize($request->settings_for_ajax_search);
        $sort_by = $request->sort_by;
        $sort_how = $request->sort_how;

        $posts = $repository->renderSearch($term, $search_by);

        if ($sort_how && $sort_by) {
            $posts = $repository->renderSort($posts, $sort_by, $sort_how);
        } else {
            $posts = $repository->renderSort($posts);
        }


        $limit_per_page = isset($request->limit_per_page_for_ajax) ? $request->limit_per_page_for_ajax : 10;
        $col_md_x = isset($request->custom_get_col) ? $request->custom_get_col : "col-md-4";

        $posts = $posts->get();
        $all_posts = json_encode($posts);
        $posts = new Paginator($limit_per_page, 6, 'bty-pagination-2', $posts);

        $html = \View::make('mbshp::cars._partials.render-for-post', compact('posts', 'col_md_x', 'settings_for_ajax'))->render();

        return \Response::json(["html" => $html, 'all_posts' => $all_posts]);
    }

    public function findPage (PostsRepository $repository, Request $request)
    {
        $all_posts = json_decode($request->all_posts);
        $col_md_x = isset($request->bootstrap_col) ? $request->bootstrap_col : "col-md-4";
        $settings_for_ajax = unserialize($request->settings_for_ajax);
        $limit_per_page = isset($request->limit_per_page) ? $request->limit_per_page : 10;

        if (! count($all_posts)) {
            $posts = $repository->getPublished();
        } else {
            $posts = $all_posts;
        }
        $all_posts = json_encode($posts);

        $posts = new Paginator($limit_per_page, 6, 'bty-pagination-2', $posts);
        $html = \View::make('mbshp::cars._partials.render-for-post', compact('posts', 'col_md_x', 'settings_for_ajax'))->render();

        return \Response::json(["html" => $html, "all_posts" => $all_posts]);
    }
}