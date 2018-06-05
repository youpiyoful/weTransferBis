//fonction pour check si il s'agit bien d'une adresse mail côté destinataire

$("#destinataire").focusout(function () {
    var myRegex = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/; //le regex check si la syntaxe est de type e-mail

    if (!myRegex.test(this.value)) {
        $('#destinataire').css("background-color", "rgb(245,62,84)");
        return false;
    } else {
        $('#destinataire').css("background-color", "rgb(83, 245, 62)");
        return true;
    }
});


//fonction pour check si il s'agit bien d'une adresse mail côté expediteur

$("#expediteur").focusout(function () {
    var myRegex = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/; //le regex check si la syntaxe est de type e-mail

    if (!myRegex.test(this.value)) {
        $('#expediteur').css("background-color", "rgb(245,62,84)");
        return false;
    } else {
        $('#expediteur').css("background-color", "rgb(83, 245, 62)");
        return true;
    }
});