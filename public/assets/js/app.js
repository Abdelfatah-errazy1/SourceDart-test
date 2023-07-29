var image=document.getElementById('image')
console.log(image);
var imageProduct=document.getElementById('imageProduct')
image.onchange=()=>{
  const file = image.files[0];
  imageProduct.src = URL.createObjectURL(file);
}