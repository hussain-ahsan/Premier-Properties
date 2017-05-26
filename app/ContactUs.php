<?php
namespace App;


use App\Services\CommonService;

class ContactUs
{

    /**
     * This method is used to upload the resume of the user
     **/
    public function contactUs($request)
    {
        $pathToFile = public_path() . env('USER_RESUME_UPLOAD_PATH');
        $fileTypeResult = CommonService::checkFileType('uploadedResume', config('app.allowedFileTypeArray'));
        if ($fileTypeResult) {
            $fileName = CommonService::uploadFile('uploadedResume', env('USER_RESUME_UPLOAD_PATH'));
            $receiverEmail = env('RECEIVER_EMAIL');
            $receiverName = env('RECEIVER_NAME');
            $subject =  env('CONTACT_SUBJECT') ?  env('CONTACT_SUBJECT') : 'Contact Us - Premier';
            $sendEmailObject = collect([
                'emailFile' => 'emails.contactUs',
                'request' => $request,
                'filePath' => $pathToFile,
                'fileName' => $fileName,
                'receiverEmail' =>$receiverEmail,
                'receiverName' => $receiverName,
                'subject' => $subject
            ]);
            $returnObject = CommonService::sendEmail($sendEmailObject);
        } else {
            $returnObject = collect([
                'status' => 'failure',
                'message' => 'Invalid file extension'
            ]);
        }
        if (!empty($fileName)) {
            CommonService::unlinkFile($pathToFile . '/' . $fileName);
        }
        return $returnObject;
    }


}