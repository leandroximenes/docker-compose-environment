<?php
if (defined('USER')) return;

$array_OMS = array(
    23085, 3319, 3400, 3509, 3608, 3004, 28001, 23473, 3707, 3806, 3913, 4002, 34744,
    28100, 46707, 4101, 3103, 46708, 4119, 4234, 2600, 160392, 2907, 4184, 23622, 46706, 4127, 34637,
    3, 2501, 1, 25239, 160329, 2187, 12914, 2709, 160008, 39925, 27, 160094, 160069, 160479, 160167,
    2, 21865
);
$gec_1 = array(3319, 3400, 3509, 3608, 3004, 23085, 28001);
$gec_2 = array(3707, 3806, 3913, 4002, 34744, 23473, 28100, 21865);
$gec_3 = array(46707, 4101, 3103);
$gec_4 = array(46708, 4119, 2600, 4234, 4184, 2907);
$gec_5 = array(23622, 4127);
$omdv = array(4127, 2600, 46706, 3, 1, 2709, 2501, 39925, 34637);
$gpte = array(23085, 23473, 46707, 46708, 23622);
$hierarq0 = array(39925, 46706, 23085, 23473, 46707, 46708, 23622);
$doc = array_merge($gec_1, $gec_2, $gec_3, $gec_4, $gec_5, $omdv);
$dec = array_merge($gec_1, $gec_2, $gec_3, $gec_4, $gec_5, $omdv);

//verifica a OM para mostrar de acordo tal
$om = [];
$status = 'NF';
if (isset($_SESSION) && isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario']['id_om'] == 39925) {
        $om = $dec;
        $status = 'EA';
    } elseif ($_SESSION['usuario']['id_om'] == 46706) {
        $om = $doc;
        $status = 'ED';
    } elseif ($_SESSION['usuario']['id_om'] == 23085) {
        $om = $gec_1;
        $status = 'EG';
    } elseif ($_SESSION['usuario']['id_om'] == 23473) {
        $om = $gec_2;
        $status = 'EG';
    } elseif ($_SESSION['usuario']['id_om'] == 46707) {
        $om = $gec_3;
        $status = 'EG';
    } elseif ($_SESSION['usuario']['id_om'] == 46708) {
        $om = $gec_4;
        $status = 'EG';
    } elseif ($_SESSION['usuario']['id_om'] == 23622) {
        $om = $gec_5;
        $status = 'EG';
    } else {
        $om = array($_SESSION['usuario']['id_om']);
        $status = 'NF';
    }
}

define("TIME_SESSAO", "7198"); //TEMPO LIMITE DE INATIVIDADE NO GG
define("USER", "admin");
define("PASS", "password");
define("PORT", "5432");
define("HOST", 'db'); // o mesmo nome do serviço do docker-composer.yml
define("DB", "sioc-leandro");
define("DNS", "pgsql:dbname=" . DB . ";user=" . USER . ";password=" . PASS . ";host=" . HOST . ";port=" . PORT);
define("OM", (isset($_SESSION) && isset($_SESSION['usuario']) ? $_SESSION['usuario']['id_om'] : ''));
define("OMS", implode(',', $om));
define("OMDV", serialize($omdv));
define("GPTES", serialize($gpte));
define("Hierarq0", serialize($hierarq0));
define("STATUS", $status);
define("ALLOM", implode(',', $array_OMS));
define("TODOS_STATUS", "'AP','EA','ED','EG','EC','NF','PA'");
define("PATHLOG", dirname(__FILE__, 2) . '/');
define("SIAFIWS", "http://painelsiafihmg.dec.eb.mil.br/ws/service");
define("OBRAS5GPE", "650, 684");
define("SISRO_URL", "https://sisro.economia.gov.br/obra/ObraResourceSOAPService?wsdl");
define("SISRO_USUARIO", "00074766392");
define("SISRO_TOKEN", "f67fdbfc5b384137ebc637bc136dc0ae");
define("CIPI", [
    'url' => 'https://hom-cipi.estaleiro.serpro.gov.br/cipiws/',
    'credenciaisAcesso' => [
        "codigoOrgao" => "52121",
        "sistema" => "SIOC",
        "cpf" => "02638256129",
    ],
    'credenciaisToken' => [
        'usuario' => 'SIOC',
        'senha' => 'HV8QqLIs'
    ]
]);
define("PROXY", [
    'host' => "10.166.128.126",
    'port' => 3128,
    'login' => "",
    'password' => "",
]);
