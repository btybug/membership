<?php

namespace BtyBugHook\Membership\Services;

use Btybug\btybug\Models\Painter\Painter;
use Btybug\btybug\Repositories\AdminsettingRepository;
use Btybug\btybug\Services\GeneralService;
use Btybug\Console\Repository\FieldsRepository;
use Btybug\Console\Repository\FormsRepository;
use BtyBugHook\Membership\Repository\BlogRepository;

class BlogService extends GeneralService
{
    private $blogRepositroy;
    private $fieldsRepository;
    private $formsRepository;
    private $adminsettingRepository;

    public function __construct (
        BlogRepository $blogRepository,
        FieldsRepository $fieldsRepository,
        FormsRepository $formsRepository,
        AdminsettingRepository $adminsettingRepository
    )
    {
        $this->blogRepositroy = $blogRepository;
        $this->fieldsRepository = $fieldsRepository;
        $this->formsRepository = $formsRepository;
        $this->adminsettingRepository = $adminsettingRepository;
    }

    public static function checkStatus ($slug)
    {
        $blogRepositroy = new BlogRepository();

        if ($slug) {
            $blog = $blogRepositroy->findBy('slug', $slug);
            if ($blog && $blog->status) {
                return true;
            }
        }

        return false;
    }

    public static function getActive ()
    {
        $blogs_array = [];
        $blogRepositroy = new BlogRepository();
        $blogs = $blogRepositroy->getActive();
        if (count($blogs)) {
            foreach ($blogs as $blog) {
                $blogs_array[] = [
                    "title"       => $blog->title,
                    "custom-link" => "/admin/membership/$blog->slug",
                    "icon"        => "fa fa-angle-right",
                    "is_core"     => "yes"
                ];
            }

            \Eventy::action('admin.menus', [
                "title"       => "Products",
                "custom-link" => "#",
                "icon"        => "fa-product-hunt",
                "is_core"     => "yes",
                "children"    => $blogs_array
            ]);
        }
    }

    public function getDataByType ($data)
    {
        $type = $data['type'];

        return $this->$type($data);
    }

    private function units ($data)
    {
        $result = [];
        $settings = $this->adminsettingRepository->getSettings('product', $data['slug']);
        if ($settings) {
            $result = (json_decode($settings->val, true));
        }

        $units = [];
        if (count($result)) {
            foreach ($result as $tag => $item) {
                if ($item['is_active']) {
                    $units[] = Painter::all()->sortByTag($tag);
                }
            }
        }

        return ['units' => array_flatten($units)];
    }

    private function fields ($data)
    {
        $form_id = $data['form_id'];
        $form = $this->formsRepository->findOneByMultiple(['id' => $form_id, 'created_by' => 'plugin']);
        if (! $form) abort(404);

        $fields = $this->fieldsRepository->getBy('table_name', $form->fields_type);
        $existingFields = (count($form->form_fields)) ? $form->form_fields()->pluck('field_slug', 'field_slug')->toArray() : [];

        return ['fields' => $fields, 'existingFields' => $existingFields, 'form' => $form];
    }
}