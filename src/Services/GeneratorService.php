<?php

namespace BtyBugHook\Membership\Services;

use Btybug\btybug\Services\GeneralService;
use BtyBugHook\Membership\Repository\PostsRepository;

class GeneratorService extends GeneralService
{
    private $result;
    private $postRepo;
    private $title;
    private $fileString;
    private $generatingFile;
    private $stubPath = 'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'Stubs';
    private $modelPath = 'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'Models'.DS.'Blogs';

    const STUB_DATA = [
        '{ClassName}' => 'className',
        '{slug}' => 'slug',
    ];

    public function __construct(PostsRepository $postsRepository)
    {
        $this->postRepo = $postsRepository;
    }


    public function generate($title)
    {
        $this->title = $title;
        $this->makeModel();
    }

    private function makeModel()
    {
        $data = [
            'className' => $this->strToModel($this->title),
            'slug' => str_slug($this->title,"_")
        ];
        $this->fileString = \File::get(plugins_path($this->stubPath . DS . 'model.stub'));
        $this->generatingFile =  plugins_path($this->modelPath . DS . $data['className'].'.php');

        $this->makeFile(self::STUB_DATA,$data);
    }

    private function strToModel($str){
        return ucfirst(camel_case($str));
    }

    private function makeFile(array $stubs,array $data){
        foreach ($stubs as $stub => $value){
            if(isset($data[$value])){
                $this->fileString = str_replace($stub,$data[$value],$this->fileString);
            }
        }

        \File::put($this->generatingFile,$this->fileString);
    }

    public function update(array $data, $file)
    {
        $updated = $this->postRepo->update($data['id'],$data);
        if ($updated) {
            if($file){
                if($updated->image && file_exists(public_path($updated->image)) && ! is_dir(public_path($updated->image))) unlink(public_path($updated->image));
                $this->upload($file, $updated->id);
            }
        }
    }

    public function upload($file, $post_id)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . "." . $extension;
        $path = 'images/posts/' . $filename;;
        $file->move('images/posts', $filename);

        $this->postRepo->update($post_id,['image' => $path]);
    }

    public function delete($id)
    {
        $plan = $this->postRepo->find($id);
        unlink(public_path($plan->icon));
        $this->postRepo->delete($id);
    }

    public static function replaceSpaceWithLine($string)
    {
        return str_replace(" ","-",$string);
    }

    public static function getPostByUrl()
    {
        $param = \Request::route()->parameters();
        if(isset($param['param'])){
            $slug = $param['param'];
            $repo = new PostsRepository();
            $post = $repo->getPublishedByUrl($slug);
            return $post;
        }

        return null;
    }

    public static function getPostById($id)
    {
        $repo = new PostsRepository();
        $post = $repo->find($id);
        return $post;
    }

    public static function getPostsByPluck()
    {
        $repo = new PostsRepository();
        $post = $repo->pluck("title","id");
        if(count($post)) return $post->toArray();

        return [];
    }
}