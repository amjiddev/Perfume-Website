@extends('layout.app')

@section('title', 'Footer Settings')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0">Footer Settings</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.footer-settings.edit') }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>

    @if($footerSettings)
    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Company Information</h5>
                    <p><strong>Company Name:</strong> {{ $footerSettings->company_name }}</p>
                    <p><strong>Description:</strong> {{ $footerSettings->company_description }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Copyright</h5>
                    <p>{{ $footerSettings->copyright_text }}</p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h5>Quick Links</h5>
                    @if($footerSettings->quick_links)
                        <ul>
                            @foreach($footerSettings->quick_links as $link)
                                <li>{{ $link['label'] ?? '' }} - {{ $link['url'] ?? '' }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-md-6">
                    <h5>Customer Service Links</h5>
                    @if($footerSettings->customer_service_links)
                        <ul>
                            @foreach($footerSettings->customer_service_links as $link)
                                <li>{{ $link['label'] ?? '' }} - {{ $link['url'] ?? '' }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <hr>

            <div>
                <h5>Social Links</h5>
                @if($footerSettings->social_links)
                    <ul>
                        @foreach($footerSettings->social_links as $social)
                            <li>{{ $social['label'] ?? '' }} ({{ $social['icon'] ?? '' }}) - {{ $social['url'] ?? '' }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info">No footer settings found. <a href="{{ route('admin.footer-settings.edit') }}">Create one</a></div>
    @endif
</div>
@endsection
