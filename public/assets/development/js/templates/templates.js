

export function renderLoginForm(data) {
    return `
    <form>
      <h2>${data.a1}</h2>
      <label for="username">${data.label1}</label>
      <input type="text" id="username" name="username">
      <label for="password">${data.label2}</label>
      <input type="password" id="password" name="password">
      <button>${data.buttonL}</button>
    </form>
  `;
}

export function renderRegistrationForm(data) {
    return `
    <form>
      <h2>${data.a2}</h2>
      <label for="name">${data.label3}</label>
      <input type="text" id="name" name="name">
      <label for="password">${data.label6}</label>
      <input type="password" id="password" name="password">
      <button>${data.buttonS}</button>
    </form>
  `;
}