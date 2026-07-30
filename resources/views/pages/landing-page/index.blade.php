<x-default-layout>

    @section('title')
        Landing Page - Home Page Settings
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

                    <form action="{{ route('admin-landing-page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Hero Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Hero Section (4 Auto-Changing Images)</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="hero_heading" class="form-label">Hero Heading</label>
                                    <input type="text" class="form-control @error('hero_heading') is-invalid @enderror" 
                                           id="hero_heading" name="hero_heading" 
                                           value="{{ old('hero_heading', $homePage->hero_heading ?? 'Discover Luxury') }}" placeholder="e.g., Discover Luxury">
                                    @error('hero_heading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hero_subheading" class="form-label">Hero Subheading</label>
                                    <textarea class="form-control @error('hero_subheading') is-invalid @enderror" 
                                              id="hero_subheading" name="hero_subheading" rows="3">{{ old('hero_subheading', $homePage->hero_subheading ?? '') }}</textarea>
                                    @error('hero_subheading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    @for($i = 1; $i <= 4; $i++)
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hero_image_{{ $i }}" class="form-label">Hero Image {{ $i }}</label>
                                            <input type="file" class="form-control @error('hero_image_'.$i) is-invalid @enderror" 
                                                   id="hero_image_{{ $i }}" name="hero_image_{{ $i }}" accept="image/*">
                                            @error('hero_image_'.$i)
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            @php $heroImage = 'hero_image_' . $i; @endphp
                                            @if($homePage->$heroImage)
                                                <div class="mt-2">
                                                    <small class="text-muted">Current image:</small>
                                                    <div style="position: relative; width: fit-content; margin-top: 0.5rem;">
                                                        <img src="{{ asset($homePage->$heroImage) }}" alt="Hero {{ $i }}" style="max-width: 200px; max-height: 150px; display: block;">
                                                        <button type="button" class="btn btn-danger" onclick="deleteHeroImage('{{ $heroImage }}')" title="Remove image" style="position: absolute; top: -10px; right: -10px; padding: 0; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 20px; z-index: 10; border: 2px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                                            ×
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endfor
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
                                           value="{{ old('about_heading', $homePage->about_heading ?? 'Almukhtar Perfume') }}" placeholder="e.g., Almukhtar Perfume">
                                    @error('about_heading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="about_description" class="form-label">About Description</label>
                                    <textarea class="form-control @error('about_description') is-invalid @enderror" 
                                              id="about_description" name="about_description" rows="4">{{ old('about_description', $homePage->about_description ?? '') }}</textarea>
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
                                            <div style="position: relative; width: fit-content; margin-top: 0.5rem;">
                                                <img src="{{ asset($homePage->about_image) }}" alt="About" style="max-width: 200px; max-height: 150px; display: block;">
                                                <button type="button" class="btn btn-danger" onclick="deleteHeroImage('about_image')" title="Remove image" style="position: absolute; top: -10px; right: -10px; padding: 0; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 20px; z-index: 10; border: 2px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                                    ×
                                                </button>
                                            </div>
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

                        <!-- Social Media Links Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Social Media Links</h6>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info" role="alert">
                                    <i class="bx bx-info-circle me-2"></i>
                                    Add your social media links here. These will be displayed in the footer of your website.
                                </div>

                                <div class="mb-3">
                                    <label for="facebook_link" class="form-label">
                                        <i class="fab fa-facebook me-2" style="color: #1877F2;"></i>Facebook Link
                                    </label>
                                    <input type="url" class="form-control @error('facebook_link') is-invalid @enderror" 
                                           id="facebook_link" name="facebook_link" 
                                           value="{{ old('facebook_link', $homePage->facebook_link ?? '') }}" 
                                           placeholder="e.g., https://www.facebook.com/yourbrand">
                                    @error('facebook_link')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="youtube_link" class="form-label">
                                        <i class="fab fa-youtube me-2" style="color: #FF0000;"></i>YouTube Link
                                    </label>
                                    <input type="url" class="form-control @error('youtube_link') is-invalid @enderror" 
                                           id="youtube_link" name="youtube_link" 
                                           value="{{ old('youtube_link', $homePage->youtube_link ?? '') }}" 
                                           placeholder="e.g., https://www.youtube.com/yourbrand">
                                    @error('youtube_link')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tiktok_link" class="form-label">
                                        <i class="fab fa-tiktok me-2" style="color: #000000;"></i>TikTok Link
                                    </label>
                                    <input type="url" class="form-control @error('tiktok_link') is-invalid @enderror" 
                                           id="tiktok_link" name="tiktok_link" 
                                           value="{{ old('tiktok_link', $homePage->tiktok_link ?? '') }}" 
                                           placeholder="e.g., https://www.tiktok.com/@yourbrand">
                                    @error('tiktok_link')
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
        </div>
    </div>

</x-default-layout>

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

function deleteHeroImage(imageField) {
    if (confirm('Are you sure you want to remove this image?')) {
        fetch(`{{ route('admin-landing-page.delete-image') }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                image_field: imageField
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload the page to reflect changes
                window.location.reload();
            } else {
                alert('Error deleting image: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting image');
        });
    }
}

function deletePageImage(pageName, imageField) {
    if (confirm('Are you sure you want to remove this image?')) {
        const routeMap = {
            'shop_page': 'admin.shop-page.delete-image',
            'perfume_page': 'admin.perfume-page.delete-image',
            'perfume_product': 'admin.perfume-page.delete-perfume-image',
            'about_page': 'admin.about-page.delete-image',
            'contact_page': 'admin.contact-page.delete-image',
            'shop_product': 'admin.shop-page.delete-product-image'
        };

        const routeName = routeMap[pageName] || '';
        let endpoint = '';

        // Create endpoint URL based on page name
        if (pageName === 'shop_page') {
            endpoint = '{{ route("admin.shop-page.delete-image") }}';
        } else if (pageName === 'perfume_page') {
            endpoint = '{{ route("admin.perfume-page.delete-image") }}';
        } else if (pageName === 'perfume_product') {
            endpoint = `{{ url('admin/perfume-page/delete-perfume-image') }}/${imageField}`;
        } else if (pageName === 'about_page') {
            endpoint = '{{ route("admin.about-page.delete-image") }}';
        } else if (pageName === 'contact_page') {
            endpoint = '{{ route("admin.contact-page.delete-image") }}';
        } else if (pageName === 'shop_product') {
            endpoint = `{{ url('admin/shop-page/delete-product-image') }}/${imageField}`;
        }

        fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                image_field: imageField,
                page_name: pageName
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('Error deleting image: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting image');
        });
    }
}
</script>

