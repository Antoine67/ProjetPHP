

var file = this.files[0];
var fileType = file["type"];
var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
if ($.inArray(fileType, validImageTypes) < 0) {
     alert('Image choisie non valide');
}