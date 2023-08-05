<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// GENERAL
require_once '../database/database.php';
require_once 'router.php';

// MIDDLEWAREs
require_once '../middleware/responseMiddleware.php';
require_once '../middleware/dataMiddleware.php';
require_once '../middleware/fileMiddleware.php';
require_once '../middleware/authMiddleware.php';

// MODELs
require_once '../model/attachment.php';
require_once '../model/complaint.php';
require_once '../model/laboratory.php';
require_once '../model/medicine.php';
require_once '../model/record.php';
require_once '../model/storage.php';
require_once '../model/treatment.php';
require_once '../model/user.php';
require_once '../model/token.php';

// CONTROLLERs
require_once '../controller/medicinesController.php';
require_once '../controller/complaintsController.php';
require_once '../controller/laboratoriesController.php';
require_once '../controller/storagesController.php';
require_once '../controller/treatmentsController.php';
require_once '../controller/recordsController.php';
require_once '../controller/attachmentsController.php';
require_once '../controller/usersController.php';
require_once '../controller/tokensController.php';

// SET HEADERS
header('Content-Type: application/json');

// ROUTER INSTANCE
$router = new Router();

// MODEL INSTANCES
$medicineModel = new MedicineModel();
$complaintModel = new ComplaintModel();
$laboratoryModel = new LaboratoryModel();
$storageModel = new StorageModel();
$treatmentModel = new TreatmentModel();
$recordModel = new RecordModel();
$attachmentModel = new AttachmentModel();
$userModel = new UserModel();
$tokenModel = new TokenModel();

// ROUTES
require_once './routes/medicinesRoute.php';
require_once './routes/complaintsRoute.php';
require_once './routes/laboratoriesRoute.php';
require_once './routes/storagesRoute.php';
require_once './routes/treatmentsRoute.php';
require_once './routes/recordsRoute.php';
require_once './routes/attachmentsRoute.php';
require_once './routes/usersRoute.php';
require_once './routes/tokensRoute.php';

// Handle 404 Not Found
$router->set404(function () {
    echo json_encode(Response::errorResponse("Endpoint Not Found", 404));
});

// Run the router
$router->run();
