
    window.onload = function() {

        var options =
        {
            imageBox: '.imageBox',
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: 'avatar.png'
        }
        var cropper;
        document.querySelector('#profile_picture').addEventListener('change', function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;

                cropper = new cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            //this.files = [];
			
			var filename = $('#profile_picture').val().replace(/C:\\fakepath\\/i, '');
			$("#upc_name").html(filename);
			$('#btnZoomIn').show();
			$('#btnZoomOut').show();
        })
        document.querySelector('#btnCrop').addEventListener('click', function(){
            var img = cropper.getDataURL()
           // document.querySelector('.cropped').innerHTML = '<img src="'+img+'">';
			$('#img_base64').val(img);
        })
        document.querySelector('#btnZoomIn').addEventListener('click', function(){
            cropper.zoomIn();
        })
        document.querySelector('#btnZoomOut').addEventListener('click', function(){
            cropper.zoomOut();
        })
		
		
		 var options_cover =
        {
            imageBox: '.imageBoxCover',
            thumbBox: '.thumbBoxCover',
            spinner: '.spinner',
            imgSrc: 'avatar.png'
        }
        var cropper_cover;
        document.querySelector('#cover_pic').addEventListener('change', function(){
            var reader = new FileReader();
			
            reader.onload = function(e) {
                options_cover.imgSrc = e.target.result;
                cropper_cover = new cropbox(options_cover);

            }
			
            reader.readAsDataURL(this.files[0]);
            //this.files = [];
			
			var filename = $('#cover_pic').val().replace(/C:\\fakepath\\/i, '');
			$("#ucc_name").html(filename);
			$('#btnZoomInCover').show();
			$('#btnZoomOutCover').show();
        })
        document.querySelector('#btnCropCover').addEventListener('click', function(){
            var img = cropper_cover.getDataURL()
          //  document.querySelector('.cropped_cover').innerHTML = '<img src="'+img+'">';
			$('#cover_img_base64').val(img);
        })
        document.querySelector('#btnZoomInCover').addEventListener('click', function(){
            cropper_cover.zoomIn();
        })
        document.querySelector('#btnZoomOutCover').addEventListener('click', function(){
            cropper_cover.zoomOut();
        })
		

    };
	
	
	$(document).ready(function(){
	
		$("#upload_cover_pic").click(function(e){
			$('#cover_pic').click();
		});
		
		$("#upload_profile_pic").click(function(e){
			$('#profile_picture').click();
		});
	});
	