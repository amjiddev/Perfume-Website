@extends('layout.master')
@section('content')
<x-default-layout>
@section('title')
Message Details
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('dashboard') }}
@endsection

<div class="row">
<div class="col-lg-8 offset-lg-2">
<div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
<h5 class="card-title mb-0">Message Details</h5>
<a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">
<i class="fas fa-arrow-left"></i> Back to Messages
</a>
</div>
<div class="card-body">
<!-- Sender Information -->
<div class="mb-4">
<h6 class="text-muted text-uppercase">Sender Information</h6>
<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label class="form-label font-weight-bold">Full Name</label>
<p class="form-control-plaintext">{{ $message->name }}</p>
</div>
</div>
<div class="col-md-6">
<div class="mb-3">
<label class="form-label font-weight-bold">Status</label>
<p class="form-control-plaintext">
@if ($message->is_read)
<span class="badge bg-success">Read</span>
@else
<span class="badge bg-danger">Unread</span>
@endif
</p>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label class="form-label font-weight-bold">Email Address</label>
<p class="form-control-plaintext">
<a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
</p>
</div>
</div>
<div class="col-md-6">
<div class="mb-3">
<label class="form-label font-weight-bold">Phone Number</label>
<p class="form-control-plaintext">
<a href="tel:{{ preg_replace('/\D/', '', $message->phone) }}">{{ $message->phone }}</a>
</p>
</div>
</div>
</div>
</div>

<hr>

<!-- Message Content -->
<div class="mb-4">
<h6 class="text-muted text-uppercase">Message</h6>
<div class="mb-3">
<label class="form-label font-weight-bold">Subject</label>
<p class="form-control-plaintext">{{ $message->subject }}</p>
</div>

<div class="mb-3">
<label class="form-label font-weight-bold">Message</label>
<p class="form-control-plaintext" style="white-space: pre-wrap; background: #f5f5f5; padding: 1rem; border-radius: 4px;">{{ $message->message }}</p>
</div>
</div>

<hr>

<!-- Message Meta -->
<div class="mb-4">
<h6 class="text-muted text-uppercase">Details</h6>
<div class="row">
<div class="col-md-6">
<small class="text-muted">
<strong>Received:</strong> {{ $message->created_at->format('F d, Y \a\t h:i A') }}
</small>
</div>
<div class="col-md-6">
<small class="text-muted">
<strong>Last Updated:</strong> {{ $message->updated_at->format('F d, Y \a\t h:i A') }}
</small>
</div>
</div>
</div>

<!-- Actions -->
<div class="d-flex gap-2">
<form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">
<i class="fas fa-trash"></i> Delete Message
</button>
</form>
<a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary">
<i class="fas fa-reply"></i> Reply via Email
</a>
</div>
</div>
</div>
</div>
</div>

</x-default-layout>
@endsection
