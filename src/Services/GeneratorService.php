<?php

namespace BtyBugHook\Membership\Services;

use Btybug\btybug\Models\Painter\Painter;
use Btybug\btybug\Repositories\AdminsettingRepository;
use Btybug\btybug\Services\GeneralService;
use Btybug\Console\Repository\FieldsRepository;
use Btybug\Console\Repository\FormsRepository;
use Btybug\Console\Repository\FrontPagesRepository;
use Btybug\Console\Services\FieldService;
use Btybug\Console\Services\FormService;
use BtyBugHook\Membership\Database\CreatePostsTable;
use BtyBugHook\Membership\Repository\PostsRepository;

class GeneratorService extends GeneralService
{
    private $result;
    private $postRepo;
    private $title;
    private $slug;
    private $fileString;
    private $generatingFile;
    private $formService;
    private $fieldsRepository;
    private $adminsettingRepository;
    private $formsRepositroy;
    private $stubPath = 'vendor' . DS . 'sahak.avatar' . DS . 'membership' . DS . 'src' . DS . 'Stubs';
    private $modelPath = 'vendor' . DS . 'sahak.avatar' . DS . 'membership' . DS . 'src' . DS . 'Models' . DS . 'Blogs';
    private $all_unit_slug = 'membership_plans';
    private $single_unit_slug = 'unit_for_post_from_membership';

    const STUB_DATA = [
        '{ClassName}' => 'className',
        '{slug}'      => 'slug',
    ];

    public function __construct (PostsRepository $postsRepository, FormService $formService, FormsRepository $formsRepository, FieldsRepository $fieldsRepository, AdminsettingRepository $adminsettingRepository)
    {
        $this->postRepo = $postsRepository;
        $this->formService = $formService;
        $this->formsRepositroy = $formsRepository;
        $this->fieldsRepository = $fieldsRepository;
        $this->adminsettingRepository = $adminsettingRepository;
    }


    public function generate ($title)
    {
        $this->title = $title;
        $this->slug = str_slug($this->title);
        $this->makeTable();
        $this->makeVariations();
        $this->makePages();
        $this->makeForms();
    }

    private function makeTable ()
    {
        CreatePostsTable::up(str_replace('-', '_', $this->slug));
    }

    private function makePages ()
    {
        $this->registerFrontPages();
    }

    private function makeForms ()
    {
        $this->registerForms();
    }

    private function registerFrontPages ()
    {
        $frontPageRepo = new FrontPagesRepository();
        \DB::transaction(function () use ($frontPageRepo) {
            $all_page = $frontPageRepo->create([
                'title'        => "All " . $this->title,
                'slug'         => "all_" . $this->slug,
                'url'          => '/' . $this->slug,
                'module_id'    => 'sahak.avatar/membership',
                'header'       => true,
                'type'         => 'plugin',
                'form_path'    => 'mbshp::page_settings.all_posts',
                'page_layout'  => 'front_layout_with_2_col_2_10.default',
                'status'       => 'published',
                'content_type' => 'template',
                'template'     => $this->all_unit_slug . '.' . $this->slug
            ]);

            $frontPageRepo->create([
                'title'        => "Single " . $this->title,
                'slug'         => "single_" . $this->slug,
                'url'          => '/' . $this->slug . '/{param}',
                'module_id'    => 'sahak.avatar/membership',
                'parent_id'    => $all_page->id,
                'header'       => true,
                'type'         => 'plugin',
                'form_path'    => 'mbshp::page_settings.single_post',
                'page_layout'  => 'front_layout_with_2_col_2_10.default',
                'status'       => 'published',
                'content_type' => 'template',
                'template'     => $this->single_unit_slug . '.' . $this->slug
            ]);
        });
    }

    private function makeVariations ()
    {
        $all_unit = Painter::find($this->all_unit_slug);
        $single_unit = Painter::find($this->single_unit_slug);
        if ($all_unit && $single_unit) {
            $all_unit->variations()->createVariation([], $this->slug, true);
            $single_unit->variations()->createVariation([], $this->slug, true);
        }
    }

    private function makeModel ()
    {
        $data = [
            'className' => $this->strToModel($this->title),
            'slug'      => str_slug($this->title, "_")
        ];
        $this->fileString = \File::get(plugins_path($this->stubPath . DS . 'model.stub'));
        $this->generatingFile = plugins_path($this->modelPath . DS . $data['className'] . '.php');

        $this->makeFile(self::STUB_DATA, $data);
    }

    private function strToModel ($str)
    {
        return ucfirst(camel_case($str));
    }

