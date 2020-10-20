<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UsuarioController extends Controller
{
    #atributo de tipo array con todos los paises

    public $paises = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

    public function index(){

        #se trae de la bd los usuarios ordenados por id de forma ascendente, en grupos de a 4 
        $usuarios = Usuario::orderBy('id','asc')->paginate(4);
        $vac = compact("usuarios");
        return view ('vistaUsuarios', $vac);

    }

    public function create(){
        #muestra la vista de adicion de usuarios llevando el array de paises
        return view('formAgregarUsuario', [
            'paises' => $this->paises
            ]);

    }

    public function store(Request $request)
    {
        #se prepara un nuevo usuario
        $usuarioNuevo = new Usuario();

        #se hace una verificacion de datos para que no haya ningun inconveniente
        $reglas = [
            "nombre" => "string|min:2|max:45|required",
            "apellido" => "string|min:2|max:45|required",
            "email" => "email|min:2|max:45|required",
        ];
        $mensajes = [
            "nombre.string" => "El campo nombre debe ser un texto",
            "nombre.min" => "El campo nombre tener como mínimo 2 caracteres",
            "nombre.max" => "El campo nombre solo puede tener hasta 45 caracteres",
            "nombre.required" => "El campo nombre debe ser completado",
            "apellido.string" => "El campo apellido debe ser un texto",
            "apellido.min" => "El campo apellido tener como mínimo 2 caracteres",
            "apellido.max" => "El campo apellido solo puede tener hasta 45 caracteres",
            "apellido.required" => "El campo apellido debe ser completado",
            "email.email" => "Error de formato de email",
            "email.min" => "El campo email tener como mínimo 2 caracteres",
            "email.max" => "El campo email solo puede tener hasta 45 caracteres",
            "email.required" => "El campo email debe ser completado",
        ];
        $this->validate($request, $reglas, $mensajes);

        #se agregan los datos al usuario preparado anteriormente
        $usuarioNuevo->nombre = $request["nombre"];
        $usuarioNuevo->apellido = $request["apellido"];
        $usuarioNuevo->email = $request["email"];
        $usuarioNuevo->pais = $request["pais"];
        $usuarioNuevo->save();

        #se vuelve a la vista anterior con un mensaje de exito
        return back()->with("estado", "el usuario se agregó con éxito");

    }

    public function edit($id)
    {
        #se dirije a la vista de modificacion de usuarios con los datos del mismo y el array de paises
        $usuario = Usuario::find($id);
        return view("formModificarUsuario", [
            'usuario' => $usuario,
            'paises' => $this->paises
        ]);

    }

    public function update(Request $request, $id)
    {

                #se hace una verificacion de datos para que no haya ningun inconveniente
                $reglas = [
                    "nombre" => "string|min:2|max:45|required",
                    "apellido" => "string|min:2|max:45|required",
                    "email" => "email|min:2|max:45|required",
                ];
                $mensajes = [
                    "nombre.string" => "El campo nombre debe ser un texto",
                    "nombre.min" => "El campo nombre tener como mínimo 2 caracteres",
                    "nombre.max" => "El campo nombre solo puede tener hasta 45 caracteres",
                    "nombre.required" => "El campo nombre debe ser completado",
                    "apellido.string" => "El campo apellido debe ser un texto",
                    "apellido.min" => "El campo apellido tener como mínimo 2 caracteres",
                    "apellido.max" => "El campo apellido solo puede tener hasta 45 caracteres",
                    "apellido.required" => "El campo apellido debe ser completado",
                    "email.email" => "Error de formato de email",
                    "email.min" => "El campo email tener como mínimo 2 caracteres",
                    "email.max" => "El campo email solo puede tener hasta 45 caracteres",
                    "email.required" => "El campo email debe ser completado",
                ];
                $this->validate($request, $reglas, $mensajes);

        #se aplican las modificaciones en la bd
        Usuario::where('id',$id)->update($request->except(['_token','_method']));
        return redirect("vistaUsuarios");

    }

    public function destroy(Request $request)
    {
        #busca el usuario a travez de su id
        $usuario = Usuario::find($request["id"]);
        
        #se elimina al usuario
        $usuario->delete();   
        return redirect("vistaUsuarios");

    }

}
