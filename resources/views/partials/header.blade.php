<!-- resources/views/partials/header.blade.php -->
<div id="headerCarousel" class="carousel slide mb-3" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#headerCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#headerCarousel" data-slide-to="1"></li>
        <li data-target="#headerCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Slides -->
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Slide Pertama</h5>
                <p>Deskripsi singkat slide pertama.</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="{{ asset('images/banner2.jpg') }}" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Slide Kedua</h5>
                <p>Deskripsi singkat slide kedua.</p>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="{{ asset('images/banner3.jpg') }}" class="d-block w-100" alt="Slide 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Slide Ketiga</h5>
                <p>Deskripsi singkat slide ketiga.</p>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="carousel-control-prev" href="#headerCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#headerCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
