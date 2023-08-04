@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Social Count</h1>
        </div>
        <div class="row">
            <div class="card card-primary col-12">
                <div class="card-header">
                    <h4>{{ __('All Social Links') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.social-count.create') }}" class="btn btn-primary">
                            {{ __('Create New') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Social Count') }}</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">

                                        @foreach ($languages as $lang)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}" id="home-tab2"
                                                    data-toggle="tab" href="#home-{{ $lang->lang }}" role="tab"
                                                    aria-controls="home" aria-selected="true">{{ $lang->name }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="tab-content tab-bordered" id="myTab3Content">
                                        @foreach ($languages as $lang)
                                            @php
                                                $socialCounts = \App\Models\SocialCount::where('language', $lang->lang)
                                                    ->orderByDesc('id')
                                                    ->get();
                                            @endphp

                                            <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}"
                                                id="home-{{ $lang->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                                                <table class="table table-striped" id="table-{{ $lang->lang }}">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                #
                                                            </th>
                                                            <th>{{ __('Icon') }}</th>
                                                            <th>{{ __('Link') }}</th>
                                                            <th>{{ __('Status') }}</th>
                                                            <th>{{ __('Language') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($socialCounts as $socialCount)
                                                            <tr>
                                                                <td>{{ $socialCount->id }}</td>
                                                                <td><i style="font-size: 20px;"
                                                                        class="{{ $socialCount->icon }}"></i>
                                                                </td>
                                                                <td>{{ $socialCount->url }}</i></td>

                                                                <td>
                                                                    @if ($socialCount->status == 1)
                                                                        <span
                                                                            class="badge badge-success">{{ __('admin.Yes') }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-danger">{{ __('admin.No') }}</span>
                                                                    @endif

                                                                </td>

                                                                <td>{{ $socialCount->language }}</td>

                                                                <td>
                                                                    <a href="{{ route('admin.social-count.edit', $socialCount->id) }}"
                                                                        class="btn btn-primary"><i
                                                                            class="fas fa-edit"></i></a>
                                                                    <a href="{{ route('admin.social-count.destroy', $socialCount->id) }}"
                                                                        class="btn btn-danger delete-item"><i
                                                                            class="fas fa-trash-alt"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        @foreach ($languages as $lang)
            $("#table-{{ $lang->lang }}").dataTable({
                "columnDefs": [{
                    "sortable": false,
                    "targets": [2, 3]
                }]
            });
        @endforeach


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