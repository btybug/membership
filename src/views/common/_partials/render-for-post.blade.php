<?php

if(isset($settings_for_ajax)){
   $settings = $settings_for_ajax;
}

$col_md_x = "col-md-4";
if (isset($settings["custom_list"]) && !isset($settings["custom_grid"])){
    $col_md_x = "col-md-12";
}
?>

<div class="bty-all-blog">
    <input type="hidden" class="custom_get_bootstrap_col" value="{{$col_md_x}}">
    <div class="container">
        <div class="row">
            @if(count($posts))
                <ul class="custom_append_post_to_ul">
                    @foreach($posts as $post)
                        <li class="{{$col_md_x}} custom_class_for_change_col">
                            <figure class="bty-recent-post-3">
                                @if(!isset($post->image))
                                    <img src="{!! url($post->image) !!}" class="img-responsive">
                                @else
                                    <img src="http://avante.biz/wp-content/uploads/Nice-Wallpapers/Nice-Wallpapers-006.jpg"
                                         alt="">
                                @endif
                                <div>
                                    <span>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$post->created_at)->format('d')}}</span>
                                    <span>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$post->created_at)->format('M')}}</span>
                                </div>
                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                <figcaption>
                                    @php
                                        if(isset($settings["custom_section1_for_post"])){
                                            $title = $settings["custom_section1_for_post"];
                                        }else{
                                            $title = 'title';
                                        }
                                    if(isset($settings["custom_section2_for_post"])){
                                            $description = $settings["custom_section2_for_post"];
                                        }else{
                                            $description = 'description';
                                        }
                                    @endphp
                                    <h3>{!! $post->$title !!}</h3>
                                    <p>
                                        {!! $post->$description !!}
                                    </p>
                                    <button>Read More</button>
                                </figcaption>
                                <a href="{{ get_post_url($post->id) }}"></a>
                            </figure>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="clearfix"></div>
                @if(!isset($dont_render_pagination))
                    @if(isset($settings["custom_pagination"]))
                        @if($settings["custom_pagination"] === "php")
                            <?php
                                $limit_page = 10;
                                if(isset($settings["custom_limit_per_page"])){
                                    $limit_page = $settings["custom_limit_per_page"];
                                }
                            ?>
                            <div class="custom_pagination">
                                @if(count($posts) >= $limit_page)
                                    {!! $posts->links() !!}
                                @endif
                            </div>
                        @elseif($settings["custom_pagination"] === "scroll")
                            <div class="ajax-load text-center" style="display:none">
                                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                            </div>
                            <input type="hidden" id="custom_limit_per_page_for_ajax" value="{{isset($settings["custom_limit_per_page"]) ? $settings["custom_limit_per_page"] : "" }}">
                        @else
                            <div class="text-center blog-load-more">
                            <button class="custom_load_more">Load More</button>
                            </div>
                            <div class="ajax-load-button text-center" style="display:none">
                                <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                            </div>
                            <input type="hidden" id="custom_limit_per_page_for_ajax" value="{{isset($settings["custom_limit_per_page"]) ? $settings["custom_limit_per_page"] : "" }}">
                        @endif
                    @endif
                @endif
        </div>
    </div>
</div>

