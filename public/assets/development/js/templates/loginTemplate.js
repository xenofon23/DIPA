export function renderLoginPage(data) {
    return `
    <div id="app">
        <div class="container">
            <div class="inside-container">
                <div class="switch">
                    <a href="#" id="login" class="selected">Login</a>
                    <a href="#" id="register">Register</a>
                </div>
                    <div class="field">
                        <span>Username</span>
                        <input id="username" type="text">
                    </div>
                    <div class="field">
                        <span>Password</span>
                        <input id="password" type="password">
                    </div>
                    <a href="#" id="login-button" class="login">Login</a>
                    <a href="#" id="register-button" class="login none">Register</a>
            </div>
        </div>
    </div>
  `;
}