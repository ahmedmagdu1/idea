{{-- resources/views/admin/content/edit.blade.php --}}
@extends('admin.layout.app')
@section('title',"Edit $filePath")

@push('styles')
<style>
    :root {
        --primary-color: #2563eb;
        --success-color: #059669;
        --warning-color: #d97706;
        --danger-color: #dc2626;
        --info-color: #0891b2;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-600: #4b5563;
        --gray-800: #1f2937;
        --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f8fafc;
    }

    /* Toolbar Styling */
    #toolbar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: var(--shadow-lg);
        border: none !important;
        padding: 1rem 1.5rem;
        height: auto;
    }

    #toolbar .form-select {
        border: none;
        border-radius: 8px;
        box-shadow: var(--shadow);
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    #toolbar .form-select:focus {
        box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
        transform: translateY(-1px);
    }

    #toolbar .btn {
        border: none;
        border-radius: 8px;
        font-weight: 600;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    #toolbar .btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s;
    }

    #toolbar .btn:hover:before {
        left: 100%;
    }

    #toolbar .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    #toolbar .btn-primary { background: #3b82f6; }
    #toolbar .btn-info { background: #06b6d4; }
    #toolbar .btn-warning { background: #f59e0b; }

    #saveStatus {
        background: rgba(255,255,255,0.9);
        color: var(--gray-800);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    /* Split Container */
    #splitContainer {
        height: calc(100vh - 5rem);
        background: white;
        border-radius: 12px;
        margin: 1rem;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .gutter {
        background: linear-gradient(to bottom, #e2e8f0, #cbd5e1);
        cursor: col-resize;
        width: 6px;
        position: relative;
        transition: all 0.3s ease;
    }

    .gutter:hover {
        background: linear-gradient(to bottom, #94a3b8, #64748b);
        width: 8px;
    }

    .gutter:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 2px;
        height: 40px;
        background: var(--gray-300);
        border-radius: 1px;
    }

    /* Editor Styling */
    #editor {
        border-radius: 12px 0 0 12px;
        background: #1e293b;
        position: relative;
    }

    .CodeMirror {
        height: 100% !important;
        font-size: 14px;
        font-family: 'Fira Code', 'Monaco', 'Menlo', monospace;
        border-radius: 12px 0 0 12px;
        background: #1e293b !important;
        color: #e2e8f0 !important;
    }

    .CodeMirror-gutters {
        background: #334155 !important;
        border: none;
    }

    .CodeMirror-linenumber {
        color: #64748b !important;
    }

    .CodeMirror-cursor {
        border-left: 2px solid #3b82f6 !important;
    }

    .CodeMirror-selected {
        background: rgba(59, 130, 246, 0.2) !important;
    }

    /* Preview Frame */
    #preview {
        border-radius: 0 12px 12px 0;
        background: white;
        border: none;
    }

    /* Modal Enhancements */
    .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
        color: white;
        border: none;
        padding: 1.5rem 2rem 1rem;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .modal-body {
        padding: 2rem;
        background: #fafbff;
    }

    .modal-footer {
        background: white;
        border: none;
        padding: 1rem 2rem 2rem;
    }

    /* Image Gallery */
    .image-gallery {
        max-height: 400px;
        overflow-y: auto;
        border-radius: 12px;
        background: white;
        padding: 1rem;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
    }

    .image-item {
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        border: 2px solid transparent;
    }

    .image-item:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .image-item:hover::after {
    content: '✓ Insert'; /* Changed from broken character */
    position: absolute;        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(37, 99, 235, 0.9);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .image-item img {
        height: 120px;
        object-fit: cover;
        width: 100%;
        transition: all 0.3s ease;
    }

    .image-item:hover img {
        transform: scale(1.05);
    }

    .delete-image {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        z-index: 10;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .image-item:hover .delete-image {
        opacity: 1;
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed var(--gray-300);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        background: white;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: var(--primary-color);
        background: rgba(37, 99, 235, 0.05);
    }

    .upload-area.dragover {
        border-color: var(--success-color);
        background: rgba(5, 150, 105, 0.1);
    }

    /* Language Editor */
    #languageFileList .list-group-item {
        border: none;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    #languageFileList .list-group-item:hover {
        background: var(--primary-color);
        color: white;
        transform: translateX(4px);
    }

    #languageFileList .list-group-item.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
    }

    .language-entries {
        max-height: 400px;
        overflow-y: auto;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
    }

    .lang-input {
        border: 2px solid var(--gray-200);
        border-radius: 8px;
        transition: all 0.3s ease;
        padding: 0.75rem;
    }

    .lang-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* Breadcrumbs */
    .breadcrumb-container {
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
    }

    /* Loading States */
    .loading {
        position: relative;
        overflow: hidden;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    /* Success/Error Messages */
    .alert-custom {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        font-weight: 500;
        position: fixed;
        top: 2rem;
        right: 2rem;
        z-index: 9999;
        animation: slideIn 0.3s ease;
        box-shadow: var(--shadow-lg);
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        #toolbar {
            padding: 0.75rem;
            flex-direction: column;
            gap: 0.5rem;
        }

        #splitContainer {
            margin: 0.5rem;
            flex-direction: column;
        }

        .gutter {
            height: 6px;
            width: 100%;
            cursor: row-resize;
        }

        #editor, #preview {
            height: 50vh;
        }
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600&display=swap">
@endpush

@section('content')
<div class="container-fluid p-0">
    <!-- Enhanced Toolbar -->
    <div id="toolbar" class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <!-- Breadcrumbs -->
            <div class="breadcrumb-container">
                <i class="fas fa-folder me-1"></i>
                {{ dirname($filePath) }} / <strong>{{ basename($filePath, '.blade.php') }}</strong>
            </div>

            <!-- Language Selector -->
            <select id="localeSelect" class="form-select form-select-sm">
                @foreach(array_keys($languageFiles) as $lng)
                    <option value="{{ $lng }}" @selected($lng===$locale)>
                        <i class="flag-icon flag-icon-{{ $lng }}"></i>
                        {{ strtoupper($lng) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Action Buttons -->
            <button id="saveBtn" class="btn btn-primary" title="{{ __('admin.save_changes_ctrl_s') }}">
                <i class="fas fa-save me-1"></i>{{ __('admin.save') }}
            </button>
            <button id="imageBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#imageModal" title="{{ __('admin.manage_images') }}">
                <i class="fas fa-images me-1"></i>{{ __('admin.images') }}
            </button>
            <button id="langBtn" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#languageModal" title="{{ __('admin.edit_languages') }}">
                <i class="fas fa-language me-1"></i>{{ __('admin.languages') }}
            </button>

            <!-- Status -->
            <span id="saveStatus" class="text-muted"></span>
        </div>
    </div>

    <!-- Enhanced Split Container -->
    <div id="splitContainer" class="d-flex">
        <div id="editor" class="flex-fill position-relative">
            <!-- Editor will be initialized here -->
        </div>
        <div class="gutter" title="Drag to resize"></div>
        <iframe id="preview" class="flex-fill border-0" title="Live Preview"></iframe>
    </div>
</div>

<!-- Enhanced Image Management Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">
                    <i class="fas fa-images me-2"></i>{{ __('admin.image_manager') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Enhanced Upload Area -->
                <div class="upload-area mb-4" id="uploadArea">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                        <h6>{{ __('admin.drag_drop_images') }}</h6>
                        <p class="text-muted mb-3">{{ __('admin.or_click_browse') }}</p>

                        <div class="row w-100">
                            <div class="col-md-6">
                                <input type="file" class="form-control" id="imageUpload" accept="image/*" multiple>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="folderName" placeholder="{{ __('admin.folder_name_optional') }}">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100" id="uploadBtn">
                                    <i class="fas fa-upload me-1"></i>{{ __('admin.upload') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Image Gallery -->
                <div class="image-gallery">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">
                            <i class="fas fa-folder-open me-2"></i>{{ __('admin.image_library') }}
                            <span class="badge bg-primary ms-2">{{ count($imageFiles) }}</span>
                        </h6>
                        <div class="input-group" style="width: 250px;">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="imageSearch" placeholder="{{ __('admin.search_images') }}">
                        </div>
                    </div>

                    <div class="row" id="imageGallery">
                        @forelse($imageFiles as $image)
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3" data-name="{{ strtolower($image['name']) }}">
                                <div class="card image-item h-100" data-url="{{ $image['url'] }}" data-path="{{ $image['path'] }}">
                                    <div class="position-relative">
                                        <img src="{{ $image['url'] }}" class="card-img-top" alt="{{ $image['name'] }}">
                                        <button class="btn btn-danger btn-sm delete-image" data-path="{{ $image['path'] }}" title="Delete Image">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="card-body p-2">
                                        <small class="text-muted d-block text-truncate" title="{{ $image['name'] }}">
                                            {{ $image['name'] }}
                                        </small>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-success">
                                                {{ number_format($image['size']/1024, 1) }} KB
                                            </small>
                                            <small class="text-muted">
                                                {{ $image['folder'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                                <p class="text-muted">{{ __('admin.no_images_uploaded') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Language Management Modal -->
<div class="modal fade" id="languageModal" tabindex="-1" aria-labelledby="languageModalLabel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="languageModalLabel">
                    <i class="fas fa-language me-2"></i>{{ __('admin.language_manager') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-file-alt me-2"></i>{{ __('admin.language_files') }}
                            </h6>
                            </div>
                            <div class="card-body p-0">
                                <div id="languageFileList" class="list-group list-group-flush">
                                    @forelse($languageFiles[$locale] ?? [] as $langFile)
                                        <a href="#" class="list-group-item list-group-item-action lang-file d-flex justify-content-between align-items-center"
                                           data-file="{{ $langFile['name'] }}">
                                            <span>
                                                <i class="fas fa-file-code me-2"></i>
                                                {{ $langFile['name'] }}.php
                                            </span>
                                            <small class="text-muted">{{ number_format($langFile['size']/1024, 1) }}KB</small>
                                        </a>
                                    @empty
                                        <div class="list-group-item text-muted text-center">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i>
                                            <p class="mb-0">{{ __('admin.no_language_files') }}</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="fas fa-edit me-2"></i>{{ __('admin.edit_content') }}
                                </h6>
                                <button class="btn btn-sm btn-success" id="addLangEntry" style="display: none;">
                                    <i class="fas fa-plus me-1"></i>{{ __('admin.add_entry') }}
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="languageEditor">
                                    <div class="text-center py-5">
                                        <i class="fas fa-hand-pointer fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">{{ __('admin.select_language_file') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>{{ __('admin.close') }}
                </button>
                <button type="button" class="btn btn-primary" id="saveLangBtn" disabled>
                    <i class="fas fa-save me-1"></i>{{ __('admin.save_changes') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Notification Container -->
<div id="notificationContainer" style="position: fixed; top: 2rem; right: 2rem; z-index: 9999;"></div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/split.js/1.6.5/split.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/xml/xml.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/css/css.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/htmlmixed/htmlmixed.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Utility Functions
    function showNotification(message, type = 'info') {
        const container = document.getElementById('notificationContainer');
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-custom alert-dismissible fade show`;
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        container.appendChild(notification);

        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }

    function setLoading(element, isLoading) {
        if (isLoading) {
            element.classList.add('loading');
            element.disabled = true;
        } else {
            element.classList.remove('loading');
            element.disabled = false;
        }
    }

    // Initialize Split.js with enhanced configuration
    const splitInstance = Split(['#editor','#preview'], {
        sizes: [50, 50],
        gutterSize: 6,
        cursor: 'col-resize',
        minSize: [300, 300],
        snapOffset: 30,
        dragInterval: 1,
        direction: 'horizontal',
        onDragEnd: function() {
            cm.refresh(); // Refresh CodeMirror after resize
        }
    });

    // Initialize Enhanced CodeMirror
    const cm = CodeMirror(document.getElementById('editor'), {
        value: @js($fileContent),
        mode: 'htmlmixed',
        theme: 'material-darker',
        lineNumbers: true,
        autofocus: true,
        indentUnit: 2,
        tabSize: 2,
        lineWrapping: true,
        foldGutter: true,
        gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
        autoCloseBrackets: true,
        autoCloseTags: true,
        matchBrackets: true,
        matchTags: true,
        showCursorWhenSelecting: true,
        styleActiveLine: true,
        extraKeys: {
            "Ctrl-Space": "autocomplete",
            "F11": function(cm) {
                cm.setOption("fullScreen", !cm.getOption("fullScreen"));
            },
            "Esc": function(cm) {
                if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
            }
        }
    });

    // Locale switch with smooth transition
    document.getElementById('localeSelect').addEventListener('change', e => {
        setLoading(e.target, true);
        const url = new URL(window.location);
        url.searchParams.set('locale', e.target.value);
        window.location = url;
    });

    // Enhanced Save functionality
    const saveStatus = document.getElementById('saveStatus');
    const saveBtn = document.getElementById('saveBtn');

    async function save() {
        setLoading(saveBtn, true);
        saveStatus.textContent = 'Saving...';

        try {
            const response = await fetch('{{ route("admin.content.update") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    file: '{{ $filePath }}',
                    content: cm.getValue(),
                    update_type: 'full'
                })
            });

            const result = await parseJsonSafe(response);

            if (result.success) {
                saveStatus.textContent = 'Saved âœ“';
                showNotification('File saved successfully!', 'success');
            } else {
                saveStatus.textContent = 'Error âœ•';
                showNotification('Failed to save file: ' + (result.message || 'Unknown error'), 'danger');
            }
        } catch (error) {
            saveStatus.textContent = 'Error âœ•';
            showNotification('Network error occurred while saving', 'danger');
        } finally {
            setLoading(saveBtn, false);
            setTimeout(() => saveStatus.textContent = '', 3000);
        }
    }

    saveBtn.addEventListener('click', save);

    // Keyboard shortcuts
    window.addEventListener('keydown', e => {
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            save();
        }
    });

    // Enhanced Live preview with SSE
    const previewFrame = document.getElementById('preview');
    const eventSource = new EventSource('{{ route("admin.content.stream") }}');

    eventSource.onmessage = function(event) {
        if (event.data) {
            try {
                const html = atob(event.data);
                previewFrame.srcdoc = html;
            } catch (error) {
                console.error('Preview decode error:', error);
            }
        }
    };

    eventSource.onerror = function(error) {
        console.error('SSE connection error:', error);
    };

    const doPreview = _.debounce(async () => {
        try {
            await fetch('{{ route("admin.content.preview") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    content: cm.getValue(),
                    locale: '{{ $locale }}'
                })
            });
        } catch (error) {
            console.error('Preview error:', error);
        }
    }, 300);

    cm.on('change', doPreview);
    doPreview(); // Initial preview

    // Enhanced Image Upload with Drag & Drop
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('imageUpload');
    const uploadBtn = document.getElementById('uploadBtn');
    const folderInput = document.getElementById('folderName');

    // Drag & Drop functionality
    uploadArea.addEventListener('click', () => fileInput.click());

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            uploadImages();
        }
    });

    async function uploadImages() {
        const files = fileInput.files;
        if (!files.length) {
            showNotification('Please select at least one image', 'warning');
            return;
        }

        setLoading(uploadBtn, true);

        for (let i = 0; i < files.length; i++) {
            const formData = new FormData();
            formData.append('image', files[i]);
            if (folderInput.value) {
                formData.append('folder', folderInput.value);
            }

            try {
                const response = await fetch('{{ route("admin.content.image.upload") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const result = await parseJsonSafe(response);
                if (result.success) {
                    addImageToGallery(result.image);
                    showNotification(`${files[i].name} uploaded successfully!`, 'success');
                } else {
                    showNotification(`Upload failed for ${files[i].name}: ${result.message}`, 'danger');
                }
            } catch (error) {
                showNotification(`Upload error for ${files[i].name}: ${error.message}`, 'danger');
            }
        }

        setLoading(uploadBtn, false);
        fileInput.value = '';
    }

    function addImageToGallery(image) {
        const gallery = document.getElementById('imageGallery');
        const imageDiv = document.createElement('div');
        imageDiv.className = 'col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3';
        imageDiv.setAttribute('data-name', image.filename.toLowerCase());

        imageDiv.innerHTML = `
            <div class="card image-item h-100" data-url="${image.url}" data-path="${image.path}">
                <div class="position-relative">
                    <img src="${image.url}" class="card-img-top" alt="${image.filename}">
                    <button class="btn btn-danger btn-sm delete-image" data-path="${image.path}" title="Delete Image">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="card-body p-2">
                    <small class="text-muted d-block text-truncate" title="${image.filename}">
                        ${image.filename}
                    </small>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-success">
                            ${(image.size/1024).toFixed(1)} KB
                        </small>
                        <small class="text-muted">
                            ${image.folder || 'general'}
                        </small>
                    </div>
                </div>
            </div>
        `;

        gallery.insertBefore(imageDiv, gallery.firstChild);
    }

    uploadBtn.addEventListener('click', uploadImages);

    // Image search functionality
    const imageSearch = document.getElementById('imageSearch');
    imageSearch?.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const imageItems = document.querySelectorAll('#imageGallery [data-name]');

        imageItems.forEach(item => {
            const name = item.dataset.name;
            if (name.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Enhanced Image selection and deletion
    document.addEventListener('click', (e) => {
        // Image insertion
        if (e.target.closest('.image-item') && !e.target.closest('.delete-image')) {
            const imageItem = e.target.closest('.image-item');
            const imageUrl = imageItem.dataset.url;
            const imageName = imageItem.querySelector('img').alt;
            const imageTag = `<img src="${imageUrl}" alt="${imageName}" class="img-fluid">`;

            const cursor = cm.getCursor();
            cm.replaceRange(imageTag, cursor);
            cm.focus();

            const modal = bootstrap.Modal.getInstance(document.getElementById('imageModal'));
            modal.hide();

            showNotification('Image inserted successfully!', 'success');
        }

        // Image deletion
        if (e.target.closest('.delete-image')) {
            e.stopPropagation();

            const deleteBtn = e.target.closest('.delete-image');
            const path = deleteBtn.dataset.path;
            const imageItem = deleteBtn.closest('[data-name]');
            const imageName = imageItem.querySelector('img').alt;

            if (!confirm(`Are you sure you want to delete "${imageName}"?`)) return;

            setLoading(deleteBtn, true);

            fetch('{{ route("admin.content.image.delete") }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ path })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    imageItem.remove();
                    showNotification(`"${imageName}" deleted successfully!`, 'success');
                } else {
                    showNotification(`Delete failed: ${result.message}`, 'danger');
                }
            })
            .catch(error => {
                showNotification(`Delete error: ${error.message}`, 'danger');
            })
            .finally(() => {
                setLoading(deleteBtn, false);
            });
        }
    });

    // Enhanced Language Management
    const localeSelect = document.getElementById('localeSelect');
    let currentLocale = localeSelect ? localeSelect.value : '{{ $locale }}';
    let currentLanguageFile = null;
    let languageData = {};
    const saveLangBtn = document.getElementById('saveLangBtn');
    const addEntryBtn = document.getElementById('addLangEntry');
    const languageDataUrlTemplate = @json(route('admin.content.language.data', ['locale' => '__LOCALE__']));\n    const parseJsonSafe = async (response) => {\n        try { return await response.json(); }\n        catch(e){ const t = await response.text(); const cleaned=t.replace(/^\\uFEFF+/, '').trimStart(); return JSON.parse(cleaned); }\n    };
    const languageUpdateUrl = @json(route('admin.content.language.update'));
    const csrfToken = @json(csrf_token());

    const escapeHtml = (value) => {
        if (value === null || value === undefined) {
            return '';
        }
        return String(value).replace(/[&<>"']/g, (ch) => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
        }[ch] || ch));
    };

    document.addEventListener('click', async (event) => {
        const item = event.target.closest('.lang-file');
        if (!item) {
            return;
        }

        event.preventDefault();
        currentLocale = localeSelect ? localeSelect.value : currentLocale;
        document.querySelectorAll('.lang-file').forEach(node => node.classList.remove('active'));
        item.classList.add('active');
        currentLanguageFile = item.dataset.file;

        try {
            const dataUrl = languageDataUrlTemplate.replace('__LOCALE__', currentLocale);
            const response = await fetch(dataUrl, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
            });
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            const result = await parseJsonSafe(response);

            if (result.success) {
                const fileData = result.data[currentLanguageFile] ?? {};
                languageData = JSON.parse(JSON.stringify(fileData));
                renderLanguageEditor();
                saveLangBtn.disabled = false;
                addEntryBtn.style.display = 'inline-block';
            } else {
                showNotification('Failed to load language data', 'danger');
            }
        } catch (error) {
            console.error('Failed to load language data:', error);
            showNotification('Failed to load language data', 'danger');
        }
    });

    const renderLanguageEditor = () => {
        const editor = document.getElementById('languageEditor');
        const entries = Object.entries(languageData);

        if (!entries.length) {
            editor.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-file-plus fa-3x text-muted mb-3"></i>
                    <p class="text-muted">{{ __('admin.language_file_empty') }}</p>
                </div>
            `;
            return;
        }

        const blocks = entries.map(([key, value]) => {
            const isObject = value !== null && typeof value === 'object';
            const displayValue = isObject ? JSON.stringify(value, null, 2) : (value ?? '');
            const escapedValue = escapeHtml(displayValue);
            const rows = Math.max(3, Math.min(12, String(displayValue).split('\n').length + 1));

            const control = isObject
                ? `<textarea class="form-control lang-input" data-key="${key}" data-type="json" rows="${rows}">${escapedValue}</textarea>`
                : `<input type="text" class="form-control lang-input" data-key="${key}" data-type="string" value="${escapedValue}" placeholder="{{ __('admin.enter_translation') }}">`;

            return `
                <div class="mb-3 lang-entry">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label mb-0 fw-semibold">${key}</label>
                        <button class="btn btn-sm btn-outline-danger remove-entry" data-key="${key}" title="Remove Entry">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    ${control}
                </div>
            `;
        });

        editor.innerHTML = `<div class="language-entries">${blocks.join('')}</div>`;
    };

    addEntryBtn.addEventListener('click', () => {
        const key = prompt('Enter the new translation key:');
        if (!key || !key.trim()) {
            return;
        }

        const trimmedKey = key.trim();
        if (Object.prototype.hasOwnProperty.call(languageData, trimmedKey)) {
            showNotification('This key already exists!', 'warning');
            return;
        }

        languageData[trimmedKey] = '';
        renderLanguageEditor();
        showNotification('New entry added successfully!', 'success');
    });

    document.addEventListener('click', (event) => {
        const removeBtn = event.target.closest('.remove-entry');
        if (!removeBtn) {
            return;
        }

        const key = removeBtn.dataset.key;
        if (confirm(`Are you sure you want to remove the "${key}" entry?`)) {
            delete languageData[key];
            renderLanguageEditor();
            showNotification('Entry removed successfully!', 'success');
        }
    });

    document.addEventListener('input', (event) => {
        const input = event.target;
        if (!input.classList.contains('lang-input')) {
            return;
        }

        const { key, type } = input.dataset;
        if (type === 'json') {
            try {
                const parsed = JSON.parse(input.value || 'null');
                languageData[key] = parsed;
                input.classList.remove('is-invalid');
            } catch {
                input.classList.add('is-invalid');
            }
        } else {
            languageData[key] = input.value;
        }
    });

    saveLangBtn.addEventListener('click', async () => {
        if (!currentLanguageFile) {
            showNotification('Please select a language file first', 'warning');
            return;
        }
        if (document.querySelector('.lang-input.is-invalid')) {
            showNotification('Fix highlighted JSON entries before saving', 'danger');
            return;
        }

        setLoading(saveLangBtn, true);

        try {
            const response = await fetch(languageUpdateUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    locale: currentLocale,
                    file: currentLanguageFile,
                    data: languageData,
                }),
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            const result = await parseJsonSafe(response);
            if (result.success) {
                showNotification('Language file saved successfully!', 'success');
            } else {
                showNotification(`Save failed: ${result.message || 'Unknown error'}`, 'danger');
            }
        } catch (error) {
            showNotification(`Save error: ${error.message}`, 'danger');
        } finally {
            setLoading(saveLangBtn, false);
        }
    });

    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
        if (eventSource) {
            eventSource.close();
        }
    });
});
</script>
@endpush

