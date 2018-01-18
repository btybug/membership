<?php

namespace BtyBugHook\Membership\Services;

use Btybug\btybug\Models\Painter\Painter;
use Btybug\btybug\Services\GeneralService;
use Btybug\Console\Repository\FrontPagesRepository;
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
    private $stubPath = 'vendor' . DS . 'sahak.avatar' . DS . 'membership' . DS . 'src' . DS . 'Stubs';
    private $modelPath = 'vendor' . DS . 'sahak.avatar' . DS . 'membership' . DS . 'src' . DS . 'Models' . DS . 'Blogs';
    private $all_unit_slug = 'membership_plans';
    private $single_unit_slug = 'unit_for_post_from_membership';

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
        $this->slug = str_slug($this->title, "_");
        $this->makeTable();
        $this->makeVariations();
        $this->makePages();
    }

    private function makeTable()
    {
        CreatePostsTable::up($this->slug);
    }

    private function makePages()
    {
        $this->registerFrontPages();
    }

    private function registerFrontPages()
    {

        $frontPageRepo = new FrontPagesRepository();
        \DB::transaction(function () use ($frontPageRepo) {
            $all_page = $frontPageRepo->create([
                'title' => "All " . $this->title,
                'slug' => "all_" . $this->slug,
                'url' => '/' . $this->slug,
                'module_id' => 'sahak.avatar/membership',
                'header' => true,
                'type' => 'plugin',
                'status' => 'published',
                'content_type' => 'template',
                'template' => $this->all_unit_slug . '.' . $this->slug
            ]);

            $frontPageRepo->create([
                'title' => "Single " . $this->title,
                'slug' => "single_" . $this->slug,
                'url' => '/' . $this->slug . '/{param}',
                'module_id' => 'sahak.avatar/membership',
                'parent_id' => $all_page->id,
                'header' => true,
                'type' => 'plugin',
                'status' => 'published',
                'content_type' => 'template',
                'template' => $this->single_unit_slug . '.' . $this->slug
            ]);
        });
    }

    private function makeVariations()
    {
        $all_unit = Painter::find($this->all_unit_slug);
        $single_unit = Painter::find($this->single_unit_slug);
        if ($all_unit && $single_unit) {
            $all_unit->variations()->createVariation([], $this->slug, true);
            $single_unit->variations()->createVariation([], $this->slug, true);
        }
    }

    private function makeModel()
    {
        $data = [
            'className' => $this->strToModel($this->title),
            'slug' => str_slug($this->title, "_")
        ];
        $this->fileString = \File::get(plugins_path($this->stubPath . DS . 'model.stub'));
        $this->generatingFile = plugins_path($this->modelPath . DS . $data['className'] . '.php');

        $this->makeFile(self::STUB_DATA, $data);
    }

    private function strToModel($str)
    {
        return ucfirst(camel_case($str));
    }

    private function makeFile(array $stubs, array $data)
    {
        foreach ($stubs as $stub => $value) {
            if (isset($data[$value])) {
                $this->fileString = str_replace($stub, $data[$value], $this->fileString);
            }
        }

        \File::put($this->generatingFile, $this->fileString);
    }
}