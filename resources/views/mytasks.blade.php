@extends('layouts.app')

@section('title', 'My Tasks - TaskFlow')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
<style>
    .task-status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-in-progress {
        background-color: #cce5ff;
        color: #004085;
    }
    
    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-blocked {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .task-card {
        border-left: 4px solid #4361ee;
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .task-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .task-priority {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-right: 10px;
    }
    
    .priority-high {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }
    
    .priority-medium {
        background-color: #fff8e1;
        color: #ff8f00;
        border: 1px solid #ffecb3;
    }
    
    .priority-low {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }
    
    .task-actions {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .task-card:hover .task-actions {
        opacity: 1;
    }
    
    .search-container {
        position: relative;
        margin-bottom: 30px;
    }
    
    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 0 0 8px 8px;
        z-index: 1000;
        max-height: 300px;
        overflow-y: auto;
        display: none;
    }
    
    .search-result-item {
        padding: 10px 15px;
        cursor: pointer;
        border-bottom: 1px solid #f1f1f1;
        transition: background-color 0.2s ease;
    }
    
    .search-result-item:hover {
        background-color: #f8f9fa;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #dee2e6;
    }
    
    .task-meta {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 10px;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .meta-item i {
        font-size: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold gradient-text mb-2">
                <i class="bi bi-check-square me-2"></i>My Tasks
            </h1>
            <p class="text-muted">Manage and track all your tasks in one place</p>
        </div>
        <div>
            <button class="btn btn-primary" onclick="location.href='{{ url('/createtask') }}'">
                <i class="bi bi-plus-circle me-2"></i>Create New Task
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('user_assigned'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('user_assigned') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if (session('task_updated'))
    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>
        {{ session('task_updated') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if (session('task_deleted'))
    <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('task_deleted') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Error Messages -->
    @error('user_Id')
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @enderror

    @if ($errors->has('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        {{ $errors->first('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Search and Filters -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="search-container">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" 
                           placeholder="Search tasks by name or description..." 
                           id="taskSearch">
                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                        Clear
                    </button>
                </div>
                <div class="search-results" id="searchResults"></div>
            </div>
        </div>
        <div class="col-md-4">
            <select class="form-select" id="statusFilter">
                <option value="all">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="in-progress">In Progress</option>
                <option value="completed">Completed</option>
                <option value="blocked">Blocked</option>
            </select>
        </div>
    </div>

    <!-- Tasks List -->
    @if(count($PfTasks) > 0)
    <div class="row" id="tasksContainer">
        @foreach ($PfTasks as $task)
        <div class="col-lg-6 col-xl-4 mb-4 task-item" 
             data-status="{{ strtolower($task->status ?? 'pending') }}"
             data-name="{{ strtolower($task->name) }}"
             data-description="{{ strtolower($task->description) }}">
            <div class="card h-100 task-card">
                <div class="card-body">
                    <!-- Task Header -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="task-status-badge status-{{ strtolower($task->status ?? 'pending') }}">
                                <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
                                {{ ucfirst($task->status ?? 'Pending') }}
                            </span>
                            <span class="task-priority priority-{{ strtolower($task->priority ?? 'medium') }}">
                                {{ ucfirst($task->priority ?? 'Medium') }} Priority
                            </span>
                        </div>
                        <div class="dropdown task-actions">
                            <button class="btn btn-sm btn-light" type="button" 
                                    data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#" 
                                       onclick="editTask({{ $task->id }})">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#" 
                                       onclick="confirmDelete({{ $task->id }})">
                                        <i class="bi bi-trash me-2"></i>Delete
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#" 
                                       onclick="showAssignmentModal({{ $task->id }})">
                                        <i class="bi bi-person-plus me-2"></i>Assign
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Task Content -->
                    <h5 class="card-title mb-3">
                        <span class="text-muted small">#{{ $task->id }}</span>
                        {{ $task->name }}
                    </h5>
                    <p class="card-text text-muted mb-4">
                        {{ Str::limit($task->description, 150) }}
                    </p>

                    <!-- Task Meta Information -->
                    <div class="task-meta">
                        @if($task->due_date)
                        <div class="meta-item">
                            <i class="bi bi-calendar"></i>
                            <span>{{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                        </div>
                        @endif
                        
                        @if($task->assigned_to)
                        <div class="meta-item">
                            <i class="bi bi-person"></i>
                            <span>Assigned</span>
                        </div>
                        @endif
                        
                        <div class="meta-item">
                            <i class="bi bi-clock"></i>
                            <span>Created {{ \Carbon\Carbon::parse($task->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Hidden Forms -->
                <div class="card-footer bg-transparent border-top-0">
                    <form id="delete-form-{{ $task->id }}" 
                          action="{{ url('deletetask/' . $task->id) }}" 
                          method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                    
                    <form id="assign-form-{{ $task->id }}" 
                          action="{{ url('AssignTeamMember/' . $task->id) }}" 
                          method="GET" style="display: none;">
                        @csrf
                        <input type="hidden" name="search_member_id" id="member-input-{{ $task->id }}">
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($PfTasks->hasPages())
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Tasks pagination">
            <ul class="pagination">
                @if($PfTasks->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $PfTasks->previousPageUrl() }}">Previous</a>
                </li>
                @endif

                @foreach(range(1, $PfTasks->lastPage()) as $page)
                <li class="page-item {{ $PfTasks->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $PfTasks->url($page) }}">{{ $page }}</a>
                </li>
                @endforeach

                @if($PfTasks->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $PfTasks->nextPageUrl() }}">Next</a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
                @endif
            </ul>
        </nav>
    </div>
    @endif
    @else
    <!-- Empty State -->
    <div class="empty-state">
        <i class="bi bi-check2-square"></i>
        <h4 class="mb-3">No tasks found</h4>
        <p class="text-muted mb-4">You haven't created any tasks yet. Start by creating your first task!</p>
        <button class="btn btn-primary" onclick="location.href='{{ url('/createtask') }}'">
            <i class="bi bi-plus-circle me-2"></i>Create Your First Task
        </button>
    </div>
    @endif
</div>

<!-- Assignment Modal -->
<div class="modal fade" id="assignmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="search-container">
                    <input type="text" class="form-control" 
                           placeholder="Search team members..." 
                           id="memberSearch">
                    <div class="search-results" id="memberResults"></div>
                </div>
                <div id="selectedMember" class="mt-3" style="display: none;">
                    <div class="alert alert-info">
                        Selected: <span id="selectedMemberName"></span>
                        <input type="hidden" id="selectedMemberId">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmAssign">Assign</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/tasks.js') }}"></script>
<script>
let currentTaskId = null;

function confirmDelete(taskId) {
    if (confirm('Are you sure you want to delete this task? This action cannot be undone.')) {
        document.getElementById('delete-form-' + taskId).submit();
    }
}

function editTask(taskId) {
    // Redirect to edit page or show edit modal
    // For now, we'll just show an alert
    alert('Edit functionality for task #' + taskId + ' would open here.');
}

function showAssignmentModal(taskId) {
    currentTaskId = taskId;
    $('#assignmentModal').modal('show');
}

function addFn(taskId) {
    currentTaskId = taskId;
    $('#assignmentModal').modal('show');
}

// Search functionality
document.addEventListener('DOMContentLoaded', function() {
    const taskSearch = document.getElementById('taskSearch');
    const searchResults = document.getElementById('searchResults');
    const clearSearch = document.getElementById('clearSearch');
    const statusFilter = document.getElementById('statusFilter');
    const tasksContainer = document.getElementById('tasksContainer');
    
    // Task search
    taskSearch.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const taskItems = document.querySelectorAll('.task-item');
        
        if (searchTerm.length > 0) {
            searchResults.innerHTML = '';
            taskItems.forEach(item => {
                const name = item.getAttribute('data-name');
                const description = item.getAttribute('data-description');
                
                if (name.includes(searchTerm) || description.includes(searchTerm)) {
                    const taskName = item.querySelector('.card-title').textContent;
                    const taskDesc = item.querySelector('.card-text').textContent;
                    
                    const resultItem = document.createElement('div');
                    resultItem.className = 'search-result-item';
                    resultItem.innerHTML = `
                        <div class="fw-bold">${taskName}</div>
                        <div class="small text-muted">${taskDesc.substring(0, 100)}...</div>
                    `;
                    resultItem.addEventListener('click', function() {
                        item.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        item.style.boxShadow = '0 0 0 3px rgba(67, 97, 238, 0.3)';
                        setTimeout(() => {
                            item.style.boxShadow = '';
                        }, 2000);
                        searchResults.style.display = 'none';
                        taskSearch.value = taskName.split(' ').slice(1).join(' ');
                    });
                    searchResults.appendChild(resultItem);
                }
            });
            searchResults.style.display = searchResults.children.length > 0 ? 'block' : 'none';
        } else {
            searchResults.style.display = 'none';
        }
        
        // Filter tasks based on search
        filterTasks();
    });
    
    // Clear search
    clearSearch.addEventListener('click', function() {
        taskSearch.value = '';
        searchResults.style.display = 'none';
        filterTasks();
    });
    
    // Status filter
    statusFilter.addEventListener('change', filterTasks);
    
    function filterTasks() {
        const searchTerm = taskSearch.value.toLowerCase();
        const statusValue = statusFilter.value;
        
        document.querySelectorAll('.task-item').forEach(item => {
            const name = item.getAttribute('data-name');
            const description = item.getAttribute('data-description');
            const status = item.getAttribute('data-status');
            
            const matchesSearch = searchTerm === '' || 
                                 name.includes(searchTerm) || 
                                 description.includes(searchTerm);
            const matchesStatus = statusValue === 'all' || status === statusValue;
            
            item.style.display = (matchesSearch && matchesStatus) ? 'block' : 'none';
        });
    }
    
    // Member search for assignment modal
    const memberSearch = document.getElementById('memberSearch');
    const memberResults = document.getElementById('memberResults');
    
    if (memberSearch) {
        memberSearch.addEventListener('input', function() {
            const searchTerm = this.value;
            
            if (searchTerm.length > 2) {
                // Fetch members from your API
                fetch(`/api/search-members?q=${encodeURIComponent(searchTerm)}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    memberResults.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(member => {
                            const resultItem = document.createElement('div');
                            resultItem.className = 'search-result-item';
                            resultItem.innerHTML = `
                                <div class="fw-bold">${member.name}</div>
                                <div class="small text-muted">${member.email}</div>
                            `;
                            resultItem.addEventListener('click', function() {
                                document.getElementById('selectedMemberName').textContent = 
                                    `${member.name} (${member.email})`;
                                document.getElementById('selectedMemberId').value = member.id;
                                document.getElementById('selectedMember').style.display = 'block';
                                memberSearch.value = '';
                                memberResults.style.display = 'none';
                            });
                            memberResults.appendChild(resultItem);
                        });
                        memberResults.style.display = 'block';
                    } else {
                        memberResults.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching members:', error);
                });
            } else {
                memberResults.style.display = 'none';
            }
        });
    }
    
    // Confirm assignment
    document.getElementById('confirmAssign').addEventListener('click', function() {
        const memberId = document.getElementById('selectedMemberId').value;
        if (memberId && currentTaskId) {
            document.getElementById(`member-input-${currentTaskId}`).value = memberId;
            document.getElementById(`assign-form-${currentTaskId}`).submit();
        }
    });
    
    // Close search results when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.search-container')) {
            searchResults.style.display = 'none';
            if (memberResults) memberResults.style.display = 'none';
        }
    });
});
</script>
@endsection