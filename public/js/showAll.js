const sortButton = document.querySelector('#sort-button');
const hzScrollDiv = document.querySelector('#hz-scroll');
let offset = 0;
let url = "http://localhost:8000/api/favorites";

if ("?s=desc" === window.location.search) {
    sortButton.setAttribute('href', "/favorites");
    url = "http://localhost:8000/api/favorites?s=desc"
}

const getUserFavorites = async () => {
    let favList = [];
    await fetch('http://localhost:8000/api/index', {
        headers: {
            "content-type": "application/json"
        }
    })
        .then((response) => response.json())
        .then(json => favList = json);
    return favList;
}

const fetchRequest = async (url, callback) => {
    let userFav = await getUserFavorites();
    await fetch(url, {
        headers: {
            "content-type": "application/json"
        }
    })
        .then(favorites => favorites.json())
        .then(json => callback(json, userFav))
}

const makeTiles = (tile, alreadyExist) => {
    const container = document.createElement("div");
    container.className = "tile-container bg-dark card";
    container.style = "height: 50%; max-width: 25em";
    if (tile.preview) {

        if (alreadyExist) {
            container.innerHTML = `
                <div class="iframe-wrapper">
                    <iframe 
                        src="${tile.preview}" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            `;
        } else {
            container.innerHTML = `
                <div class="iframe-wrapper">
                    <iframe 
                        src="${tile.preview}" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                    <div class="preview-action">
                        <a href="/add?fav=${tile.href}">
                            <i class="text-info fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            `;
        }
    } else {
        if (alreadyExist) {
            container.innerHTML = `
                <div class="fav-wrapper">
                    <img src="${tile.favicon}" alt='favicon' width="35px" class="m-3" />
                    <a href="${decodeURIComponent(tile.href)}" class="text-dark card-body">
                        <h3 class="card-title">${tile.title}</h3>
                        <p class="card-text">Primary card title</p>
                    </a>
                </div>
            `;
        } else {
            container.innerHTML = `
                <div class="fav-wrapper">
                    <img src="${tile.favicon}" alt='favicon' width="35px" class="m-3" />
                    <span class="fav-action">
                        <a href="/add?fav=${tile.href}">
                            <i class="text-info fas fa-plus"></i>
                        </a>
                    </span>
                    <a href="${decodeURIComponent(tile.href)}" class="text-dark card-body">
                        <h3 class="card-title">${tile.title}</h3>
                        <p class="card-text">Primary card title</p>
                    </a>
                </div>
            `;
        }
    }
    return container;
}

const callBack = (jsonResponse, userFav) => {
    if (document.querySelector(".mt-center")) {
        document.querySelector(".mt-center").remove();
    }
    jsonResponse.forEach((value) => {
        let alreadyExist = false;
        userFav.forEach((val) => {
            console.log(val.href, '<br>', value.href);
            if (val.href === value.href) {
                alreadyExist = true;
            }
        })
        console.log(alreadyExist);
        const tile = makeTiles(value, alreadyExist);
        hzScrollDiv.appendChild(tile);
    })
    if (0 !== jsonResponse.length) {
        hzScrollDiv.addEventListener("scroll", scroll);
    }
    
}

fetchRequest(url, callBack);

const createSpinner = () => {
    const div = document.createElement('div');
    div.className = 'mt-center';
    div.innerHTML =  `<div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>`;
    return div;
}

const scrollHorizontally = (e) => {
    e = window.event || e;
    var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
    document.getElementById('hz-scroll').scrollLeft -= (delta * 100);
    e.preventDefault();
}

const switchScroll = () => {
    const bodyOffset = document.body.offsetHeight;
    const scrollBottom = window.scrollY + window.innerHeight;
    if ((bodyOffset - 1) <= scrollBottom) {
        if (hzScrollDiv.addEventListener) {
            // IE9, Chrome, Safari, Opera
            hzScrollDiv.addEventListener('mousewheel', scrollHorizontally);
            // Firefox
            hzScrollDiv.addEventListener('DOMMouseScroll', scrollHorizontally);
        }
    } else {
        hzScrollDiv.removeEventListener('mousewheel', scrollHorizontally);
        hzScrollDiv.removeEventListener('DOMMouseScroll', scrollHorizontally);
    }
}

window.addEventListener('scroll', switchScroll);

const scroll = () => {
    const bodyOffset = hzScrollDiv.scrollWidth;
    const scrollBottom =  hzScrollDiv.scrollLeft +  hzScrollDiv.offsetWidth;
    if ((bodyOffset - 1) <= scrollBottom) {
        const spinner = createSpinner();
        hzScrollDiv.appendChild(spinner);
        offset += 8;
        url = `http://localhost:8000/api/favorites?p=${offset}`;
        fetchRequest(url, callBack);
        hzScrollDiv.removeEventListener('scroll', scroll);
    }
}

hzScrollDiv.addEventListener("scroll", scroll);