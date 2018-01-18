<?php

namespace BtyBugHook\Membership\Services;

use Btybug\btybug\Services\GeneralService;
use BtyBugHook\Membership\Repository\BlogRepository;

class BlogService  extends GeneralService
{
    private $blogRepositroy;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepositroy = $blogRepository;
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
}