<div class="card">
    <div class="card-header pb-0 border-0">
        <h5>Search</h5>
    </div>
    <form method="GET" action={{ route('dashboard') }} class="card-body">
        @method('get')
        <input type="text" value="{{ request('search-input', '') }}" class="form-control w-100" name="search-input">
        <button class="btn btn-dark mt-2 btn-sm" type="submit">Search</button>
    </form>
</div>
