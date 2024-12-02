<?php


/*
|--------------------------------------------------------------------------
| BackendModule Routes
|--------------------------------------------------------------------------
|
*/

include_once(__DIR__ . '/BackendModule/Actions/BulkActions.php');
include_once(__DIR__ . '/BackendModule/Actions/DestroyData.php');
include_once(__DIR__ . '/BackendModule/Actions/GetAllData.php');
include_once(__DIR__ . '/BackendModule/Actions/GetSingleData.php');
include_once(__DIR__ . '/BackendModule/Actions/ImportData.php');
include_once(__DIR__ . '/BackendModule/Actions/RestoreData.php');
include_once(__DIR__ . '/BackendModule/Actions/SoftDelete.php');
include_once(__DIR__ . '/BackendModule/Actions/StoreData.php');
include_once(__DIR__ . '/BackendModule/Actions/UpdateData.php');
include_once(__DIR__ . '/BackendModule/Actions/UpdateStatus.php');

include_once(__DIR__ . '/BackendModule/Others/ApiDocumentation.php');
include_once(__DIR__ . '/BackendModule/Others/ImportJob.php');

include_once(__DIR__ . '/BackendModule/Controller/Controller.php');

include_once(__DIR__ . '/BackendModule/Models/Model.php');

include_once(__DIR__ . '/BackendModule/Database/Migration.php');


include_once(__DIR__ . '/BackendModule/Routes/Route.php');

include_once(__DIR__ . '/BackendModule/Seeder/Seeder.php');

include_once(__DIR__ . '/BackendModule/Validations/BulkActionsValidation.php');
include_once(__DIR__ . '/BackendModule/Validations/DataStoreValidation.php');
include_once(__DIR__ . '/BackendModule/Validations/GetAllDataValidation.php');

/*
|--------------------------------------------------------------------------
| FrontendModule Routes
|--------------------------------------------------------------------------
|
*/
include_once(__DIR__ . '/FrontendModule/SetupIndex.php');
include_once(__DIR__ . '/FrontendModule/FormField.php');
// include_once(__DIR__ . '/FrontendModule/Pages/AllDataPage.php');
// include_once(__DIR__ . '/FrontendModule/Pages/DetailsPage.php');
// include_once(__DIR__ . '/FrontendModule/Pages/FormPage.php');
// include_once(__DIR__ . '/FrontendModule/Pages/LayoutPage.php');


// include_once(__DIR__ . '/FrontendModule/Setup/Router.php');

// include_once(__DIR__ . '/FrontendModule/Setup/SetupType.php');

// include_once(__DIR__ . '/FrontendModule/Store/Index.php');
// include_once(__DIR__ . '/FrontendModule/Store/InitialState.php');

