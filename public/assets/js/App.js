
(function () {
    ;
    console.log('oopa')
    const menuToggle = document.querySelector('.menu-toggle');
    menuToggle.onclick = function (e) {
        ;
        const body = document.querySelector('body');
        body.classList.toggle('hide-sidebar');
    }

})()


function activateClock() {

    function addOneSecond(hours, minutes, seconds) {
        const d = new Date();
        d.setHours(parseInt(hours));
        d.setMinutes(parseInt(minutes));
        d.setSeconds(parseInt(seconds) + 1);

        const h = `${d.getHours()}`.padStart(2, 0);
        const m = `${d.getMinutes()}`.padStart(2, 0);
        const s = `${d.getSeconds()}`.padStart(2, 0);

        return `${h}:${m}:${s}`;

    }
    const activeClock = document.querySelector('[active-clock]')
    if (!activateClock) return

    setInterval(function () {
        // transforma a string em array com hora minuto e segundo;  exemplo isso => 07:27:18 passa a ser isso => ['07', '27', '19']
        const parts = activeClock.innerHTML.split(':')
        activeClock.innerHTML = addOneSecond(parts[0], parts[1], parts[2])
    }, 1000)
}

activateClock();
