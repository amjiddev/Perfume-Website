@extends('layout.master')

@section('content')
<x-default-layout>

    @section('title')
        Contact Page Settings
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <!-- Contact Page Settings Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Contact Page Settings</h5>
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

                    <form action="{{ route('admin.contact-page.update') }}" method="POST" enctype="multipart/form-data">
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
                                           value="{{ old('title', $contactPage->title) }}" placeholder="e.g., Contact Us">
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
                                           value="{{ old('hero_heading', $contactPage->hero_heading) }}" placeholder="e.g., Get In Touch">
                                    @error('hero_heading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hero_subheading" class="form-label">Hero Subheading</label>
                                    <textarea class="form-control @error('hero_subheading') is-invalid @enderror" 
                                              id="hero_subheading" name="hero_subheading" rows="2">{{ old('hero_subheading', $contactPage->hero_subheading) }}</textarea>
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
                                    @if($contactPage->hero_image)
                                        <div class="mt-2">
                                            <small class="text-muted">Current image:</small>
                                            <img src="{{ asset($contactPage->hero_image) }}" alt="Hero" style="max-width: 200px; max-height: 150px; border-radius: 4px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Page Description</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="3">{{ old('description', $contactPage->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Contact Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" 
                                           value="{{ old('phone', $contactPage->phone) }}" placeholder="e.g., +92 (0) 300 1234567">
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" 
                                           value="{{ old('email', $contactPage->email) }}" placeholder="e.g., info@example.com">
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" rows="2">{{ old('address', $contactPage->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="office_hours" class="form-label">Office Hours</label>
                                    <textarea class="form-control @error('office_hours') is-invalid @enderror" 
                                              id="office_hours" name="office_hours" rows="3" placeholder="Monday - Friday: 10:00 AM - 6:00 PM&#10;Saturday: 11:00 AM - 5:00 PM&#10;Sunday: Closed">{{ old('office_hours', $contactPage->office_hours) }}</textarea>
                                    @error('office_hours')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Map Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Map Embed Code</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="map_embed_code" class="form-label">Google Maps Embed Code</label>
                                    <textarea class="form-control @error('map_embed_code') is-invalid @enderror" 
                                              id="map_embed_code" name="map_embed_code" rows="4" placeholder="Paste your Google Maps embed iframe code here">{{ old('map_embed_code', $contactPage->map_embed_code) }}</textarea>
                                    <small class="text-muted d-block mt-2">Get embed code from Google Maps: Right-click on location → Share → Embed a map</small>
                                    @error('map_embed_code')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Contact Form Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Contact Form Settings</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="contact_form_title" class="form-label">Form Title</label>
                                    <input type="text" class="form-control @error('contact_form_title') is-invalid @enderror" 
                                           id="contact_form_title" name="contact_form_title" 
                                           value="{{ old('contact_form_title', $contactPage->contact_form_title) }}" placeholder="e.g., Send us a Message">
                                    @error('contact_form_title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="contact_form_description" class="form-label">Form Description</label>
                                    <textarea class="form-control @error('contact_form_description') is-invalid @enderror" 
                                              id="contact_form_description" name="contact_form_description" rows="2">{{ old('contact_form_description', $contactPage->contact_form_description) }}</textarea>
                                    @error('contact_form_description')
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
