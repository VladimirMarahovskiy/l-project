@auth
    {!! Form::open(['route' => 'comment_add', 'role' => 'form', 'method' => 'POST']) !!}
    <div class="form-group">
        {!! Form::label('content', __('validation.attributes.comment'), ['class' => 'control-label']) !!}
        {!! Form::textarea('content', old('content'), ['class' => 'form-control' . ($errors->has('content') ? ' is-invalid' : ''), 'required', 'autofocus']) !!}
        {!! Form::hidden('post_id', $post->id ) !!}

    </div>

    <div class="form-group">
        {!! Form::submit(__('auth.add'), ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@else
  @component('components.alerts.default', ['type' => 'warning'])
    @lang('comments.sign_in_to_comment')
  @endcomponent
@endauth
