<?php namespace Helpsmile\Services\Upload;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Helpsmile\User;
use Helpsmile\Organisation;
use Helpsmile\Services\Forms\AddEmployeeForm;
use Helpsmile\Services\Validation\FormValidationException;
use Excel;

class ExcelUploadService
{
    /**
     * Organisation instance.
     *
     * @var \Helpsmile\Organisation
     */
    protected $organisation;

    /**
     * The array containing the errors.
     *
     * @var array
     */
    protected $errors;

    /**
     * Get the errors.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the organisation for importing the employee details.
     *
     * @param  \Helpsmile\Organisation  $organisation
     * @return array|bool
     */
    public function forOrganisation(Organisation $organisation)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Handle the file upload. Returns the response body on success, or false
     * on failure.
     *
     * @param  \Symfony\Component\HttpFoundation\File\UploadedFile  $file
     * @return array|bool
     */
    public function handle(UploadedFile $file)
    {
        $mime = $file->getMimeType();

        if($mime == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' 
            || $mime == 'application/vnd.ms-excel'){

            $users = Excel::load($file->getRealPath())->toArray();
        
            $form = app(AddEmployeeForm::class);
            
            //Column names in excel are in row number 1
            //Therefore actual data starts from row number 2
            $rowNumber = 2;
            $this->errors = [];
            foreach ($users as $data) {
                try
                {
                    $data['password'] = $data['password_confirmation'] = 'password';
                    $form->validate($data);
                }
                catch(FormValidationException $e){
                    $this->errors[$rowNumber] = $e->getErrors()->all();
                }
                ++$rowNumber;
            }
            if($this->errors)
               return false;
            
            return $users;
        
        }
        else
        {
            $this->errors = "You are allowed to upload only excel files and not with mime $mime";
            return false;
        }
    }
}
