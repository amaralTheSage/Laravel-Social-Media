<div class="col-3">
    <div class="card overflow-hidden">
        <div class="card-body pt-3">
            <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'text-white bg-primary' : '' }}" href="/">
                        <span>Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('feed') ? 'text-white bg-primary' : '' }}" href="{{ route('feed') }}">
                        <span>Feed</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/terms">
                        <span>Terms</span></a>
                </li>

            </ul>
        </div>

    </div>
</div>
