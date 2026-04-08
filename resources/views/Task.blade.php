@extends('layouts.app')

@section('title', 'Create Task - TaskFlow')

@section('styles')
<style>
    .task-form-wrapper {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .task-form-container {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: var(--card-shadow);
        width: 100%;
        max-width: 600px;
        position: relative;
        overflow: hidden;
        animation: slideUp 0.5s ease;
    }

    .task-form-container::before {
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

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-group input.error,
    .form-group textarea.error,
    .form-group select.error {
        border-color: #dc3545;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .error-message i {
        font-size: 0.9rem;
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

    .submit-btn i {
        font-size: 1.2rem;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(79, 172, 254, 0.3);
    }

    .submit-btn:active {
        transform: translateY(0);
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

    .priority-select {
        cursor: pointer;
    }

    .priority-high {
        border-left: 4px solid #dc3545;
    }

    .priority-medium {
        border-left: 4px solid #ffc107;
    }

    .priority-low {
        border-left: 4px solid #28a745;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 768px) {
        .task-form-container {
            padding: 30px 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }
    }

    /* Character counter */
    .char-counter {
        text-align: right;
        font-size: 0.8rem;
        color: #999;
        margin-top: 5px;
    }

    .char-counter.limit-reached {
        color: #dc3545;
    }
</style>
@endsection

@section('content')
<div class="task-form-wrapper">
    <div class="task-form-container">
        <div class="form-header">
            <div class="form-icon">
                <i class="bi bi-plus-circle"></i>
            </div>
            <h2>Create New Task</h2>
            <p>Add a new task to your project and track progress</p>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ url('/storetask') }}" method="POST" id="taskForm">
            @csrf
            
            <!-- Project ID (hidden) if coming from project -->
            @if(isset($projectId))
                <input type="hidden" name="project_id" value="{{ $projectId }}">
            @endif

            <!-- Task Name -->
            <div class="form-group">
                <label for="task-name">
                    <i class="bi bi-tag"></i> Task Name
                </label>
                <input type="text" 
                       id="task-name" 
                       name="name" 
                       value="{{ old('name') }}"
                       placeholder="Enter task name" 
                       required
                       class="@error('name') error @enderror">
                @error('name')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Task Description -->
            <div class="form-group">
                <label for="task-description">
                    <i class="bi bi-file-text"></i> Task Description
                </label>
                <textarea id="task-description" 
                          name="task_description" 
                          placeholder="Describe what needs to be done..."
                          required
                          class="@error('task_description') error @enderror"
                          maxlength="500">{{ old('task_description') }}</textarea>
                <div class="char-counter">
                    <span id="charCount">0</span>/500 characters
                </div>
                @error('task_description')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Priority (Optional enhancement) -->
            <div class="form-group">
                <label for="priority">
                    <i class="bi bi-flag"></i> Priority Level
                </label>
                <select id="priority" name="priority" class="priority-select">
                    <option value="low">🟢 Low Priority</option>
                    <option value="medium" selected>🟡 Medium Priority</option>
                    <option value="high">🔴 High Priority</option>
                </select>
            </div>

            <!-- Due Date (Optional enhancement) -->
            <div class="form-row">
                <div class="form-group">
                    <label for="due_date">
                        <i class="bi bi-calendar"></i> Due Date
                    </label>
                    <input type="date" 
                           id="due_date" 
                           name="due_date" 
                           value="{{ old('due_date') }}"
                           min="{{ date('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label for="assignee">
                        <i class="bi bi-person"></i> Assign To (Optional)
                    </label>
                    <select id="assignee" name="assignee">
                        <option value="">Select team member</option>
                        <option value="me">Myself</option>
                        <!-- Add dynamic team members here -->
                    </select>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <i class="bi bi-check-lg"></i> Create Task
            </button>
            
            <a href="{{ url()->previous() }}" class="cancel-btn">
                <i class="bi bi-arrow-left"></i> Cancel
            </a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter for description
        const descriptionInput = document.getElementById('task-description');
        const charCountSpan = document.getElementById('charCount');
        
        if (descriptionInput && charCountSpan) {
            // Initialize counter
            charCountSpan.textContent = descriptionInput.value.length;
            
            // Update counter on input
            descriptionInput.addEventListener('input', function() {
                const length = this.value.length;
                charCountSpan.textContent = length;
                
                // Add warning class if near limit
                const counterDiv = document.querySelector('.char-counter');
                if (length >= 450) {
                    counterDiv.classList.add('limit-reached');
                } else {
                    counterDiv.classList.remove('limit-reached');
                }
            });
        }

        // Priority select styling
        const prioritySelect = document.getElementById('priority');
        if (prioritySelect) {
            prioritySelect.addEventListener('change', function() {
                // Remove existing priority classes
                this.classList.remove('priority-high', 'priority-medium', 'priority-low');
                // Add new class based on selected value
                if (this.value === 'high') {
                    this.classList.add('priority-high');
                } else if (this.value === 'medium') {
                    this.classList.add('priority-medium');
                } else {
                    this.classList.add('priority-low');
                }
            });
            
            // Trigger initial class
            prioritySelect.dispatchEvent(new Event('change'));
        }

        // Form validation before submit
        const form = document.getElementById('taskForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const taskName = document.getElementById('task-name');
                const taskDesc = document.getElementById('task-description');
                let hasError = false;

                // Clear previous errors
                document.querySelectorAll('.error-message').forEach(el => el.remove());
                document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));

                // Validate task name
                if (!taskName.value.trim()) {
                    showError(taskName, 'Task name is required');
                    hasError = true;
                } else if (taskName.value.trim().length < 3) {
                    showError(taskName, 'Task name must be at least 3 characters');
                    hasError = true;
                }

                // Validate description
                if (!taskDesc.value.trim()) {
                    showError(taskDesc, 'Task description is required');
                    hasError = true;
                } else if (taskDesc.value.trim().length < 10) {
                    showError(taskDesc, 'Please provide a more detailed description (at least 10 characters)');
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = document.querySelector('.error');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        }

        // Helper function to show error messages
        function showError(inputElement, message) {
            inputElement.classList.add('error');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = `<i class="bi bi-exclamation-circle"></i> ${message}`;
            inputElement.parentNode.appendChild(errorDiv);
        }

        // Auto-fill project ID from URL if present
        const urlParams = new URLSearchParams(window.location.search);
        const projectId = urlParams.get('project_id');
        if (projectId && !document.querySelector('input[name="project_id"]')) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'project_id';
            hiddenInput.value = projectId;
            document.getElementById('taskForm').appendChild(hiddenInput);
        }
    });

    // SweetAlert for successful task creation (optional)
    @if(session('task_created'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('task_created') }}',
            confirmButtonColor: '#4facfe',
            timer: 3000,
            showConfirmButton: true
        });
    @endif
</script>
@endsection