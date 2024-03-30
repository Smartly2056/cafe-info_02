/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/login.blade.php",
    "./resources/**/login_form.blade.php",
    "./resources/**/logout.blade.php",
    "./resources/**/register.blade.php",
    "./resources/**/signup.blade.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

