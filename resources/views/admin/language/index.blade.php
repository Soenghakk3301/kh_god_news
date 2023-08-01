@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Language</h1>
        </div>
        <div class="row">
            <div class="card card-primary col-12">
                <div class="card-header">
                    <h4>{{ __('All Language') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.language.create') }}" class="btn btn-primary">
                            {{ __('Create New') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>{{ __('Language Name') }}</th>
                                    <th>{{ __('Language Code') }}</th>
                                    <th>{{ __('Default') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($languages as $language)
                                    <tr>
                                        <td>
                                            {{ $language->id }}
                                        </td>
                                        <td>{{ $language->name }}</td>
                                        <td>{{ $language->lang }}</td>

                                        @if ($language->default == 1)
                                            <td><span class="badge badge-primary">{{ __('Default') }}</span></td>
                                        @else
                                            <td><span class="badge badge-warning">{{ __('Default') }}</span></td>
                                        @endif

                                        @if ($language->status == 1)
                                            <td><span class="badge badge-success">{{ __('Active') }}</span></td>
                                        @else
                                            <td><span class="badge badge-danger">{{ __('Inactive') }}</span></td>
                                        @endif

                                        <td>
                                            <a href="{{ route('admin.language.edit', $language->id) }}"
                                                class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.language.destroy', $language->id) }}"
                                                class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });

        // handle dynamic delete
        $(document).ready(function() {
            $('.delete-item').on('click', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        let url = $(this).attr('href')

                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            success: function(data) {
                                if (data.status === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Deleted Successfully.',
                                        'success'
                                    )
                                    window.location.reload()
                                } else if (data.status === 'error') {
                                    Swal.fire(
                                        'Erorr!',
                                        'Can Not Delete This One.',
                                        'error'
                                    )
                                }
                            },
                            errr: function(xhr, status, error) {
                                console.error(error)
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush
