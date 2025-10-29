{{-- resources/views/admin/content/language.blade.php --}}
@extends('admin.layout.app')
@section('title', 'Language Manager')

@section('content')
<div class="container-fluid px-4">
  <div class="d-flex align-items-center justify-content-between py-3 border-bottom mb-3">
    <div>
      <h3 class="mb-0"><i class="fas fa-language me-2"></i>Language Manager</h3>
      <small class="text-muted">Manage translation files by locale</small>
    </div>
    <div class="d-flex align-items-center gap-2">
      <select id="localeSelect" class="form-select">
        @foreach(array_keys($languageFiles) as $lng)
          <option value="{{ $lng }}" @selected($lng===$locale)>{{ strtoupper($lng) }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-light"><strong>Language Files ({{ strtoupper($locale) }})</strong></div>
        <div class="card-body p-0">
          <div id="languageFileList" class="list-group list-group-flush">
            @forelse($languageFiles[$locale] ?? [] as $langFile)
              <a href="#" class="list-group-item list-group-item-action lang-file d-flex justify-content-between align-items-center"
                 data-file="{{ $langFile['name'] }}">
                <span><i class="fas fa-file-code me-2"></i>{{ $langFile['name'] }}.php</span>
                <small class="text-muted">{{ number_format($langFile['size']/1024, 1) }}KB</small>
              </a>
            @empty
              <div class="list-group-item text-muted text-center">
                <i class="fas fa-folder-open fa-2x mb-2"></i>
                <p class="mb-0">No language files found</p>
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
          <strong>Edit Content</strong>
          <button class="btn btn-sm btn-success" id="addLangEntry" style="display:none;">
            <i class="fas fa-plus me-1"></i> Add Entry
          </button>
        </div>
        <div class="card-body">
          <div id="languageEditor">
            <div class="text-center py-5">
              <i class="fas fa-hand-pointer fa-3x text-muted mb-3"></i>
              <p class="text-muted">Select a language file to start editing</p>
            </div>
          </div>
        </div>
        <div class="card-footer d-flex justify-content-end gap-2">
          <a href="{{ route('admin.content.index') }}" class="btn btn-outline-secondary">Back</a>
          <button class="btn btn-primary" id="saveLangBtn" disabled>
            <i class="fas fa-save me-1"></i> Save Changes
          </button>
        </div>
      </div>
    </div>
  </div>

  <div id="notificationContainer" style="position: fixed; top: 2rem; right: 2rem; z-index: 9999;"></div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const localeSelect = document.getElementById('localeSelect');
  let currentLocale = localeSelect.value;

  const languageDataUrlTemplate = @json(route('admin.content.language.data', ['locale' => '__LOCALE__']));
  const languageUpdateUrl = @json(route('admin.content.language.update'));
  const csrfToken = @json(csrf_token());
  const languageEditor = document.getElementById('languageEditor');
  const languageCache = new Map();

  const buildLanguageDataUrl = (locale, file) => {
    const basePath = languageDataUrlTemplate.replace('__LOCALE__', encodeURIComponent(locale));
    return file ? `${basePath}?file=${encodeURIComponent(file)}` : basePath;
  };

  const cloneData = (value) => JSON.parse(JSON.stringify(value ?? {}));

  const showLoadingState = () => {
    languageEditor.innerHTML = `
      <div class="text-center py-5">
        <div class="spinner-border text-primary mb-3" role="status" aria-hidden="true"></div>
        <p class="text-muted mb-0">Loading translation entries...</p>
      </div>`;
  };

  const showErrorState = () => {
    languageEditor.innerHTML = `
      <div class="text-center py-5 text-danger">
        <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
        <p class="mb-0">Unable to load this language file.</p>
      </div>`;
  };

  localeSelect.addEventListener('change', (event) => {
    const url = new URL(window.location.href);
    const segments = url.pathname.split('/');
    segments[segments.length - 1] = event.target.value;
    url.pathname = segments.join('/');
    window.location.href = url.toString();
  });

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

  const showNotification = (message, type = 'info') => {
    const container = document.getElementById('notificationContainer');
    const el = document.createElement('div');
    el.className = `alert alert-${type} alert-dismissible fade show`;
    el.innerHTML = `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
    container.appendChild(el);
    setTimeout(() => el.remove(), 5000);
  };

  let currentLanguageFile = null;
  let languageData = {};
  const saveLangBtn = document.getElementById('saveLangBtn');
  const addEntryBtn = document.getElementById('addLangEntry');

  document.addEventListener('click', async (event) => {
    const trigger = event.target.closest('.lang-file');
    if (!trigger) {
      return;
    }

    event.preventDefault();
    currentLocale = localeSelect.value;
    document.querySelectorAll('.lang-file').forEach((node) => node.classList.remove('active'));
    trigger.classList.add('active');
    currentLanguageFile = trigger.dataset.file;

    if (!currentLanguageFile) {
      return;
    }

    const cacheKey = `${currentLocale}:${currentLanguageFile}`;
    saveLangBtn.disabled = true;
    addEntryBtn.style.display = 'none';

    if (languageCache.has(cacheKey)) {
      languageData = cloneData(languageCache.get(cacheKey));
      renderLanguageEditor();
      saveLangBtn.disabled = false;
      addEntryBtn.style.display = 'inline-block';
      return;
    }

    showLoadingState();

    try {
      const dataUrl = buildLanguageDataUrl(currentLocale, currentLanguageFile);
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
      const result = await response.json();
      if (result.success) {
        const fileData = result.data[currentLanguageFile] ?? {};
        const cloned = cloneData(fileData);
        languageCache.set(cacheKey, cloned);
        languageData = cloneData(cloned);
        renderLanguageEditor();
        saveLangBtn.disabled = false;
        addEntryBtn.style.display = 'inline-block';
      } else {
        showNotification('Failed to load language data', 'danger');
        showErrorState();
      }
    } catch (error) {
      console.error('Language load error', error);
      showNotification('Failed to load language data', 'danger');
      showErrorState();
    }
  });

  const renderLanguageEditor = () => {
    const entries = Object.entries(languageData);
    if (!entries.length) {
      languageEditor.innerHTML = `<div class="text-center py-4"><i class="fas fa-file-plus fa-3x text-muted mb-3"></i><p class="text-muted">This language file is empty. Start by adding some entries.</p></div>`;
      return;
    }

    const blocks = entries.map(([key, value]) => {
      const isObject = value !== null && typeof value === 'object';
      const displayValue = isObject ? JSON.stringify(value, null, 2) : (value ?? '');
      const escapedValue = escapeHtml(displayValue);
      const rows = Math.max(3, Math.min(12, String(displayValue).split('\n').length + 1));

      const control = isObject
        ? `<textarea class="form-control lang-input" data-key="${key}" data-type="json" rows="${rows}">${escapedValue}</textarea>`
        : `<input type="text" class="form-control lang-input" data-key="${key}" data-type="string" value="${escapedValue}" placeholder="Enter translation...">`;

      return `
        <div class="mb-3 lang-entry">
          <div class="d-flex justify-content-between align-items-center mb-1">
            <label class="form-label mb-0 fw-semibold">${key}</label>
            <button class="btn btn-sm btn-outline-danger remove-entry" data-key="${key}"><i class="fas fa-trash"></i></button>
          </div>
          ${control}
        </div>`;
    });

    languageEditor.innerHTML = `<div class="language-entries">${blocks.join('')}</div>`;
  };

  addEntryBtn.addEventListener('click', () => {
    const key = prompt('Enter the new translation key:');
    if (!key || !key.trim()) {
      return;
    }

    const trimmed = key.trim();
    if (Object.prototype.hasOwnProperty.call(languageData, trimmed)) {
      showNotification('This key already exists', 'warning');
      return;
    }

    languageData[trimmed] = '';
    renderLanguageEditor();
    showNotification('New entry added', 'success');
  });

  document.addEventListener('click', (event) => {
    const removeBtn = event.target.closest('.remove-entry');
    if (!removeBtn) {
      return;
    }

    const key = removeBtn.dataset.key;
    if (confirm(`Remove "${key}"?`)) {
      delete languageData[key];
      renderLanguageEditor();
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
      showNotification('Select a language file first', 'warning');
      return;
    }
    if (document.querySelector('.lang-input.is-invalid')) {
      showNotification('Fix highlighted JSON entries before saving', 'danger');
      return;
    }

    saveLangBtn.disabled = true;
    try {
      const cacheKey = `${currentLocale}:${currentLanguageFile}`;
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
      const result = await response.json();
      if (result.success) {
        showNotification('Language file saved', 'success');
        languageCache.set(cacheKey, cloneData(languageData));
      } else {
        showNotification(result.message ?? 'Save failed', 'danger');
      }
    } catch (error) {
      console.error('Language save error', error);
      showNotification('Save error', 'danger');
    } finally {
      saveLangBtn.disabled = false;
    }
  });
});
</script>
@endpush
