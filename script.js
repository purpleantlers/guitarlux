// Variables del cuerpo, preferencias y carrito
const body = document.querySelector('body')
const languageBtn = document.getElementById('languageBtn')
const themeBtn = document.getElementById('themeBtn')
const cartBtn = document.getElementById('cartBtn')

// Función para crear una Cookie en JavaScript
function setCookie(name, value, expire) {
  const date = new Date()

  // La variable expire se asigna por minutos
  date.setTime(date.getTime() + expire * 60 * 1000)
  let expireDate = `expires = ${date.toUTCString()}`

  document.cookie = `${name} = ${value}; ${expireDate}`
}

// Función para recuperar las Cookies por nombre en JavaScript
function getCookie(name) {
  const cookieString = document.cookie

  // Separamos todas las cookies que existen
  const cookies = cookieString.split(';')

  // Recorremos la cadena de texto restante eliminando los valores antes del '=' y éste
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim()
    if (cookie.startsWith(name + '=')) {
      return cookie.substring(name.length + 1)
    }
  }

  return null
}

// Función que revisa las Cookies para definir estilos de la página según preferencias
function checkCookie() {
  if (getCookie('language') === 'spanish' && getCookie('theme') === 'light') {
    languageBtn.innerHTML = `<img src="assets/english_d.svg" alt="Language">`
    themeBtn.innerHTML = `<img src="assets/moon.svg" alt="Theme">`
    cartBtn.innerHTML = `<img src="assets/cart_d.svg" alt="Shopping Cart">`
    body.classList.remove('dark')  
  } else if (getCookie('language') === 'spanish' && getCookie('theme') === 'dark') {
    languageBtn.innerHTML = `<img src="assets/english_l.svg" alt="Language">`
    themeBtn.innerHTML = `<img src="assets/sun.svg" alt="Theme">`
    cartBtn.innerHTML = `<img src="assets/cart_l.svg" alt="Shopping Cart">`
    body.classList.add('dark')  
  } else if (getCookie('language') === 'english' && getCookie('theme') === 'light') {
    languageBtn.innerHTML = `<img src="assets/spanish_d.svg" alt="Language">`
    themeBtn.innerHTML = `<img src="assets/moon.svg" alt="Theme">`
    cartBtn.innerHTML = `<img src="assets/cart_d.svg" alt="Shopping Cart">`
    body.classList.remove('dark')  
  } else {
    languageBtn.innerHTML = `<img src="assets/spanish_l.svg" alt="Language">`
    themeBtn.innerHTML = `<img src="assets/sun.svg" alt="Theme">`
    cartBtn.innerHTML = `<img src="assets/cart_l.svg" alt="Shopping Cart">`
    body.classList.add('dark')  
  }
}

if (!localStorage.getItem('language')) {
  localStorage.setItem('language', 'spanish')
}

if (!localStorage.getItem('theme')) {
  localStorage.setItem('theme', 'light')
}

// Establece el idioma Español por defecto, si no hay Cookie
if (!getCookie('language')) {
  setCookie('language', 'spanish', 30)
}

// Establece el tema claro por defecto, si no hay Cookie
if (!getCookie('theme')) {
  setCookie('theme', 'light', 30)
}

// Establece estilos iniciales de la página
checkCookie()

// Cambio de idioma a partir del botón
languageBtn.addEventListener('click', () => {
  if (getCookie('language') === 'spanish') {
    setCookie('language', 'english', 30)
    checkCookie()
  } else {
    setCookie('language', 'spanish', 30)
    checkCookie()
  }
})

// Cambio de tema a partir del botón
themeBtn.addEventListener('click', () => {
  if (getCookie('theme') === 'light') {
    setCookie('theme', 'dark', 30)
    checkCookie()
  } else {
    setCookie('theme', 'light', 30)
    checkCookie()
  }
})