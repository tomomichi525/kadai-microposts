<ul class="media-list">
@foreach ($microposts as $micropost)
    <?php $user = $micropost->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
            
            <div>
                <p>{!! nl2br(e($micropost->content)) !!}</p>
            </div>
            <div>
                <ul class ="list-inline">
                    <li class="list-inline-item">
                    @if (Auth::user()->is_liking($micropost->id))
                        {!! Form::open(['route' => ['user.unlike', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('unfavorite', ['class' => "btn btn-success btn-xs"]) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['user.like', $micropost->id]]) !!}
                            {!! Form::submit('favorite', ['class' => "btn btn-default btn-xs "]) !!}
                        {!! Form::close() !!}
                    @endif

                </li>
                
                <li class="list-inline-item">
            
                @if (Auth::id() == $micropost->user_id)
                    {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                @endif
                </li>
                </ul>
            </div>
            </div>
    
    </li>
@endforeach
</ul>
{!! $microposts->render() !!}