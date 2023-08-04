@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Social Count') }}</h1>
        </div>
        <div class="row">
            <div class="card card-primary col-12">
                <div class="card-header">
                    <h4>{{ __('Create Social Count') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.social-count.update', $socialCount->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="language">Language</label>
                            <select name="language" id="language-select" class="form-control">
                                <option value="">--Select--</option>

                                @foreach ($languages as $lang)
                                    <option {{ $lang->lang === $socialCount->language ? 'selected' : '' }}
                                        value="{{ $lang->lang }}">{{ $lang->name }}</option>
                                @endforeach
                            </select>
                            @error('language')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="icon">{{ __('Icon') }}</label>
                            <br>
                            <button class="btn btn-primary" name="icon" role="iconpicker"
                                data-icon="{{ $socialCount->icon }}"></button>
                            @error('name')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="url">{{ __('Url') }}</label>
                            <input type="text" class="form-control" name="url" value="{{ $socialCount->url }}">
                            @error('url')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fan_count">{{ __('Fan Count') }}</label>
                            <input type="text" class="form-control" name="fan_count"
                                value="{{ $socialCount->fan_count }}">
                            @error('fan_count')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fan_type">{{ __('Fan Type') }}</label>
                            <input type="text" class="form-control" name="fan_type"
                                value="{{ $socialCount->fan_type }}">
                            @error('fan_type')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Button Text') }}</label>
                            <input name="button_text" type="text" class="form-control" id="name"
                                value="{{ $socialCount->button_text }}">
                            @error('button_text')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Pick Your Color') }}</label>
                            <div class="input-group colorpickerinput">
                                <input name="color" type="text" class="form-control"
                                    value="{{ $socialCount->color }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="fas fa-fill-drip"></i>
                                    </div>
                                </div>
                                @error('color')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="show_at_nav">{{ __('Show At Nav') }}</label>
                            <select name="show_at_nav" id="" class="form-control">
                                <option {{ $socialCount->status === 0 ? 'selected' : '' }} value="0">
                                    {{ __('No') }}</option>
                                <option {{ $socialCount->status === 1 ? 'selected' : '' }} value="1">
                                    {{ __('Yes') }}</option>
                            </select>
                            @error('show_at_nav')
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
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        $(".colorpickerinput").colorpicker({
            format: 'hex',
            component: '.input-group-append',
        });
    </script>
@endpush
