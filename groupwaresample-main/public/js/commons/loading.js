const l = document.getElementById('loading-screen');
function showLoading(m='Loading...') {l.querySelector('.message').innerHTML = m;l.style.display = 'flex';}
function hideLoading() {l.style.display = 'none';}
