document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('a-logout')?.addEventListener('click', () => {
        document.getElementById('form-logout').submit()
        return false
    })
    const copyElements = document.querySelectorAll('[data-toggle="copy"]')
    copyElements.forEach(element => {
        element.addEventListener('click', copyTextToClipboard(element.getAttribute('data-text')))
    })
})

function copyTextToClipboard(text) {
    navigator.clipboard.writeText(text)
        .then(() => {
        })
        .catch(error => {
            console.log(error)
        })
}
