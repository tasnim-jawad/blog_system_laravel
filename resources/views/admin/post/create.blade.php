@extends('layouts.backend.app')

@section('title', 'create post')
@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{asset('backend')}}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush
@section('theme','theme-red')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>FORM EXAMPLES</h2>
        </div>

        <form action="{{Route('admin.post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW POST
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" name="title" class="form-control">
                                    <label for="title" class="form-label">Post title</label>
                                </div>
                                {{-- individual error message --}}
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-control">
                                    <label for="image" class="form-label">Upload Image</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                                {{-- individual error message --}}
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="checkbox" id="Publish" name="status" class="filled-in" >
                                <label for="Publish">Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CATEGORIES AND TAGS
                            </h2>
                        </div>
                        <div class="body">
                                <div class="form-group form-float">
                                    <div class="form-line {{$errors->has('categories') ? 'focused error' : '' }}">
                                        <label for="category">select category</label>
                                        <select name="categories[]" id="category" class="form-control show-tick"
                                        data-live-search="true" multiple>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="name" class="form-label">Category</label> --}}
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line {{$errors->has('tags') ? 'focused error' : '' }}">
                                        <label for="tag">select tag</label>
                                        <select name="tags[]" id="tag" class="form-control show-tick"
                                        data-live-search="true" multiple>
                                            @foreach ($tags as $tag)
                                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <label for="name" class="form-label">Category</label> --}}
                                    </div>
                                </div>
                                <br>
                                <a href="{{Route('admin.post.index')}}" class="btn btn-danger waves-effect m-t-15">BACK</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Write post body
                            </h2>
                        </div>
                        <div class="body">
                            <textarea name="body" id="tinymce"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
        </form>
    </div>
</section>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{asset('backend')}}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- TinyMCE -->
    <script src="{{asset('backend')}}/plugins/tinymce/tinymce.js"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('backend')}}/plugins/tinymce';
        });
    </script>
@endpush








