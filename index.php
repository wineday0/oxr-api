<?php

use Controller\Controller;

require_once 'config/params.php';

require_once 'src/Service/ServiceInterface.php';
require_once 'src/Service/OpenExchangeRateService.php';

require_once 'src/Component/Currency.php';

require_once 'src/Dto/RatesDto.php';
require_once 'src/Dto/LatestDto.php';
require_once 'src/Dto/DtoBuilder.php';

require_once 'src/Client/Methods.php';
require_once 'src/Client/AuthenticationTypes.php';
require_once 'src/Client/ApiClient.php';

require_once 'src/Controller/Controller.php';

$response = (new Controller())->getOXRLatest();
print_r($response);