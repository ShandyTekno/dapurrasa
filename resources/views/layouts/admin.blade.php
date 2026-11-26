<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - DapurRasa</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="{{ asset('css/dapurrasa.css') }}?v={{ filemtime(public_path('css/dapurrasa.css')) }}" rel="stylesheet">
</head>
<body>

<nav class="admin-mobile-bar d-flex d-md-none align-items-center justify-content-between sticky-top">
    <div class="d-flex align-items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" alt="Logo DapurRasa" class="sidebar-logo" style="height:36px">
        <span class="text-white fw-bold fs-5">Dapur<span style="color:var(--oranye)">Rasa</span></span>
    </div>
    <button class="btn btn-outline-light btn-sm rounded-3 px-2 py-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-controls="adminSidebarOffcanvas">
        <i class="bi bi-list fs-5"></i>
    </button>
</nav>

<div class="container-fluid p-0">
    <div class="row g-0">

        <aside class="col-md-3 col-lg-2 offcanvas-md offcanvas-start sidebar p-3 d-flex flex-column" tabindex="-1" id="adminSidebarOffcanvas">
            <div class="sidebar-brand d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo DapurRasa" class="sidebar-logo">
                    <div>
                        <h5 class="text-white mb-0 fw-bold" style="line-height:1.15">Dapur<span style="color:var(--oranye)">Rasa</span></h5>
                        <small style="color:rgba(255,255,255,0.62);font-size:0.68rem;letter-spacing:1px;font-weight:700">PT EL CAPCAY</small>
                    </div>
                </a>
                <button type="button" class="btn-close btn-close-white d-md-none" data-bs-dismiss="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-label="Tutup"></button>
            </div>

            <div class="sidebar-section-label">Menu Utama</div>
            <ul class="nav flex-column gap-1 mb-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                        <i class="bi bi-tags"></i>
                        <span>Kategori Menu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}" href="{{ route('admin.menu.index') }}">
                        <i class="bi bi-card-checklist"></i>
                        <span>Data Menu</span>
                    </a>
                </li>
                <li class="nav-item mt-3 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.1)">
                    <div class="sidebar-section-label pt-0">Pintasan</div>
                    <a class="nav-link" href="{{ route('home') }}" target="_blank">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>Lihat Website</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-user-card">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <div class="overflow-hidden">
                        <p class="text-white small fw-bold mb-0 text-truncate">{{ auth()->user()->name }}</p>
                        <p class="mb-0 text-truncate" style="color:rgba(255,255,255,0.62);font-size:0.74rem">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sidebar-logout w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="col-12 col-md-9 col-lg-10 p-3 p-sm-4 p-lg-5">
            @include('partials.alerts')
            @yield('content')
        </main>
    </div>
</div>

<div class="modal fade" id="imageMaxsizeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-header border-0 pb-0 justify-content-end">
                <button type="button" class="btn btn-dark btn-sm rounded-circle p-2 shadow-lg" data-bs-dismiss="modal" aria-label="Close" style="width:38px;height:38px;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-x-lg text-white"></i>
                </button>
            </div>
            <div class="modal-body text-center p-2">
                <img id="maxsizeModalImg" src="" alt="Foto Menu Maxsize" class="img-fluid rounded-4 shadow-lg border" style="max-height:82vh;object-fit:contain;background:#ffffff">
                <div class="mt-3">
                    <h5 id="maxsizeModalTitle" class="text-white fw-bold mb-1" style="text-shadow: 0 2px 4px rgba(0,0,0,0.8)"></h5>
                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill">Ukuran Penuh (Max Size)</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function openMaxsizeModal(imgUrl, title) {
    const modalImg = document.getElementById('maxsizeModalImg');
    const modalTitle = document.getElementById('maxsizeModalTitle');
    if (modalImg) modalImg.src = imgUrl;
    if (modalTitle) modalTitle.textContent = title || '';
    const modalEl = document.getElementById('imageMaxsizeModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }
}

function initInteractiveTable(config) {
    const table = document.getElementById(config.tableId);
    if (!table) return;

    const tbody = table.querySelector('tbody');
    const searchInput = document.getElementById(config.searchId);
    const clearBtn = document.getElementById(config.clearId);
    const countLabel = document.getElementById(config.countId);
    const noMatchRow = document.getElementById(config.noMatchId);
    const dataRows = Array.from(tbody.querySelectorAll('tr[data-row]'));

    function updateFilter() {
        const q = searchInput ? searchInput.value.trim().toLowerCase() : '';
        if (clearBtn) {
            clearBtn.style.display = q.length > 0 ? 'block' : 'none';
        }
        let visible = 0;
        dataRows.forEach(row => {
            const haystack = (row.getAttribute('data-search') || row.textContent).toLowerCase();
            const match = !q || haystack.includes(q);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        if (noMatchRow) {
            noMatchRow.style.display = (dataRows.length > 0 && visible === 0) ? '' : 'none';
        }
        if (countLabel) {
            countLabel.textContent = `Menampilkan ${visible} dari ${dataRows.length} data`;
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', updateFilter);
    }
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            searchInput.value = '';
            updateFilter();
            searchInput.focus();
        });
    }

    const headers = table.querySelectorAll('thead th.sortable-th');
    headers.forEach(th => {
        th.addEventListener('click', () => {
            const colIndex = Array.from(th.parentNode.children).indexOf(th);
            const type = th.getAttribute('data-sort-type') || 'text';
            const isAsc = !th.classList.contains('sort-asc');

            headers.forEach(h => {
                h.classList.remove('sort-asc', 'sort-desc');
                const icon = h.querySelector('.sort-icon');
                if (icon) icon.className = 'bi bi-arrow-down-up sort-icon';
            });

            th.classList.add(isAsc ? 'sort-asc' : 'sort-desc');
            const activeIcon = th.querySelector('.sort-icon');
            if (activeIcon) {
                activeIcon.className = isAsc ? 'bi bi-sort-up sort-icon' : 'bi bi-sort-down sort-icon';
            }

            const sorted = dataRows.sort((a, b) => {
                const cellA = a.children[colIndex];
                const cellB = b.children[colIndex];
                let valA = cellA.getAttribute('data-sort-value') ?? cellA.textContent.trim();
                let valB = cellB.getAttribute('data-sort-value') ?? cellB.textContent.trim();

                if (type === 'number') {
                    valA = parseFloat(valA) || 0;
                    valB = parseFloat(valB) || 0;
                    return isAsc ? valA - valB : valB - valA;
                }
                return isAsc
                    ? valA.localeCompare(valB, 'id', { sensitivity: 'base' })
                    : valB.localeCompare(valA, 'id', { sensitivity: 'base' });
            });

            sorted.forEach(row => tbody.appendChild(row));
            if (noMatchRow) tbody.appendChild(noMatchRow);
        });
    });

    updateFilter();
}
</script>
@stack('scripts')
</body>
</html>
