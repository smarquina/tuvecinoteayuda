<?php
/**
 * Created for tuvecinoteayuda.
 * User: Sergio Martin Marquina
 * Email: smarquina@zenos.es
 * Date: 26/03/2020
 * Time: 22:17
 */

namespace App\Http\Managers\Auth;


use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;

class VerifyUserManager {

    /**
     * Verify DNI service.
     *
     * @param string $file_base64
     * @param User   $user
     * @return VerificationResponse
     * @throws ConnectionException
     */
    public static function verifyUser(string $file_base64, User &$user) {
        try {
            $response = \Http::post(env('URL_VERIFICATION'), ["img" => $file_base64]);

            switch ($response) {
                case $response->successful():
                    $dniText = collect(explode("\n",
                                               collect($response->json()["textAnnotations"])->first()['description']))
                        ->filter();

                    $dniVars       = new DniVars;
                    $currentDniVar = null;

                    $dniText->each(function ($text) use (&$currentDniVar, &$dniVars) {
                        switch ($text) {
                            case DniVars::APELLIDOS:
                                $currentDniVar = DniVars::APELLIDOS;
                                break;
                            case DniVars::NOMBRE:
                                $currentDniVar = DniVars::NOMBRE;
                                break;
                            case DniVars::FECHA_DE_NACIMIENTO:
                                $currentDniVar = DniVars::FECHA_DE_NACIMIENTO;
                                break;
                            case (preg_match('/^' . DniVars::DNI . '\s([0-9]{8}[A-Z]{1})\z/', $text, $matches) ? true : false):
                                $currentDniVar = null;
                                $dniVars->setDni($matches[1]);
                                break;
                            case DniVars::NACIONALIDAD:
                            case DniVars::SEXO:
                            case DniVars::VALIDEZ:
                                $currentDniVar = null;
                                break;
                            default:
                                switch ($currentDniVar) {
                                    case DniVars::APELLIDOS:
                                        $dniVars->setSurname($text);
                                        break;
                                    case DniVars::NOMBRE:
                                        $dniVars->setName($text);
                                        break;
                                    case DniVars::FECHA_DE_NACIMIENTO:
                                        $dniVars->setBirthday($text);
                                        break;
                                }
                        }
                    });

                    similar_text(self::trimText("{$dniVars->getName()} {$dniVars->getSurname()}"),
                                 self::trimText($user->name),
                                 $threshold);

                    if ($threshold >= config('auth.verification_name_percentage') &&
                        self::trimText($dniVars->getDni()) == self::trimText($user->cif)) {

                        $user->birthday = $dniVars->getBirthday();
                        return new VerificationResponse(true, null);
                    } else {
                        return new VerificationResponse(false, null);
                    }
                    break;
                case $response->clientError():
                case $response->serverError():
                    return new VerificationResponse(false, $response);
                    break;
            }
        } catch (\Exception $exception) {
            \Log::error($exception);
            throw new ConnectionException(trans('user.verification.connection_error'));
        }
    }

    /**
     * Check valid DNI.
     *
     * @param string $dni
     * @return bool
     */
    public static function dniValidator(string $dni): bool {
        $letter  = substr($dni, -1);
        $numbers = substr($dni, 0, -1);
        return (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers % 23, 1) == $letter
                && strlen($letter) == 1
                && strlen($numbers) == 8);
    }

    /**
     * Trim text to make comparisons with it.
     *
     * @param $string
     * @return string
     */
    private static function trimText($string) {
        $replacer = [
            'Á' => 'A',
            'É' => 'E',
            'Í' => 'I',
            'Ó' => 'O',
            'Ú' => 'U',
        ];

        return Str::Upper(strtr($string, $replacer));
    }
}

/**
 * Class DniVars
 * @package App\Http\Managers\Auth
 */
class DniVars {

    const APELLIDOS           = "APELLIDOS";
    const NOMBRE              = "NOMBRE";
    const NACIONALIDAD        = "NACIONALIDAD";
    const SEXO                = "SEXO";
    const FECHA_DE_NACIMIENTO = "FECHA DE NACIMIENTO";
    const VALIDEZ             = "NUM SOPORT VALIDEZ";
    const DNI                 = "DNI";

    protected $name;
    protected $surname;
    protected $dni;
    protected $birthday;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void {
        empty($this->name)
            ? $this->name = $name
            : $this->name .= " {$name}";
    }

    /**
     * @return string
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname): void {
        empty($this->surname)
            ? $this->surname = $surname
            : $this->surname .= " {$surname}";
    }

    /**
     * @return string
     */
    public function getDni() {
        return $this->dni;
    }

    /**
     * @param string $dni
     */
    public function setDni($dni): void {
        $this->dni = $dni;
    }

    /**
     * @return Carbon
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday($birthday): void {
        $this->birthday = Carbon::createFromFormat("d m Y", $birthday);
    }


}

/**
 * Class VerificationResponse
 * @package App\Http\Managers\Auth
 */
class VerificationResponse {

    public $response;
    public $verified;

    /**
     * VerificationResponse constructor.
     * @param bool     $verified
     * @param Response $response
     */
    public function __construct(bool $verified, Response $response = null) {
        $this->verified = $verified;
        $this->response = $response;
    }
}
