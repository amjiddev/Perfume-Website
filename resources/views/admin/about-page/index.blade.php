@extends('layout.master')

@section('content')
<x-default-layout>

    @section('title')
        About Page Settings
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <!-- About Page Settings Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">About Page Settings</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.about-page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Page Title -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Page Title</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Page Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" 
                                           value="{{ old('title', $aboutPage->title) }}" placeholder="e.g., About Us">
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Hero Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Hero Section</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="hero_heading" class="form-label">Hero Heading</label>
                                    <input type="text" class="form-control @error('hero_heading') is-invalid @enderror" 
                                           id="hero_heading" name="hero_heading" 
                                           value="{{ old('hero_heading', $aboutPage->hero_heading) }}" placeholder="e.g., About Our Company">
                                    @error('hero_heading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hero_subheading" class="form-label">Hero Subheading</label>
                                    <textarea class="form-control @error('hero_subheading') is-invalid @enderror" 
                                              id="hero_subheading" name="hero_subheading" rows="2">{{ old('hero_subheading', $aboutPage->hero_subheading) }}</textarea>
                                    @error('hero_subheading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hero_image" class="form-label">Hero Background Image</label>
                                    <input type="file" class="form-control @error('hero_image') is-invalid @enderror" 
                                           id="hero_image" name="hero_image" accept="image/*">
                                    @error('hero_image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @if($aboutPage->hero_image)
                                        <div class="mt-2">
                                            <small class="text-muted">Current image:</small>
                                            <img src="{{ asset($aboutPage->hero_image) }}" alt="Hero" style="max-width: 200px; max-height: 150px; border-radius: 4px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Content Section 1 -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Content Section 1</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="content_section_1_title" class="form-label">Section Title</label>
                                    <input type="text" class="form-control @error('content_section_1_title') is-invalid @enderror" 
                                           id="content_section_1_title" name="content_section_1_title" 
                                           value="{{ old('content_section_1_title', $aboutPage->content_section_1_title) }}">
                                    @error('content_section_1_title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content_section_1_description" class="form-label">Section Description</label>
                                    <textarea class="form-control @error('content_section_1_description') is-invalid @enderror" 
                                              id="content_section_1_description" name="content_section_1_description" rows="4">{{ old('content_section_1_description', $aboutPage->content_section_1_description) }}</textarea>
                                    @error('content_section_1_description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content_section_1_image" class="form-label">Section Image</label>
                                    <input type="file" class="form-control @error('content_section_1_image') is-invalid @enderror" 
                                           id="content_section_1_image" name="content_section_1_image" accept="image/*">
                                    @error('content_section_1_image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @if($aboutPage->content_section_1_image)
                                        <div class="mt-2">
                                            <small class="text-muted">Current image:</small>
                                            <img src="{{ asset($aboutPage->content_section_1_image) }}" alt="Section 1" style="max-width: 200px; max-height: 150px; border-radius: 4px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Content Section 2 -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Content Section 2</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="content_section_2_title" class="form-label">Section Title</label>
                                    <input type="text" class="form-control @error('content_section_2_title') is-invalid @enderror" 
                                           id="content_section_2_title" name="content_section_2_title" 
                                           value="{{ old('content_section_2_title', $aboutPage->content_section_2_title) }}">
                                    @error('content_section_2_title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content_section_2_description" class="form-label">Section Description</label>
                                    <textarea class="form-control @error('content_section_2_description') is-invalid @enderror" 
                                              id="content_section_2_description" name="content_section_2_description" rows="4">{{ old('content_section_2_description', $aboutPage->content_section_2_description) }}</textarea>
                                    @error('content_section_2_description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content_section_2_image" class="form-label">Section Image</label>
                                    <input type="file" class="form-control @error('content_section_2_image') is-invalid @enderror" 
                                           id="content_section_2_image" name="content_section_2_image" accept="image/*">
                                    @error('content_section_2_image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @if($aboutPage->content_section_2_image)
                                        <div class="mt-2">
                                            <small class="text-muted">Current image:</small>
                                            <img src="{{ asset($aboutPage->content_section_2_image) }}" alt="Section 2" style="max-width: 200px; max-height: 150px; border-radius: 4px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Mission, Vision, Values Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Mission, Vision & Values</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="mission_title" class="form-label">Mission Title</label>
                                        <input type="text" class="form-control @error('mission_title') is-invalid @enderror" 
                                               id="mission_title" name="mission_title" 
                                               value="{{ old('mission_title', $aboutPage->mission_title) }}">
                                        @error('mission_title')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="vision_title" class="form-label">Vision Title</label>
                                        <input type="text" class="form-control @error('vision_title') is-invalid @enderror" 
                                               id="vision_title" name="vision_title" 
                                               value="{{ old('vision_title', $aboutPage->vision_title) }}">
                                        @error('vision_title')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="mission_description" class="form-label">Mission Description</label>
                                    <textarea class="form-control @error('mission_description') is-invalid @enderror" 
                                              id="mission_description" name="mission_description" rows="3">{{ old('mission_description', $aboutPage->mission_description) }}</textarea>
                                    @error('mission_description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="vision_description" class="form-label">Vision Description</label>
                                    <textarea class="form-control @error('vision_description') is-invalid @enderror" 
                                              id="vision_description" name="vision_description" rows="3">{{ old('vision_description', $aboutPage->vision_description) }}</textarea>
                                    @error('vision_description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="values_title" class="form-label">Values Title</label>
                                    <input type="text" class="form-control @error('values_title') is-invalid @enderror" 
                                           id="values_title" name="values_title" 
                                           value="{{ old('values_title', $aboutPage->values_title) }}">
                                    @error('values_title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="values_description" class="form-label">Values Description</label>
                                    <textarea class="form-control @error('values_description') is-invalid @enderror" 
                                              id="values_description" name="values_description" rows="3">{{ old('values_description', $aboutPage->values_description) }}</textarea>
                                    @error('values_description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mb-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-2"></i>Back
                </a>
            </div>
        </div>
    </div>

</x-default-layout>
@endsection
