<div class="col-md-3 mb-4">
    <div class="list-group">
        <a href="{{ route('user.profile') }}"
            class="list-group-item list-group-item-action {{ request()->routeIs('user.profile') ? 'active' : '' }}">
            <i class="bi bi-person-circle me-2"></i> Profil
        </a>
        <a href="{{ route('user.account') }}"
            class="list-group-item list-group-item-action {{ request()->routeIs('user.account') ? 'active' : '' }}">
            <i class="bi bi-gear me-2"></i> Akun
        </a>
    </div>
</div>
