const canvas = document.getElementById('game');
const context = canvas.getContext('2d');

top_5_players = []
top_5_scores = []

//llamada Ajax
function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function readMaxScores() {

    var ajax = objetoAjax();
    formdata = new FormData();
    formdata.append('_token', document.getElementById('token').getAttribute("content"));
    formdata.append('_method', 'POST');

    ajax.open("POST", "ranita/max_scores", true);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta)
            for (let i = 0; i < respuesta.length; i++) {
                top_5_players[i] = respuesta[i].user
                top_5_scores[i] = respuesta[i].max_score
            }
        }
    }

    ajax.send(formdata)
}
readMaxScores()


const grid = 48;
const gridGap = 10;

//ESTADO INICIAL JUEGO
var nivel = 1
var vidas = 3
    //sprites naves


// a simple sprite prototype function
function Sprite(props) {
    // shortcut for assigning all object properties to the sprite
    Object.assign(this, props);
}
Sprite.prototype.render = function() {
    context.fillStyle = this.color;

    // draw a rectangle sprite
    if (this.shape === 'rect') {
        // by using a size less than the grid we can ensure there is a visual space
        // between each row
        var img_tierra = document.getElementById("tierra")
        var patron_tierra = context.createPattern(img_tierra, 'repeat');
        context.fillStyle = patron_tierra;
        context.fillRect(this.x, this.y + gridGap / 2, this.size, grid - gridGap);
    } else if (this.shape === 'frog') {

        var img = document.getElementById("jose")
        var pat = context.createPattern(img, 'repeat');
        context.arc(
            this.x + this.size / 2, this.y + this.size / 2,
            this.size / 2 - gridGap / 2, 0, 2 * Math.PI
        );
        context.fillStyle = pat;
        context.fillRect(this.x, this.y + gridGap / 2, this.size, grid - gridGap);
        // by using a size less than the grid we can ensure there is a visual space
        // between each row
        //context.fillRect(this.x, this.y + gridGap / 2, this.size, grid - gridGap);
    }
    // draw a circle sprite. since size is the diameter we need to divide by 2
    // to get the radius. also the x/y position needs to be centered instead of
    // the top-left corner of the sprite
    else {
        var img_fuego = document.getElementById("fuego")
        var patron_fuego = context.createPattern(img_fuego, 'repeat');
        context.fillStyle = patron_fuego;

        context.beginPath();
        context.arc(
            this.x + this.size / 2, this.y + this.size / 2,
            this.size / 2 - gridGap / 2, 0, 2 * Math.PI
        );
        context.fill();
    }
}

const frogger = new Sprite({
    x: grid * 6,
    y: grid * 13,
    //color: 'greenyellow',
    size: grid,
    shape: 'frog',
    url: 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/47/PNG_transparency_demonstration_1.png/640px-PNG_transparency_demonstration_1.png'
});
const scoredFroggers = [];

// a pattern describes each obstacle in the row
var patterns = [
    // end bank is safe
    null,

    // log
    {
        spacing: [2], // how many grid spaces between each obstacle
        color: 'violet', // color of the obstacle
        size: grid * 4, // width (rect) / diameter (circle) of the obstacle
        shape: 'rect', // shape of the obstacle (rect or circle)
        speed: 0.75 // how fast the obstacle moves and which direction
    },

    // turtle
    {
        spacing: [0, 2, 0, 2, 0, 2, 0, 4],
        color: '#de0004',
        size: grid,
        shape: 'rect',
        speed: -1
    },

    // long log
    {
        spacing: [2],
        color: '#c55843',
        size: grid * 7,
        shape: 'rect',
        speed: 1.5
    },

    // log
    {
        spacing: [3],
        color: '#c55843',
        size: grid * 3,
        shape: 'rect',
        speed: 0.5
    },

    // turtle
    {
        spacing: [0, 0, 1],
        color: '#de0004',
        size: grid,
        shape: 'rect',
        speed: -1
    },

    // beach is safe
    null,

    // truck
    {
        spacing: [3, 8],
        color: '#c2c4da',
        size: grid,
        shape: 'circle',
        speed: -1
    },

    // fast car
    {
        spacing: [14],
        color: '#c2c4da',
        size: grid,
        shape: 'circle',
        speed: 0.75
    },

    // car
    {
        spacing: [3, 3, 7],
        color: '#de3cdd',
        size: grid,
        shape: 'circle',
        speed: -0.75
    },

    // bulldozer
    {
        spacing: [3, 3, 7],
        color: '#0bcb00',
        size: grid,
        shape: 'circle',
        speed: 0.5
    },

    // car
    {
        spacing: [4],
        color: '#e5e401',
        size: grid,
        shape: 'circle',
        speed: -0.5
    },

    // start zone is safe
    null
];

