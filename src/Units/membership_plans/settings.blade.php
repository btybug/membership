<?php
$postRepo = new \BtyBugHook\Blog\Repository\PostsRepository();
$post = $postRepo->first()->toArray();
?>
<div class="row">
    <div class="col-xs-12 ">
        <div class="bty-panel-collapse">
            <div>
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#general"
                   aria-expanded="true">
                    <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                    <span class="title">General</span>
                </a>
            </div>
            <div id="general" class="collapse in" aria-expanded="true" style="">
                <div class="content bty-settings-panel">
                    <div class="general-head">
                        <div>
                            <h5>Show search input:</h5>
                            <input name="custom_search" type="checkbox" class="show_search_input bty-input-checkbox-5"
                                   id="bty-checkbox-search-set">
                            <label for="bty-checkbox-search-set"></label>
                        </div>
                        <div class="grid-list">
                            <div>
                                <input name="grid_system" value="grid" type="radio" class="bty-input-radio-1" id="bty-sort-grid" {{(isset($settings["grid_system"]) && $settings["grid_system"] === "grid")?"checked":""}} {{ !isset($settings["grid_system"])?"checked":"" }}>
                                <label for="bty-sort-grid">GRID</label>
                            </div>
                            <div>
                                <input name="grid_system" value="list" type="radio" class="bty-input-radio-1" id="bty-sort-list" {{(isset($settings["grid_system"]) && $settings["grid_system"] === "list")?"checked":""}}>
                                <label for="bty-sort-list">LIST</label>
                            </div>
                        </div>
                    </div>
                    <div class="custom_search_div_for_append {{!isset($settings["custom_search"])?"custom_hidden_for_search_div":""}}">
                        <h6>Search by:</h6>
                        <div class="select-search">
                            <select name="custom_search_by[]" class="form-control" id="custom_search_by"
                                    multiple="multiple">
                                <option value="id" selected>ID</option>
                                @foreach($post as $key => $val)
                                    @if($key === 'id')
                                        @continue
                                    @endif
                                    @if(isset($settings["custom_search_by"]) && count($settings["custom_search_by"]) && in_array($key,$settings["custom_search_by"]))
                                        <option value="{{$key}}" selected>{{$key}}</option>
                                    @else
                                        <option value="{{$key}}">{{$key}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bty-panel-collapse">
            <div>
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#sorting"
                   aria-expanded="true">
                    <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                    <span class="title">Sort system</span>
                </a>
            </div>
            <div id="sorting" class="collapse in" aria-expanded="true" style="">
                <div class="content bty-settings-panel bty-sort-by">
                    <div>
                        <h5>Show sort system:</h5>
                        <input name="custom_sort" type="checkbox" class="show_sort_system bty-input-checkbox-5"
                               id="bty-checkbox-search-sort">
                        <label for="bty-checkbox-search-sort"></label>
                    </div>

                    <div class="custom_sort_div_for_append {{ !isset($settings["custom_sort"]) ? "custom_hidden_for_sort_div" : "" }}">
                        @if(isset($settings["custom_sort_by"]))
                            <h6>Sort by
                                <i class="fa fa-plus custom_add_sort_rule"></i>
                            </h6>
                            <div class="custom_sort_append_for_rules">
                                <div class="sort-select-ad custom_margin_10">
                                    <div class="bty-input-select-1 custom_class_for_copy">
                                        <select name="custom_sort_by[]" id="">
                                            <option value="id">ID</option>
                                            @foreach($post as $key => $val)
                                                @if($key === 'id')
                                                    @continue
                                                @endif
                                                <option value="{{$key}}">{{$key}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <input name="custom_sort_how" type="radio" class="bty-input-radio-1"
                                               id="bty-sort-asc"
                                               value="ASC" {{(isset($settings["custom_sort_how"]) && $settings["custom_sort_how"] == 'ASC')?"selected":""}}>
                                        <label for="bty-sort-asc">ASC:</label>

                                        <input name="custom_sort_how" type="radio" class="bty-input-radio-1"
                                               id="bty-sort-desc"
                                               value="DESC" {{(isset($settings["custom_sort_how"]) && $settings["custom_sort_how"] == 'DESC')?"selected":""}}>
                                        <label for="bty-sort-desc">DESC:</label>
                                    </div>
                                    <div class="sort-by-text">
                                        <input type="text" placeholder="Your text">
                                    </div>
                                </div>
                                @if(count($settings["custom_sort_by"]) > 1)
                                    @foreach($settings["custom_sort_by"] as $keyy => $sort_by)
                                        @if($sort_by === 'id')
                                            @continue
                                        @endif
                                        <div class="sort-select-ad custom_margin_10">
                                            <div class="bty-input-select-1">
                                                <select name="custom_sort_by[{{$sort_by}}]" id="">
                                                    @foreach($post as $key => $val)
                                                        @if($key === 'id' || $keyy === 'id')
                                                            @continue
                                                        @endif
                                                        @if($sort_by === $key)
                                                            <option value="{{$key}}" selected>{{$key}}</option>
                                                        @else
                                                            <option value="{{$key}}">{{$key}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="bty-panel-collapse">
            <div>
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pagination"
                   aria-expanded="true">
                    <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                    <span class="title">Pagination system</span>
                </a>
            </div>
            <div id="pagination" class="collapse in" aria-expanded="true" style="">
                <div class="content bty-settings-panel">
                    <div class="pagin-number">
                        <div>
                            <h5>Pagination:</h5>
                            <div class="bty-input-select-1">
                                <select name="custom_pagination">
                                    <option value="php" {{ (isset($settings['custom_pagination']) && $settings["custom_pagination"] == "php") ? "selected" : "" }}>PHP pagiantion</option>
                                    <option value="load" {{ (isset($settings['custom_pagination']) && $settings["custom_pagination"] == "load") ? "selected" : "" }}>Load more button</option>
                                    <option value="scroll" {{ (isset($settings['custom_pagination']) && $settings["custom_pagination"] == "scroll") ? "selected" : "" }}>Scrolling</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <h5>Limit page:</h5>
                                <input class="bty-setting-numner" name="custom_limit_per_page" min="5" type="number" placeholder="count" value="{{ isset($settings["custom_limit_per_page"]) ? $settings["custom_limit_per_page"] : 10 }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bty-panel-collapse">
            <div>
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#data-mapping" aria-expanded="true">
                    <span class="icon"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                    <span class="title">Data mapping</span>
                </a>
            </div>
            <div id="data-mapping" class="collapse in" aria-expanded="true" style="">
                <div class="content bty-settings-panel">
                    <div class="data-mapping">
                        <div>
                            <h6>Section 1:</h6>
                            <div class="bty-input-select-1">
                                <select name="custom_sort_by[]" id="">
                                    <option value="id">ID</option>
                                    @foreach($post as $key => $val)
                                        @if($key === 'id')
                                            @continue
                                        @endif
                                        <option value="{{$key}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <h6>Section 2:</h6>
                            <div class="bty-input-select-1">
                                <select name="custom_sort_by[]" id="">
                                    <option value="id">ID</option>
                                    @foreach($post as $key => $val)
                                        @if($key === 'id')
                                            @continue
                                        @endif
                                        <option value="{{$key}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <h6>Section 3:</h6>
                            <div class="bty-input-select-1">
                                <select name="custom_sort_by[]" id="">
                                    <option value="id">ID</option>
                                    @foreach($post as $key => $val)
                                        @if($key === 'id')
                                            @continue
                                        @endif
                                        <option value="{{$key}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <h6>Section 4:</h6>
                            <div class="bty-input-select-1">
                                <select name="custom_sort_by[]" id="">
                                    <option value="id">ID</option>
                                    @foreach($post as $key => $val)
                                        @if($key === 'id')
                                            @continue
                                        @endif
                                        <option value="{{$key}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
{!!  BBstyle($_this->path.'/css/settings.css') !!}
{!!  BBstyle($_this->path.'/css/custom.css') !!}

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

{!!  BBscript($_this->path.'/js/custom.js') !!}
