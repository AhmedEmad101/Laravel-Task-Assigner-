@extends('layouts.app')

@section('title', 'Add Team Member - TaskFlow')

@section('styles')
<style>
    .member-form-wrapper {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .member-form-container {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: var(--card-shadow);
        width: 100%;
        max-width: 700px;
        position: relative;
        overflow: hidden;
        animation: slideUp 0.5s ease;
    }

    .member-form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 10px 25px rgba(79, 172, 254, 0.2);
    }

    .form-icon i {
        font-size: 2.5rem;
        color: white;
    }

    .form-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 10px;
    }

    .form-header p {
        color: #666;
        font-size: 0.95rem;
    }

    .team-info-card {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
        border-left: 4px solid var(--primary-color);
    }

    .team-info-icon {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .team-info-icon i {
        font-size: 1.5rem;
        color: var(--primary-color);
    }

    .team-info-details {
        flex: 1;
    }

    .team-info-label {
        font-size: 0.8rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .team-info-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 0.95rem;
    }

    .form-group label i {
        margin-right: 8px;
        color: var(--primary-color);
    }

    .search-input-group {
        position: relative;
    }

    .search-input-group input {
        width: 100%;
        padding: 12px 45px 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
    }

    .search-input-group input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
    }

    .search-input-group i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    .search-results {
        margin-top: 15px;
        max-height: 300px;
        overflow-y: auto;
        border-radius: 12px;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        display: none;
    }

    .search-results.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    .result-item {
        padding: 12px 15px;
        border-bottom: 1px solid #e9ecef;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .result-item:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }

    .result-item:last-child {
        border-bottom: none;
    }

    .result-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    .result-info {
        flex: 1;
    }

    .result-name {
        font-weight: 600;
        color: #333;
    }

    .result-id {
        font-size: 0.8rem;
        color: #888;
    }

    .result-email {
        font-size: 0.8rem;
        color: #666;
    }

    .loading-indicator {
        text-align: center;
        padding: 20px;
        color: var(--primary-color);
    }

    .no-results {
        text-align: center;
        padding: 20px;
        color: #999;
    }

    .selected-member {
        background: linear-gradient(135deg, rgba(79, 172, 254, 0.1), rgba(0, 242, 254, 0.1));
        border-radius: 12px;
        padding: 15px;
        margin-top: 15px;
        display: none;
        align-items: center;
        gap: 12px;
    }

    .selected-member.active {
        display: flex;
        animation: fadeIn 0.3s ease;
    }

    .selected-member-info {
        flex: 1;
    }

    .selected-member-label {
        font-size: 0.8rem;
        color: #888;
    }

    .selected-member-name {
        font-weight: 600;
        color: #333;
    }

    .clear-selection {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 1.2rem;
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .submit-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(79, 172, 254, 0.3);
    }

    .submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .cancel-btn {
        width: 100%;
        padding: 14px;
        background: white;
        color: #666;
        font-size: 16px;
        font-weight: 600;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
        text-decoration: none;
    }

    .cancel-btn:hover {
        background: #f8f9fa;
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .member-form-container {
            padding: 30px 20px;
        }

        .team-info-card {
            flex-direction: column;
            text-align: center;
        }

        .result-item {
            flex-direction: column;
            text-align: center;
        }
    }

    /* Custom scrollbar */
    .search-results::-webkit-scrollbar {
        width: 8px;
    }

    .search-results::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .search-results::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .search-results::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endsection

@section('content')
<div class="member-form-wrapper">
    <div class="member-form-container">
        <div class="form-header">
            <div class="form-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h2>Add Team Member</h2>
            <p>Search and add new members to your team</p>
        </div>

        <!-- Flash Messages -->
        @if(session('Success_add_member'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('Success_add_member') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('Failed_add_member'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('Failed_add_member') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Team Information -->
        @if(session('Team_Name') || isset($teamName))
        <div class="team-info-card">
            <div class="team-info-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="team-info-details">
                <div class="team-info-label">Adding member to</div>
                <div class="team-info-name">{{ session('Team_Name') ?? $teamName ?? 'Team' }}</div>
            </div>
        </div>
        @endif

        <form action="{{ url('/addteammember/' . (session('Team_ID') ?? $teamId)) }}" method="GET" id="memberForm">
            @csrf
            <input type="hidden" id="user_id" name="UserId" value="">
            <input type="hidden" id="selected_user_id" name="selected_user_id">
            
            <div class="form-group">
                <label for="search_member">
                    <i class="bi bi-search"></i> Search Member
                </label>
                <div class="search-input-group">
                    <input type="text" 
                           id="search_member" 
                           name="search" 
                           placeholder="Search by name, email, or ID..." 
                           autocomplete="off"
                           required>
                    <i class="bi bi-person"></i>
                </div>
                <div id="search_results" class="search-results"></div>
                <div id="selected_member" class="selected-member">
                    <i class="bi bi-person-check-fill fs-3 text-success"></i>
                    <div class="selected-member-info">
                        <div class="selected-member-label">Selected Member</div>
                        <div class="selected-member-name" id="selected_member_name"></div>
                    </div>
                    <button type="button" class="clear-selection" onclick="clearSelection()">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn" disabled>
                <i class="bi bi-person-plus"></i> Add Member
            </button>
            
            <a href="{{ url('/allmyteams') }}" class="cancel-btn">
                <i class="bi bi-arrow-left"></i> Cancel
            </a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    let selectedUser = null;
    let searchTimeout = null;

    document.addEventListener('DOMContentLoaded', function() {
        // Set user ID from localStorage or global variable
        const userId = localStorage.getItem('id') || '{{ $userId ?? "" }}';
        const userIdField = document.getElementById('user_id');
        if (userIdField && userId) {
            userIdField.value = userId;
        }

        // Search functionality with debounce
        const searchInput = document.getElementById('search_member');
        const searchResults = document.getElementById('search_results');
        const submitBtn = document.getElementById('submitBtn');

        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const query = this.value.trim();
                
                // Clear previous timeout
                if (searchTimeout) {
                    clearTimeout(searchTimeout);
                }
                
                if (query.length < 2) {
                    searchResults.classList.remove('active');
                    searchResults.innerHTML = '';
                    return;
                }
                
                // Debounce search
                searchTimeout = setTimeout(() => {
                    performSearch(query);
                }, 300);
            });
        }

        // Form validation
        const form = document.getElementById('memberForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (!selectedUser) {
                    e.preventDefault();
                    showError('Please select a member to add');
                    return false;
                }
                
                // Set the selected user ID before submit
                const selectedUserIdInput = document.getElementById('selected_user_id');
                if (selectedUserIdInput) {
                    selectedUserIdInput.value = selectedUser.id;
                }
            });
        }
    });

    // Perform search via AJAX
    function performSearch(query) {
        const searchResults = document.getElementById('search_results');
        
        // Show loading state
        searchResults.innerHTML = '<div class="loading-indicator"><i class="bi bi-hourglass-split"></i> Searching...</div>';
        searchResults.classList.add('active');
        
        $.ajax({
            url: "{{ url('/searchuser') }}",
            type: "GET",
            data: { search: query },
            success: function(data) {
                if (data && data.length > 0) {
                    displaySearchResults(data);
                } else {
                    searchResults.innerHTML = '<div class="no-results"><i class="bi bi-emoji-frown"></i> No users found</div>';
                }
            },
            error: function(xhr, status, error) {
                console.error('Search error:', error);
                searchResults.innerHTML = '<div class="no-results"><i class="bi bi-exclamation-triangle"></i> Error searching users</div>';
            }
        });
    }

    // Display search results
    function displaySearchResults(users) {
        const searchResults = document.getElementById('search_results');
        
        let html = '';
        users.forEach(user => {
            const initial = user.name ? user.name.charAt(0).toUpperCase() : 'U';
            html += `
                <div class="result-item" onclick="selectMember(${JSON.stringify(user).replace(/"/g, '&quot;')})">
                    <div class="result-avatar">${initial}</div>
                    <div class="result-info">
                        <div class="result-name">${escapeHtml(user.name || 'Unknown')}</div>
                        <div class="result-id">ID: ${user.id}</div>
                        ${user.email ? `<div class="result-email">${escapeHtml(user.email)}</div>` : ''}
                    </div>
                </div>
            `;
        });
        
        searchResults.innerHTML = html;
        searchResults.classList.add('active');
    }

    // Select a member from search results
    function selectMember(user) {
        selectedUser = user;
        
        const searchInput = document.getElementById('search_member');
        const searchResults = document.getElementById('search_results');
        const selectedMemberDiv = document.getElementById('selected_member');
        const selectedMemberName = document.getElementById('selected_member_name');
        const submitBtn = document.getElementById('submitBtn');
        
        // Update input with selected user info
        searchInput.value = `${user.name || user.id} (ID: ${user.id})`;
        
        // Show selected member info
        selectedMemberName.textContent = `${user.name || 'User'} (ID: ${user.id})`;
        selectedMemberDiv.classList.add('active');
        
        // Hide search results
        searchResults.classList.remove('active');
        searchResults.innerHTML = '';
        
        // Enable submit button
        submitBtn.disabled = false;
        
        // Clear any errors
        clearError();
    }

    // Clear current selection
    function clearSelection() {
        selectedUser = null;
        
        const searchInput = document.getElementById('search_member');
        const selectedMemberDiv = document.getElementById('selected_member');
        const submitBtn = document.getElementById('submitBtn');
        
        searchInput.value = '';
        selectedMemberDiv.classList.remove('active');
        submitBtn.disabled = true;
        searchInput.focus();
    }

    // Helper function to escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Show error message
    function showError(message) {
        // Check if SweetAlert is available
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
                confirmButtonColor: '#dc3545'
            });
        } else {
            alert(message);
        }
    }

    function clearError() {
        const errorDiv = document.querySelector('.error-message');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    // Close search results when clicking outside
    document.addEventListener('click', function(e) {
        const searchResults = document.getElementById('search_results');
        const searchInput = document.getElementById('search_member');
        
        if (searchResults && searchInput) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.classList.remove('active');
            }
        }
    });

    // Handle enter key in search input
    document.getElementById('search_member')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            if (selectedUser) {
                document.getElementById('memberForm').submit();
            }
        }
    });
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection