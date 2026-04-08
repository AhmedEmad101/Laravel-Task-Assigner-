@extends('layouts.app')

@section('title', 'Dashboard - Task Assigner')

@section('styles')
<style>
    .welcome-section {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-top: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }

    .welcome-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    .user-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        font-weight: bold;
        margin: 0 auto 20px;
        border: 4px solid white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .dashboard-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        height: 100%;
        transition: all 0.3s ease;
        border: none;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--hover-shadow);
    }

    .dashboard-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    .card-icon {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 2rem;
    }

    .card-title {
        color: #333;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 1.3rem;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 30px;
    }

    .notification-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #ff4757;
        color: white;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: bold;
        z-index: 1;
    }

    .stats-card {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin: 10px 0;
    }

    .stats-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
</style>
@endsection

@section('content')
    <!-- Welcome Section -->
    <div class="welcome-section">
        <div class="user-avatar" id="userAvatar">
            U
        </div>
        <h1 class="text-center mb-3">Welcome back, <span id="userDisplayName" class="gradient-text">User</span>! 👋</h1>
        <p class="text-center text-muted mb-4">Here's what's happening with your projects today</p>
        
        <!-- Quick Stats -->
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <i class="bi bi-check-circle fs-4"></i>
                    <div class="stats-number" id="tasksCount">0</div>
                    <div class="stats-label">Active Tasks</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <i class="bi bi-folder fs-4"></i>
                    <div class="stats-number" id="projectsCount">0</div>
                    <div class="stats-label">Projects</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <i class="bi bi-people fs-4"></i>
                    <div class="stats-number" id="teamsCount">0</div>
                    <div class="stats-label">Teams</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stats-card">
                    <i class="bi bi-clock fs-4"></i>
                    <div class="stats-number" id="pendingCount">0</div>
                    <div class="stats-label">Pending</div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn btn-primary btn-lg" onclick="location.href='{{ url('/team') }}'">
                <i class="bi bi-people-fill me-2"></i> Create Team
            </button>
            <button class="btn btn-primary btn-lg" onclick="location.href='{{ url('/project') }}'">
                <i class="bi bi-folder-plus me-2"></i> Create Project
            </button>
            <button class="btn btn-primary btn-lg" onclick="location.href='{{ url('/send') }}'">
                <i class="bi bi-chat-dots me-2"></i> Send SMS
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success-addteam'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success-addteam') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('task_created'))
        <div class="alert alert-info alert-dismissible fade show mt-4" role="alert">
            <i class="bi bi-bell-fill me-2"></i>
            {{ session('task_created') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('project_created'))
        <div class="alert alert-info alert-dismissible fade show mt-4" role="alert">
            <i class="bi bi-bell-fill me-2"></i>
            {{ session('project_created') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Dashboard Cards -->
    <div class="row mt-5 g-4">
        <!-- My Tasks Card -->
        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card">
                @if (session('task_created'))
                    <div class="notification-badge">1</div>
                @endif
                <div class="card-icon">
                    <i class="bi bi-check-square"></i>
                </div>
                <h3 class="card-title text-center">My Tasks</h3>
                <p class="card-text text-center">Manage your assigned tasks, track progress, and meet deadlines efficiently.</p>
                <div class="text-center mt-4">
                    <form action="{{ url('/mytasks') }}" method="GET" class="d-inline-block me-2 mb-2">
                        @csrf
                        <input type="hidden" name="TaskCreator" id="TaskCreator">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-eye me-1"></i> View Tasks
                        </button>
                    </form>
                    <form action="{{ url('/workon') }}" method="get" class="d-inline-block mb-2">
                        @csrf
                        <input type="hidden" name="Assignment" id="Assignmentorid">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-person-check me-1"></i> Assignments
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- My Projects Card -->
        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card">
                @if (session('project_created'))
                    <div class="notification-badge">1</div>
                @endif
                <div class="card-icon">
                    <i class="bi bi-folder2-open"></i>
                </div>
                <h3 class="card-title text-center">My Projects</h3>
                <p class="card-text text-center">Organize, monitor, and collaborate on all your projects in one place.</p>
                <div class="text-center mt-4">
                    <form action="{{ url('/allmyprojects') }}" method="GET">
                        @csrf
                        <input type="hidden" name="Authorid" id="Authorid">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-folder2 me-1"></i> View Projects
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- My Teams Card -->
        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h3 class="card-title text-center">My Teams</h3>
                <p class="card-text text-center">Collaborate with team members, assign roles, and manage team activities.</p>
                <div class="text-center mt-4">
                    <form action="{{ url('/allmyteams') }}" method="GET">
                        @csrf
                        <input type="hidden" name="CreatorID" id="Creatorid">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-people-fill me-1"></i> View Teams
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="dashboard-card">
                <h3 class="card-title mb-4">
                    <i class="bi bi-activity me-2"></i> Recent Activity
                </h3>
                <div class="list-group">
                    <div class="list-group-item border-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                <i class="bi bi-plus-circle text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <span>New task created</span>
                                    <small class="text-muted">2 minutes ago</small>
                                </div>
                                <small class="text-muted">Design Homepage</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item border-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                <i class="bi bi-check-circle text-success"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <span>Project completed</span>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                                <small class="text-muted">Mobile App Development</small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item border-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                <i class="bi bi-person-plus text-info"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <span>New team member added</span>
                                    <small class="text-muted">Yesterday</small>
                                </div>
                                <small class="text-muted">John Doe joined Design Team</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update user avatar with initial
        if (typeof userEmail !== 'undefined') {
            const name = userEmail.split('@')[0];
            const displayName = name.charAt(0).toUpperCase() + name.slice(1);
            document.getElementById('userDisplayName').textContent = displayName;
            document.getElementById('userAvatar').textContent = name.charAt(0).toUpperCase();
        }

        // Fetch dashboard stats (you'll need to implement these API endpoints)
        if (typeof userId !== 'undefined' && typeof token !== 'undefined') {
            // Example: Fetch task count
            fetch(`/api/user/${userId}/tasks/count`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.count !== undefined) {
                    document.getElementById('tasksCount').textContent = data.count;
                }
            })
            .catch(console.error);

            // Add similar fetches for projectsCount, teamsCount, pendingCount
        }

        // Sample data for demonstration
        setTimeout(() => {
            document.getElementById('tasksCount').textContent = '12';
            document.getElementById('projectsCount').textContent = '5';
            document.getElementById('teamsCount').textContent = '3';
            document.getElementById('pendingCount').textContent = '7';
        }, 1000);
    });
</script>
@endsection