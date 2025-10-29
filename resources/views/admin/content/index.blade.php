
{{-- resources/views/admin/content/index.blade.php --}}
@extends('admin.layout.app')
@section('title', 'Content Manager Dashboard')

@push('styles')
<style>
    .content-dashboard {
        padding-bottom: 3rem;
    }

    .content-dashboard .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        background-color: #fff;
    }

    .content-dashboard .dashboard-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
    }

    .content-dashboard .dashboard-hero .card-body {
        padding: 2.5rem;
    }

    .content-dashboard .hero-title {
        font-size: 1.9rem;
        font-weight: 600;
    }

    .content-dashboard .hero-subtitle {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .content-dashboard .hero-meta {
        font-size: 0.85rem;
    }

    .content-dashboard .hero-meta span {
        display: block;
        font-size: 1rem;
        font-weight: 600;
        color: #fff;
    }

    .content-dashboard .quick-stats .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .content-dashboard .quick-stats .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 30px rgba(15, 23, 42, 0.12);
    }

    .content-dashboard .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        flex-shrink: 0;
    }

    .content-dashboard .bg-gradient-primary { background: linear-gradient(135deg, #667eea, #764ba2); }
    .content-dashboard .bg-gradient-success { background: linear-gradient(135deg, #84fab0, #8fd3f4); color: #155e75; }
    .content-dashboard .bg-gradient-warning { background: linear-gradient(135deg, #ffecd2, #fcb69f); color: #8b4513; }
    .content-dashboard .bg-gradient-info { background: linear-gradient(135deg, #a8edea, #fed6e3); color: #7c3aed; }

    .content-dashboard .content-tabs {
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .content-dashboard .content-tabs .nav-link {
        border-radius: 999px;
        font-weight: 500;
        color: #6c757d;
        background-color: #f1f3f5;
        border: none;
        padding: 0.55rem 1.35rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .content-dashboard .content-tabs .nav-link:hover {
        color: #4c51bf;
    }

    .content-dashboard .content-tabs .nav-link.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        box-shadow: 0 12px 24px rgba(102, 126, 234, 0.35);
    }

    .content-dashboard .template-table thead th {
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        border-bottom: none;
        background-color: #f8fafc;
        color: #6b7280;
    }

    .content-dashboard .template-table tbody td {
        vertical-align: middle;
        border-top: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }

    .content-dashboard .file-row {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .content-dashboard .file-row:hover {
        background-color: rgba(102, 126, 234, 0.08);
    }

    .content-dashboard .file-initial {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(102, 126, 234, 0.12);
        color: #4c51bf;
        font-size: 1rem;
        font-weight: 600;
    }

    .content-dashboard .badge-soft {
        border-radius: 999px;
        padding: 0.35rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 500;
        background: rgba(102, 126, 234, 0.12);
        color: #4c51bf;
    }

    .content-dashboard .badge-soft-success {
        background: rgba(16, 185, 129, 0.12);
        color: #047857;
    }

    .content-dashboard .badge-soft-warning {
        background: rgba(251, 191, 36, 0.15);
        color: #92400e;
    }

    .content-dashboard .language-card .card-header {
        background-color: #f8fafc;
    }

    .content-dashboard .language-card .list-group-item {
        border: none;
        border-bottom: 1px solid #f1f5f9;
        padding: 0.9rem 1.25rem;
    }

    .content-dashboard .language-card .list-group-item:last-child {
        border-bottom: none;
    }

    .content-dashboard .media-card {
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .content-dashboard .media-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 28px rgba(15, 23, 42, 0.12);
    }

    .content-dashboard .media-card img {
        height: 140px;
        object-fit: cover;
        width: 100%;
    }

    .content-dashboard .activity-timeline {
        position: relative;
        padding-left: 1.5rem;
    }

    .content-dashboard .activity-timeline::before {
        content: '';
        position: absolute;
        top: 0.25rem;
        left: 0.35rem;
        width: 2px;
        height: 100%;
        background: linear-gradient(180deg, #667eea, rgba(102, 126, 234, 0));
    }

    .content-dashboard .activity-item {
        position: relative;
        padding-left: 1.5rem;
        margin-bottom: 1.75rem;
    }

    .content-dashboard .activity-item:last-child {
        margin-bottom: 0;
    }

    .content-dashboard .activity-item::before {
        content: '';
        position: absolute;
        left: -0.1rem;
        top: 0.35rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
    }

    .content-dashboard .activity-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(102, 126, 234, 0.1);
        color: #4c51bf;
        margin-bottom: 0.35rem;
    }

    .content-dashboard .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
    }

    .content-dashboard .empty-state i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: rgba(102, 126, 234, 0.4);
    }

    .content-dashboard .btn-edit {
        border-radius: 999px;
        padding: 0.45rem 1.2rem;
        font-weight: 600;
        border: none;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
    }

    .content-dashboard .btn-edit:hover {
        color: #fff;
        background: linear-gradient(135deg, #5a6fd8, #6a4190);
    }

    .fade-in {
        opacity: 0;
        animation: fadeIn 0.45s ease forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 991.98px) {
        .content-dashboard .dashboard-hero .card-body {
            padding: 2rem;
        }

        .content-dashboard .hero-title {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 767.98px) {
        .content-dashboard .quick-stats .card-body {
            flex-direction: column;
            text-align: center;
        }

        .content-dashboard .stat-icon {
            margin-bottom: 0.5rem;
        }

        .content-dashboard .content-tabs {
            justify-content: flex-start;
        }
    }
</style>
@endpush

@section('content')
@php
    $lastEdit = $recentEdits[0] ?? null;
    $lastEditHuman = $lastEdit['human_time'] ?? null;
    $lastEditFile = $lastEdit['file'] ?? null;
@endphp
<div class="content-dashboard container-fluid px-4">
    <div class="dashboard-hero card mb-4 text-white">
        <div class="card-body">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <h1 class="hero-title mb-2">
                        <i class="fas fa-edit me-2"></i>Content Management Dashboard
                    </h1>
                    <p class="hero-subtitle mb-0">
                        Manage Blade templates, translation files, and media assets from one focused workspace.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="hero-meta">
                        <small class="text-white-50 d-block mb-1">Last change</small>
                        <span>{{ $lastEditHuman ?? 'No edits recorded yet' }}</span>
                        @if ($lastEditFile)
                            <small class="text-white-50">{{ $lastEditFile }}</small>
                        @endif
                    </div>
                    <div class="hero-meta mt-3">
                        <small class="text-white-50 d-block mb-1">Dashboard cached</small>
                        <span>{{ now()->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="quick-stats row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-gradient-primary">
                        <i class="fas fa-file-code"></i>
                    </div>
                    <div>
                        <p class="text-muted text-uppercase fw-semibold mb-1 small">Blade Templates</p>
                        <h3 class="mb-0">{{ number_format($statistics['total_views'] ?? count($viewFiles)) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-gradient-success">
                        <i class="fas fa-language"></i>
                    </div>
                    <div>
                        <p class="text-muted text-uppercase fw-semibold mb-1 small">Translation Entries</p>
                        <h3 class="mb-0">{{ number_format($statistics['total_languages'] ?? 0) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-gradient-warning">
                        <i class="fas fa-images"></i>
                    </div>
                    <div>
                        <p class="text-muted text-uppercase fw-semibold mb-1 small">Media Assets</p>
                        <h3 class="mb-0">{{ number_format($statistics['total_images'] ?? count($imageFiles)) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-gradient-info">
                        <i class="fas fa-database"></i>
                    </div>
                    <div>
                        <p class="text-muted text-uppercase fw-semibold mb-1 small">Content Footprint</p>
                        <h3 class="mb-0">{{ $statistics['disk_usage'] ?? '0 B' }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills content-tabs mb-3" id="contentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-templates-pill" data-bs-toggle="tab" data-bs-target="#tab-templates"
                    type="button" role="tab" aria-controls="tab-templates" aria-selected="true">
                <i class="fas fa-file-code"></i>
                <span>Templates</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-languages-pill" data-bs-toggle="tab" data-bs-target="#tab-languages"
                    type="button" role="tab" aria-controls="tab-languages" aria-selected="false">
                <i class="fas fa-language"></i>
                <span>Languages</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-media-pill" data-bs-toggle="tab" data-bs-target="#tab-media"
                    type="button" role="tab" aria-controls="tab-media" aria-selected="false">
                <i class="fas fa-images"></i>
                <span>Media</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-activity-pill" data-bs-toggle="tab" data-bs-target="#tab-activity"
                    type="button" role="tab" aria-controls="tab-activity" aria-selected="false">
                <i class="fas fa-history"></i>
                <span>Activity</span>
            </button>
        </li>
    </ul>

    <div class="tab-content" id="contentTabsContent">
        {{-- Templates --}}
        <div class="tab-pane fade show active" id="tab-templates" role="tabpanel" aria-labelledby="tab-templates-pill">
            <div class="card mb-4">
                <div class="card-header bg-white border-0 py-4">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h5 class="mb-1">Blade Templates</h5>
                            <small class="text-muted">Browse and edit any published view</small>
                        </div>
                        <div class="search-wrapper w-100 w-md-auto">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="searchBlades"
                                       placeholder="Search templates by name or folder">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 template-table">
                        <thead>
                            <tr>
                                <th scope="col">Template</th>
                                <th scope="col" class="text-center">Directory</th>
                                <th scope="col" class="text-end">Size</th>
                                <th scope="col" class="text-end">Modified</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="bladesTableBody">
                        @forelse ($viewFiles as $index => $file)
                            <tr class="file-row fade-in"
                                data-name="{{ strtolower($file['name']) }}"
                                style="animation-delay: {{ 0.3 + ($index * 0.04) }}s">
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="file-initial">
                                            {{ strtoupper(substr($file['name'], 0, 1)) }}
                                        </span>
                                        <div>
                                            <div class="fw-semibold">{{ $file['name'] }}</div>
                                            <small class="text-muted">{{ $file['path'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-soft badge-dir">{{ $file['directory'] }}</span>
                                </td>
                                <td class="text-end">
                                    <span class="text-muted small">
                                        {{ $file['human_size'] ?? number_format($file['size'] / 1024, 1) . ' KB' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <small class="text-muted">
                                        {{ $file['human_date'] ?? \Carbon\Carbon::createFromTimestamp($file['modified'])->diffForHumans() }}
                                    </small>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-edit"
                                       href="{{ route('admin.content.edit', ['file' => $file['path']]) }}">
                                        <i class="fas fa-pen-to-square me-1"></i>Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-file-circle-question"></i>
                                        <p class="mb-0">No Blade templates were detected in the project.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Languages --}}
        <div class="tab-pane fade" id="tab-languages" role="tabpanel" aria-labelledby="tab-languages-pill">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-between gap-3 mb-3">
                <div>
                    <h5 class="mb-1">Language Files</h5>
                    <small class="text-muted">Locales available for translation management</small>
                </div>
                <a href="{{ route('admin.content.language.manage', app()->getLocale()) }}"
                   class="btn btn-outline-primary">
                    <i class="fas fa-language me-1"></i>Open Language Manager
                </a>
            </div>
            <div class="row g-3">
                @forelse ($languageFiles as $locale => $files)
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="card language-card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge badge-soft-success">{{ strtoupper($locale) }}</span>
                                    <span class="text-muted small">
                                        {{ count($files) }} file{{ count($files) === 1 ? '' : 's' }}
                                    </span>
                                </div>
                                <a href="{{ route('admin.content.language.manage', $locale) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Manage
                                </a>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach ($files as $file)
                                    <div class="list-group-item d-flex align-items-center justify-content-between">
                                        <div>
                                            <strong>{{ $file['name'] }}.php</strong>
                                            <div class="text-muted small">
                                                {{ $file['human_size'] ?? number_format($file['size'] / 1024, 1) . ' KB' }}
                                                &middot; {{ \Carbon\Carbon::createFromTimestamp($file['modified'])->diffForHumans() }}
                                            </div>
                                        </div>
                                        <span class="badge badge-soft-warning">{{ $locale }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="empty-state mb-0">
                                    <i class="fas fa-language"></i>
                                    <p class="mb-0">No translation files available yet. Create a locale from the language manager.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Media --}}
        <div class="tab-pane fade" id="tab-media" role="tabpanel" aria-labelledby="tab-media-pill">
            <div class="card mb-4">
                <div class="card-header bg-white border-0 py-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h5 class="mb-1">Media Library</h5>
                        <small class="text-muted">
                            Showing the {{ min(12, count($imageFiles)) }} most recent uploads
                        </small>
                    </div>
                    <span class="badge badge-soft">
                        Total assets: {{ number_format(count($imageFiles)) }}
                    </span>
                </div>
                <div class="card-body">
                    @if (count($imageFiles) > 0)
                        <div class="row g-3">
                            @foreach (array_slice($imageFiles, 0, 12) as $image)
                                <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                                    <div class="media-card card h-100">
                                        <img src="{{ $image['url'] }}" alt="{{ $image['name'] }}" class="image-preview">
                                        <div class="card-body p-3">
                                            <div class="fw-semibold text-truncate">{{ $image['name'] }}</div>
                                            <div class="text-muted small mb-1">
                                                {{ $image['human_size'] ?? number_format($image['size'] / 1024, 1) . ' KB' }}
                                            </div>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::createFromTimestamp($image['modified'])->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-images"></i>
                            <p class="mb-0">No media assets uploaded yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Activity --}}
        <div class="tab-pane fade" id="tab-activity" role="tabpanel" aria-labelledby="tab-activity-pill">
            <div class="card">
                <div class="card-header bg-white border-0 py-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h5 class="mb-1">Recent Activity</h5>
                        <small class="text-muted">Tracked edits across templates, languages, and media</small>
                    </div>
                    <span class="badge badge-soft">
                        {{ count($recentEdits) }} update{{ count($recentEdits) === 1 ? '' : 's' }} stored
                    </span>
                </div>
                <div class="card-body">
                    @if (count($recentEdits) > 0)
                        @php
                            $activityIcons = [
                                'view' => 'fa-file-code',
                                'language' => 'fa-language',
                                'media' => 'fa-image',
                            ];
                        @endphp
                        <div class="activity-timeline">
                            @foreach ($recentEdits as $entry)
                                @php
                                    $category = $entry['category'] ?? 'view';
                                    $icon = $activityIcons[$category] ?? 'fa-edit';
                                    $typeLabel = \Illuminate\Support\Str::headline($entry['update_type'] ?? 'update');
                                @endphp
                                <div class="activity-item fade-in">
                                    <div class="activity-icon">
                                        <i class="fas {{ $icon }}"></i>
                                    </div>
                                    <div class="fw-semibold">{{ $typeLabel }}</div>
                                    <div class="text-muted small mb-1">
                                        {{ $entry['file'] ?? 'Unknown file' }}
                                    </div>
                                    <div class="text-muted small">
                                        <i class="fas fa-user me-1"></i>{{ $entry['user'] ?? 'System' }}
                                        <span class="mx-2">&middot;</span>
                                        <i class="fas fa-clock me-1"></i>{{ $entry['human_time'] ?? 'Moments ago' }}
                                    </div>
                                    @if (!empty($entry['locale']))
                                        <div class="text-muted small mt-1">
                                            <i class="fas fa-language me-1"></i>{{ strtoupper($entry['locale']) }}
                                            @if (!empty($entry['entries']))
                                                <span class="mx-2">&middot;</span>{{ $entry['entries'] }} keys
                                            @endif
                                        </div>
                                    @endif
                                    @if (!empty($entry['size']) && ($entry['category'] ?? '') === 'view')
                                        <div class="text-muted small mt-1">
                                            <i class="fas fa-weight-hanging me-1"></i>{{ number_format($entry['size'] / 1024, 1) }} KB saved
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-history"></i>
                            <p class="mb-0">Content edits will appear here once changes are published.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchBlades');
    const tableBody = document.getElementById('bladesTableBody');
    const rows = tableBody ? tableBody.querySelectorAll('tr[data-name]') : [];

    searchInput?.addEventListener('input', debounce((event) => {
        const searchTerm = event.target.value.toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.dataset.name ?? '';
            const directory = row.querySelector('.badge-dir')?.textContent.toLowerCase() ?? '';
            const matches = name.includes(searchTerm) || directory.includes(searchTerm);

            if (matches) {
                row.style.display = '';
                row.style.animationDelay = `${visibleCount * 0.04}s`;
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noResultsRow = tableBody.querySelector('.no-results');
        if (visibleCount === 0 && searchTerm) {
            if (!noResultsRow) {
                const newRow = document.createElement('tr');
                newRow.className = 'no-results';
                newRow.innerHTML = `
                    <td colspan="5">
                        <div class="empty-state mb-0">
                            <i class="fas fa-search"></i>
                            <p class="mb-0">No templates matched "<strong>${searchTerm}</strong>"</p>
                        </div>
                    </td>
                `;
                tableBody.appendChild(newRow);
            }
        } else if (noResultsRow) {
            noResultsRow.remove();
        }
    }, 250));

    document.addEventListener('click', (event) => {
        const fileRow = event.target.closest('.file-row');
        if (fileRow && !event.target.closest('.btn')) {
            const editButton = fileRow.querySelector('.btn-edit');
            if (editButton && !editButton.classList.contains('loading')) {
                editButton.classList.add('loading');
                editButton.dataset.originalLabel = editButton.innerHTML;
                editButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Loading';

                setTimeout(() => {
                    window.location.href = editButton.href;
                }, 300);
            }
        }
    });

    document.addEventListener('keydown', (event) => {
        if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {
            event.preventDefault();
            searchInput?.focus();
        }

        if (event.key === 'Escape' && document.activeElement === searchInput) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.blur();
        }
    });

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
    }, { rootMargin: '24px' });

    document.querySelectorAll('.image-preview').forEach(img => {
        imageObserver.observe(img);
    });
});

function debounce(fn, wait) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn.apply(this, args), wait);
    };
}
</script>
@endpush

