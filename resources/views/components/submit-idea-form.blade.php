<div>
    <h4> Share yours ideas </h4>
    <form action={{ route('ideas.store') }} method="POST" class="row">
        @csrf
        @method('post')

        <div class="mb-3">
            <textarea class="form-control" id="contentBox" name="contentBox" rows="3"></textarea>
            @error('contentBox')
                <p class="fs-6 mt-2 text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button class="btn btn-dark" type="submit"> Share </button>
        </div>
    </form>
    <hr>
</div>
