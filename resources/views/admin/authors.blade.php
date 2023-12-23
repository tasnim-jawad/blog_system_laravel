@extends('layouts.backend.app')

@section('title', 'Authors')
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
                                ALL AUTHORS <span class="badge bg-blue">{{$authors->count()}}</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>srl#</th>
                                            <th>Name</th>
                                            <th>Post count</th>
                                            <th>Comment count</th>
                                            <th>Createed at</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>srl#</th>
                                            <th>Name</th>
                                            <th>Post count</th>
                                            <th>Comment count</th>
                                            <th>Created at</th>
                                            <th>action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @if (!empty($authors) && count($authors) > 0)
                                            @foreach ($authors as $key=>$author)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{ucwords($author->name) }}</td>
                                                <td>{{$author->posts_count}}</td>
                                                <td>{{$author->comments_count}}</td>
                                                <td>{{$author->created_at->toDateString()}}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-danger waves-effect" type="button" onclick="deleteAuthor({{$author->id}})">
                                                        <i class="material-icons">delete</i>
                                                    </button>

                                                    <form class="d-none" id="delete-form-{{$author->id}}" action="{{Route('admin.authors.destroy' ,$author->id)}}" method="POST">
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
        function deleteAuthor(id) {
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



