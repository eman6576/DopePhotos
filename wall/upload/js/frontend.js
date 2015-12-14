var upload = document.getElementById('upload');
var image = document.getElementById('image');

function uploadImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            image.setAttribute('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        
        $("img").show();
        $("#checkboxlist").show();
    }
};

$("#upload").change(function(){
    uploadImage(this);
});

function applyMyNostalgiaFilter() {   
    var filter = 'saturate(40%) grayscale(100%) contrast(45%) sepia(100%)';
    image.style.filter = filter;
    image.style.webkitFilter = filter;
};

function applyGrayscaleFilter() {   
    var filter = 'grayscale(100%)';
    image.style.filter = filter;
    image.style.webkitFilter = filter;
};

function applyNegativeFilter() {
    var filter = 'invert(100%)';
    image.style.filter = filter;
    image.style.webkitFilter = filter;
}

function revertToOriginal() {   
    var filter = '';
    image.style.filter = filter;
    image.style.webkitFilter = filter;
};

function resetUploader() {
    location.reload();
};