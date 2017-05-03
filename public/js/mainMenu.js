function activeMenu(active) {
    $(".active").removeClass( "active" );
    $(".link-"+active).parent().attr( 'class', 'active' );

}
