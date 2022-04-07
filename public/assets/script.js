document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('form.game')) game()
})

function game() {
  const inputs = document.querySelectorAll('input')
  inputs.forEach((input, key) => input.addEventListener('keyup', ({ keyCode }) => {
    if (inputs[key + 1] && keyCode > 64 && keyCode < 91) inputs[key + 1].focus()
    if (inputs[key - 1] && keyCode === 8) inputs[key - 1].focus()
  }))
}