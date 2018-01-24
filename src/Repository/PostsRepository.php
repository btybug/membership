<?php
namespace BtyBugHook\Membership\Repository;

use Btybug\btybug\Models\Universal\Paginator;
use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Membership\Models\Post;
use BtyBugHook\Membership\Services\BlogService;

class PostsRepository extends GeneralRepository
{
    private $table;
    private $slug;
    private $blog;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->slug = \Request::route('slug');
        $this->blog = $blogRepository;
        $this->table = str_replace('-','_',$this->slug);
        parent::__construct();
    }
    /**
     * @return mixed
     */
    public function getGroupedWithAuthor($id)
    {
        return $this->model->where('author_id', $id)->get();
    }

    public function getPublished()
    {
        return $this->model->where('status', 'published')->orWhere('status',1)->get();
    }

    public function paginationSettings($settings){
        $pagination_type = isset($settings["custom_pagination"]) ? $settings["custom_pagination"] : null;
        $limit_per_page = $settings["custom_limit_per_page"] ? $settings["custom_limit_per_page"] : 10;

        $posts = $this->getPublished();

        if ($pagination_type){
            $posts = new Paginator($limit_per_page,6,'bty-pagination-2',$posts);
        }
        return $posts;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getPublishedByUrl($slug)
    {
        return $this->model->where('status', 'published')->where('slug',$slug)->first();
    }

    public function renderSearch($term,$search_by = null){
        $result = $this->model;
        if(count($search_by)){
            foreach ($search_by as $key => $column){
                if($key === 0){
                    $result = $result->where($column,'like','%'.$term.'%');
                }else{
                    $result = $result->orWhere($column,'like','%'.$term.'%');
                }
            }
        }else{
            $result = $result->where('title','like','%'.$term.'%');
        }
        return $result;
    }

    public function renderSort($all_posts,$sort_by='id',$sort_how='ASC'){

        $result = $all_posts->orderBy($sort_by,$sort_how);

        return $result;
    }

    public function model()
    {
        if(!$this->checkStatus()) return false;

        return \DB::table($this->table);
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function findOrFail(int $id, array $columns = ['*'], array $with = [])
    {
        $result = $this->model->select($columns)->where('id',$id)->first();
        abort_unless($result,401);
        return $this->model->select($columns)->where('id',$id)->first();
    }

    public function checkStatus(){
        return BlogService::checkStatus($this->slug);
    }

    public function getBlogModel(){
        return $this->blog->findBy('slug',$this->slug);
    }
}