@extends('layout.master')
@section('content')
<x-default-layout>
@section('title')
Email Subscriptions
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('dashboard') }}
@endsection
<div class="row">
<div class="col-md-12">
<div class="card mb-4">
<div class="card-header d-flex justify-content-between align-items-center">
<div>
<h5 class="card-title mb-0">Email Subscriptions</h5>
<small class="text-muted">{{ $subscriptions->total() }} total subscriptions</small>
</div>
<div class="badge bg-info rounded-pill">{{ $subscriptions->count() }} Active</div>
</div>
<div class="card-body">

@if ($subscriptions->count() > 0)
<div class="table-responsive">
<table class="table table-hover">
<thead class="table-light">
<tr>
<th style="width: 30px;">
<input type="checkbox" id="selectAll">
</th>
<th>Email</th>
<th>Subscription Status</th>
<th style="width: 180px;">Subscribed Date</th>
<th style="width: 120px;">Actions</th>
</tr>
</thead>
<tbody>
@foreach ($subscriptions as $subscription)
<tr>
<td>
<input type="checkbox" class="subscription-checkbox" value="{{ $subscription->id }}">
</td>
<td>
<strong>{{ $subscription->email }}</strong>
</td>
<td>
<span class="badge bg-success">Active</span>
</td>
<td>
{{ $subscription->created_at->format('M d, Y H:i') }}
</td>
<td>
<div class="btn-group" role="group" style="display: flex; gap: 0.5rem;">
<form action="{{ route('admin.email-subscriptions.destroy', $subscription->id) }}" method="POST" style="display: inline;">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-sm btn-danger" 
    onclick="return confirm('Are you sure you want to remove this subscription?')" 
    title="Delete"
    style="padding: 0.4rem 0.8rem; border-radius: 6px; background: #e63946; border: none; color: white; font-size: 1rem; cursor: pointer; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
    <i class="fas fa-trash" style="font-size: 1rem;"></i>
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
{{ $subscriptions->links() }}
</div>
@else
<div class="alert alert-info">
<i class="fas fa-info-circle"></i> No email subscriptions yet.
</div>
@endif
</div>
</div>
</div>
</div>

</x-default-layout>
@endsection
