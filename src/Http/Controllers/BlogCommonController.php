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
use BtyBugHook\Membership\Services\GeneratorService;
use BtyBugHook\Membership\Services\ReplaceAtor;
use Illuminate\Http\Request;
use Btybug\Console\Repository\FrontPagesRepository;
use Btybug\btybug\Models\Migrations;
use Btybug\btybug\Repositories\AdminsettingRepository;
use BtyBugHook\Blog\Http\Requests\CreatePostRequest;
use BtyBugHook\Membership\Http\Requests\PostSettingsRequest;
use BtyBugHook\Membership\Repository\PostsRepository;
use BtyBugHook\Membership\Services\PostsService;
use Yajra\DataTables\DataTables;

class BlogCommonController extends Controller
{
    public $postsRepository;

    public function __construct(PostsRepository $postsRepository)
    {
        $this->postsRepository = $postsRepository;
        if (!$this->postsRepository->checkStatus()) abort(404, 'Blog not found');
    }

    public function getIndex()
    {
        $model = $this->postsRepository->getBlogModel();
        return view('mbshp::common.index', compact('model'));
    }

    public function getPosts($slug)
    {
        return view('mbshp::common.list', compact(['slug']));
    }

    public function postsData($slug)
    {
        set_time_limit(-1);
        ini_set('memory_limit', '2048M');
        return DataTables::of(\DB::table($this->postsRepository->table))->addColumn('actions', function ($post) use ($slug) {
            $url = url("admin/membership/$slug/edit-post", $post->id);
            return "<a href='$url' class='btn btn-warning'><i class='fa fa-edit'></i></a>";
        }, 2)->addColumn('author', function ($post) {
            return BBGetUser($post->author_id);
        })->editColumn('image', function ($post) {
            if($post->image){
                return "<img src='$post->image' width='50px' height='50px' alt='image' />";
            }else{
                return null;
            }
        })->editColumn('description', function ($post) {
           return str_limit($post->description,20);
        })->rawColumns(['actions','image'])->make(true);
    }

    public function getNewPost(
        $slug
    )
    {
        return view('mbshp::common.create',compact('slug'));
    }

    public function postNewPost(
        CreatePostRequest $request,
        PostsService $postsService
    )
    {
        $result = $postsService->create($request->except("_token", 'image'), $request->file("image"));

        return redirect()->to('admin/membership/cars/posts')->with("message", "Post Successfully Created");
    }

    public function getSettings(
        FrontPagesRepository $pagesRepository,
        FormsRepository $formsRepository,
        AdminsettingRepository $adminsettingRepository,
        $slug
    )
    {
        $table = $this->postsRepository->table;
        $all = $pagesRepository->findBy('slug', 'all_' . $slug);
        $single = $pagesRepository->findBy('slug', 'single_' . $slug);
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

        $settings = $adminsettingRepository->findOneByMultipleSettingsArray(['section' => 'btybug_blog', 'settingkey' => $slug.'_settings']);

        return view('mbshp::common.settings', compact(['all', 'single', 'createForms', 'editForms', 'settings', 'slug', 'table']))->with($this->data);
    }

    public function getFormBulder()
    {
        $form = null;
        //$data['form_fields'] = ($settings) ? json_decode($settings->value,true) : [];
        return view("mbshp::common.form_bulder", compact('form'));
    }

    public function getEditFormBulder(
        FormsRepository $formsRepository,
        FormService $formService,
        $slug,
        $id
    )
    {
        $table = $this->postsRepository->table;
        $form = $formsRepository->findOrFail($id);
        $form->fields_json = $formService->fieldsJson($id, true);
        $form->unit_json = json_encode(ajaxExtract(json_decode($form->unit_json, true)));
        $fields = json_encode((count($form->form_fields)) ? $form->form_fields()->pluck('field_slug', 'field_slug')->toArray() : []);
        $html = $formService->render($id);

        return view("mbshp::common.form_bulder", compact('form', 'fields', 'html', 'table'));
    }

    public function postFormBulder(
        Request $request,
        FormService $service
    )
    {
        $service->createOrUpdate($request->except('_token'));

        return redirect()->to('admin/blog/form-list')->with('message', 'Form successfully Saved');
    }

    public function getList(
        FormsRepository $formsRepository,
        $slug
    )
    {
        $pluginForms = $formsRepository->getFormsByFieldType($this->postsRepository->table, ['core', 'plugin']);
        $forms = $formsRepository->getFormsByFieldType($this->postsRepository->table, ['custom']);
        return view("mbshp::common.form-list", compact('pluginForms', 'forms', 'slug'));
    }


