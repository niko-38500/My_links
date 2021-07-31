<?php ob_start() ?>
<section id="slide-show">
    <div class="carousel-wrapper">
        <div class="left-arrow"><i class="fas fa-chevron-left fa-lg"></i></div>
        <div class="right-arrow"><i class="fas fa-chevron-right fa-lg"></i></div>
        <div class="carousel-dots">
            <div class="carousel-dot initial"></div>
            <div class="carousel-dot"></div>
            <div class="carousel-dot"></div>
            <div class="carousel-dot"></div>
        </div>
        <img class="carousel-img initial" src="images/ec2dd8f8a701848eac03894d58cd84f5358d9f11copy.jpg" />
        <div class="img-content initial">
            <span class="content-wrapper"></span>
            <span class="content">
                <h2>Bienvenue</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut laudantium odio quaerat, molestias placeat iste, maxime atque mollitia rerum ipsa quae minus. Lorem ipsum dolor sit.</p>
                <a href="#" class="carousel-btn">Dépot GitHub</a>
            </span>
            <span class="content-wrapper"></span>
        </div>
        <img class="carousel-img" src="images/65dd4f32edb29335f347b183584c74d5aa22f5e8.jpg" />
        <div class="img-content">
            <span></span>
            <span>
                <h2>Second header</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam quae delectus, ipsum facere natus excepturi neque repudiandae consequatur ea non officiis veritatis, dicta.</p>
                <a href="#" class="carousel-btn">Dépot GitHub</a>
            </span>
            <span></span>

        </div>
        <img class="carousel-img" src="https://images.wave.fr/images//jul-ckhjls.jpeg" />
        <div class="img-content">
            <span></span>
            <span>
                <h2>blabla</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur minima saepe commodi adipisci odio aliquid asperiores iste itaque repellat vero, nostrum delectus repellendus repudiandae.</p>
                <a href="#" class="carousel-btn">Dépot GitHub</a>
            </span>
            <span></span>

        </div>
        <img class="carousel-img" src="images/a30061c58845cbb00cd3536ce1d2df6398d7a39b.jpg" />
        <div class="img-content">
            <span></span>
            <span>
                <h2>blabla</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt, eos obcaecati officiis illum necessitatibus voluptatem rerum vero nam soluta ex veritatis facere saepe tempore</p>
                <a href="#" class="carousel-btn">Dépot GitHub</a>
            </span>
            <span></span>
        </div>
    </div>
</section>
<?php 
$content = ob_get_clean();
$title = "My-links - Home";
?>