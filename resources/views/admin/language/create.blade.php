@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Language</h1>
        </div>
        <div class="row">
            <div class="card card-primary col-12">
                <div class="card-header">
                    <h4>Create Language</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.language.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="lang">Language</label>
                            <select name="lang" id="language-select" class="form-control">
                                <option value="">--Select--</option>

                                @foreach (config('language') as $key => $lang)
                                    <option value="{{ $key }}">{{ $lang['name'] }}</option>
                                @endforeach
                            </select>
                            @error('lang')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" readonly type="text" class="form-control" id="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input name="slug" readonly type="text" class="form-control" id="slug">
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Is it default?</label>
                            <select name="default" id="" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('default')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#language-select').on('change', function() {
                let value = $(this).val()
                let name = $(this).children(':selected').text()
                $('#slug').val(value)
                $('#name').val(name)
            })
        })
    </script>
@endpush
