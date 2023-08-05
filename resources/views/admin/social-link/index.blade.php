@extends('admin.layouts.master')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>{{ __('Social Links') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Social Links') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.social-link.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create new') }}
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>{{ __('Icon') }}</th>
                            <th>{{ __('Url') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socialLinks as $socialLink)
                            <tr>
                                <td>{{ $socialLink->id }}</td>

                                <td>
                                    <i style="font-size: 20px;" class="{{ $socialLink->icon }}"></i>
                                </td>

                                <td>{{ $socialLink->url }}</i></td>

                                <td>
                                    @if ($socialLink->status == 1)
                                        <span class="badge badge-success">{{ __('Yes') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('No') }}</span>
                                    @endif

                                </td>

                                <td>
                                    <a href="{{ route('admin.social-link.edit', $socialLink->id) }}"
                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.social-link.destroy', $socialLink->id) }}"
                                        class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $("#table-sub").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [1]
            }]
        });


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
