<x-default-layout>
<div class="container-fluid dashboard-container">
    <!-- Header with Notifications -->
    <div class="dashboard-header">
        <div class="header-left">
            <h1>Dashboard</h1>
            <p class="subtitle">Welcome to Perfume Store Admin Panel</p>
        </div>
        <div class="header-right">
            <div class="notification-icon-wrapper">
                <button class="notification-btn" id="notificationBtn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">{{ count($notifications) }}</span>
                </button>
                <div class="notification-dropdown" id="notificationDropdown">
                    <div class="notification-header">
                        <h6>Notifications</h6>
                        <span class="close-btn">&times;</span>
                    </div>
                    <div class="notification-list">
                        @forelse($notifications as $notification)
                            <div class="notification-item" onclick="openOrderModal({{ $notification->id }}, '{{ $notification->customer_name }}', '{{ $notification->email }}', '{{ $notification->phone }}', '{{ $notification->address }}', '{{ $notification->city }}', '{{ $notification->state }}', '{{ $notification->zip }}', {{ json_encode($notification->products) }}, {{ $notification->total }}, '{{ $notification->notes }}', '{{ $notification->status }}')" style="cursor: pointer;">
                                <div class="notification-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-title">New Order from {{ $notification->customer_name }}</p>
                                    <p class="notification-message">Order Total: Rs {{ number_format($notification->total, 2) }}</p>
                                    <p class="notification-time">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="notification-empty">
                                <i class="fas fa-inbox"></i>
                                <p>No notifications</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <!-- Profile Icon with Dropdown -->
            <div class="profile-icon-wrapper">
                <button class="profile-btn" id="profileBtn" data-bs-toggle="dropdown" aria-expanded="false" title="Profile">
                    <span class="profile-initial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown" id="profileDropdown">
                    <div class="dropdown-header fw-bold">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </div>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="javascript:void(0)" onclick="openProfileModal()">
                        <i class="fas fa-user me-2"></i> My Profile
                    </a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Status Cards -->
    <div class="review-status-cards">
        <div class="status-card pending" onclick="openOrdersByStatus('pending')">
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="card-content">
                <h3>{{ $pendingOrders }}</h3>
                <p>Pending Orders</p>
            </div>
            <div class="card-chart">
                <canvas id="pendingChart"></canvas>
            </div>
        </div>

        <div class="status-card approved" onclick="openOrdersByStatus('approved')">
            <div class="card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="card-content">
                <h3>{{ $approvedOrders }}</h3>
                <p>Approved Orders</p>
            </div>
            <div class="card-chart">
                <canvas id="approvedChart"></canvas>
            </div>
        </div>

        <div class="status-card rejected" onclick="openOrdersByStatus('rejected')">
            <div class="card-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="card-content">
                <h3>{{ $rejectedOrders }}</h3>
                <p>Rejected Orders</p>
            </div>
            <div class="card-chart">
                <canvas id="rejectedChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Email Subscriptions Section -->
    <div class="section email-subscriptions-section">
        <h2 class="section-title">
            <i class="fas fa-envelope"></i> Email Subscriptions
        </h2>

        <div class="subscription-list">
            <h5>Total Subscribers: <span class="subscriber-count">{{ count($emailSubscriptions) }}</span></h5>
            <div class="subscribers-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Subscribed Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($emailSubscriptions as $index => $subscription)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $subscription->email }}</td>
                                    <td>{{ $subscription->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <button class="btn-delete-subscription" onclick="deleteSubscription({{ $subscription->id }})">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <i class="fas fa-inbox" style="font-size: 2rem; color: #ccc; margin-bottom: 1rem; display: block;"></i>
                                        No subscribers yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Toast -->
    <div id="notificationToast" class="notification-toast" style="display: none;">
        <div class="toast-content">
            <i class="fas fa-check-circle"></i>
            <span id="toastMessage">Notification received</span>
        </div>
        <div class="toast-progress"></div>
    </div>

    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document" style="position: fixed; right: 20px; top: 50%; transform: translateY(-50%); margin: 0; width: 400px;">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
                    <h5 class="modal-title" id="profileModalLabel" style="margin: 0;">My Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: center; padding: 2rem;">
                    <div style="width: 100px; height: 100px; margin: 0 auto 1.5rem; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                        <span style="font-size: 2.5rem; color: white; font-weight: 700;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <h6 style="margin-bottom: 0.5rem; font-weight: 700; color: #000;">{{ Auth::user()->name ?? 'Admin' }}</h6>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders List Modal -->
    <div class="modal fade" id="ordersListModal" tabindex="-1" role="dialog" aria-labelledby="ordersListModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h5 class="modal-title" id="ordersListModalLabel" style="margin: 0;">
                        <span id="ordersStatusTitle"></span> Orders
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="ordersListModalBody">
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; font-size: 0.9rem; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #f0f0f0; border-bottom: 2px solid #eee;">
                                    <th style="text-align: left; padding: 1rem; font-weight: 600; color: #667eea;">#</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 600; color: #667eea;">Customer</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 600; color: #667eea;">Email</th>
                                    <th style="text-align: left; padding: 1rem; font-weight: 600; color: #667eea;">Phone</th>
                                    <th style="text-align: right; padding: 1rem; font-weight: 600; color: #667eea;">Total</th>
                                    <th style="text-align: center; padding: 1rem; font-weight: 600; color: #667eea;">Status</th>
                                    <th style="text-align: center; padding: 1rem; font-weight: 600; color: #667eea;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="ordersTableBody">
                                <!-- Orders will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                        <h5 class="modal-title" id="orderModalLabel" style="margin: 0;">Order Details</h5>
                        <span id="orderStatus" class="badge" style="margin-left: auto;"></span>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="orderModalBody">
                    <!-- Order details will be loaded here -->
                </div>
                <div class="modal-footer" style="border-top: 1px solid #eee; gap: 0.5rem;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="approveBtn" onclick="approveOrderFromModal()" style="padding: 0.5rem 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-check-circle"></i> Approve
                    </button>
                    <button type="button" class="btn btn-warning" id="pendingBtn" onclick="markOrderPendingFromModal()" style="padding: 0.5rem 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-clock"></i> Mark Pending
                    </button>
                    <button type="button" class="btn btn-danger" id="rejectBtn" onclick="rejectOrderFromModal()" style="padding: 0.5rem 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-times-circle"></i> Reject
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section" style="display: none;">
        <div class="chart-card">
            <h3 class="chart-title">Daily Sales (Last 30 Days)</h3>
            <canvas id="dailySalesChart"></canvas>
        </div>

        <div class="chart-card">
            <h3 class="chart-title">Monthly Sales (Last 12 Months)</h3>
            <canvas id="monthlySalesChart"></canvas>
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
    }

    .dashboard-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Header */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .header-left {
        flex: 1;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 1rem;
        justify-content: flex-end;
    }

    .notification-icon-wrapper {
        position: relative;
    }

    .notification-btn {
        background: #007bff;
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .notification-btn:hover {
        background: #0056b3;
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }

    .profile-btn {
        background: #6c757d;
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .profile-btn:hover {
        background: #5a6268;
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    }

    .profile-icon-wrapper {
        position: relative;
    }

    .profile-dropdown {
        background: white;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        min-width: 220px;
    }

    .profile-dropdown .dropdown-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 8px 8px 0 0;
        padding: 1rem;
    }

    .profile-dropdown .dropdown-item {
        padding: 0.7rem 1rem;
        transition: all 0.2s ease;
    }

    .profile-dropdown .dropdown-item:hover {
        background: #f5f5f5;
        color: #667eea;
        padding-left: 1.2rem;
    }

    .profile-dropdown .dropdown-divider {
        margin: 0.5rem 0;
    }

    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ff4444;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .notification-dropdown {
        position: absolute;
        top: 70px;
        right: 0;
        background: white;
        width: 350px;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        max-height: 400px;
        overflow-y: auto;
        display: none;
        z-index: 1000;
    }

    .notification-dropdown.show {
        display: block;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid #eee;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px 12px 0 0;
    }

    .notification-header h6 {
        margin: 0;
        font-weight: 700;
    }

    .close-btn {
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s;
    }

    .close-btn:hover {
        opacity: 1;
    }

    .notification-list {
        padding: 1rem;
    }

    .notification-item {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        background: #f9f9f9;
        transition: all 0.3s ease;
    }

    .notification-item:hover {
        background: #f0f0f0;
        transform: translateX(5px);
    }

    .notification-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }

    .notification-content {
        flex: 1;
    }

    .notification-title {
        font-weight: 600;
        color: #000;
        margin-bottom: 0.3rem;
        font-size: 0.9rem;
    }

    .notification-message {
        color: #666;
        font-size: 0.85rem;
        margin-bottom: 0.3rem;
    }

    .notification-time {
        color: #999;
        font-size: 0.75rem;
        margin: 0;
    }

    .notification-empty {
        text-align: center;
        padding: 2rem 1rem;
        color: #999;
    }

    .notification-empty i {
        font-size: 2rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    /* Review Status Cards */
    .review-status-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .status-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .status-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }

    .status-card.pending::before {
        background: linear-gradient(90deg, #ffc107, #ff9800);
    }

    .status-card.approved::before {
        background: linear-gradient(90deg, #28a745, #20c997);
    }

    .status-card.rejected::before {
        background: linear-gradient(90deg, #dc3545, #ff6b6b);
    }

    .status-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .status-card {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .card-icon {
        font-size: 3rem;
        width: 80px;
        height: 80px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .status-card.pending .card-icon {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }

    .status-card.approved .card-icon {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .status-card.rejected .card-icon {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .card-content {
        flex: 1;
    }

    .card-content h3 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #000;
        margin: 0;
    }

    .card-content p {
        color: #666;
        margin: 0.5rem 0 0 0;
        font-size: 0.95rem;
    }

    .card-chart {
        width: 80px;
        height: 40px;
    }

    /* Section Styling */
    .section {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #000;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .section-title i {
        color: #667eea;
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        border: none;
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        padding: 1rem;
        border-color: #eee;
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #eee;
    }

    .table tbody tr:hover {
        background: #f9f9f9;
        transform: scale(1.01);
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-weight: 600;
    }

    .author-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .rating-stars {
        color: #ffc107;
        font-size: 0.9rem;
    }

    .rating-stars i {
        margin-right: 0.2rem;
    }

    .review-text {
        color: #666;
        font-size: 0.9rem;
    }

    .order-total {
        color: #28a745;
        font-weight: 700;
        font-size: 1rem;
    }

    .product-count {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        padding: 0.3rem 0.8rem;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-approve, .btn-reject {
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-approve {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .btn-approve:hover {
        background: #28a745;
        color: white;
        transform: scale(1.1);
    }

    .btn-reject {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .btn-reject:hover {
        background: #dc3545;
        color: white;
        transform: scale(1.1);
    }

    /* Email Subscription Section */
    .subscription-list h5 {
        color: #000;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .subscriber-count {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .btn-delete-subscription {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .btn-delete-subscription:hover {
        background: #dc3545;
        color: white;
        transform: scale(1.05);
    }

    /* Charts Section */
    .charts-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 2rem;
    }

    .chart-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .chart-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #000;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #eee;
    }

    /* Notification Toast */
    .notification-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        z-index: 2000;
        animation: slideIn 0.3s ease-out;
        overflow: hidden;
    }

    .toast-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        color: #28a745;
        font-weight: 600;
    }

    .toast-content i {
        font-size: 1.5rem;
    }

    .toast-progress {
        height: 3px;
        background: linear-gradient(90deg, #28a745, #20c997);
        animation: slideOut 3s ease-in-out forwards;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            width: 100%;
        }
        to {
            width: 0;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .dashboard-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .dashboard-header h1 {
            font-size: 2rem;
        }

        .review-status-cards {
            grid-template-columns: 1fr;
        }

        .status-card {
            flex-direction: column;
            text-align: center;
        }

        .charts-section {
            grid-template-columns: 1fr;
        }

        .notification-dropdown {
            width: 90vw;
            right: -30px;
        }

        .subscription-form .input-group {
            flex-direction: column;
        }

        .notification-toast {
            right: 10px;
            left: 10px;
            width: auto;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Notification Toggle with Toast
    document.getElementById('notificationBtn').addEventListener('click', function() {
        const dropdown = document.getElementById('notificationDropdown');
        dropdown.classList.toggle('show');
    });

    document.querySelector('.close-btn').addEventListener('click', function() {
        document.getElementById('notificationDropdown').classList.remove('show');
    });

    // Close notification when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('notificationDropdown');
        const btn = document.getElementById('notificationBtn');
        if (!dropdown.contains(event.target) && !btn.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });

    // Show success toast
    function showSuccessToast(message) {
        // Toast removed - not needed
    }

    // Mini Charts
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { display: false },
            x: { display: false }
        }
    };

    // Daily Sales Chart
    const dailyCtx = document.getElementById('dailySalesChart')?.getContext('2d');
    if (dailyCtx) {
        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: {!! $dailyLabels !!},
                datasets: [{
                    label: 'Sales',
                    data: {!! $dailyData !!},
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, labels: { color: '#000', font: { size: 12 } } }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#666', font: { size: 11 } },
                        grid: { color: 'rgba(0, 0, 0, 0.05)' }
                    },
                    x: {
                        ticks: { color: '#666', font: { size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // Monthly Sales Chart
    const monthlyCtx = document.getElementById('monthlySalesChart')?.getContext('2d');
    if (monthlyCtx) {
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: {!! $monthlyLabels !!},
                datasets: [{
                    label: 'Sales',
                    data: {!! $monthlyData !!},
                    backgroundColor: 'rgba(102, 126, 234, 0.8)',
                    borderColor: '#667eea',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, labels: { color: '#000', font: { size: 12 } } }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#666', font: { size: 11 } },
                        grid: { color: 'rgba(0, 0, 0, 0.05)' }
                    },
                    x: {
                        ticks: { color: '#666', font: { size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
    }

    function approveOrder(orderId) {
        if (confirm('Are you sure you want to approve this order?')) {
            fetch(`/api/orders/${orderId}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Order approved successfully!');
                    location.reload();
                } else {
                    alert('Failed to approve order');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function rejectOrder(orderId) {
        if (confirm('Are you sure you want to reject this order?')) {
            fetch(`/api/orders/${orderId}/reject`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Order rejected successfully!');
                    location.reload();
                } else {
                    alert('Failed to reject order');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function deleteSubscription(subscriptionId) {
        // Implement API call to delete subscription
        console.log('Delete subscription:', subscriptionId);
    }

    // Open orders by status
    function openOrdersByStatus(status) {
        // Fetch orders from database based on status
        fetch(`/api/orders-by-status?status=${status}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const orders = data.orders || [];

            // Set title
            const titleMap = {
                'pending': 'Pending',
                'approved': 'Approved',
                'rejected': 'Rejected'
            };
            document.getElementById('ordersStatusTitle').textContent = titleMap[status];

            // Build table rows
            let tableHTML = '';
            let rowNumber = 1;

            orders.forEach(order => {
                const statusColor = order.status === 'approved' ? '#28a745' : 
                                   order.status === 'rejected' ? '#dc3545' : '#ffc107';
                const statusText = order.status ? order.status.toUpperCase() : 'PENDING';
                
                tableHTML += `
                    <tr style="border-bottom: 1px solid #eee; transition: all 0.3s ease;" onmouseover="this.style.background='#f9f9f9'" onmouseout="this.style.background='white'">
                        <td style="padding: 1rem; font-weight: 600; color: #667eea;">${rowNumber}</td>
                        <td style="padding: 1rem;">${order.customer_name}</td>
                        <td style="padding: 1rem;">${order.email}</td>
                        <td style="padding: 1rem;">${order.phone}</td>
                        <td style="padding: 1rem; text-align: right; font-weight: 600; color: #28a745;">Rs ${order.total.toLocaleString()}</td>
                        <td style="padding: 1rem; text-align: center;">
                            <span style="background: ${statusColor}; color: white; padding: 0.4rem 0.8rem; border-radius: 4px; font-weight: 600; font-size: 0.85rem;">
                                ${statusText}
                            </span>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <button class="btn btn-sm btn-primary view-order-btn" data-order-id="${order.id}" data-order-data='${JSON.stringify(order)}' title="View Order" style="padding: 0.3rem 0.8rem; font-size: 0.85rem; border: none; background: #007bff; cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteOrder(${order.id})" title="Delete Order" style="padding: 0.3rem 0.8rem; font-size: 0.85rem; border: none; background: #dc3545; cursor: pointer; margin-left: 0.3rem;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                rowNumber++;
            });

            // Add event listeners to view buttons
            setTimeout(() => {
                document.querySelectorAll('.view-order-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const orderData = JSON.parse(this.getAttribute('data-order-data'));
                        openOrderModal(
                            orderData.id,
                            orderData.customer_name,
                            orderData.email,
                            orderData.phone,
                            orderData.address,
                            orderData.city,
                            orderData.state,
                            orderData.zip,
                            orderData.products || [],
                            orderData.total,
                            orderData.notes || '',
                            orderData.status || 'pending'
                        );
                    });
                });
            }, 100);

            if (orders.length === 0) {
                tableHTML = `
                    <tr>
                        <td colspan="7" style="padding: 2rem; text-align: center; color: #999;">
                            <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                            No ${titleMap[status].toLowerCase()} orders
                        </td>
                    </tr>
                `;
            }

            document.getElementById('ordersTableBody').innerHTML = tableHTML;

            // Close current modals and open orders list modal
            const currentModal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
            if (currentModal) {
                currentModal.hide();
            }

            const ordersListModal = new bootstrap.Modal(document.getElementById('ordersListModal'));
            ordersListModal.show();
        })
        .catch(error => {
            console.error('Error fetching orders:', error);
            alert('Error loading orders');
        });
    }
    let currentOrderId = null;
    let currentOrderStatus = 'pending';

    function openOrderModal(orderId, customerName, email, phone, address, city, state, zip, products, total, notes, status = 'pending') {
        currentOrderId = orderId;
        currentOrderStatus = status || 'pending';
        
        let productsHTML = '';
        let rowNumber = 1;
        if (Array.isArray(products) && products.length > 0) {
            products.forEach(product => {
                const itemTotal = (product.price || 0) * (product.quantity || 1);
                productsHTML += `
                    <tr>
                        <td style="font-weight: 600; color: #667eea;">${rowNumber}</td>
                        <td>${product.name}</td>
                        <td>Rs ${(product.price || 0).toLocaleString()}</td>
                        <td style="text-align: center; font-weight: 600;">${product.quantity || 1}</td>
                        <td style="text-align: right; font-weight: 600; color: #28a745;">Rs ${itemTotal.toLocaleString()}</td>
                    </tr>
                `;
                rowNumber++;
            });
        }

        const modalBody = `
            <div style="padding: 0;">
                <h6 style="margin-bottom: 1rem; font-weight: 700; color: #667eea; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-user-circle"></i> Customer Information
                </h6>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
                    <div>
                        <p style="margin: 0; color: #999; font-size: 0.85rem;">Name</p>
                        <p style="margin: 0.5rem 0 0 0; font-weight: 600; color: #000;">${customerName}</p>
                    </div>
                    <div>
                        <p style="margin: 0; color: #999; font-size: 0.85rem;">Email</p>
                        <p style="margin: 0.5rem 0 0 0; font-weight: 600; color: #000;">${email}</p>
                    </div>
                    <div>
                        <p style="margin: 0; color: #999; font-size: 0.85rem;">Phone</p>
                        <p style="margin: 0.5rem 0 0 0; font-weight: 600; color: #000;">${phone}</p>
                    </div>
                </div>

                <h6 style="margin-bottom: 1rem; font-weight: 700; color: #667eea; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-map-marker-alt"></i> Shipping Address
                </h6>
                <div style="background: #f9f9f9; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border-left: 4px solid #667eea;">
                    <p style="margin: 0; color: #333; font-size: 0.9rem; font-weight: 500;">${address}</p>
                    <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.9rem;">${city}, ${state} ${zip}</p>
                </div>

                <h6 style="margin-bottom: 1rem; font-weight: 700; color: #667eea; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-shopping-bag"></i> Order Items
                </h6>
                <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 8px; border: 1px solid #eee;">
                    <table style="width: 100%; font-size: 0.9rem;">
                        <thead>
                            <tr style="background: #f0f0f0; border-bottom: 2px solid #eee;">
                                <th style="text-align: center; padding: 0.8rem; font-weight: 600; color: #667eea; width: 40px;">#</th>
                                <th style="text-align: left; padding: 0.8rem; font-weight: 600; color: #667eea;">Product</th>
                                <th style="text-align: left; padding: 0.8rem; font-weight: 600; color: #667eea;">Price</th>
                                <th style="text-align: center; padding: 0.8rem; font-weight: 600; color: #667eea;">Qty</th>
                                <th style="text-align: right; padding: 0.8rem; font-weight: 600; color: #667eea;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${productsHTML}
                        </tbody>
                    </table>
                </div>

                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.1rem; font-weight: 600;">Order Total:</span>
                        <span style="font-size: 1.8rem; font-weight: 700;">Rs ${total.toLocaleString()}</span>
                    </div>
                </div>

                <div id="approvalSection" style="display: none; margin-bottom: 1.5rem; padding: 1.5rem; border-radius: 8px; background: #f0f8f0; border-left: 4px solid #28a745;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-check-circle" style="font-size: 1.5rem; color: #28a745;"></i>
                        <div>
                            <p style="margin: 0; font-weight: 700; color: #28a745; font-size: 1rem;">✓ Order Approved</p>
                            <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.9rem;" id="approvalTime"></p>
                        </div>
                    </div>
                </div>

                <div id="rejectionSection" style="display: none; margin-bottom: 1.5rem; padding: 1.5rem; border-radius: 8px; background: #fff0f0; border-left: 4px solid #dc3545;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-times-circle" style="font-size: 1.5rem; color: #dc3545;"></i>
                        <div>
                            <p style="margin: 0; font-weight: 700; color: #dc3545; font-size: 1rem;">✕ Order Rejected</p>
                            <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.9rem;" id="rejectionTime"></p>
                        </div>
                    </div>
                </div>

                ${notes ? `
                    <h6 style="margin-bottom: 1rem; font-weight: 700; color: #667eea; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-sticky-note"></i> Special Instructions
                    </h6>
                    <p style="margin: 0; color: #666; padding: 1rem; background: #fff9e6; border-left: 4px solid #ffc107; border-radius: 4px;">${notes}</p>
                ` : ''}
            </div>
        `;

        document.getElementById('orderModalBody').innerHTML = modalBody;
        
        // Update status badge
        const statusBadge = document.getElementById('orderStatus');
        statusBadge.textContent = currentOrderStatus.toUpperCase();
        statusBadge.className = 'badge';
        if (currentOrderStatus === 'pending') {
            statusBadge.style.background = '#ffc107';
        } else if (currentOrderStatus === 'approved') {
            statusBadge.style.background = '#28a745';
        } else if (currentOrderStatus === 'rejected') {
            statusBadge.style.background = '#dc3545';
        }

        // Update button visibility based on status
        const approveBtn = document.getElementById('approveBtn');
        const rejectBtn = document.getElementById('rejectBtn');
        const pendingBtn = document.getElementById('pendingBtn');

        if (currentOrderStatus === 'pending') {
            // If pending: show Approve and Reject buttons, hide Pending button
            approveBtn.style.display = 'flex';
            rejectBtn.style.display = 'flex';
            pendingBtn.style.display = 'none';
        } else if (currentOrderStatus === 'approved') {
            // If approved: show Reject and Pending buttons, hide Approve button
            approveBtn.style.display = 'none';
            rejectBtn.style.display = 'flex';
            pendingBtn.style.display = 'flex';
        } else if (currentOrderStatus === 'rejected') {
            // If rejected: show Approve and Pending buttons, hide Reject button
            approveBtn.style.display = 'flex';
            rejectBtn.style.display = 'none';
            pendingBtn.style.display = 'flex';
        }

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('orderModal'));
        modal.show();
    }

    function approveOrderFromModal() {
        if (!currentOrderId) return;
        
        if (confirm('Are you sure you want to approve this order?')) {
            fetch(`/api/orders/${currentOrderId}/approve`, {
                method: 'POST',
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
                    currentOrderStatus = 'approved';
                    const statusBadge = document.getElementById('orderStatus');
                    statusBadge.textContent = 'APPROVED';
                    statusBadge.style.background = '#28a745';
                    
                    // Show approval section
                    const approvalSection = document.getElementById('approvalSection');
                    approvalSection.style.display = 'block';
                    document.getElementById('approvalTime').textContent = 'Approved at ' + new Date().toLocaleString();
                    
                    // Update buttons for approved status
                    document.getElementById('approveBtn').style.display = 'none';
                    document.getElementById('rejectBtn').style.display = 'flex';
                    document.getElementById('pendingBtn').style.display = 'flex';
                    
                    // Update status cards
                    setTimeout(() => {
                        updateStatusCards();
                        // Close modal after 1 second
                        setTimeout(() => {
                            const modal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
                            if (modal) modal.hide();
                        }, 1000);
                    }, 500);
                } else {
                    alert('Failed to approve order: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error approving order: ' + error.message);
            });
        }
    }

    function rejectOrderFromModal() {
        if (!currentOrderId) return;
        
        if (confirm('Are you sure you want to reject this order?')) {
            fetch(`/api/orders/${currentOrderId}/reject`, {
                method: 'POST',
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
                    currentOrderStatus = 'rejected';
                    const statusBadge = document.getElementById('orderStatus');
                    statusBadge.textContent = 'REJECTED';
                    statusBadge.style.background = '#dc3545';
                    
                    // Show rejection section
                    const rejectionSection = document.getElementById('rejectionSection');
                    rejectionSection.style.display = 'block';
                    document.getElementById('rejectionTime').textContent = 'Rejected at ' + new Date().toLocaleString();
                    
                    // Update buttons for rejected status
                    document.getElementById('approveBtn').style.display = 'flex';
                    document.getElementById('rejectBtn').style.display = 'none';
                    document.getElementById('pendingBtn').style.display = 'flex';
                    
                    // Update status cards
                    setTimeout(() => {
                        updateStatusCards();
                        // Close modal after 1 second
                        setTimeout(() => {
                            const modal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
                            if (modal) modal.hide();
                        }, 1000);
                    }, 500);
                } else {
                    alert('Failed to reject order: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error rejecting order: ' + error.message);
            });
        }
    }

    function markOrderPendingFromModal() {
        if (!currentOrderId) return;
        
        if (confirm('Are you sure you want to mark this order as pending?')) {
            // Create a new endpoint to mark as pending, or update the existing one
            fetch(`/api/orders/${currentOrderId}/pending`, {
                method: 'POST',
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
                    currentOrderStatus = 'pending';
                    const statusBadge = document.getElementById('orderStatus');
                    statusBadge.textContent = 'PENDING';
                    statusBadge.style.background = '#ffc107';
                    
                    // Hide approval and rejection sections
                    document.getElementById('approvalSection').style.display = 'none';
                    document.getElementById('rejectionSection').style.display = 'none';
                    
                    // Update buttons for pending status
                    document.getElementById('approveBtn').style.display = 'flex';
                    document.getElementById('rejectBtn').style.display = 'flex';
                    document.getElementById('pendingBtn').style.display = 'none';
                    
                    // Update status cards
                    setTimeout(() => {
                        updateStatusCards();
                    }, 500);
                } else {
                    alert('Failed to mark order as pending: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error marking order as pending: ' + error.message);
            });
        }
    }

    function deleteOrder(orderId) {
        if (!orderId) return;
        
        if (confirm('Are you sure you want to delete this order? This action cannot be undone.')) {
            fetch(`/api/orders/${orderId}`, {
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
                    alert('Order deleted successfully!');
                    // Close modal and refresh orders list
                    const modal = bootstrap.Modal.getInstance(document.getElementById('ordersListModal'));
                    if (modal) modal.hide();
                    // Refresh the orders list by clicking the current status card
                    setTimeout(() => {
                        updateStatusCards();
                        location.reload(); // Reload page to refresh data
                    }, 500);
                } else {
                    alert('Failed to delete order: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting order: ' + error.message);
            });
        }
    }

    function updateStatusCards() {
        // Fetch updated counts from API
        fetch('/api/status-counts', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update pending count
                document.querySelectorAll('.status-card.pending .card-content h3')[0].textContent = data.pending;
                // Update approved count
                document.querySelectorAll('.status-card.approved .card-content h3')[0].textContent = data.approved;
                // Update rejected count
                document.querySelectorAll('.status-card.rejected .card-content h3')[0].textContent = data.rejected;
            }
        })
        .catch(error => console.error('Error updating status cards:', error));
    }

    function showSuccessToast(message) {
        const toast = document.getElementById('notificationToast');
        const toastContent = toast.querySelector('.toast-content');
        const toastMessage = document.getElementById('toastMessage');
        
        toastContent.style.color = '#28a745';
        toastMessage.textContent = message;
        toastContent.querySelector('i').className = 'fas fa-check-circle';
        
        toast.style.display = 'block';
        
        setTimeout(() => {
            toast.style.display = 'none';
        }, 3000);
    }

    function openProfileModal() {
        // Close the profile dropdown
        const profileBtn = document.getElementById('profileBtn');
        if (profileBtn && profileBtn.classList.contains('show')) {
            profileBtn.click();
        }
        
        // Open profile modal
        const modal = new bootstrap.Modal(document.getElementById('profileModal'));
        modal.show();
    }
</script>

</x-default-layout>
