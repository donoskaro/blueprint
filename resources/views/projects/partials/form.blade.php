{!! Form::textField('name', 'Name') !!}
{!! Form::textareaField('description', 'Description') !!}
{!! Form::emailField('email', 'Email (optional)', null, ['maxlength' => 255]) !!}

{!! Form::submitButton('Save') !!}

{!! Form::close() !!}
