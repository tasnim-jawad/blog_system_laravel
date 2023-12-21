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
            background-image: url({{Storage::disk('public')->url('post/'.$post->image)}});

        }
    </style>
@endpush

@section('content')
    <div class="header_bg">
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{Storage::disk('public')->url('profile/'.$post->user->image)}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                                    <h6 class="date">{{$post->created_at->diffForHumans()}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

                            <div class="para">
                                {!! html_entity_decode($post->body)!!}
                            </div>

                            <ul class="tags">
                                @foreach ($post->categories as $category)
                                    <li><a href="#">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
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
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>



                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                            <p>{{$post->user->about}}</p>
                        </div>

                        <div class="tag-area">

                            <h4 class="title"><b>TAG CLOUD</b></h4>
                            <ul>
                                @foreach ($post->tags as $tag)
                                    <li><a href="#">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">

                @foreach ($rendomPosts as $rendomPost )

                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$rendomPost->image)}}" alt="Blog Image"></div>

                                <a class="avatar" href="#"><img src="{{Storage::disk('public')->url('profile/'.$rendomPost->user->image)}}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{Route('post.details',$rendomPost->slug)}}"><b>{{$rendomPost->title}}</b></a></h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                                <a href="javascript:void(0)"
                                                onclick="toastr.info('To add favorite list ,you have to login first','Info',{
                                                    closeButton : true,
                                                    progresBar  : true,
                                                })">
                                                    <i class="ion-heart"></i>{{$rendomPost->favorite_to_users->count()}}
                                                </a>
                                            @else
                                            <a href="javascript:void(0)"
                                            class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$rendomPost->id)
                                            ->count() == 0 ? 'favorite_posts' : ''}}"
                                            onclick="document.getElementById('favorite-form-{{ $rendomPost->id }}').submit();">
                                                <i class="ion-heart"></i>{{$rendomPost->favorite_to_users->count()}}
                                            </a>

                                            <form id="favorite-form-{{ $rendomPost->id }}" action="{{Route('post.favorite',$rendomPost->id)}}"
                                                method="POST" style="display: none">
                                            @csrf
                                            </form>

                                            @endguest
                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach

            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        <form method="post">
                            <div class="row">

                                <div class="col-sm-6">
                                    <input type="text" aria-required="true" name="contact-form-name" class="form-control"
                                        placeholder="Enter your name" aria-invalid="true" required >
                                </div><!-- col-sm-6 -->
                                <div class="col-sm-6">
                                    <input type="email" aria-required="true" name="contact-form-email" class="form-control"
                                        placeholder="Enter your email" aria-invalid="true" required>
                                </div><!-- col-sm-6 -->

                                <div class="col-sm-12">
                                    <textarea name="contact-form-message" rows="2" class="text-area-messge form-control"
                                        placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->

                            </div><!-- row -->
                        </form>
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS(12)</b></h4>

                    <div class="commnets-area">

                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>Katy Liu</b></a>
                                    <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                                </div>

                                <div class="right-area">
                                    <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                </div>

                            </div><!-- post-info -->

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                                Ut enim ad minim veniam</p>

                        </div>

                        <div class="comment">
                            <h5 class="reply-for">Reply for <a href="#"><b>Katy Lui</b></a></h5>

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>Katy Liu</b></a>
                                    <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                                </div>

                                <div class="right-area">
                                    <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                </div>

                            </div><!-- post-info -->

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                                Ut enim ad minim veniam</p>

                        </div>

                    </div><!-- commnets-area -->

                    <div class="commnets-area ">

                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>Katy Liu</b></a>
                                    <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                                </div>

                                <div class="right-area">
                                    <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                </div>

                            </div><!-- post-info -->

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                                Ut enim ad minim veniam</p>

                        </div>

                    </div><!-- commnets-area -->

                    <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection

@push('js')

@endpush
