// Get the modal
var modal = document.getElementById('myModal');
window.onclick = function(event) {
  if (event.target == modal) {
      modal.style.display = "none";
  }
}
// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = $('.announcement-post-image-header');
var modalImg = $("#img01");
var captionText = document.getElementById("caption");
$('.announcement-post-image-header').click ( function(){
    modal.style.display = "block";
    var newSrc = this.src;
    modalImg.attr('src', newSrc);
    captionText.innerHTML = this.alt;
});

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}