    private function makeFile (array $stubs, array $data)
    {
        foreach ($stubs as $stub => $value) {
            if (isset($data[$value])) {
                $this->fileString = str_replace($stub, $data[$value], $this->fileString);
            }
        }

        \File::put($this->generatingFile, $this->fileString);
    }

    private function registerForms ()
    {
        $form = new FormsRepository();
        $fieldRepo = new FieldsRepository();
        \DB::transaction(function () use ($form, $fieldRepo) {
            $create_form = $form->create([
                'name'        => 'Create ' . $this->title,
                'slug'        => 'create_' . $this->slug,
                'created_by'  => 'plugin',
                'type'        => 'new',
                'fields_type' => str_replace('-', '_', $this->slug)
            ]);
            $this->generateFormBlade($create_form);
            $edit_form = $form->create([
                'name'        => 'Edit ' . $this->title,
                'slug'        => 'edit_' . $this->slug,
                'created_by'  => 'plugin',
                'type'        => 'edit',
                'fields_type' => str_replace('-', '_', $this->slug)
            ]);
            $this->generateFormBlade($edit_form);
            //generating create form fields
            $fieldRepo->create([
                'name'          => 'Title',
                'slug'          => uniqid(),
                'visibility'    => true,
                'table_name'    => str_replace('-', '_', $this->slug),
                'column_name'   => 'title',
                'type'          => 'text',
                'structured_by' => 'plugin',
            ]);

            $fieldRepo->create([
                'name'          => 'Status',
                'slug'          => uniqid(),
                'visibility'    => true,
                'table_name'    => str_replace('-', '_', $this->slug),
                'column_name'   => 'status',
                'type'          => 'select',
                'manual'        => 'manual',
                'json_data'     => '{"manual":"draft,published"}',
                'structured_by' => 'plugin',
            ]);
            $fieldRepo->create([
                'name'          => 'Description',
                'slug'          => uniqid(),
                'visibility'    => true,
                'table_name'    => str_replace('-', '_', $this->slug),
                'column_name'   => 'description',
                'type'          => 'textarea',
                'structured_by' => 'plugin',
            ]);

            $fieldRepo->create([
                'name'          => 'Price',
                'slug'          => 'price_pym_'.str_replace('-', '_', $this->slug),
                'visibility'    => false,
                'table_name'    => str_replace('-', '_', $this->slug),
                'column_name'   => 'price',
                'type'          => 'text',
                'structured_by' => 'plugin',
                'before_save' => 'json_encode',
            ]);

            $fieldRepo->create([
                'name'          => 'Tax & Services',
                'slug'          => 'tax_services_pym_'.str_replace('-', '_', $this->slug),
                'visibility'    => false,
                'table_name'    => str_replace('-', '_', $this->slug),
                'column_name'   => 'tax_services',
                'type'          => 'text',
                'structured_by' => 'plugin',
                'before_save' => 'json_encode',
            ]);
        });
    }

    private function generateFormBlade ($form)
    {
//        $html = "{{--Form $form->id --}}\r\n" . \File::get(plugins_path('vendor/sahak.avatar/membership/src/views/common/_partials/custom_fields/fheader.blade.php')) . "\r\n";
//        $html .= \File::get(plugins_path('vendor/sahak.avatar/membership/src/views/common/_partials/custom_fields/default_content.blade.php')) . "\r\n";
//        $html .= \File::get(plugins_path('vendor/sahak.avatar/membership/src/views/common/_partials/custom_fields/ffooter.blade.php')) . "\r\n";
        //TODO: make default form
        $this->formService->generateBlade($form->id, '');
    }

    public function generateTabs ($form_slug, $slug = null)
    {

        $form = $this->formsRepositroy->findBy('slug', $form_slug);
        $fieldsJson = $form->fields_json;
        $fieldHtml = '';
        $data = [];
        $settings = $this->adminsettingRepository->getSettings('product', $slug);
        if ($settings) {
            $data = (json_decode($settings->val, true));
        }

        if ($fieldsJson) {
            $fields = json_decode($fieldsJson, true);
            foreach ($fields as $field) {
                $field = $this->fieldsRepository->find($field);
                $path = plugins_path('vendor/sahak.avatar/membership/src/views/common/_partials/custom_fields/' . $field->type . '.blade.php');
                if (\File::exists($path)) {
                    $blade = \File::get($path) . "\r\n";
                    $fieldHtml .= ReplaceAtor::replace($blade, $field);
                }
            }
        }
        $html = \View('mbshp::common._partials.custom_fields.formTemplate', compact(['fieldHtml', 'data', 'slug']))->render();
        $this->formService->generateBlade($form->id, $html);
    }

    public static function renderField ($id)
    {
        $repositroy = new FieldsRepository();
        $field = $repositroy->find($id);

        return FieldService::getFieldHtml($field);
    }
}