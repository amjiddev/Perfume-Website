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
<div class="btn-group" role="group" style="display: flex; gap: 0.5rem;">
<button type="button" class="btn btn-sm btn-primary view-message-btn" 
    data-message-id="{{ $message->id }}"
    data-message-name="{{ $message->name }}"
    data-message-email="{{ $message->email }}"
    data-message-phone="{{ $message->phone }}"
    data-message-subject="{{ $message->subject }}"
    data-message-body="{{ $message->message }}"
    data-message-is-read="{{ $message->is_read ? 1 : 0 }}"
    title="View"
    style="padding: 0.4rem 0.8rem; border-radius: 6px; background: #0066ff; border: none; color: white; font-size: 1rem; cursor: pointer; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
    <i class="fas fa-eye" style="font-size: 1rem;"></i>
</button>
<form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" style="display: inline;">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-sm btn-danger" 
    onclick="return confirm('Are you sure?')" 
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

<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: white; border-bottom: 1px solid #eee; padding: 1.5rem;">
                <h5 class="modal-title" id="messageModalLabel" style="margin: 0; color: #333; font-weight: 700;">Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="messageModalBody" style="padding: 2rem;">
                <!-- Message details will be loaded here -->
            </div>
        </div>
    </div>
</div>

</x-default-layout>
@endsection

<script>
    // Initialize view message buttons
    function initializeViewMessageButtons() {
        const viewBtns = document.querySelectorAll('.view-message-btn');
        viewBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const messageId = this.getAttribute('data-message-id');
                const name = this.getAttribute('data-message-name');
                const email = this.getAttribute('data-message-email');
                const phone = this.getAttribute('data-message-phone');
                const subject = this.getAttribute('data-message-subject');
                const message = this.getAttribute('data-message-body');
                const isRead = parseInt(this.getAttribute('data-message-is-read'));
                
                openMessageModal(messageId, name, email, phone, subject, message, isRead);
            });
        });
    }

    let currentMessageId = null;

    function openMessageModal(messageId, name, email, phone, subject, message, isRead) {
        currentMessageId = messageId;
        
        // Mark message as read
        if (!isRead) {
            markMessageAsRead(messageId);
        }

        const readBadge = `<span style="display: inline-block; background: #28a745; color: white; padding: 0.4rem 0.8rem; border-radius: 4px; font-size: 0.85rem; font-weight: 600;">Read</span>`;
        const unreaderBadge = `<span style="display: inline-block; background: #dc3545; color: white; padding: 0.4rem 0.8rem; border-radius: 4px; font-size: 0.85rem; font-weight: 600;">Unread</span>`;
        
        const modalBody = `
            <div style="padding: 0;">
                <!-- Sender Information Section -->
                <h6 style="margin-bottom: 1rem; font-weight: 700; color: #999; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Sender Information</h6>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                    <div>
                        <p style="margin: 0 0 0.5rem 0; color: #333; font-weight: 600; font-size: 0.9rem;">Full Name</p>
                        <p style="margin: 0; color: #666; font-size: 0.95rem;">${name}</p>
                    </div>
                    <div>
                        <p style="margin: 0 0 0.5rem 0; color: #333; font-weight: 600; font-size: 0.9rem;">Status</p>
                        <p style="margin: 0;">${isRead ? readBadge : unreaderBadge}</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                    <div>
                        <p style="margin: 0 0 0.5rem 0; color: #333; font-weight: 600; font-size: 0.9rem;">Email Address</p>
                        <p style="margin: 0; color: #667eea;"><a href="mailto:${email}" style="color: #667eea; text-decoration: none;">${email}</a></p>
                    </div>
                    <div>
                        <p style="margin: 0 0 0.5rem 0; color: #333; font-weight: 600; font-size: 0.9rem;">Phone Number</p>
                        <p style="margin: 0; color: #667eea;"><a href="tel:${phone}" style="color: #667eea; text-decoration: none;">${phone}</a></p>
                    </div>
                </div>

                <hr style="margin: 2rem 0; border: none; border-top: 1px solid #eee;">

                <!-- Message Section -->
                <h6 style="margin-bottom: 1rem; font-weight: 700; color: #999; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Message</h6>
                
                <div style="margin-bottom: 1.5rem;">
                    <p style="margin: 0 0 0.5rem 0; color: #333; font-weight: 600; font-size: 0.9rem;">Subject</p>
                    <p style="margin: 0; color: #666; font-size: 0.95rem;">${subject}</p>
                </div>

                <div style="margin-bottom: 2rem;">
                    <p style="margin: 0 0 0.5rem 0; color: #333; font-weight: 600; font-size: 0.9rem;">Message</p>
                    <p style="margin: 0; color: #666; font-size: 0.95rem; white-space: pre-wrap; line-height: 1.6; background: #f5f5f5; padding: 1rem; border-radius: 4px;">${message}</p>
                </div>

                <hr style="margin: 2rem 0; border: none; border-top: 1px solid #eee;">

                <!-- Details Section -->
                <h6 style="margin-bottom: 1rem; font-weight: 700; color: #999; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Details</h6>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                    <div>
                        <p style="margin: 0; color: #999; font-size: 0.85rem;"><strong>Received:</strong> ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })} at ${new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })}</p>
                    </div>
                    <div>
                        <p style="margin: 0; color: #999; font-size: 0.85rem;"><strong>Last Updated:</strong> ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })} at ${new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn btn-danger" onclick="deleteMessageFromModal()" style="padding: 0.6rem 1.5rem; font-weight: 600; border: none; border-radius: 4px; cursor: pointer;">
                        <i class="fas fa-trash" style="margin-right: 0.5rem;"></i> Delete Message
                    </button>
                    <a href="mailto:${email}?subject=Re: ${encodeURIComponent(subject)}" class="btn btn-primary" style="padding: 0.6rem 1.5rem; font-weight: 600; border: none; border-radius: 4px; cursor: pointer; text-decoration: none;">
                        <i class="fas fa-reply" style="margin-right: 0.5rem;"></i> Reply via Email
                    </a>
                </div>
            </div>
        `;

        document.getElementById('messageModalBody').innerHTML = modalBody;

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('messageModal'));
        modal.show();
    }

    function markMessageAsRead(messageId) {
        fetch(`/admin/messages/${messageId}/mark-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Message marked as read');
        })
        .catch(error => console.error('Error marking message as read:', error));
    }

    function deleteMessageFromModal() {
        if (!currentMessageId) return;
        
        if (confirm('Are you sure you want to delete this message?')) {
            fetch(`/admin/messages/${currentMessageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Message deleted successfully!');
                    
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('messageModal'));
                    if (modal) modal.hide();
                    
                    // Reload the page to show updated messages
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                } else {
                    alert('Failed to delete message: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting message: ' + error.message);
            });
        }
    }

    // Initialize on page load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeViewMessageButtons);
    } else {
        initializeViewMessageButtons();
    }
</script>
