<div id="login-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Login</p>
            <button class="delete login-cancel-btn" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <form action="{{ route('formLogin')  }}" method="post">
                {{ csrf_field() }}
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
                <footer class="modal-card-foot">
                    <div class="field">
                        <p class="control">
                            <button class="button is-success" type="submit">
                                Login
                            </button>
                            <button class="button login-cancel-btn" type="reset">
                                Cancel
                            </button>
                        </p>
                    </div>
                </footer>
            </form>
        </section>
    </div>
</div>

