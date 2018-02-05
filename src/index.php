<?php
addProvider('BtyBugHook\Membership\Providers\ModuleServiceProvider');

function get_options_data (string $name, $slug)
{
    $options = [];
    $adminsettingRepository = new \Btybug\btybug\Repositories\AdminsettingRepository();
    $settings = $adminsettingRepository->getSettings('product', $slug);
    if ($settings) {
        $data = (json_decode($settings->val, true));
        if (isset($data[$name]) && isset($data[$name]['options'])) {
            $options = $data[$name]['options'];
        }
    }

    return $options;
}

if (! function_exists('get_field_attr')) {
    function get_field_attr ($id, $attr = null)
    {
        $fieldRepository = new \Btybug\Console\Repository\FieldsRepository();

        $field = $fieldRepository->find($id);
        if ($field && ! $attr) {
            return $field;
        } elseif ($field && $attr && isset($field->$attr)) {
            return $field->$attr;
        }

        return null;
    }
}

if (! function_exists('get_active_form')) {
    function get_active_form ($form_type = "posts_create_form")
    {
        $adminsettingRepository = new \Btybug\btybug\Repositories\AdminsettingRepository();
        $settings = $adminsettingRepository->findOneByMultipleSettingsArray(['section' => 'btybug_blog', 'settingkey' => 'blog_settings']);

        return (isset($settings[$form_type])) ? ['slug' => $settings[$form_type]] : null;
    }
}

if (! function_exists('get_post_url')) {
    function get_post_url (int $post_id)
    {
        $postRepository = new \BtyBugHook\Blog\Repository\PostsRepository();
        $post = $postRepository->find($post_id);

        if ($post) {
            $pagesRepository = new \Btybug\Console\Repository\FrontPagesRepository();
            $all = $pagesRepository->findBy('slug', 'all-posts');
            $url_manager = posts_url_manager();
            if ($url_manager && isset($post->$url_manager)) {
                return new \Illuminate\Support\HtmlString($all->url . "/" . $post->$url_manager);
            } else {
                return new \Illuminate\Support\HtmlString($all->url . "/" . $post_id);
            }
        }

        return new \Illuminate\Support\HtmlString('javascript::void(0)');
    }
}

if (! function_exists('posts_url_manager')) {
    function posts_url_manager ()
    {
        $settingsRepository = new \Btybug\btybug\Repositories\AdminsettingRepository();
        if (get_blog_slug_in_page())
            $settings = $settingsRepository->findOneByMultipleSettingsArray(['section' => 'btybug_blog', 'settingkey' => get_blog_slug_in_page() . '_settings']);

        if (isset($settings['url_manager'])) {
            return $settings['url_manager'];
        }

        return 'id';
    }
}

if (! function_exists('find_post_by_url')) {
    function find_post_by_url ()
    {
        $slug = posts_url_manager();
        if ($slug) {
            $param = \Request::route()->parameters();
            if (isset($param['param'])) {
                $param = $param['param'];
                $postRepository = new \BtyBugHook\Blog\Repository\PostsRepository();

                return $postRepository->findBy($slug, $param);
            }
        }

        return null;
    }
}

function get_all_blog_posts ()
{
    $data = [];
    $page = \Btybug\btybug\Services\RenderService::getFrontPageByURL();
    if ($page) {
        $slug = str_replace_first('all_', '', $page->slug);
        $data = DB::table(str_replace('-', '_', $slug))->where('status', 'published')->orWhere('status', 1)->get();
    }

    return $data;
}

function get_blog_slug_in_page ()
{
    $page = \Btybug\btybug\Services\RenderService::getFrontPageByURL();
    $slug = emptyString();
    if ($page) {
        $slug = str_replace_first('all_', '', $page->slug);

        if ($page->parent_id) {
            $slug = str_replace_first('single_', '', $page->slug);
        }
    }

    return $slug;
}