<div class="carousel slide theme-slider text-center" id="controlStyledExample" data-ride="carousel">
    <div class="carousel-indicators">
    </div>
    <div class="carousel-inner rounded tes">

    </div>
</div>

<script>
    // Multiple images preview with JavaScript
    $('#gambar').change(function() {
        var indicators = $('.carousel-indicators');
        indicators.html('');
        var inner = $('.carousel-inner');
        inner.html('');
        var image = document.getElementById("gambar");
        if (image.files) {
            var filesAmount = image.files.length;
            for (let i = 0; i < filesAmount; i++) {
                let reader = new FileReader();
                reader.onload = () => {
                    // console.log(reader.result);
                    var img = $('<img>').addClass('d-block w-100 img-carousel-preview').attr('src', reader.result).attr('alt', 'slide ' + (i));

                    if (i == 0) {
                        var btnIndicator = $('<button>').addClass('active').attr('type', 'button').attr('data-bs-target', '#controlStyledExample').attr('data-bs-slide-to', i.toString()).attr('aria-current', 'true').attr('aria-label', 'Slide ' + (i))

                        var item = $('<div>').addClass('carousel-item active').append(img);

                    } else {
                        console.log('benar');
                        var btnIndicator = $('<button>').attr('type', 'button').attr('data-bs-target', '#controlStyledExample').attr('data-bs-slide-to', i.toString()).attr('aria-label', 'Slide ' + (i));
                        var item = $('<div>').addClass('carousel-item').append(img);
                    }

                    indicators.append(btnIndicator);
                    inner.append(item);
                }
                reader.readAsDataURL(image.files[i]);

            }
            var controlPrev = $('<button>').addClass('carousel-control-prev').attr('type', 'button').attr('data-bs-target', '#controlStyledExample').attr('data-bs-slide', 'prev');
            var controlPrevIcon = $('<span>').addClass('fas fa-angle-left');
            var controlPrevLabel = $('<span>').addClass('sr-only').text('Previous');
            var controlNext = $('<button>').addClass('carousel-control-next').attr('type', 'button').attr('data-bs-target', '#controlStyledExample').attr('data-bs-slide', 'next');
            var controlNextIcon = $('<span>').addClass('fas fa-angle-right');
            var controlNextLabel = $('<span>').addClass('sr-only').text('Next');

            controlPrev.append(controlPrevIcon, controlPrevLabel);
            controlNext.append(controlNextIcon, controlNextLabel);
            inner.append(controlNext, controlPrev);
        }
    });
</script>