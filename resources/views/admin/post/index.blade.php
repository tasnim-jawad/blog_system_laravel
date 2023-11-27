@extends('layouts.backend.app')

@section('title', 'post')
@push('css')

@endpush
@section('theme','theme-red')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a class="btn btn-primary waves-effect" href="{{Route('admin.post.create')}}">
                    <i class="material-icons">add</i>
                    <span>Add Post</span>
                </a>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL POSTS <span class="badge bg-blue">{{$posts->count()}}</span>
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
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>Is approved</th>
                                            <th>Status</th>
                                            <th>Createed at</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>srl#</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>Is approved</th>
                                            <th>Status</th>
                                            <th>Createed at</th>
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
                                                <td>{{$post->view_count}}</td>
                                                <td>
                                                    @if($post->is_approved ==true)
                                                        <span class="badge bg-blue">Approved</span>
                                                    @else
                                                        <span class="badge bg-red">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($post->status ==true)
                                                        <span class="badge bg-green">Published</span>
                                                    @else
                                                        <span class="badge bg-red">Pending</span>
                                                    @endif
                                                </td>
                                                <td>{{$post->created_at}}</td>
                                                <td class="text-center">
                                                    @if ($post->is_approved == false)
                                                        <button type="button" class="btn btn-sm btn-warning waves-effect" onclick="approvePost({{$post->id}})">
                                                            <i class="material-icons">pending</i>
                                                        </button>
                                                        <form style="display: none" action="{{Route('admin.post.approve',$post->id)}}" method="POST" id="approval-form" >
                                                            @csrf
                                                            @method('PUT')
                                                        </form>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success waves-effect" disabled>
                                                            <i class="material-icons">done</i>
                                                        </button>
                                                    @endif
                                                    <a class="btn btn-sm btn-primary waves-effect" href="{{Route('admin.post.show' ,$post->id)}}"><i class="material-icons">visibility</i></a>
                                                    <a class="btn btn-sm btn-info waves-effect" href="{{Route('admin.post.edit' ,$post->id)}}"><i class="material-icons">edit</i></a>
                                                    <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="deletePost({{$post->id}})">
                                                        <i class="material-icons">delete</i>
                                                    </button>

                                                    <form style="display: none" id="delete-form-{{$post->id}}" action="{{Route('admin.post.destroy' ,$post->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
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
        function deletePost(id) {
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
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();

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

        function approvePost(id) {
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "Do you want to approve this post!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, approve it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault();
                document.getElementById('approval-form').submit();

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



