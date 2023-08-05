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
                    <form action="{{ route('admin.social-link.update', $socialLink->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="icon">{{ __('Icon') }}</label>
                            <br>
                            <button class="btn btn-primary" name="icon" role="iconpicker"
                                data-icon="{{ $socialLink->icon }}"></button>
                            @error('name')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="url">{{ __('Url') }}</label>
                            <input type="text" class="form-control" name="url" value="{{ $socialLink->url }}">
                            @error('url')
                                <p class="text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                <option {{ $socialLink->status === 1 ? 'selected' : '' }} value="1">Active</option>
                                <option {{ $socialLink->status === 0 ? 'selected' : '' }} value="0">Inactive</option>
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
