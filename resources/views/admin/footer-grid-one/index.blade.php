@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Footer Grid One</h1>
        </div>
        <div class="card card-primary">

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}" id="home-tab2" data-toggle="tab"
                                href="#home-{{ $language->lang }}" role="tab" aria-controls="home"
                                aria-selected="true">{{ $language->name }}</a>
                        </li>
                    @endforeach

                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    @foreach ($languages as $language)
                        @php
                            $footerTitle = \App\Models\FooterTitle::where(['language' => $language->lang, 'key' => 'grid_one_title'])->first();
                            
                        @endphp
                        <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}"
                            id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="card-body">
                                <form action="{{ route('admin.footer-grid-one-title') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">{{ __('admin.Footer Title') }}</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ @$footerTitle->value }}">
                                        <input type="hidden" value="{{ $language->lang }}" class="form-control"
                                            name="language">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

        <div class="card card-primary col-12">
            <div class="card-header">
                <h4>{{ __('Footer Grid One') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.footer-grid-one.create') }}" class="btn btn-primary">
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
                                            $footerGridOne = \App\Models\FooterGridOne::where('language', $lang->lang)
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
                                                        <th>{{ __('Name') }}</th>
                                                        <th>{{ __('Url') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($footerGridOne as $footer)
                                                        <tr>
                                                            <td>{{ $footer->id }}</td>
                                                            <td>{{ $footer->name }}</td>
                                                            <td>{{ $footer->url }}</td>
                                                            <td>
                                                                @if ($footer->status == 1)
                                                                    <span class="badge badge-primary">{{ __('Active') }}
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-danger">{{ __('Inactive') }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.footer-grid-one.edit', $footer->id) }}"
                                                                    class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                                <a href="{{ route('admin.footer-grid-one.destroy', $footer->id) }}"
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
