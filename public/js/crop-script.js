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
                    initJcrop(pictureRatio, pictureClientWidth, pictureClientHeight, input);

                }

            });

        };

        reader.readAsDataURL(input.files[0]);

    }

}


function initJcrop(pictureRatio, pictureClientWidth, pictureClientHeight, input) {

    $('#imageChoosePanel').hide(400);
    $('#imageCropButtonsPanel').show(400);
    $('#imageCropCancelButton').click(function() {
        $('#imageCropButtonsPanel').hide(400);
        $('#imageChoosePanel').show(400);
        if (typeof JcropAPI != 'undefined')
            JcropAPI.destroy();
        $('#JcropPicture').replaceWith("<img id='JcropPicture' class='img-responsive' src=" + profilePicturePath + " alt=''/>");
    });

	$('#JcropPicture').Jcrop({
        setSelect: [0, 0, Math.round(500 / pictureRatio), Math.round(500 / pictureRatio)],
        aspectRatio: 1,
        minSize: [Math.round(500 / pictureRatio), Math.round(500 / pictureRatio)],
        allowSelect: false,
        boxWidth: pictureClientWidth,
        boxHeight: pictureClientHeight,
        onChange: updateCanvas,
        onSelect: updateCanvas
    }, function() {

        JcropAPI = this;
        JcropAPI.animateTo([100,100,400,300]);

        /*$('#cropx').val(Math.round(parseInt($('#JcropPicture').next().css('left')) * pictureRatio));
        $('#cropy').val(Math.round(parseInt($('#JcropPicture').next().css('top')) * pictureRatio));
        $('#cropw').val(Math.round(parseInt($('#JcropPicture').next().css('width')) * pictureRatio));
        $('#croph').val(Math.round(parseInt($('#JcropPicture').next().css('height')) * pictureRatio));*/

	});

    function updateCanvas(c) {
        var JcropPicture = $('#JcropPicture')[0];
        var JcropCanvas = $('#JcropCanvas')[0];
        $('#JcropCanvas').attr('width', c.w);
        $('#JcropCanvas').attr('height', c.h);
        var context = JcropCanvas.getContext('2d');
        context.drawImage(JcropPicture,
            c.x,
            c.y,
            c.w - 1,
            c.h - 1,
            0,
            0,
            c.w,
            c.h

            /*Math.round(parseInt($('#JcropPicture').next().css('left')) * pictureRatio), 
            Math.round(parseInt($('#JcropPicture').next().css('top')) * pictureRatio), 
            Math.round(parseInt($('#JcropPicture').next().css('width')) * pictureRatio), 
            Math.round(parseInt($('#JcropPicture').next().css('height')) * pictureRatio), 
            Math.round(parseInt($('#JcropCanvas').next().css('left')) * pictureRatio), 
            Math.round(parseInt($('#JcropCanvas').next().css('top')) * pictureRatio), 
            Math.round(parseInt($('#JcropCanvas').next().css('width')) * pictureRatio), 
            Math.round(parseInt($('#JcropCanvas').next().css('height')) * pictureRatio)*/
        );
        $('#imageCropButton').click(function() {

            $('#cropped').val('true');
           /*$('#cropx').val(Math.round(parseInt($('#JcropPicture').next().css('left')) * pictureRatio));
            $('#cropy').val(Math.round(parseInt($('#JcropPicture').next().css('top')) * pictureRatio));
            $('#cropw').val(Math.round(parseInt($('#JcropPicture').next().css('width')) * pictureRatio));
            $('#croph').val(Math.round(parseInt($('#JcropPicture').next().css('height')) * pictureRatio));*/

            var imageByteSize = input.files[0].size;
            var dataURL = JcropCanvas.toDataURL('image/jpeg');
            var base64ImageByteSize = dataURL.length;
            var formData = new FormData();
            formData.append('image', input.files[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (base64ImageByteSize <= imageByteSize) {
                var progress = $(".loading-progress").progressTimer({
                    timeLimit: 60    
                });
                $.ajax({
                    /*xhr: function() {
                        
                        var xhr = new window.XMLHttpRequest();
                        
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                var percentageComplete = e.loaded / e.total * 100 + '%';
                                console.log(percentageComplete);
                            }
                        }, false);
                        
                        return xhr;

                    },*/
                    type: 'POST',
                    url: 'users/crop',
                    data: {
                        alreadyCropped: true,
                        base64Image: dataURL,
                        type: 'user'
                    },
                    dataType: 'JSON'
                }).done(function() {
                    progress.progressTimer('complete');
                    imageUploadFinished = true;
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'users/crop',
                    data: {
                        alreadyCropped: false,
                        image: formData,
                        cropX: c.x * pictureRatio,
                        cropY: c.y * pictureRatio,
                        cropW: c.w * pictureRatio,
                        cropH: c.h * pictureRatio,
                        type: 'user'
                    },
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function() {
                    }
                });
            }
            
        });
    }

};