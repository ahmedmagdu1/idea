{{-- resources/views/admin/content/index.blade.php --}}
@extends('admin.layout.app')
@section('title', 'Content Manager Dashboard')

@push('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .dashboard-header {
        background: var(--primary-gradient);
        color: white;
        border-radius: 16px;
        margin: 2rem 0;
        padding: 2rem;
        box-shadow: var(--card-shadow);
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: none;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--hover-shadow);
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 24px;
        color: white;
    }

    .stat-icon.primary { background: linear-gradient(135deg, #667eea, #764ba2); }
    .stat-icon.success { background: linear-gradient(135deg, #84fab0, #8fd3f4); }
    .stat-icon.warning { background: linear-gradient(135deg, #ffecd2, #fcb69f); }
    .stat-icon.info { background: linear-gradient(135deg, #a8edea, #fed6e3); }

    .content-section {
        background: white;
        border-radius: 16px;
        margin-bottom: 2rem;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
    }

    .content-section:hover {
        box-shadow: var(--hover-shadow);
    }

    .section-header {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #dee2e6;
    }

    .file-row {
        border-bottom: 1px solid #f1f3f4;
        transition: var(--transition);
        cursor: pointer;
    }

    .file-row:hover {
        background: linear-gradient(90deg, #f8f9ff, transparent);
        transform: translateX(4px);
    }

    .file-row:last-child {
        border-bottom: none;
    }

    .badge-custom {
        padding: 0.35rem 0.8rem;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.75rem;
    }

    .badge-dir {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .badge-lang {
        background: linear-gradient(135deg, #84fab0, #8fd3f4);
        color: white;
    }

    .badge-size {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #e9ecef;
    }

    .image-preview {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #f1f3f4;
        transition: var(--transition);
    }

    .image-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--card-shadow);
    }

    .image-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--hover-shadow);
    }

    .image-card:hover .image-preview {
        transform: scale(1.05);
    }

    .search-box {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
        transition: var(--transition);
    }

    .search-box:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-custom {
        border-radius: 12px;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        transition: var(--transition);
        border: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #5a6fd8, #6a4190);
        transform: translateY(-2px);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .loading-skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .dashboard-header {
            margin: 1rem 0;
            padding: 1.5rem;
        }

        .section-header {
            padding: 1rem;
        }

        .stat-card {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Dashboard Header -->
    <div class="dashboard-header fade-in">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">
                    <i class="fas fa-edit me-3"></i>{{ __('admin.content_management_dashboard') }}
                </h1>
                <p class="mb-0 opacity-75">
                    {{ __('admin.manage_blade_templates') }}
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex flex-column">
                    <small class="opacity-75">{{ __('admin.last_updated') }}</small>
                    <strong>{{ now()->format('M d, Y H:i') }}</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card fade-in" style="animation-delay: 0.1s">
                <div class="stat-icon primary">
                    <i class="fas fa-file-code"></i>
                </div>
                <div class="text-center">
                    <h3 class="fw-bold text-primary mb-1">{{ count((array)($viewFiles ?? [])) }}</h3>
                    <p class="text-muted mb-0">{{ __('admin.blade_templates') }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card fade-in" style="animation-delay: 0.2s">
                <div class="stat-icon success">
                    <i class="fas fa-language"></i>
                </div>
                <div class="text-center">
                    <h3 class="fw-bold text-success mb-1">
                        {{ collect(($languageFiles ?? []))->flatten(1)->count() }}
                    </h3>
                    <p class="text-muted mb-0">{{ __('admin.language_files') }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card fade-in" style="animation-delay: 0.3s">
                <div class="stat-icon warning">
                    <i class="fas fa-images"></i>
                </div>
                <div class="text-center">
                    <h3 class="fw-bold text-warning mb-1">{{ count((array)($imageFiles ?? [])) }}</h3>
                    <p class="text-muted mb-0">{{ __('admin.recent_images') }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card fade-in" style="animation-delay: 0.4s">
                <div class="stat-icon info">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="text-center">
                    <h3 class="fw-bold text-info mb-1">{{ count((array)($recentEdits ?? [])) }}</h3>
                    <p class="text-muted mb-0">{{ __('admin.recent_activity') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Blade Templates Section -->
    <div class="content-section fade-in" style="animation-delay: 0.5s">
        <div class="section-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">
                        <i class="fas fa-file-code me-2 text-primary"></i>
                        {{ __('admin.blade_templates') }}
                        <span class="badge bg-primary ms-2">{{ count((array)($viewFiles ?? [])) }}</span>
                    </h5>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control search-box border-start-0"
                               id="searchBlades" placeholder="Search templates...">
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0 py-3">
                            <i class="fas fa-file me-2"></i>Template
                        </th>
                        <th class="border-0 py-3 text-center">
                            <i class="fas fa-folder me-2"></i>Directory
                        </th>
                        <th class="border-0 py-3 text-end">
                            <i class="fas fa-weight-hanging me-2"></i>Size
                        </th>
                        <th class="border-0 py-3 text-end">
                            <i class="fas fa-clock me-2"></i>Modified
                        </th>
                        <th class="border-0 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="bladesTableBody">
                @forelse(($viewFiles ?? []) as $index => $file)
                    <tr class="file-row fade-in"
                        data-name="{{ strtolower($file['name']) }}"
                        style="animation-delay: {{ 0.6 + ($index * 0.05) }}s">
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon primary me-3" style="width: 40px; height: 40px; font-size: 16px;">
                                    <i class="fas fa-file-code"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $file['name'] }}</div>
                                    <small class="text-muted">{{ basename($file['path']) }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center py-3">
                            <span class="badge badge-custom badge-dir">
                                {{ $file['directory'] }}
                            </span>
                        </td>
                        <td class="text-end py-3">
                            <span class="badge badge-custom badge-size">
                                {{ $file['human_size'] ?? number_format($file['size']/1024, 1) . ' KB' }}
                            </span>
                        </td>
                        <td class="text-end py-3">
                            <small class="text-muted">
                                {{ $file['human_date'] ?? \Carbon\Carbon::createFromTimestamp($file['modified'])->diffForHumans() }}
                            </small>
                        </td>
                        <td class="text-end py-3">
                            <div class="btn-group btn-group-sm" role="group">
                                <button class="btn btn-outline-secondary copy-path" data-path="{{ $file['path'] }}" title="Copy path">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <a class="btn btn-custom btn-edit"
                                   href="{{ route('admin.content.edit', ['file' => $file['path']]) }}">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-file-code"></i>
                                <p class="mb-0">{{ __('admin.no_blade_templates') }}</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Language Files Section -->
    <div class="content-section fade-in" style="animation-delay: 0.7s">
        <div class="section-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-language me-2 text-success"></i>
                    {{ __('admin.language_files') }}
                    <span class="badge bg-success ms-2">{{ count($languageFiles) }}</span>
                </h5>
                @php($firstLocale = array_key_first($languageFiles))
                @if($firstLocale)
                    <a href="{{ route('admin.content.language.manage', $firstLocale) }}" class="btn btn-sm btn-outline-success">
                        <i class="fas fa-sliders me-1"></i> Manage
                    </a>
                @endif
            </div>
        </div>
        <div class="p-4">
            @forelse($languageFiles as $locale => $files)
                <div class="mb-4">
                    <h6 class="mb-3">
                        <span class="badge badge-custom badge-lang me-2">
                            {{ strtoupper($locale) }}
                        </span>
                        {{ __('admin.language_files_locale', ['locale' => strtoupper($locale)]) }}
                    </h6>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted">Locale: {{ strtoupper($locale) }}</small>
                        <a href="{{ route('admin.content.language.manage', $locale) }}" class="btn btn-sm btn-outline-secondary">
                            Open Manager
                        </a>
                    </div>
                    <div class="row">
                        @foreach($files as $file)
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-file-alt text-success me-2"></i>
                                            <strong class="text-truncate">{{ $file['name'] }}.php</strong>
                                        </div>
                                        <div class="d-flex justify-content-between text-muted">
                                            <small>{{ $file['human_size'] ?? number_format($file['size']/1024, 1) . 'KB' }}</small>
                                            <small>{{ \Carbon\Carbon::createFromTimestamp($file['modified'])->format('M d') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-language"></i>
                    <p class="mb-0">{{ __('admin.no_language_files') }}</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Images Section -->
    <div class="content-section fade-in" style="animation-delay: 0.8s">
        <div class="section-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">
                        <i class="fas fa-images me-2 text-warning"></i>
                        {{ __('admin.recent_images') }}
                        <span class="badge bg-warning ms-2">{{ count((array)($imageFiles ?? [])) }}</span>
                    </h5>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-muted">
                        {{ __('admin.showing_images', ['shown' => count(array_slice($imageFiles, 0, 12)), 'total' => count((array)($imageFiles ?? []))]) }}
                    </small>
                </div>
            </div>
        </div>
        <div class="p-4">
            @if(count($imageFiles) > 0)
                <div class="row">
                    @foreach(array_slice($imageFiles, 0, 12) as $index => $image)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4 fade-in"
                             style="animation-delay: {{ 0.9 + ($index * 0.05) }}s">
                            <div class="image-card h-100">
                                <div class="position-relative">
                                    <img src="{{ $image['url'] }}"
                                         class="image-preview w-100"
                                         alt="{{ $image['name'] }}"
                                         style="height: 120px;">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-dark bg-opacity-75">
                                            {{ $image['human_size'] ?? number_format($image['size']/1024, 1) . 'KB' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <small class="text-muted d-block text-truncate mb-1"
                                           title="{{ $image['name'] }}">
                                        {{ $image['name'] }}
                                    </small>
                                    <small class="text-success">
                                        <i class="fas fa-folder me-1"></i>{{ $image['folder'] }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(count($imageFiles) > 12)
                    <div class="text-center mt-4">
                        <div class="alert alert-info border-0 d-inline-flex align-items-center">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ __('admin.more_images_available', ['count' => count($imageFiles) - 12]) }}
                        </div>
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-images"></i>
                    <p class="mb-0">{{ __('admin.no_images_uploaded') }}</p>
                    <small class="text-muted">{{ __('admin.upload_images_editor') }}</small>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Enhanced search functionality
    const searchInput = document.getElementById('searchBlades');
    const tableBody = document.getElementById('bladesTableBody');
    const rows = tableBody.querySelectorAll('tr[data-name]');

    searchInput?.addEventListener('input', debounce((e) => {
        const searchTerm = e.target.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.dataset.name;
            const directory = row.querySelector('.badge-dir')?.textContent.toLowerCase() || '';
            const matches = name.includes(searchTerm) || directory.includes(searchTerm);

            if (matches) {
                row.style.display = '';
                row.style.animationDelay = `${visibleCount * 0.05}s`;
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show "no results" message if needed
        const noResults = tableBody.querySelector('.no-results');
        if (visibleCount === 0 && searchTerm) {
            if (!noResults) {
                const noResultsRow = document.createElement('tr');
                noResultsRow.className = 'no-results';
                noResultsRow.innerHTML = `
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="fas fa-search"></i>
                            <p class="mb-0">No templates found matching "${searchTerm}"</p>
                        </div>
                    </td>
                `;
                tableBody.appendChild(noResultsRow);
            }
        } else if (noResults) {
            noResults.remove();
        }
    }, 300));

    // Click to edit functionality with loading state
    document.addEventListener('click', (e) => {
        const fileRow = e.target.closest('.file-row');
        if (fileRow && !e.target.closest('.btn')) {
            const editBtn = fileRow.querySelector('.btn-edit');
            if (editBtn && !editBtn.classList.contains('loading')) {
                editBtn.classList.add('loading');
                editBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Loading...';

                setTimeout(() => {
                    window.location.href = editBtn.href;
                }, 500);
            }
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        // Ctrl/Cmd + K to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput?.focus();
        }

        // Escape to clear search
        if (e.key === 'Escape' && document.activeElement === searchInput) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.blur();
        }
    });

    // Image lazy loading
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.style.opacity = '0';
                img.onload = () => {
                    img.style.transition = 'opacity 0.3s ease';
                    img.style.opacity = '1';
                };
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll('.image-preview').forEach(img => {
        imageObserver.observe(img);
    });

    // Tooltips for truncated text
    document.querySelectorAll('[title]').forEach(element => {
        if (element.scrollWidth > element.clientWidth) {
            element.style.cursor = 'help';
        }
    });
});

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Performance monitoring
if ('performance' in window) {
    window.addEventListener('load', () => {
        const loadTime = performance.now();
        console.log(`Dashboard loaded in ${loadTime.toFixed(2)}ms`);
    });
}
</script>
@endpush


