@if (count($favorites) > 0)

<ul class="media-list">
@foreach ($favorites as $tweets)
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($tweets->user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $tweets->user->name, ['id' => $tweets->user_id]) !!} <span class="text-muted">posted at {{ $tweets->created_at }}</span>
            <div>
            <div>
                <p>{!! nl2br(e($tweets->content)) !!}</p>
                 <ul class ="list-inline">
                    <li class="list-inline-item">
                    @if (Auth::user()->is_liking($tweets->id))
                        {!! Form::open(['route' => ['user.unlike', $tweets->id], 'method' => 'delete']) !!}
                            {!! Form::submit('unfavorite', ['class' => "btn btn-success btn-xs"]) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['user.like', $tweets->id]]) !!}
                            {!! Form::submit('favorite', ['class' => "btn btn-default btn-xs "]) !!}
                        {!! Form::close() !!}
                    @endif

                </li>
                
                <li class="list-inline-item">
            
                @if (Auth::id() == $tweets->user_id)
                    {!! Form::open(['route' => ['microposts.destroy', $tweets->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                @endif
                </li>
                </ul>

            </div>

        </div>
    </li>
<! - Omission ->
@endforeach
</ul>
{!! $favorites->render() !!}
@endif