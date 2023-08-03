@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Category') }}</h1>
        </div>
        <div class="row">
            <div class="card card-primary col-12">
                <div class="card-header">
                    <h4>{{ __('Create Category') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="language">Language</label>
                            <select name="language" id="language-select" class="form-control">
                                <option value="">--Select--</option>

                                @foreach ($languages as $lang)
                                    <option {{ $category->language == $lang->lang ? 'selected' : '' }}
                                        value="{{ $lang->lang }}"> {{ $lang->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('language')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" type="text" class="form-control" id="name" name="name"
                                value="{{ $category->name }}">
                            @error('name')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="show_at_nav">{{ __('Show At Nav') }}</label>
                            <select name="show_at_nav" id="" class="form-control">
                                <option {{ $category->show_at_nav == 0 ? 'selected' : '' }} value="0">
                                    {{ __('No') }}</option>
                                <option {{ $category->show_at_nav == 1 ? 'selected' : '' }} value="1">
                                    {{ __('Yes') }}</option>
                            </select>
                            @error('show_at_nav')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                <option {{ $category->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                <option {{ $category->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                            </select>
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
