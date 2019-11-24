

//图片上传预览
function preview(file,w,h)
{
    var MAXWIDTH  = w;
    var MAXHEIGHT = h;
    if (file.files && file.files[0])
    {
        var img=$(file).next('img')[0];
        img.onload = function(){
            img.width  =  MAXWIDTH;
            img.height =  MAXHEIGHT;
        };
        var reader = new FileReader();
        reader.onload = function(evt){img.src = evt.target.result;};
        reader.readAsDataURL(file.files[0]);
        $(file).prev('label').css('background','rgba(0,0,0,0.6)').text('重新选择');
    }
}




