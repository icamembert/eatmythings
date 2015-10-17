function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {

            var currentPicturePath = $('#JcropPicture').attr('src');
            $('#JcropPicture').attr('src', e.target.result);
                    
            $('#JcropPicture').one('load', function() {
                
                var pictureNaturalWidth = document.getElementById('JcropPicture').naturalWidth; 
                var pictureNaturalHeight = document.getElementById('JcropPicture').naturalHeight;
                var pictureClientWidth = document.getElementById('JcropPicture').clientWidth;
                var pictureClientHeight = document.getElementById('JcropPicture').clientHeight;

                var pictureRatio = pictureNaturalWidth / pictureClientWidth;
                
                if (pictureNaturalWidth < 500 || pictureNaturalHeight < 500) {
                    
                    $('#JcropPicture').attr('src', '');

                    if (typeof JcropAPI != 'undefined')
                        JcropAPI.destroy();

                    alert('Picture must be at least 500x500 pixels!');
                    $('#JcropPicture').attr('src', currentPicturePath);

                } else {

                    if (typeof JcropAPI != 'undefined')
                        JcropAPI.destroy();
                    initJcrop(pictureRatio, pictureClientWidth, pictureClientHeight);

                }

            });

        };

        reader.readAsDataURL(input.files[0]);

    }

}


function initJcrop(pictureRatio, pictureClientWidth, pictureClientHeight) {

    $('#cropped').val('true');

	$('#JcropPicture').Jcrop({
        setSelect: [0, 0, Math.round(500 / pictureRatio), Math.round(500 / pictureRatio)],
        aspectRatio: 1,
        minSize: [Math.round(500 / pictureRatio), Math.round(500 / pictureRatio)],
        allowSelect: false,
        boxWidth: pictureClientWidth,
        boxHeight: pictureClientHeight
    }, function() {

        JcropAPI = this;
        JcropAPI.animateTo([100,100,400,300]);

        $('#cropx').val(Math.round(parseInt($('#JcropPicture').next().css('left')) * pictureRatio));
        $('#cropy').val(Math.round(parseInt($('#JcropPicture').next().css('top')) * pictureRatio));
        $('#cropw').val(Math.round(parseInt($('#JcropPicture').next().css('width')) * pictureRatio));
        $('#croph').val(Math.round(parseInt($('#JcropPicture').next().css('height')) * pictureRatio));

	});

    $('#JcropContainer').mouseout(function() {
        $('#cropx').val(Math.round(parseInt($('#JcropPicture').next().css('left')) * pictureRatio));
        $('#cropy').val(Math.round(parseInt($('#JcropPicture').next().css('top')) * pictureRatio));
        $('#cropw').val(Math.round(parseInt($('#JcropPicture').next().css('width')) * pictureRatio));
        $('#croph').val(Math.round(parseInt($('#JcropPicture').next().css('height')) * pictureRatio));
    });

};