@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Footer Info') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Footer Info') }}</h4>

            </div>

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
                            
                            $footerInfo = \App\Models\FooterInfo::where('language', $language->lang)->first();
                            
                            //  dd($footerInfo);
                            
                        @endphp
                        <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}"
                            id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="card-body">
                                <form action="{{ route('admin.footer-info.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <img src="{{ asset(@$footerInfo->logo) }}" width="100px" alt="">
                                        <br>
                                        <label for="icon">{{ __('Icon') }}</label>
                                        <input type="file" name="logo" class="form-control">
                                        <input type="hidden" name="language" value="{{ $language->lang }}">
                                        @error('name')
                                            <p class="text-center">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">{{ __('Short Description') }}</label>
                                        <textarea name="description" class="form-control" id="" cols="30" rows="10">{!! @$footerInfo->description !!}</textarea>
                                        @error('name')
                                            <p class="text-center">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="copyright">{{ __('Copyright ') }}</label>
                                        <input name="copyright" class="form-control" id=""
                                            value="{{ @$footerInfo->copyright }}" />
                                        @error('name')
                                            <p class="text-center">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: "{{ $error }}"
                });
            @endforeach
        @endif
    </script>
@endpush

{{-- @push('scripts')
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
@endpush --}}
