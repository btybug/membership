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
}