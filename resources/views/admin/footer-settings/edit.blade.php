@extends('layout.app')

@section('title', 'Edit Footer Settings')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0">Edit Footer Settings</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.footer-settings.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.footer-settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Company Information -->
                <div class="mb-4">
                    <h5 class="mb-3">Company Information</h5>
                    
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" 
                               id="company_name" name="company_name" 
                               value="{{ old('company_name', $footerSettings->company_name ?? '') }}" required>
                        @error('company_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="company_description" class="form-label">Company Description</label>
                        <textarea class="form-control @error('company_description') is-invalid @enderror" 
                                  id="company_description" name="company_description" rows="3" required>{{ old('company_description', $footerSettings->company_description ?? '') }}</textarea>
                        @error('company_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="copyright_text" class="form-label">Copyright Text</label>
                        <input type="text" class="form-control @error('copyright_text') is-invalid @enderror" 
                               id="copyright_text" name="copyright_text" 
                               value="{{ old('copyright_text', $footerSettings->copyright_text ?? '') }}" required>
                        @error('copyright_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="{{ route('admin.footer-settings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
