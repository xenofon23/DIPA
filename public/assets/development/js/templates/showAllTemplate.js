export function renderShowAllPage(data) {
    return `
    <div id="app">
        <div class="top-bar">
            <div class="nav-title">
                <a href="index.html">RoomBuddy</a>
            </div>
            <div class="nav-buttons">
                <a href="profile.html">Create Profile</a>
                <a href="matchProfiles.html">Match Profile</a>
                <a href="showAll.html">Show All</a>
            </div>
        </div>
        <div class="container" style="width: 90%;position: absolute">
            <div class="inside-container" style="display: flex; flex-wrap: wrap; width: 90%">
                <div id="card"></div>
            </div>
        </div>
    </div>
  `;
}