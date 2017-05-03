function starAdd(date, user_id) {
    var userRating = document.getElementById("user-"+date+'-'+user_id);
    var elem = document.createElement("img");

    $.ajax({
      method: "POST",
      url: "/addStar",
      data: { user: user_id, date: date }
    })
      .done(function( msg ) {
        userRating.parentNode.setAttribute("onclick", "starRemove('"+date+"', '"+user_id+"')");

        elem.setAttribute("src", "/img/star.png");
        userRating.appendChild(elem);
      });

}

function starRemove(date, user_id) {
    var userRating = document.getElementById("user-"+date+'-'+user_id);

    $.ajax({
      method: "POST",
      url: "/removeStar",
      data: { user: user_id, date: date }
    })
      .done(function( msg ) {
        userRating.parentNode.setAttribute("onclick", "starAdd('"+date+"', '"+user_id+"')");
        userRating.innerHTML = "";
      });

}
