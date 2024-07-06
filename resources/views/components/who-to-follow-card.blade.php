<div class="hstack gap-2 mb-3">
    <div class="avatar">
        <a href={{ Auth::user() ? route('users.show', $user->id) : route('login') }}>

            <img class="avatar-img rounded-circle" style="width: 45px" src={{ $user->getImageUrl() }} alt="">

        </a>
    </div>
    <div class="overflow-hidden">
        <a class="h6 mb-0" href="#!">{{ $user->username }}</a>
    </div>
    <form action="{{ route('users.follow', $user) }}" class="btn btn-primary-soft rounded-circle icon-md ms-auto"
        method="POST">
        @csrf
        @method('post')

        <button style="border:none;background:white">
            <i class="fa-solid fa-plus"></i>
        </button>
    </form>
</div>
