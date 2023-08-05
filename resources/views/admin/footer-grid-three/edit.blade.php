@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Footer') }}</h1>
        </div>
        <div class="row">
            <div class="card card-primary col-12">
                <div class="card-header">
                    <h4>{{ __('Edit Footer Grid Three') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.footer-grid-three.update', $footerGridThree->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="language">Language</label>
                            <select name="language" id="language-select" class="form-control">
                                <option value="">--Select--</option>

                                @foreach ($languages as $lang)
                                    <option {{ $lang->lang === $footerGridThree->language ? 'selected' : '' }}
                                        value="{{ $lang->lang }}">{{ $lang->name }}</option>
                                @endforeach
                            </select>
                            @error('language')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" type="text" class="form-control" id="name" name="name"
                                value="{{ $footerGridThree->name }}">
                            @error('name')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="url">{{ __('Url') }}</label>
                            <input type="text" type="text" class="form-control" id="url" name="url"
                                value="{{ $footerGridThree->url }}">
                            @error('url')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                <option {{ $footerGridThree->status === 1 ? 'selected' : '' }} value="1">Active
                                </option>
                                <option {{ $footerGridThree->status === 0 ? 'selected' : '' }} value="0">Inactive
                                </option>
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
