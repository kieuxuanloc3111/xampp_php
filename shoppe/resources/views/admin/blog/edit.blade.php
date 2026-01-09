@extends('admin.layouts.app')

@section('title', 'Edit Blog')

@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Edit Blog</h4>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.blog.update', $blog->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- TITLE --}}
                        <div class="form-group">
                            <label class="col-md-12">Title</label>
                            <div class="col-md-12">
                                <input
                                    type="text"
                                    name="title"
                                    value="{{ old('title', $blog->title) }}"
                                    class="form-control form-control-line"
                                    required
                                >
                            </div>
                        </div>

                        {{-- IMAGE --}}
                        <div class="form-group">
                            <label class="col-md-12">Image</label>
                            <div class="col-md-12">
                                <input
                                    type="text"
                                    name="image"
                                    value="{{ old('image', $blog->image) }}"
                                    class="form-control form-control-line"
                                >
                            </div>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="form-group">
                            <label class="col-md-12">Description</label>
                            <div class="col-md-12">
                                <textarea
                                    name="description"
                                    id="description"
                                    rows="6"
                                    class="form-control form-control-line">{{ old('description', $blog->description) }}</textarea>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success text-white">
                                    Update
                                </button>
                                <a href="{{ route('admin.blog.index') }}"
                                   class="btn btn-secondary">
                                    Back
                                </a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection

{{-- CKEDITOR --}}
@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
@endpush
