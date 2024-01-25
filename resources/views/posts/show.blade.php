<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-2 text-white">

        <div>

            <h1 style="font-size: xx-large">{{ $post->title }}</h1>

            <span class="text-sm text-white">
                {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}
            </span>
        </div>

        <div class="prose mt-6">

            {!! $post->html !!}

        </div>

        <div class="mt-12">

            <h2 id="comments" class="text-2xl font-semibold">Comments</h2>

        @auth 

            <form action="{{ route('posts.comments.store', $post) }}" method="post">
                @csrf


                <textarea style="background-color: darkgray" name="body" id="body" cols="30" rows="5" class="w-full"></textarea>

                <x-primary-button style="background-color: darkgray" type="submit">Add Comment</x-primary-button>

            </form>

        @endauth 

            <ul class="divide-y">

                @foreach($comments as $comment)

                    <li class="py-4 px-2">

                        <p>{{$comment->body}}</p>

                        <span class="text-sm">

                            {{ $comment->created_at->diffForHumans() }} by {{ $comment->user->name }}

                        </span>
                    
                    @can('delete', $comment)

                        <form action="{{ route('posts.comments.destroy', ['post' => $post, 'comment' => $comment]) }}" method="post">

                            @csrf

                            @method('DELETE')

                            <x-danger-button style="background-color: darkgray" type="submit">Delete</x-danger-button>

                        </form>

                    @endcan
                    </li>

                @endforeach

            </ul>

            <div>

                {{ $comments->links() }}

            </div>

        </div>

    </div>
</x-app-layout>
