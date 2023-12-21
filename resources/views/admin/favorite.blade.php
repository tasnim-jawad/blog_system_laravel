@extends('layouts.backend.app')

@section('title', 'post')
@push('css')

@endpush
@section('theme','theme-red')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL FAVORITE POSTS <span class="badge bg-blue">{{$posts->count()}}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>srl#</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th><i class="material-icons">favorite</i></th>
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>srl#</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th><i class="material-icons">favorite</i></th>
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if (!empty($posts) && count($posts) > 0)
                                            @foreach ($posts as $key=>$post)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{\Illuminate\Support\Str::limit(ucwords($post->title), 15, $end='...') }}</td>
                                                <td>{{$post->user->name}}</td>
                                                <td>{{$post->favorite_to_users->count()}}</td>
                                                <td>{{$post->view_count}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary waves-effect" href="{{Route('admin.post.show' ,$post->id)}}"><i class="material-icons">visibility</i></a>

                                                    <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="removePost({{$post->id}})">
                                                        <i class="material-icons">delete</i>
                                                    </button>

                                                    <form style="display: none" id="remove-form-{{$post->id}}" action="{{Route('post.favorite' ,$post->id)}}" method="POST">
                                                        @csrf
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
@endsection

@push('js')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('backend')}}/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="{{asset('backend')}}/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    {{-- sweetalert2 plugin js  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Js -->
    <script src="{{asset('backend')}}/js/pages/tables/jquery-datatable.js"></script>

    <script type="text/javascript">
        function removePost(id) {
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, remove it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault();
                document.getElementById('remove-form-'+id).submit();

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your imaginary file is safe :)",
                icon: "error"
                });
            }
            });
        }


    </script>

@endpush



