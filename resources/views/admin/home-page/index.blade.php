@extends('layout.master')

@section('content')
<x-default-layout>

    @section('title')
        Home Page Settings
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <!-- Home Page Settings Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Home Page Settings</h5>
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

                    <form action="{{ route('admin.home-page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                           value="{{ old('hero_heading', $homePage->hero_heading) }}" placeholder="e.g., Discover Luxury">
                                    @error('hero_heading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hero_subheading" class="form-label">Hero Subheading</label>
                                    <textarea class="form-control @error('hero_subheading') is-invalid @enderror" 
                                              id="hero_subheading" name="hero_subheading" rows="3">{{ old('hero_subheading', $homePage->hero_subheading) }}</textarea>
                                    @error('hero_subheading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hero_image_1" class="form-label">Hero Image 1</label>
                                            <input type="file" class="form-control @error('hero_image_1') is-invalid @enderror" 
                                                   id="hero_image_1" name="hero_image_1" accept="image/*">
                                            @error('hero_image_1')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            @if($homePage->hero_image_1)
                                                <div class="mt-2">
                                                    <small class="text-muted">Current image:</small>
                                                    <img src="{{ asset($homePage->hero_image_1) }}" alt="Hero 1" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hero_image_2" class="form-label">Hero Image 2</label>
                                            <input type="file" class="form-control @error('hero_image_2') is-invalid @enderror" 
                                                   id="hero_image_2" name="hero_image_2" accept="image/*">
                                            @error('hero_image_2')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            @if($homePage->hero_image_2)
                                                <div class="mt-2">
                                                    <small class="text-muted">Current image:</small>
                                                    <img src="{{ asset($homePage->hero_image_2) }}" alt="Hero 2" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About Us Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">About Us Section</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="about_heading" class="form-label">About Heading</label>
                                    <input type="text" class="form-control @error('about_heading') is-invalid @enderror" 
                                           id="about_heading" name="about_heading" 
                                           value="{{ old('about_heading', $homePage->about_heading) }}" placeholder="e.g., Almukhtar Perfume">
                                    @error('about_heading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="about_description" class="form-label">About Description</label>
                                    <textarea class="form-control @error('about_description') is-invalid @enderror" 
                                              id="about_description" name="about_description" rows="4">{{ old('about_description', $homePage->about_description) }}</textarea>
                                    @error('about_description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="about_image" class="form-label">About Image</label>
                                    <input type="file" class="form-control @error('about_image') is-invalid @enderror" 
                                           id="about_image" name="about_image" accept="image/*">
                                    @error('about_image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @if($homePage->about_image)
                                        <div class="mt-2">
                                            <small class="text-muted">Current image:</small>
                                            <img src="{{ asset($homePage->about_image) }}" alt="About" style="max-width: 200px; max-height: 150px;">
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">About Features</label>
                                    <div id="features-container">
                                        @forelse($homePage->about_features ?? [] as $index => $feature)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="about_features[]" 
                                                       value="{{ $feature }}" placeholder="Feature">
                                                <button class="btn btn-outline-danger" type="button" onclick="removeFeature(this)">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        @empty
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="about_features[]" 
                                                       placeholder="Feature">
                                                <button class="btn btn-outline-danger" type="button" onclick="removeFeature(this)">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addFeature()">
                                        <i class="bx bx-plus me-2"></i>Add Feature
                                    </button>
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
        </div>
    </div>

</x-default-layout>
@endsection

<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="about_features[]" placeholder="Feature">
        <button class="btn btn-outline-danger" type="button" onclick="removeFeature(this)">
            <i class="bx bx-trash"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeFeature(btn) {
    btn.parentElement.remove();
}
</script>
