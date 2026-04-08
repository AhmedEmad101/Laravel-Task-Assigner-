@extends('layouts.app')

@section('title', 'My Projects - TaskFlow')

@section('styles')
<style>
    .projects-header {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-top: 20px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }

    .projects-header::before {
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

    .projects-stats {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 15px;
        padding: 15px 20px;
        margin-bottom: 30px;
    }

    .project-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }

    .project-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(180deg, var(--primary-color), var(--accent-color));
    }

    .project-name {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .project-badge {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .project-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .project-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
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

    .btn-action i {
        font-size: 1.1rem;
    }

    .btn-create-task {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: white;
    }

    .btn-create-task:hover {
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

    .project-card {
        animation: fadeIn 0.5s ease forwards;
    }
</style>
@endsection

@section('content')
    <!-- Header Section -->
    <div class="projects-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item">
                    <a href="{{ url('/home') }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="bi bi-folder2-open me-1"></i> My Projects
                </li>
            </ol>
        </nav>
        
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="page-title">
                    <i class="bi bi-folder2-open me-2"></i>Projects List
                </h1>
                <p class="text-muted mb-0">Manage and organize all your projects in one place</p>
            </div>
            <button class="btn btn-primary btn-lg" onclick="location.href='{{ url('/project') }}'">
                <i class="bi bi-plus-circle me-2"></i>Create New Project
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('task_created'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-bell-fill me-2"></i>
            {{ session('task_created') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Projects Stats -->
    <div class="projects-stats">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-folder2-open fs-3 text-primary"></i>
                    </div>
                    <div>
                        <h3 class="mb-0">{{ count($projects) }}</h3>
                        <p class="text-muted mb-0">Total Projects</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="searchProject" placeholder="Search projects...">
                </div>
            </div>
        </div>
    </div>

    <!-- Projects List -->
    @if(count($projects) > 0)
        <div class="projects-list" id="projectsList">
            @foreach ($projects as $p)
                <div class="project-card" data-project-title="{{ strtolower($p->title) }}">
                    <div class="project-name">
                        <span>{{ $p->title }}</span>
                        <span class="project-badge">
                            <i class="bi bi-folder me-1"></i>Project
                        </span>
                    </div>
                    <p class="project-description">
                        <i class="bi bi-file-text me-2 text-muted"></i>
                        {{ $p->description ?: 'No description provided.' }}
                    </p>
                    <div class="project-actions">
                        <form action="{{ url('/createtask') }}" method="GET" class="d-inline">
                            @csrf
                            <input type="hidden" name="ProjectId" value="{{ $p->id }}">
                            <button type="submit" class="btn btn-action btn-create-task">
                                <i class="bi bi-plus-circle"></i> Create Task
                            </button>
                        </form>
                        
                        <button class="btn btn-action btn-edit" onclick="editProject({{ $p->id }})">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        
                        <form id="delete-form-{{ $p->id }}" action="{{ url('/delete/' . $p->id) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="btn btn-action btn-delete" onclick="confirmDelete({{ $p->id }})">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-folder2-open"></i>
            </div>
            <h3 class="empty-state-title">No Projects Yet</h3>
            <p class="empty-state-text">Get started by creating your first project!</p>
            <button class="btn btn-primary btn-lg" onclick="location.href='{{ url('/project') }}'">
                <i class="bi bi-plus-circle me-2"></i>Create New Project
            </button>
        </div>
    @endif
@endsection

@section('scripts')
<script>
    // Project search functionality
    document.getElementById('searchProject')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const projects = document.querySelectorAll('.project-card');
        
        projects.forEach(project => {
            const title = project.getAttribute('data-project-title');
            if (title.includes(searchTerm)) {
                project.style.display = 'block';
                project.style.animation = 'fadeIn 0.5s ease forwards';
            } else {
                project.style.display = 'none';
            }
        });
    });

    // Delete confirmation function
    function confirmDelete(projectId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone! All tasks related to this project will also be deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${projectId}`).submit();
            }
        });
    }

    // Edit project function (you can customize this)
    function editProject(projectId) {
        // You can implement this to open a modal or redirect to edit page
        Swal.fire({
            title: 'Edit Project',
            text: 'This feature is coming soon!',
            icon: 'info',
            confirmButtonText: 'OK'
        });
    }

    // Add animation to project cards as they appear
    document.querySelectorAll('.project-card').forEach((card, index) => {
        card.style.animationDelay = `${index * 0.05}s`;
    });
</script>

<!-- SweetAlert2 CDN for better alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection