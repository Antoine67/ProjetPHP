function findsize() {
    //this.files[0].size gets the size of your file.
    var fileIn = $("#monFichier")[0];
    var size = fileIn.files[0].size;
    console.log(size);

    
        if(size > 2097152){
        alert("Votre fichier a dépasser la taille maximale. La taille maximale autorisée est de 2Mo.");
        $('#bouton-ajouter-image-activite').hide();
    }
    else{
        $('#bouton-ajouter-image-activite').show();
    }
};