@extends('layout/layout')

@section('content')
    <form action="{{ route('formRegister')  }}" method="POST">
        {{ csrf_field() }}
        <div class="field">
            <p class="control has-icons-left has-icons-right">
                <input class="input" type="text" placeholder="Name" name="name">
                <span class="icon is-small is-left">
                     <i class="fas fa-address-card"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <p class="control has-icons-left has-icons-right">
                <input class="input" type="email" placeholder="Email" name="email">
                <span class="icon is-small is-left">
                     <i class="fas fa-envelope"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <p class="control has-icons-left">
                <input class="input" type="password" placeholder="Password" name="password">
                <span class="icon is-small is-left">
      <i class="fas fa-lock"></i>
    </span>
            </p>
        </div>
        <div class="field">
            <p class="control">
                <button class="button" type="submit">
                    Register
                </button>
            </p>
        </div>
    </form>
@endsection
