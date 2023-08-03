@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>News</h1>
        </div>
        <div class="row">
            <div class="card card-primary col-12">
                <div class="card-header">
                    <h4>{{ __('All News') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                            {{ __('Create New') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('Category') }}</h4>
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
                                                $news = \App\Models\News::with('category')
                                                    ->where('language', $lang->lang)
                                                    ->orderBy('id', 'DESC')
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
                                                            <th>{{ __('Image') }}</th>
                                                            <th>{{ __('Title') }}</th>
                                                            <th>{{ __('Category') }}</th>
                                                            <th>{{ __('In Breaking') }}</th>
                                                            <th>{{ __('In Slider') }}</th>
                                                            <th>{{ __('In Popular') }}</th>
                                                            <th>{{ __('Status') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($news as $item)
                                                            <tr>
                                                                <td>{{ $item->id }}</td>
                                                                <td>
                                                                    <img src="{{ asset($item->image) }}" width="200px"
                                                                        height="130px" alt="100">
                                                                </td>

                                                                <td>{{ $item->title }}</td>
                                                                <td>{{ $item->category->name }}</td>

                                                                <td>
                                                                    <label class="custom-switch mt-2">
                                                                        <input value="1" type="checkbox"
                                                                            {{ $item->is_breaking_news === 1 ? 'checked' : '' }}
                                                                            name="is_breaking_news"
                                                                            data-id="{{ $item->id }}"
                                                                            data-name="is_breaking_news"
                                                                            class="custom-switch-input toggle-status">
                                                                        <span class="custom-switch-indicator"></span>
                                                                    </label>
                                                                </td>

                                                                <td>
                                                                    <label class="custom-switch mt-2">
                                                                        <input value="1" type="checkbox"
                                                                            {{ $item->show_at_slider === 1 ? 'checked' : '' }}
                                                                            name="show_at_slider"
                                                                            data-id="{{ $item->id }}"
                                                                            data-name="show_at_slider"
                                                                            class="custom-switch-input toggle-status">
                                                                        <span class="custom-switch-indicator"></span>
                                                                    </label>
                                                                </td>

                                                                <td>
                                                                    <label class="custom-switch mt-2">
                                                                        <input value="1" type="checkbox"
                                                                            {{ $item->show_at_popular === 1 ? 'checked' : '' }}
                                                                            name="show_at_popular"
                                                                            data-id="{{ $item->id }}"
                                                                            data-name="show_at_popular"
                                                                            class="custom-switch-input toggle-status">
                                                                        <span class="custom-switch-indicator"></span>
                                                                    </label>
                                                                </td>

                                                                <td>
                                                                    <label class="custom-switch mt-2">
                                                                        <input value="1" type="checkbox"
                                                                            {{ $item->status === 1 ? 'checked' : '' }}
                                                                            name="status" data-id="{{ $item->id }}"
                                                                            data-name="status"
                                                                            class="custom-switch-input toggle-status">
                                                                        <span class="custom-switch-indicator"></span>
                                                                    </label>
                                                                </td>

                                                                <td>
                                                                    <a href="{{ route('admin.news.edit', $item->id) }}"
                                                                        class="btn btn-primary"><i
                                                                            class="fas fa-edit"></i></a>
                                                                    <a href="{{ route('admin.news.destroy', $item->id) }}"
                                                                        class="btn btn-danger delete-item"><i
                                                                            class="fas fa-trash-alt"></i></a>
                                                                    <a href="{{ route('admin.news-copy', $item->id) }}"
                                                                        class="btn btn-primary"><i
                                                                            class="fas fa-copy"></i></a>
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


        // handle toggling .toggle-status
        $(document).ready(function() {
            $('.toggle-status').on('click', function() {
                let id = $(this).data('id')
                let name = $(this).data('name')
                let status = $(this).prop('checked') ? 1 : 0

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.toggle-news-status') }}",
                    data: {
                        id,
                        name,
                        status
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: 'Signed in successfully'
                            })
                        }
                    },
                    error: function() {

                    }
                })
            })
        })
    </script>
@endpush
