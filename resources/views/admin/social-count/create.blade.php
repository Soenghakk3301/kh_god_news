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
                    <form action="{{ route('admin.social-count.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="language">Language</label>
                            <select name="language" id="language-select" class="form-control">
                                <option value="">--Select--</option>

                                @foreach ($languages as $lang)
                                    <option value="{{ $lang->lang }}">{{ $lang->name }}</option>
                                @endforeach
                            </select>
                            @error('language')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="icon">{{ __('Icon') }}</label>
                            <br>
                            <button class="btn btn-primary" name="icon" role="iconpicker"></button>
                            @error('name')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="url">{{ __('Url') }}</label>
                            <input type="text" class="form-control" name="url">
                            @error('url')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fan_count">{{ __('Fan Count') }}</label>
                            <input type="text" class="form-control" name="fan_count">
                            @error('fan_count')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fan_type">{{ __('Fan Type') }}</label>
                            <input type="text" class="form-control" name="fan_type"
                                placeholder="ex: liks, fans, followers">
                            @error('fan_type')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Button Text') }}</label>
                            <input name="button_text" type="text" class="form-control" id="name">
                            @error('button_text')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Pick Your Color') }}</label>
                            <div class="input-group colorpickerinput">
                                <input name="color" type="text" class="form-control">
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
                                <option value="0">{{ __('No') }}</option>
                                <option value="1">{{ __('Yes') }}</option>
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
                        <button class="btn btn-primary">Create</button>
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
