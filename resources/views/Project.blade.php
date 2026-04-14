@extends('layouts.app')

@section('title', 'Create Project - Task Assigner')

@section('styles')
<style>
    .project-form-wrapper {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .project-form-container {
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

    .project-form-container::before {
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 768px) {
        .project-form-container {
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

    /* Project preview */
    .project-preview {
        background: linear-gradient(135deg, rgba(79, 172, 254, 0.05), rgba(0, 242, 254, 0.05));
        border-radius: 12px;
        padding: 20px;
        margin-top: 20px;
        display: none;
    }

    .project-preview.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    .preview-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }

    .preview-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 8px;
    }

    .preview-description {
        font-size: 0.85rem;
        color: #666;
        line-height: 1.5;
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
</style>
@endsection

@section('content')
<div class="project-form-wrapper">
    <div class="project-form-container">
        <div class="form-header">
            <div class="form-icon">
                <i class="bi bi-folder-plus"></i>
            </div>
            <h2>Create New Project</h2>
            <p>Start a new project and organize your tasks</p>
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

        @if (session('project_created'))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-bell-fill me-2"></i>
                {{ session('project_created') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ url('/createproject') }}" method="POST" id="projectForm">
            @csrf
            <input type="hidden" id="user_id" name="UserId" value="">
            
            <!-- Project Name -->
            <div class="form-group">
                <label for="project-name">
                    <i class="bi bi-tag"></i> Project Name
                </label>
                <input type="text" 
                       id="project-name" 
                       name="title" 
                       value="{{ old('title') }}"
                       placeholder="Enter project name (e.g., Website Redesign, Mobile App)" 
                       required
                       maxlength="100"
                       class="@error('title') error @enderror">
                <div class="char-counter">
                    <span id="titleCount">0</span>/100 characters
                </div>
                @error('title')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Project Description -->
            <div class="form-group">
                <label for="project-description">
                    <i class="bi bi-file-text"></i> Project Description
                </label>
                <textarea id="project-description" 
                          name="description" 
                          placeholder="Describe what this project is about, its goals, and key deliverables..."
                          required
                          class="@error('description') error @enderror"
                          maxlength="500">{{ old('description') }}</textarea>
                <div class="char-counter">
                    <span id="descCount">0</span>/500 characters
                </div>
                @error('description')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Optional: Project Settings Row -->
            <div class="form-row">
                <div class="form-group">
                    <label for="project-status">
                        <i class="bi bi-flag"></i> Project Status
                    </label>
                    <select id="project-status" name="status">
                        <option value="planning">📋 Planning</option>
                        <option value="active" selected="selected">🚀 Active</option>
                        <option value="on-hold">⏸️ On Hold</option>
                        <option value="completed">✅ Completed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="deadline">
                        <i class="bi bi-calendar"></i> Deadline (Optional)
                    </label>
                    <input type="date" 
                           id="deadline" 
                           name="deadline" 
                           value="{{ old('deadline') }}"
                           min="{{ date('Y-m-d') }}">
                </div>
            </div>

            <!-- Project Preview -->
            <div class="project-preview" id="projectPreview">
                <div class="preview-title">
                    <i class="bi bi-eye"></i> Project Preview
                </div>
                <div class="preview-name" id="previewName"></div>
                <div class="preview-description" id="previewDescription"></div>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">
                <i class="bi bi-plus-circle"></i> Create Project
            </button>
            
            <a href="{{ url('/allmyprojects') }}" class="cancel-btn">
                <i class="bi bi-arrow-left"></i> Cancel
            </a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set user ID from localStorage or global variable
        const userId = localStorage.getItem('id') || '{{ $userId ?? "" }}';
        const userIdField = document.getElementById('user_id');
        if (userIdField && userId) {
            userIdField.value = userId;
        } else if (!userId) {
            console.warn('No user ID found. Please ensure you are logged in.');
        }

        // Project name character counter and preview
        const projectNameInput = document.getElementById('project-name');
        const titleCountSpan = document.getElementById('titleCount');
        const projectPreview = document.getElementById('projectPreview');
        const previewName = document.getElementById('previewName');
        const descriptionInput = document.getElementById('project-description');
        const previewDescription = document.getElementById('previewDescription');
        const descCountSpan = document.getElementById('descCount');
        
        if (projectNameInput && titleCountSpan) {
            // Initialize counter
            titleCountSpan.textContent = projectNameInput.value.length;
            
            // Update counter on input
            projectNameInput.addEventListener('input', function() {
                const length = this.value.length;
                titleCountSpan.textContent = length;
                
                // Add warning class if near limit
                const counterDiv = this.closest('.form-group').querySelector('.char-counter');
                if (length >= 90) {
                    counterDiv.classList.add('limit-reached');
                } else {
                    counterDiv.classList.remove('limit-reached');
                }
                
                // Update preview
                updatePreview();
            });
        }

        // Description character counter and preview
        if (descriptionInput && descCountSpan) {
            // Initialize counter
            descCountSpan.textContent = descriptionInput.value.length;
            
            // Update counter on input
            descriptionInput.addEventListener('input', function() {
                const length = this.value.length;
                descCountSpan.textContent = length;
                
                // Add warning class if near limit
                const counterDiv = this.closest('.form-group').querySelector('.char-counter');
                if (length >= 450) {
                    counterDiv.classList.add('limit-reached');
                } else {
                    counterDiv.classList.remove('limit-reached');
                }
                
                // Update preview
                updatePreview();
            });
        }

        // Update project preview
        function updatePreview() {
            const name = projectNameInput ? projectNameInput.value.trim() : '';
            const description = descriptionInput ? descriptionInput.value.trim() : '';
            
            if (name || description) {
                if (name) {
                    previewName.textContent = name;
                }
                if (description) {
                    previewDescription.textContent = description.length > 150 
                        ? description.substring(0, 150) + '...' 
                        : description;
                }
                projectPreview.classList.add('active');
            } else {
                projectPreview.classList.remove('active');
            }
        }

        // Initial preview check
        updatePreview();

        // Form validation before submit
        const form = document.getElementById('projectForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                const projectName = document.getElementById('project-name');
                const description = document.getElementById('project-description');
                let hasError = false;

                // Clear previous errors
                document.querySelectorAll('.error-message').forEach(el => el.remove());
                document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));

                // Validate project name
                if (!projectName.value.trim()) {
                    showError(projectName, 'Project name is required');
                    hasError = true;
                } else if (projectName.value.trim().length < 3) {
                    showError(projectName, 'Project name must be at least 3 characters');
                    hasError = true;
                }

                // Validate description
                if (!description.value.trim()) {
                    showError(description, 'Project description is required');
                    hasError = true;
                } else if (description.value.trim().length < 10) {
                    showError(description, 'Please provide a more detailed description (at least 10 characters)');
                    hasError = true;
                }

                // Validate user ID
                if (!userIdField.value) {
                    showError(userIdField, 'User information missing. Please refresh the page.');
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = document.querySelector('.error');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    // Disable submit button to prevent double submission
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Creating Project...';
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

        // Real-time validation blur events
        if (projectNameInput) {
            projectNameInput.addEventListener('blur', function() {
                const errorDiv = this.parentNode.querySelector('.error-message:not(.char-counter *)');
                if (this.value.trim() && this.value.trim().length < 3) {
                    if (!errorDiv) {
                        showError(this, 'Project name must be at least 3 characters');
                    }
                } else if (errorDiv && this.value.trim().length >= 3) {
                    errorDiv.remove();
                    this.classList.remove('error');
                }
            });
        }

        if (descriptionInput) {
            descriptionInput.addEventListener('blur', function() {
                const errorDiv = this.parentNode.querySelector('.error-message');
                if (this.value.trim() && this.value.trim().length < 10) {
                    if (!errorDiv) {
                        showError(this, 'Description must be at least 10 characters');
                    }
                } else if (errorDiv && this.value.trim().length >= 10) {
                    errorDiv.remove();
                    this.classList.remove('error');
                }
            });
        }
    });

    // SweetAlert for successful project creation
    @if(session('project_created'))
        Swal.fire({
            icon: 'success',
            title: 'Project Created!',
            text: '{{ session('project_created') }}',
            confirmButtonColor: '#4facfe',
            timer: 3000,
            showConfirmButton: true
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: 'Please check the form for errors',
            confirmButtonColor: '#dc3545'
        });
    @endif
</script>
@endsection