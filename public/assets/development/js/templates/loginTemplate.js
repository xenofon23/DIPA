export function renderLoginPage(data) {
    return `
    <div id="app">
        <div class="top-bar">
            <div class="nav-title">
                <a href="index.html">RoomBuddy</a>
            </div>
            <div class="nav-buttons">
<!--                <a href="profile.html">Create Profile</a>-->
<!--                <a href="matchProfile.html">Match Profile</a>-->
            </div>
        </div>
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