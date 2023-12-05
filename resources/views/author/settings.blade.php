@extends('layouts.backend.app')

@section('title','dashboard')

@push('css')
@endpush

@section('theme','theme-red')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            PROFILE UPDATE
                        </h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#profile_with_icon_title" data-toggle="tab">
                                    <i class="material-icons">face</i> PROFILE UPDATE
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#password_with_icon_title" data-toggle="tab">
                                    <i class="material-icons">password</i> PASSWORD
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                                <div class="body">
                                    <form action="{{Route('author.update.profile')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        @method('PUT')
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="name">Name</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" value="{{Auth::user()->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email">Email</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" value="{{Auth::user()->email}}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email">Image</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="file" class="form-control" id="image" name="image" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email">About</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea name="about" id="about" class="form-control" cols="30" rows="3">{{Auth::user()->about}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title">
                                <div class="body">
                                    <form action="{{Route('author.update.password')}}" method="POST" class="form-horizontal">
                                        @csrf
                                        @method('PUT')
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="old_password">Old Password</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter your old password" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="password">New Password</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your new password" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="password_confirmation">Confirm Password</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm new password" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Password Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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




