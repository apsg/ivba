const inViewport = (entries, observer) => {
    entries.forEach(entry => {
        entry.target.classList.toggle("is-inViewport", entry.isIntersecting);
    });
};

const Obs = new IntersectionObserver(inViewport);
const obsOptions = {
    thresholds: [1,1,1,1 ],
};

// Attach observer to every [data-inviewport] element:
document.querySelectorAll('[data-inviewport]').forEach(el => {
    Obs.observe(el, obsOptions);
});
