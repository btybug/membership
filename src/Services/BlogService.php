<?php

namespace BtyBugHook\Membership\Services;

use Btybug\btybug\Services\GeneralService;
use Btybug\Console\Repository\FieldsRepository;
use Btybug\Console\Repository\FormsRepository;
use BtyBugHook\Membership\Repository\BlogRepository;

class BlogService  extends GeneralService
{
    private $blogRepositroy;
    private $fieldsRepository;
    private $formsRepository;

    public function __construct(
        BlogRepository $blogRepository,
        FieldsRepository $fieldsRepository,
        FormsRepository $formsRepository
    )
    {
        $this->blogRepositroy = $blogRepository;
        $this->fieldsRepository = $fieldsRepository;
        $this->formsRepository = $formsRepository;
    }

    public static function checkStatus($slug)
    {
        $blogRepositroy = new BlogRepository();

        if($slug){
            $blog = $blogRepositroy->findBy('slug',$slug);
            if($blog && $blog->status){
                return true;
            }
        }

        return false;
    }

    public static function getActive()
    {
        $blogs_array = [];
        $blogRepositroy = new BlogRepository();
        $blogs = $blogRepositroy->getActive();
        if(count($blogs)){
            foreach ($blogs as $blog){
                $blogs_array[] =  [
                    "title" => $blog->title,
                    "custom-link" => "/admin/membership/$blog->slug",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ];
            }

            \Eventy::action('admin.menus', [
                "title" => "Products",
                "custom-link" => "#",
                "icon" => "fa-product-hunt",
                "is_core" => "yes",
                "children" => $blogs_array
            ]);
        }
    }

    public function getDataByType($type,$form_id){
        return $this->$type($form_id);
    }

    private function units($form_id){
        return [];
    }

    private function fields($form_id){
        $form = $this->formsRepository->findOneByMultiple(['id' => $form_id, 'created_by' => 'plugin']);
        if (! $form)  abort(404);

        $fields = $this->fieldsRepository->getBy('table_name', $form->fields_type);
        $existingFields = (count($form->form_fields)) ? $form->form_fields()->pluck('field_slug', 'field_slug')->toArray() : [];

        return ['fields' => $fields, 'existingFields' => $existingFields];
    }
}