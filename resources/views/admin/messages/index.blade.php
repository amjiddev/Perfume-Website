@extends('layout.master')
@section('content')
<x-default-layout>
@section('title')
Contact Messages
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('dashboard') }}
@endsection
<div class="row">
<div class="col-md-12">
<div class="card mb-4">
<div class="card-header d-flex justify-content-between align-items-center">
<div>
<h5 class="card-title mb-0">Contact Messages</h5>
<small class="text-muted">{{ $messages->total() }} total messages</small>
</div>
<div class="badge bg-danger rounded-pill">{{ $unreadCount }} Unread</div>
</div>
<div class="card-body">
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{ session('success') }}
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if ($messages->count() > 0)
<div class="table-responsive">
<table class="table table-hover">
<thead class="table-light">
<tr>
<th style="width: 30px;">
<input type="checkbox" id="selectAll">
</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Subject</th>
<th>Status</th>
<th style="width: 150px;">Date</th>
<th style="width: 120px;">Actions</th>
</tr>
</thead>
<tbody>
@foreach ($messages as $message)
<tr class="{{ !$message->is_read ? 'table-info' : '' }}">
<td>
<input type="checkbox" class="message-checkbox" value="{{ $message->id }}">
</td>
<td>
<strong>{{ $message->name }}</strong>
</td>
<td>
<a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
</td>
<td>
<a href="tel:{{ preg_replace('/\D/', '', $message->phone) }}">{{ $message->phone }}</a>
</td>
<td>
{{ Str::limit($message->subject, 30) }}
</td>
<td>
@if (!$message->is_read)
<span class="badge bg-danger">Unread</span>
@else
<span class="badge bg-success">Read</span>
@endif
</td>
<td>
{{ $message->created_at->format('M d, Y H:i') }}
</td>
<td>
<div class="btn-group" role="group">
<a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-sm btn-primary" title="View">
<i class="fas fa-eye"></i>
</a>
<form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" style="display: inline;">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
<i class="fas fa-trash"></i>
</button>
</form>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center">
{{ $messages->links() }}
</div>
@else
<div class="alert alert-info">
<i class="fas fa-info-circle"></i> No messages found yet.
</div>
@endif
</div>
</div>
</div>
</div>

</x-default-layout>
@endsection
