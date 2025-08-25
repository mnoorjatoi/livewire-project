<x-layout>
     <div class="container py-md-5 container--narrow">
        <p><small><strong><a href="{{ route('view-post', $post->id) }}">&laquo; Bak to post permalink</a></strong></small></p>
      <form action="{{ route('update-post', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
          <input name="title" id="post-title" class="form-control form-control-lg form-control-title" value="{{ old('title', $post->title) }}" type="text" placeholder="" autocomplete="off" />
          @error('title')
            {{ $message }}
          @enderror
        </div>
        <div class="form-group">
          <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
          <textarea name="body" id="post-body" class="body-content tall-textarea form-control" type="text">{{ $post->body }}</textarea>
          @error('body')
            {{ $message }}
          @enderror
        </div>
            <button class="btn btn-primary">Save Changes</button>
      </form>
    </div>
</x-layout>
