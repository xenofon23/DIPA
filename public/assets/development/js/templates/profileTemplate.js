export function renderProfilePage(data) {
    return `
    <div id="app">
        <div class="container">
            <div class="inside-container">
                <div class="switch">
                    <a class="selected">Create your Profile</a>
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
                    <div>
                        <label>Cleaning</label>
                        <input id="cleaning" type="checkbox">
                    </div>
                    <div>
                        <label>Cooking</label>
                        <input id="cooking" type="checkbox">
                    </div>
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