    public function postSettings(
        Request $request,
        FrontPagesRepository $pagesRepository,
        AdminsettingRepository $adminsettingRepository,
        $slug
    )
    {
        $adminsettingRepository->createOrUpdate(json_encode($request->only('posts_create_form', 'posts_edit_form', 'url_manager'), true), 'btybug_blog', $slug.'_settings');
        $all = $pagesRepository->findBy('slug', 'all_'.$slug);
        $single = $pagesRepository->findBy('slug', 'single_'.$slug);
        $pagesRepository->update($all->id, ['template' => $request->all_main_content]);
        $pagesRepository->update($single->id, ['template' => $request->single_main_content]);
        return redirect()->back();
    }

    public function unitRenderWithFields(
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

    public function postFormFieldsSettings(Request $request, AdminsettingRepository $adminsettingRepository)
    {
        $data = $request->except('_token');
        $adminsettingRepository->createOrUpdate(json_encode($data, true), 'btybug_blog', 'form_field_settings');
        return redirect()->back();
    }

    public function getEditPost(
        PostsRepository $postsRepository,
        $slug,
        $id
    )
    {
        $post = $postsRepository->findOrFail($id);
        return view('mbshp::common.edit', compact('post','slug'));
    }

    public function postEditPos(
        $id,
        Request $request,
        PostsService $postsService
    )
    {
        $result = $postsService->update($request->except("_token", 'image'), $request->file("image"));

        return redirect()->to('admin/blog/posts')->with("message", "Post Successfully Edited");
    }

    public function getFieldsByTable(
        Request $request,
        FieldsRepository $fieldsRepository
    )
    {
        $fields = $fieldsRepository->getWhereNotExists($request->table, $request->fields);
        $html = \View("mbshp::common._partials.field-list", compact('fields'))->render();

        return \Response::json(['html' => $html]);
    }

    public function getFormSettings(
        RoleRepository $roleRepository,
        FormsRepository $formsRepository,
        $slug,
        $id
    )
    {
        $form = $formsRepository->findOrFail($id);
        $formRoles = (count($form->form_roles)) ? $form->form_roles()->pluck('role_id', 'role_id')->toArray() : [];
        $roles = $roleRepository->getAll()->toArray();
        return view('mbshp::common.forms.settings', compact('roles', 'form', 'formRoles'));
    }

    public function postFormSettings(
        Request $request,
        FormService $formService,
        $slug,
        $id
    )
    {
        $formService->saveSettings($id, $request);

        return redirect()->back()->with('message', 'Form settings are saved');
    }

    public function getMyFormsView(
        $id,
        FormsRepository $formsRepository,
        FormService $formService
    )
    {
        $form = $formsRepository->findOneByMultiple(['id' => $id, 'created_by' => 'plugin']);
        if (!$form) abort(404, "Form not found");

        return view('mbshp::common.forms.view', compact('form'));
    }

    public function carsData()
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

    public function createPosts()
    {

        set_time_limit(-1);
        ini_set('memory_limit', '2048M');
        $data = array();
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

    public function appendPostScrollPaginator(PostsRepository $repository, Request $request)
    {

        $posts = json_decode($request->all_posts);

        $limit_per_page = isset($request->custom_limit_per_page) ? $request->custom_limit_per_page : 10;
        $col_md_x = isset($request->bootstrap_col) ? $request->bootstrap_col : "col-md-4";
        $settings_for_ajax = unserialize($request->settings_for_ajax);
        $all_posts = json_encode($posts);
        if (!count($posts) < $limit_per_page) {
            return \Response::json(["html" => '', 'all_posts' => $all_posts]);
        }
        $posts = new Paginator($limit_per_page, 6, 'bty-pagination-2', $posts);

        $html = \View::make('mbshp::common._partials.render-for-post', compact('posts', 'col_md_x', 'settings_for_ajax'))->render();

        return \Response::json(["html" => $html, 'all_posts' => $all_posts]);
    }

    public function search(PostsRepository $repository, Request $request)
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

        $html = \View::make('mbshp::common._partials.render-for-post', compact('posts', 'col_md_x', 'settings_for_ajax'))->render();

        return \Response::json(["html" => $html, 'all_posts' => $all_posts]);
    }

    public function findPage(PostsRepository $repository, Request $request)
    {
        $all_posts = json_decode($request->all_posts);
        $col_md_x = isset($request->bootstrap_col) ? $request->bootstrap_col : "col-md-4";
        $settings_for_ajax = unserialize($request->settings_for_ajax);
        $limit_per_page = isset($request->limit_per_page) ? $request->limit_per_page : 10;

        if (!count($all_posts)) {
            $posts = $repository->getPublished();
        } else {
            $posts = $all_posts;
        }
        $all_posts = json_encode($posts);

        $posts = new Paginator($limit_per_page, 6, 'bty-pagination-2', $posts);
        $html = \View::make('mbshp::common._partials.render-for-post', compact('posts', 'col_md_x', 'settings_for_ajax'))->render();

        return \Response::json(["html" => $html, "all_posts" => $all_posts]);
    }

    public function getOptions(AdminsettingRepository $adminsettingRepository, $slug)
    {
        $data = [];
        $settings = $adminsettingRepository->getSettings('product', $slug);
        if ($settings) {
            $data = (json_decode($settings->val, true));
        }
        $options = \Config::get('options.listener');
//        $options = get_prices_data();
//
//        foreach ($options as $key => $option) {
//            if (isset($data['allow_price']['options'][$key])) {
//                $options[$key]['checked'] = true;
//            } else {
//                $options[$key]['checked'] = false;
//            }
//        }
//        dd($options);
        return view('mbshp::common.options', compact('options', 'data', 'slug'));
    }

    public function postOptions(
        Request $request,
        AdminsettingRepository $adminsettingRepository,
        GeneratorService $generatorService,
        FormsRepository $formsRepository,
        $slug
    )
    {
        $data = $request->except('_token');
        $adminsettingRepository->createOrUpdate(json_encode($data, true), 'product', $slug);
        $generatorService->generateTabs('create_'.$slug,$slug);
        $generatorService->generateTabs('edit_'.$slug,$slug);
        return \Response::json(['error' => false]);
    }

    public function postGetOptionsForm(
        Request $request,
        AdminsettingRepository $adminsettingRepository,
        $slug
    )
    {
        $option = \Config::get("options.listener.$request->type.render_function",null);
        return (is_callable($option)) ? $option($request->value) : null;
    }

    public function getOrderButton($slug,AdminsettingRepository $adminsettingRepository)
    {
        $settingsData=$adminsettingRepository->getSettings( 'blog_order_button', $slug);
        if($settingsData){
            $settings=json_decode($settingsData->val,true);
        }
        $columns = \DB::select("SHOW COLUMNS FROM $slug");
        return view('mbshp::common.order_button', compact('columns', 'slug','settings'));
    }

    public function getMyFormsEdit(
        FormsRepository $formsRepository,
        FieldsRepository $fieldsRepository,
        FormService $formService,
        $slug,
        $id
    )
    {
        $form = $formsRepository->findOneByMultiple(['id' => $id, 'created_by' => 'plugin']);
        if (!$form) abort(404, "Form not found");

        $fields = $fieldsRepository->getBy('table_name', $this->postsRepository->table);
        $existingFields = (count($form->form_fields)) ? $form->form_fields()->pluck('field_slug', 'field_slug')->toArray() : [];
        return view('mbshp::common.forms.edit', compact('form', 'fields', 'existingFields','slug'));
    }

    public function postRenderField(
        Request $request,
        FieldsRepository $fieldsRepository
    )
    {
        $field = $fieldsRepository->findByTableAndCol($request->table, $request->field);

        if ($field && view()->exists("mbshp::common._partials.custom_fields." . $field->type)) {
            $html = \view("mbshp::common._partials.custom_fields." . $field->type)->with('field', $field->toArray())->render();
            return ['error' => false, 'html' => $html];
        }
        return ['error' => true];
    }

    public function postSaverForm(
        Request $request,
        FieldsRepository $fieldsRepository,
        FormService $formService,
        GeneratorService $generatorService,
        $slug
    )
    {
        $data = $request->except('_token');
        $id = $data['id'];
        $fields = $data['fields_json'];
        $data['fields_json'] = array_keys($fields);
        $form = $formService->createOrUpdate($data);
        if($form){
            $generatorService->generateTabs($form->slug,$slug);
            return ['error' => false];
        }

        return ['error' => true];
    }

    /**
     * @param Request $request
     * @param AdminsettingRepository $adminsettingRepository
     * @return array
     */
    public function postOrderButton(
        Request $request,
        AdminsettingRepository $adminsettingRepository
    )
    {
        $slug = $request->get('slug');
        $data = json_encode($request->except(['slug', '_token']), true);
        $adminsettingRepository->createOrUpdate($data, 'blog_order_button', $slug);
        return ['error' => false];
    }
}