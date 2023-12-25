@extends('layouts.backend.app')

@section('title','dashboard')

@push('css')
@endpush

@section('theme','theme-red')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL POSTS</div>
                            <div class="number count-to" data-from="0" data-to="{{ $posts->count() }}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL FAVORITE POSTS</div>
                            <div class="number count-to" data-from="0" data-to="{{ Auth::user()->favorite_posts()->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">pending_actions</i>
                        </div>
                        <div class="content">
                            <div class="text">PENDING POST</div>
                            <div class="number count-to" data-from="0" data-to="{{ $total_panding_posts }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL VIEWS</div>
                            <div class="number count-to" data-from="0" data-to="{{ $all_views }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix">
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <div class="info-box bg-red hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">category</i>
                                </div>
                                <div class="content">
                                    <div class="text">TOTAL CATEGORIES</div>
                                    <div class="number count-to" data-from="0" data-to="{{ $category_all_count }}" data-speed="1000" data-fresh-interval="20"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <div class="info-box bg-blue hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">tag</i>
                                </div>
                                <div class="content">
                                    <div class="text">TOTAL TAGS</div>
                                    <div class="number count-to" data-from="0" data-to="{{ $teg_all_count }}" data-speed="1000" data-fresh-interval="20"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <div class="info-box bg-green hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">account_circle</i>
                                </div>
                                <div class="content">
                                    <div class="text">TOTAL AUTHOR</div>
                                    <div class="number count-to" data-from="0" data-to="{{ $author_count }}" data-speed="1000" data-fresh-interval="20"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <div class="info-box bg-teal hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">person_add</i>
                                </div>
                                <div class="content">
                                    <div class="text">NEW AUTHOR</div>
                                    <div class="number count-to" data-from="0" data-to="{{ $new_author_today }}" data-speed="1000" data-fresh-interval="20"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="header">
                            <h2>TOP 5 POPULER POSTS</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Rank</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Author</th>
                                            <th class="text-center">Views</th>
                                            <th class="text-center">Favorite</th>
                                            <th class="text-center">Comments</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($popular_posts as $key => $post)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>{{ Str::limit($post->title, 30) }}</td>
                                                <td class="text-center">{{ $post->user->name }}</td>
                                                <td class="text-center">{{ $post->view_count }}</td>
                                                <td class="text-center">{{ $post->favorite_to_users()->count() }}</td>
                                                <td class="text-center">{{ $post->comments()->count() }}</td>
                                                <td class="text-center">
                                                    @if( $post->is_approved == 1)
                                                        <span class="label bg-green">Published</span>
                                                    @else
                                                        <span class="label bg-red">unpublished</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary waves-effect" href="{{Route('admin.post.show' ,$post->id)}}"><i class="material-icons">visibility</i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->

            </div>
        </div>
    </section>
@endsection

@push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('backend')}}/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="{{asset('backend')}}/plugins/raphael/raphael.min.js"></script>
    <script src="{{asset('backend')}}/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="{{asset('backend')}}/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{asset('backend')}}/plugins/flot-charts/jquery.flot.js"></script>
    <script src="{{asset('backend')}}/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="{{asset('backend')}}/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="{{asset('backend')}}/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="{{asset('backend')}}/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{asset('backend')}}/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="{{asset('backend')}}/js/pages/index.js"></script>
@endpush




