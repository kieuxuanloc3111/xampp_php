@extends('admin.layouts.app')

@section('title', 'Add Blog')

@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Add Blog</h4>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.blog.store') }}">
                        @csrf

                        {{-- TITLE --}}
                        <div class="form-group">
                            <label class="col-md-12">Title</label>
                            <div class="col-md-12">
                                <input
                                    type="text"
                                    name="title"
                                    class="form-control form-control-line"
                                    required
                                >
                            </div>
                        </div>

                        {{-- IMAGE (TEXT – làm sau upload) --}}
                        <div class="form-group">
                            <label class="col-md-12">Image</label>
                            <div class="col-md-12">
                                <input
                                    type="text"
                                    name="image"
                                    class="form-control form-control-line"
                                    placeholder="Image URL"
                                >
                            </div>
                        </div>

                        {{-- DESCRIPTION (CKEDITOR) --}}
                        <div class="form-group">
                            <label class="col-md-12">Description</label>
                            <div class="col-md-12">
                                <textarea
                                    name="description"
                                    id="description"
                                    rows="6"
                                    class="form-control form-control-line">
                                </textarea>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success text-white">
                                    Save
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
