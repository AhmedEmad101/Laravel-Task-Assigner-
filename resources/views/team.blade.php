@extends('layouts.app')

@section('title', 'Create Team - TaskFlow')

@section('styles')
<style>
    .team-form-wrapper {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .team-form-container {
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

    .team-form-container::before {
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

    .info-box {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .info-box i {
        font-size: 1.5rem;
        color: var(--primary-color);
    }

    .info-box-content {
        flex: 1;
    }

    .info-box-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .info-box-text {
        font-size: 0.85rem;
        color: #666;
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

    .team-preview {
        background: linear-gradient(135deg, rgba(79, 172, 254, 0.05), rgba(0, 242, 254, 0.05));
        border-radius: 12px;
        padding: 20px;
        margin-top: 20px;
        display: none;
    }

    .team-preview.active {
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
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary-color);
        word-break: break-word;
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
        .team-form-container {
            padding: 30px 20px;
        }

        .form-icon {
            width: 60px;
            height: 60px;
        }

        .form-icon i {
            font-size: 1.8rem;
        }

        .form-header h2 {
            font-size: 1.5rem;
        }
    }

    /* Character counter for team name */
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
<div class="team-form-wrapper">
    <div class="team-form-container">
        <div class="form-header">
            <div class="form-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <h2>Create a New Team</h2>
            <p>Build your dream team and start collaborating</p>
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

        <!-- Info Box -->
        <div class="info-box">
            <i class="bi bi-info-circle-fill"></i>
            <div class="info-box-content">
                <div class="info-box-title">Team Leader Information</div>
                <div class="info-box-text">You will be automatically assigned as the team leader</div>
            </div>
        </div>

        <form action="{{ url('/storeteam') }}" method="POST" id="teamForm">
            @csrf
            
            <!-- Hidden leader ID field -->
            <input type="hidden" name="leader_Id" id="leader_Id" value="">
            
            <!-- Team Name -->
            <div class="form-group">
                <label for="team-name">
                    <i class="bi bi-tag"></i> Team Name
                </label>
                <input type="text" 
                       id="team-name" 
                       name="name" 
                       value="{{ old('name') }}"
                       placeholder="Enter team name (e.g., Development Team, Design Squad)" 
                       required
                       maxlength="100"
                       class="@error('name') error @enderror">
                <div class="char-counter">
                    <span id="charCount">0</span>/100 characters
                </div>
                @error('name')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Optional: Team Description -->
            <div class="form-group">
                <label for="team-description">
                    <i class="bi bi-file-text"></i> Team Description (Optional)
                </label>
                <textarea id="team-description" 
                          name="description" 
                          placeholder="Describe the team's purpose, goals, or any other relevant information..."
                          maxlength="500">{{ old('description') }}</textarea>
                <div class="char-counter">
                    <span id="descCharCount">0</span>/500 characters
                </div>
            </div>

            <!-- Team Preview -->
            <div class="team-preview" id="teamPreview">
                <div class="preview-title">
                    <i class="bi bi-eye"></i> Team Preview
                </div>
                <div class="preview-name" id="previewName"></div>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">
                <i class="bi bi-plus-circle"></i> Create Team
            </button>
            
            <a href="{{ url('/allmyteams') }}" class="cancel-btn">
                <i class="bi bi-arrow-left"></i> Cancel
            </a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get leader ID from localStorage
        const leaderId = localStorage.getItem('id');
        const leaderIdField = document.getElementById('leader_Id');
        
        if (leaderId && leaderIdField) {
            leaderIdField.value = leaderId;
        } else {
            // If no ID in localStorage, try to get from user data
            console.warn('No leader ID found in localStorage');
            // You can also fetch from a meta tag or global variable
            @if(isset($userId))
                leaderIdField.value = '{{ $userId }}';
            @endif
        }

        // Team name character counter and preview
        const teamNameInput = document.getElementById('team-name');
        const charCountSpan = document.getElementById('charCount');
        const teamPreview = document.getElementById('teamPreview');
        const previewName = document.getElementById('previewName');
        
        if (teamNameInput && charCountSpan) {
            // Initialize counter
            charCountSpan.textContent = teamNameInput.value.length;
            
            // Update counter on input
            teamNameInput.addEventListener('input', function() {
                const length = this.value.length;
                charCountSpan.textContent = length;
                
                // Add warning class if near limit
                const counterDiv = document.querySelector('.char-counter');
                if (length >= 90) {
                    counterDiv.classList.add('limit-reached');
                } else {
                    counterDiv.classList.remove('limit-reached');
                }
                
                // Update preview
                if (this.value.trim()) {
                    previewName.textContent = this.value.trim();
                    teamPreview.classList.add('active');
                } else {
                    teamPreview.classList.remove('active');
                }
            });
            
            // Show preview if there's initial value
            if (teamNameInput.value.trim()) {
                previewName.textContent = teamNameInput.value.trim();
                teamPreview.classList.add('active');
            }
        }

        // Description character counter
        const descriptionInput = document.getElementById('team-description');
        const descCharCountSpan = document.getElementById('descCharCount');
        
        if (descriptionInput && descCharCountSpan) {
            descCharCountSpan.textContent = descriptionInput.value.length;
            
            descriptionInput.addEventListener('input', function() {
                const length = this.value.length;
                descCharCountSpan.textContent = length;
                
                const counterDiv = descriptionInput.parentElement.querySelector('.char-counter');
                if (length >= 450) {
                    counterDiv.classList.add('limit-reached');
                } else {
                    counterDiv.classList.remove('limit-reached');
                }
            });
        }

        // Form validation before submit
        const form = document.getElementById('teamForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                const teamName = document.getElementById('team-name');
                let hasError = false;

                // Clear previous errors
                document.querySelectorAll('.error-message').forEach(el => el.remove());
                document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));

                // Validate team name
                if (!teamName.value.trim()) {
                    showError(teamName, 'Team name is required');
                    hasError = true;
                } else if (teamName.value.trim().length < 3) {
                    showError(teamName, 'Team name must be at least 3 characters');
                    hasError = true;
                } else if (teamName.value.trim().length > 100) {
                    showError(teamName, 'Team name must be less than 100 characters');
                    hasError = true;
                }

                // Validate leader ID
                if (!leaderIdField.value) {
                    showError(leaderIdField, 'Leader information is missing. Please refresh the page.');
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
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Creating Team...';
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

        // Real-time validation for team name
        teamNameInput?.addEventListener('blur', function() {
            const errorDiv = this.parentNode.querySelector('.error-message');
            if (this.value.trim() && this.value.trim().length < 3) {
                if (!errorDiv) {
                    showError(this, 'Team name must be at least 3 characters');
                }
            } else if (errorDiv && this.value.trim().length >= 3) {
                errorDiv.remove();
                this.classList.remove('error');
            }
        });
    });

    // SweetAlert for successful team creation (optional)
    @if(session('success-addteam'))
        Swal.fire({
            icon: 'success',
            title: 'Team Created!',
            text: '{{ session('success-addteam') }}',
            confirmButtonColor: '#4facfe',
            timer: 3000,
            showConfirmButton: true
        }).then(() => {
            window.location.href = '{{ url("/allmyteams") }}';
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

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection