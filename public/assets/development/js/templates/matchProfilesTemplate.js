export function renderMatchProfilePage(data) {
    return `
    <div id="app">
        <div class="top-bar">
            <div class="nav-title">
                <a href="index.html">RoomBuddy</a>
            </div>
            <div class="nav-buttons">
                <a href="profile.html">Create Profile</a>
                <a href="matchProfile.html">Match Profile</a>
            </div>
        </div>
        <div class="container">
            <div class="inside-container">
                <div id="card"></div>
                <a href="#" id="match-button" class="login">Submit</a>
            </div>
        </div>
    </div>
  `;
}