// rows holds all the sprites for that row
const rows = [];
for (let i = 0; i < patterns.length; i++) {
    rows[i] = [];

    let x = 0;
    let index = 0;
    const pattern = patterns[i];

    // skip empty patterns (safe zones)
    if (!pattern) {
        continue;
    }

    // allow there to be 1 extra pattern offscreen so the loop is seamless
    // (especially for the long log)
    let totalPatternWidth =
        pattern.spacing.reduce((acc, space) => acc + space, 0) * grid +
        pattern.spacing.length * pattern.size;
    let endX = 0;
    while (endX < canvas.width) {
        endX += totalPatternWidth;
    }
    endX += totalPatternWidth;

    // populate the row with sprites
    while (x < endX) {
        rows[i].push(new Sprite({
            x,
            y: grid * (i + 1),
            index,
            ...pattern
        }));

        // move the next sprite over according to the spacing
        const spacing = pattern.spacing;
        x += pattern.size + spacing[index] * grid;
        index = (index + 1) % spacing.length;
    }
}

// game loop
function loop() {
    if (vidas == 0) {
        //readMaxScores()
        context.fillStyle = "blue";
        context.fillRect(0, 0, canvas.width, canvas.height);

        if (/Mobi/.test(navigator.userAgent)) {
            context.font = "bold 350% DotGothic16,sans-serif";
            context.fillStyle = "white";
            context.fillText("ALL TIME", canvas.width / 2 - (grid * 0.8), grid * 2);
            context.fillText("GREATEST", canvas.width / 2 - (grid * 0.8), grid * 3.5);

            context.font = "bold 400% DotGothic16,sans-serif";
            context.fillText("LA RANITA", canvas.width / 2 - grid * 1.4, grid * 6);

            context.font = "bold 300% DotGothic16,sans-serif";
            for (let i = 0; i < 5; i++) {
                context.fillText((i + 1) + " " + top_5_players[i] + " - " + top_5_scores[i], canvas.width / 2 - grid * 1, grid * 8 + i * grid);
            }

            //imagen ranita
            var ranita = document.getElementById("jose")
            var patron_ranita = context.createPattern(ranita, 'repeat');
            context.fillStyle = patron_ranita;
            context.fillRect(grid * 5, grid * 13, grid, grid);

            //imagen logo
            var logo = document.getElementById("logo")
            var patron_logo = context.createPattern(logo, 'repeat');
            context.fillStyle = patron_logo;
            context.fillRect(grid * 10, grid * 13, grid, grid);
        } else {
            context.font = "bold 350% DotGothic16,sans-serif";
            context.fillStyle = "white";
            context.fillText("ALL TIME", canvas.width / 2 - (grid * 2.2), grid * 2);
            context.fillText("GREATEST", canvas.width / 2 - (grid * 2.2), grid * 3.5);

            context.font = "bold 400% DotGothic16,sans-serif";
            context.fillText("LA RANITA", canvas.width / 2 - (grid * 3), grid * 6);

            context.font = "bold 300% DotGothic16,sans-serif";
            for (let i = 0; i < 5; i++) {
                context.fillText((i + 1) + " " + top_5_players[i] + " - " + top_5_scores[i], canvas.width / 2 - grid * 2.5, grid * 8 + i * grid);
            }

            //imagen ranita
            var ranita = document.getElementById("jose")
            var patron_ranita = context.createPattern(ranita, 'repeat');
            context.fillStyle = patron_ranita;
            context.fillRect(grid * 4, grid * 13, grid, grid);

            //imagen logo
            var logo = document.getElementById("logo")
            var patron_logo = context.createPattern(logo, 'repeat');
            context.fillStyle = patron_logo;
            context.fillRect(grid * 8, grid * 13, grid, grid);
        }

        function introducirHighScore(nuevo_user) {
            var ajax = objetoAjax();
            formdata = new FormData();
            formdata.append('_token', document.getElementById('token').getAttribute("content"));
            formdata.append('new_user', nuevo_user);
            formdata.append('level', nivel);
            formdata.append('_method', 'POST');

            ajax.open("POST", "ranita/new_score", true);

            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    var respuesta = JSON.parse(this.responseText);
                }
            }
            ajax.send(formdata)
        }

        new_user = "jose"
        while (new_user.length != 3) {
            new_user = prompt("Has alcanzado el nivel " + nivel +
                ". Introduce tu nick (Ex: AAA)\n\nCancela para ver el Hall of Fame de La Ranita")
        }
        introducirHighScore(new_user);




    } else {
        requestAnimationFrame(loop);
    }

    context.clearRect(0, 0, canvas.width, canvas.height);

    // draw the game background

    var img_carretera = document.getElementById("carretera")
    var patron_carretera = context.createPattern(img_carretera, 'repeat');
    context.fillStyle = patron_carretera;
    context.fillRect(0, grid * 6, grid * 13, grid * 8);

    // water

    var img_agua = document.getElementById("agua")
    var patron_agua = context.createPattern(img_agua, 'repeat');
    context.fillStyle = patron_agua;
    context.fillRect(0, grid, canvas.width, grid * 7);



    //logo safe zone

    var img_gold = document.getElementById("gold")
    var patron_gold = context.createPattern(img_gold, 'repeat');
    context.fillStyle = patron_gold;
    context.fillRect(0, grid, canvas.width, grid);

    //context.fillRect(0, grid, canvas.width, grid * 6);

    // lava final




    // middle

    var img_arena = document.getElementById("arena")
    var patron_arena = context.createPattern(img_arena, 'repeat');
    context.fillStyle = patron_arena;
    context.fillRect(0, 7 * grid, canvas.width, grid);

    // start zone
    var img_cesped = document.getElementById("cesped")
    var patron_cesped = context.createPattern(img_cesped, 'repeat');
    context.arc(
        this.x + this.size / 2, this.y + this.size / 2,
        this.size / 2 - gridGap / 2, 0, 2 * Math.PI
    );
    context.fillStyle = patron_cesped;
    context.fillRect(0, canvas.height - grid * 2, canvas.width, grid);

    //TEXTO Y DEMAS

    context.font = " BOLD 280% DotGothic16";
    context.fillStyle = "black";

    if (/Mobi/.test(navigator.userAgent)) {
        context.fillText("NIVEL " + nivel, canvas.width / 4, grid - 4);
        if (vidas == 1) {
            var corazon = document.getElementById("corazon")
            var patron_corazon = context.createPattern(corazon, 'repeat');
            context.fillStyle = patron_corazon;
            context.fillRect(grid * 12, 0, grid, grid);
        } else if (vidas == 2) {
            var corazon = document.getElementById("corazon")
            var patron_corazon = context.createPattern(corazon, 'repeat');
            context.fillStyle = patron_corazon;
            context.fillRect(grid * 11, 0, grid * 2, grid);
        } else if (vidas == 3) {
            var corazon = document.getElementById("corazon")
            var patron_corazon = context.createPattern(corazon, 'repeat');
            context.fillStyle = patron_corazon;
            context.fillRect(grid * 10, 0, grid * 3, grid);
        }
    } else {
        context.fillText("NIVEL " + nivel, 0, grid - 4);
        if (vidas == 1) {
            var corazon = document.getElementById("corazon")
            var patron_corazon = context.createPattern(corazon, 'repeat');
            context.fillStyle = patron_corazon;
            context.fillRect(grid * 12, 0, grid, grid);
        } else if (vidas == 2) {
            var corazon = document.getElementById("corazon")
            var patron_corazon = context.createPattern(corazon, 'repeat');
            context.fillStyle = patron_corazon;
            context.fillRect(grid * 11, 0, grid * 2, grid);
        } else if (vidas == 3) {
            var corazon = document.getElementById("corazon")
            var patron_corazon = context.createPattern(corazon, 'repeat');
            context.fillStyle = patron_corazon;
            context.fillRect(grid * 10, 0, grid * 3, grid);
        }
    }


    if (/Mobi/.test(navigator.userAgent)) {
        var izquierda = document.getElementById("izquierda")
        var patron_izquierda = context.createPattern(izquierda, 'repeat');
        context.fillStyle = patron_izquierda;
        context.fillRect(0, grid * 14, grid * 8 - 40, grid);

        var derecha = document.getElementById("derecha")
        var patron_derecha = context.createPattern(derecha, 'repeat');
        context.fillStyle = patron_derecha;
        context.fillRect(grid * 9 + 10, grid * 14, grid * 8 - 40, grid);
    }



    // update and draw obstacles
    for (let r = 0; r < rows.length; r++) {
        const row = rows[r];

        for (let i = 0; i < row.length; i++) {
            const sprite = row[i]
            sprite.x += sprite.speed * (nivel * 0.5);
            sprite.render();

            // loop sprite around the screen
            // sprite is moving to the left and goes offscreen
            if (sprite.speed < 0 && sprite.x < 0 - sprite.size) {

                // find the rightmost sprite
                let rightMostSprite = sprite;
                for (let j = 0; j < row.length; j++) {
                    if (row[j].x > rightMostSprite.x) {
                        rightMostSprite = row[j];
                    }
                }

                // move the sprite to the next spot in the pattern so it continues
                const spacing = patterns[r].spacing;
                sprite.x =
                    rightMostSprite.x + rightMostSprite.size +
                    spacing[rightMostSprite.index] * grid;
                sprite.index = (rightMostSprite.index + 1) % spacing.length;
            }

            // sprite is moving to the right and goes offscreen
            if (sprite.speed > 0 && sprite.x > canvas.width) {

                // find the leftmost sprite
                let leftMostSprite = sprite;
                for (let j = 0; j < row.length; j++) {
                    if (row[j].x < leftMostSprite.x) {
                        leftMostSprite = row[j];
                    }
                }

                // move the sprite to the next spot in the pattern so it continues
                const spacing = patterns[r].spacing;
                let index = leftMostSprite.index - 1;
                index = index >= 0 ? index : spacing.length - 1;
                sprite.x = leftMostSprite.x - spacing[index] * grid - sprite.size;
                sprite.index = index;
            }
        }
    }

    // draw frogger
    frogger.x += frogger.speed || 0;
    frogger.render();

    // draw scored froggers
    scoredFroggers.forEach(frog => frog.render());

    // check for collision with all sprites in the same row as frogger
    const froggerRow = frogger.y / grid - 1 | 0;
    let collision = false;
    for (let i = 0; i < rows[froggerRow].length; i++) {
        let sprite = rows[froggerRow][i];

        // axis-aligned bounding box (AABB) collision check
        // treat any circles as rectangles for the purposes of collision
        if (frogger.x < sprite.x + sprite.size - gridGap &&
            frogger.x + grid - gridGap > sprite.x &&
            frogger.y < sprite.y + grid &&
            frogger.y + grid > sprite.y) {
            collision = true;

            // reset frogger if got hit by car
            if (froggerRow > rows.length / 2) {
                frogger.x = grid * 6;
                frogger.y = grid * 13;
            }
            // move frogger along with obstacle

        }
    }

    if (!collision) {
        // if fogger isn't colliding reset speed
        frogger.speed = 0;

        // frogger got to end bank (goal every 3 cols)
        const col = (frogger.x + grid / 2) / grid | 0;
        if (froggerRow === 0 &&
            // check to see if there isn't a scored frog already there
            !scoredFroggers.find(frog => frog.x === col * grid)) {
            scoredFroggers.push(new Sprite({
                ...frogger,
                x: col * grid,
                y: frogger.y + 5
            }));
        }

        // reset frogger if not on obstacle in river
        if (froggerRow < rows.length / 2 - 1) {
            frogger.x = grid * 6;
            frogger.y = grid * 13;
            if (froggerRow == 0) {
                nivel = nivel + 1
            } else {
                vidas = vidas - 1
            }
            //victory
        } else {
            //vivo en carretera
            //console.log("Estoy en carretera y vivo")
        }
    } else {
        if (frogger.y < grid * 7) {
            //console.log("Estoy en un tronco y vivo")
        } else {
            //crash en carretera
            vidas = vidas - 1
        }

    }
}

// listen to touch events to move frogger just forward
document.addEventListener('touchstart', function(e) {
    clientX = e.touches[0].clientX
    clientY = e.touches[0].clientY
    console.log(clientY)
    if (clientY < 1500) {
        frogger.y -= grid;
    } else {
        if (clientX > 650) {
            frogger.x += grid;
        } else if (clientX < 650) {
            frogger.x -= grid;
        }
    }

})

document.addEventListener('keydown', function(e) {
    // left arrow key
    if (e.which === 37) {
        frogger.x -= grid;
    }
    // right arrow key
    else if (e.which === 39) {
        frogger.x += grid;
    }

    // up arrow key
    else if (e.which === 38) {
        frogger.y -= grid;
    }
    // down arrow key
    else if (e.which === 40) {
        frogger.y += grid;
    }

    // clamp frogger position to stay on screen
    frogger.x = Math.min(Math.max(0, frogger.x), canvas.width - grid);
    frogger.y = Math.min(Math.max(grid, frogger.y), canvas.height - grid * 2);
});


// start the game
requestAnimationFrame(loop);