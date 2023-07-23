<?php
class DashboardController extends Utility
{
    private $medicineModel;

    public function __construct(MedicineModel $medicineModel)
    {
        $this->medicineModel = $medicineModel;
    }

    public function getAllMedicine(): array
    {
        try {
            $medicines = $this->medicineModel->getAllMedicines();

            return $this->successResponseWithData("Medicines successfully fetched.", ['medicines' => $medicines]);
        } catch (Exception $error) {
            return $this->errorResponse("Error: Unable to fetch medicines.");
        }
    }
}