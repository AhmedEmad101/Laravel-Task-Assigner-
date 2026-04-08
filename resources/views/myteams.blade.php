@extends('layouts.app')

@section('title', 'My Teams - TaskFlow')

@section('styles')
<style>
    .teams-header {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-top: 20px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }

    .teams-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 10px;
    }

    .teams-stats {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 15px;
        padding: 15px 20px;
        margin-bottom: 30px;
    }

    .team-card {
        background: white;
        border-radius: 15px;
        margin-bottom: 30px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }

    .team-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        padding: 20px 25px;
        color: white;
        position: relative;
    }

    .team-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }

    .team-name i {
        font-size: 1.8rem;
    }

    .team-badge {
        background: rgba(255,255,255,0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .team-leader {
        margin-top: 10px;
        font-size: 0.9rem;
        opacity: 0.95;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .team-leader i {
        font-size: 1rem;
    }

    .team-body {
        padding: 25px;
    }

    .members-section {
        margin-bottom: 25px;
    }

    .members-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.1rem;
    }

    .members-title i {
        color: var(--primary-color);
    }

    .member-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .member-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 15px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .member-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .member-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .member-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1rem;
    }

    .member-details {
        flex: 1;
    }

    .member-id {
        font-weight: 600;
        color: #333;
    }

    .member-joined {
        font-size: 0.8rem;
        color: #888;
    }

    .leader-badge {
        background: #28a745;
        color: white;
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .member-actions {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        padding: 5px 10px;
        font-size: 0.85rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .team-actions {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }

    .btn-action {
        padding: 8px 20px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add-member {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: white;
    }

    .btn-add-member:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        color: white;
    }

    .btn-edit {
        background-color: #ffc107;
        border: none;
        color: #333;
    }

    .btn-edit:hover {
        background-color: #ffb300;
        transform: translateY(-2px);
    }

    .btn-delete {
        background-color: #dc3545;
        border: none;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    .btn-delete-member {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-delete-member:hover {
        color: #c82333;
        transform: scale(1.1);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
    }

    .empty-state-icon {
        font-size: 4rem;
        color: var(--primary-color);
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state-title {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
    }

    .empty-state-text {
        color: #666;
        margin-bottom: 20px;
    }

    .breadcrumb-custom {
        background: transparent;
        padding: 0;
        margin-bottom: 20px;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: #666;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .team-card {
        animation: fadeIn 0.5s ease forwards;
    }

    .stats-number {
        font-size: 1.8rem;
        font-weight: bold;
        color: var(--primary-color);
    }

    .stats-label {
        color: #666;
        font-size: 0.9rem;
    }
</style>
@endsection

@section('content')
    <!-- Header Section -->
    <div class="teams-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item">
                    <a href="{{ url('/home') }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="bi bi-people me-1"></i> My Teams
                </li>
            </ol>
        </nav>
        
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="page-title">
                    <i class="bi bi-people-fill me-2"></i>Teams List
                </h1>
                <p class="text-muted mb-0">Manage your teams, add members, and collaborate effectively</p>
            </div>
            <button class="btn btn-primary btn-lg" onclick="location.href='{{ url('/team') }}'">
                <i class="bi bi-plus-circle me-2"></i>Create New Team
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('Success_add_member'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('Success_add_member') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('team_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('team_deleted') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('member_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('member_deleted') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('Failed_add_member'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('Failed_add_member') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Teams Stats -->
    <div class="teams-stats">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-people fs-3 text-primary"></i>
                    </div>
                    <div>
                        <div class="stats-number">{{ count($teams) }}</div>
                        <div class="stats-label">Total Teams</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-person-check fs-3 text-success"></i>
                    </div>
                    <div>
                        <div class="stats-number" id="totalMembers">0</div>
                        <div class="stats-label">Total Members</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="searchTeam" placeholder="Search teams...">
                </div>
            </div>
        </div>
    </div>

    <!-- Teams List -->
    @if(count($teams) > 0)
        <div class="teams-list" id="teamsList">
            @php $totalMembersCount = 0; @endphp
            @foreach ($teams as $teamName => $teamMembers)
                @php 
                    $firstMember = $teamMembers->first();
                    $leaderId = $firstMember ? $firstMember->leader_Id : 'N/A';
                    $teamId = $firstMember ? $firstMember->id : null;
                    $memberCount = $teamMembers->count();
                    $totalMembersCount += $memberCount;
                @endphp
                
                <div class="team-card" data-team-name="{{ strtolower($teamName) }}">
                    <div class="team-header">
                        <div class="team-name">
                            <div>
                                <i class="bi bi-people-fill me-2"></i>
                                {{ $teamName }}
                            </div>
                            <span class="team-badge">
                                <i class="bi bi-person"></i> {{ $memberCount }} Members
                            </span>
                        </div>
                        <div class="team-leader">
                            <i class="bi bi-crown"></i>
                            Team Leader: <strong>ID {{ $leaderId }}</strong>
                        </div>
                    </div>
                    
                    <div class="team-body">
                        <!-- Members Section -->
                        <div class="members-section">
                            <div class="members-title">
                                <i class="bi bi-person-badge"></i>
                                Team Members
                                <span class="badge bg-secondary ms-2">{{ $memberCount }}</span>
                            </div>
                            
                            @if($memberCount > 0)
                                <div class="member-list">
                                    @foreach ($teamMembers as $member)
                                        <div class="member-item">
                                            <div class="member-info">
                                                <div class="member-avatar">
                                                    {{ substr($member->member_id, 0, 1) }}
                                                </div>
                                                <div class="member-details">
                                                    <div class="member-id">
                                                        Member ID: {{ $member->member_id }}
                                                            : {{ $member->name }}
                                                        @if($member->member_id == $leaderId)
                                                            <span class="leader-badge">
                                                                <i class="bi bi-star-fill"></i> Leader
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="member-joined">
                                                        <i class="bi bi-clock"></i> 
                                                        Joined {{ $member->created_at ? $member->created_at->diffForHumans() : 'Recently' }}
                                                    </div>
                                                </div>
                                            </div>
                                            @if($member->member_id != $leaderId)
                                                <div class="member-actions">
                                                    <form action="{{ url('/DeleteTeamMember/' . $teamName . '/' . $member->member_id) }}" 
                                                          method="POST" 
                                                          id="delete-member-form-{{ $teamId }}-{{ $member->member_id }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" 
                                                                class="btn-delete-member" 
                                                                onclick="confirmDeleteMember('{{ $teamName }}', '{{ $member->member_id }}', {{ $teamId }})"
                                                                title="Remove member">
                                                            <i class="bi bi-person-x fs-5"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center text-muted py-3">
                                    <i class="bi bi-people fs-1 opacity-50"></i>
                                    <p>No members yet</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Team Actions -->
                        <div class="team-actions">
                            <form action="{{ url('/toteammember') }}" method="GET" class="d-inline">
                                @csrf
                                <input type="hidden" name="Leader_ID" value="{{ $leaderId }}">
                                <input type="hidden" name="Team_ID" value="{{ $teamId }}">
                                <input type="hidden" name="Team_Name" value="{{ $teamName }}">
                                <button type="submit" class="btn-action btn-add-member">
                                    <i class="bi bi-person-plus"></i> Add Member
                                </button>
                            </form>
                            
                            <button class="btn-action btn-edit" onclick="editTeam({{ $teamId }})">
                                <i class="bi bi-pencil"></i> Edit Team
                            </button>
                            
                            <form action="{{ url('/DeleteTeam/' . $teamId) }}" method="POST" id="delete-team-form-{{ $teamId }}" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn-action btn-delete" onclick="confirmDeleteTeam({{ $teamId }})">
                                    <i class="bi bi-trash"></i> Delete Team
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <script>
            // Update total members count
            document.getElementById('totalMembers').textContent = '{{ $totalMembersCount }}';
        </script>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-people"></i>
            </div>
            <h3 class="empty-state-title">No Teams Yet</h3>
            <p class="empty-state-text">Create a team to start collaborating with your colleagues!</p>
            <button class="btn btn-primary btn-lg" onclick="location.href='{{ url('/team') }}'">
                <i class="bi bi-plus-circle me-2"></i>Create New Team
            </button>
        </div>
    @endif
@endsection

@section('scripts')
<script>
    // Search functionality
    document.getElementById('searchTeam')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const teams = document.querySelectorAll('.team-card');
        
        teams.forEach(team => {
            const teamName = team.getAttribute('data-team-name');
            if (teamName.includes(searchTerm)) {
                team.style.display = 'block';
                team.style.animation = 'fadeIn 0.5s ease forwards';
            } else {
                team.style.display = 'none';
            }
        });
    });

    // Delete team confirmation
    function confirmDeleteTeam(teamId) {
        Swal.fire({
            title: 'Delete Team?',
            text: "This action cannot be undone! All team members will be removed and associated data will be lost.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete team!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-team-form-${teamId}`).submit();
            }
        });
    }

    // Delete member confirmation
    function confirmDeleteMember(teamName, memberId, teamId) {
        Swal.fire({
            title: 'Remove Member?',
            text: `Are you sure you want to remove member ID ${memberId} from this team?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, remove member',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-member-form-${teamId}-${memberId}`).submit();
            }
        });
    }

    // Edit team function
    function editTeam(teamId) {
        Swal.fire({
            title: 'Edit Team',
            text: 'This feature is coming soon!',
            icon: 'info',
            confirmButtonText: 'OK'
        });
    }

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            setTimeout(() => bsAlert.close(), 5000);
        });
    }, 1000);
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection