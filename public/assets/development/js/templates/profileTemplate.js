export function renderProfilePage(data) {
    data = JSON.parse(data.dynamicData);

    console.log(data)
    if (data !== true) {
        let male = data.second.gender === 'male' ? 'checked' : ''
        let female = data.second.gender === 'female' ? 'checked' : ''
        let cleaning = data.second.housework.clean === true ? 'checked' : ''
        let cooking = data.second.housework.cooking === true ? 'checked' : ''
        let pet = data.second.pet === true ? 'checked' : ''
        let smoke = data.second.smoke === true ? 'checked' : ''

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
        <div class="container">
            <div class="inside-container">
                <div class="switch">
                    <a class="selected">Create your Profile</a>
                </div>
                <div class="field">
                    <span>Full Name</span>
                    <input id="full-name" type="text" value="${data.basic.name}">
                </div>
                <div class="field">
                    <span>Location</span>
                    <input id="location" type="text" value="${data.basic.location}">
                </div>
                <div class="field">
                    <span>Budget</span>
                    <input id="budget" type="number" value="${data.basic.budget}">
                </div>
                <div class="field">
                    <span>Age</span>
                    <input id="age" type="number" value="${data.second.age}">
                </div>
                
                <!--Gender Selection-->
                <div>
                    <h3>Gender</h3>
                    <form>
                        <label for="male">Male</label>
                        <input type="radio" id="male" value="Male" name="gender_sel" ${male}>
                        <label for="female">Female</label>
                        <input type="radio" id="female" value="Female" name="gender_sel" ${female}>
                    </form>
                </div>
                
                <!--Housework Selection-->
                <div class="housework">
                    <h3>Housework</h3>
                    <from>
                        <label for="cleaning">Cleaning</label>
                        <input type="radio" id="cleaning" value="Cleaning" name="housework_sel" ${cleaning}>
                        <label for="cooking">Cooking</label>
                        <input type="radio" id="cooking" value="Cooking" name="housework_sel" ${cooking}>
                    </from>
                </div>
                
                <!--Other Selection-->
                <div class="other">
                    <h3>Other</h3>
                    <div>
                        <label>Pet</label>
                        <input id="pet" type="checkbox" ${pet}>
                    </div>
                    <div>
                        <label>Smoke</label>
                        <input id="smoke" type="checkbox" ${smoke}>
                    </div>
                </div>

                <a href="matchProfiles.html" id="login-button" class="login">Update</a>
            </div>
        </div>
    </div>
  `;
    }
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
        <div class="container">
            <div class="inside-container">
                <div class="switch">
                    <a class="selected">Create your Profile</a>
                </div>
                <div class="field">
                    <span>Full Name</span>
                    <input id="full-name" type="text">
                </div>
                <div class="field">
                    <span>Location</span>
                    <input id="location" type="text">
                </div>
                <div class="field">
                    <span>Budget</span>
                    <input id="budget" type="number">
                </div>
                <div class="field">
                    <span>Age</span>
                    <input id="age" type="number">
                </div>
                
                <!--Gender Selection-->
                <div>
                    <h3>Gender</h3>
                    <form>
                        <label for="male">Male</label>
                        <input type="radio" id="male" value="Male" name="gender_sel">
                        <label for="female">Female</label>
                        <input type="radio" id="female" value="Female" name="gender_sel">
                    </form>
                </div>
                
                <!--Housework Selection-->
                <div class="housework">
                    <h3>Housework</h3>
                    <from>
                        <label for="cleaning">Cleaning</label>
                        <input type="radio" id="cleaning" value="Cleaning" name="housework_sel">
                        <label for="cooking">Cooking</label>
                        <input type="radio" id="cooking" value="Cooking" name="housework_sel">
                    </from>
                </div>
                
                <!--Other Selection-->
                <div class="other">
                    <h3>Other</h3>
                    <div>
                        <label>Pet</label>
                        <input id="pet" type="checkbox">
                    </div>
                    <div>
                        <label>Smoke</label>
                        <input id="smoke" type="checkbox">
                    </div>
                </div>

                <a href="#" id="login-button" class="login">Submit</a>
            </div>
        </div>
    </div>
  `;
}