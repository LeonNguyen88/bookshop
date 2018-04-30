function preview_cover(event){
    var reader = new FileReader();
    reader.onload = function(event){
        var imageUrl = event.target.result;
        imageElement = document.createElement('img');
        imageElement.src = imageUrl;
        imageElement.className = "preview-thumbnail";
        $('#preview-cover').html(imageElement);
    }
    reader.readAsDataURL(event.target.files[0]);
}
function preview_thumbnail(event){
    if(document.getElementsByClassName('preview-thumbnail-item')){
        $('.preview-thumbnail-item').remove();
    }
    for(var i = 0; i < event.target.files.length; i++){
        var reader = new FileReader();
        reader.onload = function(event){
            var imageUrl = event.target.result;
            var image = '<img src="'+ imageUrl + '" class="preview-thumbnail" />';
            itemElement = document.createElement('div');
            itemElement.className = 'preview-thumbnail-item';
            itemElement.innerHTML = image;
            $('#preview-photo').append(itemElement);
        }
        reader.readAsDataURL(event.target.files[i]);
    }
}