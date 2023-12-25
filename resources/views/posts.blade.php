@extends('layouts.frontend.app')

@section('title', 'post-details')

@push('css')
    <link href="{{asset('frontend/css/single-post/styles.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/single-post/responsive.css')}}" rel="stylesheet">
    <style>
        .favorite_posts{
            text-decoration: none;
            color: #498BF9;
        }
        .header_bg{
            height: 400px;
            width: 100%;
            /* background-color: red; */
            background-size: cover;
            background-position: center;
            background-image: url({{asset('frontend/images/slider-1-1600x900.jpg')}});

        }
    </style>
@endpush

@section('content')
    <div class="header_bg">
        <div class="display-table  center-text">
			<h1 class="title display-table-cell"><b>All POSTS</b></h1>
		</div>
    </div><!-- slider -->

    <section class="recomended-area section">
        <div class="container">
            <div class="row">

                @foreach ($posts as $post )

                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="Blog Image"></div>

                                <a class="avatar" href="{{ Route('author.posts',$post->user->username) }}"><img src="{{Storage::disk('public')->url('profile/'.$post->user->image)}}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{Route('post.details',$post->slug)}}"><b>{{$post->title}}</b></a></h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                                <a href="javascript:void(0)"
                                                onclick="toastr.info('To add favorite list ,you have to login first','Info',{
                                                    closeButton : true,
                                                    progresBar  : true,
                                                })">
                                                    <i class="ion-heart"></i>{{$post->favorite_to_users->count()}}
                                                </a>
                                            @else
                                            <a href="javascript:void(0)"
                                            class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$post->id)
                                            ->count() == 0 ? 'favorite_posts' : ''}}"
                                            onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();">
                                                <i class="ion-heart"></i>{{$post->favorite_to_users->count()}}
                                            </a>

                                            <form id="favorite-form-{{ $post->id }}" action="{{Route('post.favorite',$post->id)}}"
                                                method="POST" style="display: none">
                                            @csrf
                                            </form>

                                            @endguest
                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments()->count()}}</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach

            </div><!-- row -->

            {{$posts->links()}} <!-- pagination -->

        </div><!-- container -->
    </section>

@endsection

@push('js')

@endpush
