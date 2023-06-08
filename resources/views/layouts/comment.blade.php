<div class=" comment">

    <h4>Comment & Reply</h4>

    {{-- {{ dd($article->comments()->whereNull("parent_id")->latest("id")->get()) }} --}}

    @forelse ($article->comments()->whereNull("parent_id")->latest("id")->get() as $comment)
        <div class=" card mb-3">
            <div class="card-body ">
                <p class=" mb-0">
                    <i class="bi bi-chat-square-text-fill me-2"></i> {{ $comment->content }}
                </p>

                <div class="">

                    <span class=" badge bg-dark">
                        <i class=" bi bi-person"></i> {{ $comment->user->name }}
                    </span>

                    <span class=" badge bg-dark">
                        <i class=" bi bi-clock"></i> {{ $comment->created_at->diffForHumans() }}
                    </span>

                    @can('delete', $comment)
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class=" d-inline-block">
                            @csrf
                            @method('delete')
                            <button class=" badge border-0 bg-dark">
                                <i class=" bi bi-trash3"></i> Delete
                            </button>
                        </form>
                    @endcan



                    @auth

                        <span role='button' class=" user-select-none badge bg-dark mb-2 reply-btn">
                            <i class=" bi bi-reply"></i> Reply
                        </span>

                        <form action="{{ route('comment.store') }}" class=" ms-4 d-none" method="post">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <input type="hidden" name="article_id" value={{ $article->id }}>
                            <textarea name="content" class=" form-control mb-2" rows="2" placeholder="Reply to {{ $comment->user->name }}'s comment ..."></textarea>
                            <div class=" d-flex justify-content-between align-items-end">
                                <p class=" mb-0">Replying as {{ Auth::user()->name }}</p>
                                <button class="btn btn-sm btn-dark">Reply</button>
                            </div>
                        </form>

                    @endauth


                    @foreach ($comment->replies()->latest("id")->get() as $reply)

                    <div class=" card ms-4 mt-2">
                        <div class="card-body ">
                            <p class=" mb-0">
                                <i class="bi bi-reply me-2"></i> {{ $reply->content }}
                            </p>

                            <div class="">

                                <span class=" badge bg-dark">
                                    <i class=" bi bi-person"></i> {{ $reply->user->name }}
                                </span>

                                <span class=" badge bg-dark">
                                    <i class=" bi bi-clock"></i> {{ $reply->created_at->diffForHumans() }}
                                </span>

                                @can('delete', $reply)
                                    <form action="{{ route('comment.destroy', $reply->id) }}" method="post" class=" d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button class=" badge border-0 bg-dark">
                                            <i class=" bi bi-trash3"></i> Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>

                    @endforeach





                </div>
            </div>
        </div>

    @empty

        <div class=" card mb-3">
            <div class="card-body text-center">
                <p class=" mb-0">There is no comment yet !</p>
            </div>
        </div>
    @endforelse


    @auth
        <form action="{{ route('comment.store') }}" method="post">
            @csrf

            <input type="hidden" name="article_id" value={{ $article->id }}>
            <textarea name="content" class=" form-control mb-2" rows="3" placeholder="Say something about this article ...."></textarea>
            <div class=" d-flex justify-content-between align-items-end">
                <p class=" mb-0">Commenting as {{ Auth::user()->name }}</p>
                <button class="btn btn-sm btn-dark">Comment</button>
            </div>
        </form>

    @endauth



</div>

@vite(["resources/js/reply.js"])
