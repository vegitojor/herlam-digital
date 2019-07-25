var _url = _urlServer + "/vistas/categoria.php";

$(document).ready( () => {

});


function shareSocial(id, imagen, idCategoria) {
	$("#share-" + id).jsSocials({
        shares: ["twitter", "facebook", "googleplus", "linkedin",  {
        	share:"pinterest",
		    label: "Pin it",
		    logo: "fa fa-pinterest",
		    media: _urlServer + "/resourses/imagen_producto/" + imagen
		}],
        url: _urlServer + "/resourses/imagen_producto/" + imagen,
        text: "Mod Pc",
        showLabel: false,
    	showCount: false,
    	shareIn: "popup"
    });
}


