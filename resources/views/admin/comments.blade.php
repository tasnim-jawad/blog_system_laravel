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
                                ALL COMMENTS  <span class="badge bg-blue">{{$comments->count()}}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">srl#</th>
                                            <th class="text-center">Comment details</th>
                                            <th class="text-center">Post details</th>
                                            <th class="text-center">action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">srl#</th>
                                            <th class="text-center">Comment details</th>
                                            <th class="text-center">Post details</th>
                                            <th class="text-center">action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($comments as $key => $comment)
                                            <tr>
                                                <td>{{$key+=1}}</td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <img src="{{Storage::disk('public')->url('profile/'.$comment->user->image)}}"
                                                            alt="user image" width="64" height="64">
                                                        </div>
                                                        <div class="media-body">
                                                            <h4>{{$comment->user->name}}
                                                                <small>{{$comment->created_at->diffForHumans()}}</small>
                                                            </h4>
                                                            <p>{{$comment->comment}}</p>
                                                            <a href="{{Route('post.details',$comment->post->slug.'#comments')}}">Reply</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <img src="{{Storage::disk('public')->url('post/'.$comment->post->image)}}"
                                                            alt="user image" width="64" height="64">
                                                        </div>
                                                        <div class="media-body">
                                                            <a target="_blank" href="{{Route('post.details',$comment->post->slug)}}">
                                                                <h4 class="media-heading">
                                                                    {{Str::limit($comment->post->title, 40, ' ...')}}
                                                                </h4>
                                                            </a>
                                                            <p><strong>{{$comment->post->user->name}}</strong></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="deleteComment({{$comment->id}})">
                                                        <i class="material-icons">delete</i>
                                                    </button>

                                                    <form style="display: none" id="delete-form-{{$comment->id}}" action="{{Route('admin.comments.destroy' ,$comment->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
        function deleteComment(id) {
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


    </script>

@endpush



