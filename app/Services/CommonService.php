<?php

namespace App\Services;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Mail;
use Illuminate\Support\Facades\Input;
use Symfony\Component\CssSelector\Exception\ExpressionErrorException;
use Symfony\Component\Debug\ExceptionHandler;

class CommonService
{

    /**
     * @param $file => complete file name with path
     */
    public static function unlinkFile($file)
    {
        try {
            if (file_exists($file)) {
                unlink($file);
                return collect(['status' => 'success', 'message' => $file . ' removed']);
            } else {
                return collect(['status' => 'failure', 'message' => $file . ' doesn\'t exist']);
            }
        } catch (ExpressionErrorException $e) {
            return collect(['status' => 'failure', 'message' => $e]);
        }
    }

    /**
     * This method is used to check file mime type
     * @param $fileId and allowed File types array
     * @return true of false
     */
    public static function checkFileType($fileId, $allowedFileTypes)
    {
        $fileTypeResult = true;
        if (!empty($_FILES)) {
            $fileType = $_FILES[$fileId]['type'];
            if (!empty($fileType)) {
                $fileTypeResult = in_array($fileType, $allowedFileTypes);
            }
        }
        return $fileTypeResult;
    }

    /**
     * This method is used to send email the uploaded the resume of the user
     * @param object have email HTML file, request object, receiver name, email address
     **/
    public static function sendEmail($sendEmailObject)
    {
        try {
            Mail::send($sendEmailObject['emailFile'], ['request' => $sendEmailObject['request']], function ($m) use ($sendEmailObject) {
                if ($sendEmailObject['filePath'] != '' && $sendEmailObject['fileName'] != '') {
                    $m->attach($sendEmailObject['filePath'] . '/' . $sendEmailObject['fileName'], $options = []);
                }
                $m->to($sendEmailObject['receiverEmail'], $sendEmailObject['receiverName'])->subject($sendEmailObject['subject']);
            });
            return collect(['status' => 'success', 'message' => 'We will contact you soon..!']);
        } catch (ExpressionErrorException $e) {
            return collect(['status' => 'failure', 'message' => 'Something went wrong while attaching your file']);
        }
    }

    /**
     * This method is used to upload reports
     * @param $fileId
     * @param $uploadPath
     * @return string
     */
    public static function uploadFile($fileId, $uploadPath)
    {
        $fileName = '';
        if (Input::hasFile($fileId)) {
            $dt = Carbon::parse(Carbon::Now());
            $timeStamp = $dt->timestamp;
            $destinationPath = public_path() . $uploadPath;
            $extension = Input::file($fileId)->getClientOriginalExtension();
            $fileOriginalName = Input::file($fileId)->getClientOriginalName();
            $fileOriginalName = str_replace('.' . $extension, "", $fileOriginalName);
            $fileName = $timeStamp . '__' . $fileOriginalName . '.' . $extension;
            Input::file($fileId)->move($destinationPath, $fileName);
        }
        return $fileName;
    }

    /**
     * This method is used to get date
     * @param $value
     * @param $format
     * @return string
     */
    public static function getDate($value, $format)
    {
        $getDate = '';
        if(strtotime($value) >= 0){
            $date = new DateTime($value);
            $getDate = $date->format($format);
        }
        return $getDate;
    }

    /**
     * This method is used to set date
     * @param $value
     * @param string $format
     * @return bool|string
     */
    public static function setDate($value, $format)
    {
        $setDate = '';
        if(!empty($value)){
            $setDate = date($format, strtotime($value));
        }
        return $setDate;
    }

    /**
     * This method is used to resize and save the image.
     * @param $path
     * @param $image
     * @param $savePath
     * @return ImageInterface|static
     */
    public static function resizeImage($path, $image, $savePath)
    {
        $imagine = new Imagine();
        $imageSize = getimagesize(public_path().$path.$image);
        $size = new Box($imageSize[0], $imageSize[1]);
        if (!file_exists(public_path().$savePath)) {
            mkdir(public_path().$savePath, 755, true);
        }
        $resizeImage = $imagine -> open(public_path().$path.$image)
                                -> resize($size)
                                -> save(public_path().$savePath.$image);

        return $resizeImage;
    }

    /**
     * This method is used to make image thumbnail in different sizes
     * @param $path
     * @param $width
     * @param $height
     * @param $image
     * @return ImageInterface|static
     */
    public static function thumbnailImage($path, $width, $height, $image)
    {
      $imagine = new Imagine();
      $size = new Box($width, $height);
      $mode = ImageInterface::THUMBNAIL_INSET;
      if (!file_exists(public_path().$path)) {
          mkdir(public_path().$path, 755, true);
      }
      $thumbnailImage =  $imagine -> open(public_path().$path.$image)
                                  -> thumbnail($size, $mode)
                                  -> save(public_path().$path.$width.'*'.$height.'_'.$image);
      return $thumbnailImage;
    }

}