// https://github.com/BaseMax/RippleEffectCSS
document.querySelectorAll(`[effect="ripple"]`).forEach(el => {
    el.addEventListener('click', e => {
  
        var stylecode =  `background-color: `+ el.style.backgroundColor+`;`
        e = e.touches ? e.touches[0] : e;
        const r = el.getBoundingClientRect(),
              d = Math.sqrt(Math.pow(r.width, 2) + Math.pow(r.height, 2)) * 2;
        el.style.cssText = stylecode + `--s: 0; --o: 1;`;
        el.offsetTop;
        el.style.cssText = stylecode + `--t: 1; --o: 0; --d: ${d}; --x:${e.clientX - r.left}; --y:${e.clientY - r.top};`;
      
    });
});

