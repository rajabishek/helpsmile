<?php namespace Helpsmile\Services\Upload;

use Intervention\Image\Facades\Image;
use Helpsmile\Filesystem\FilesystemManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Foundation\Application;
use Helpsmile\User;
use Storage;

class ImageUploadService
{
    /**
     * The directory to safe image uploads to.
     *
     * @var string
     */
    protected $directory = 'public/uploads/profiles';

    /**
     * The extension to use for image files.
     *
     * @var string
     */
    protected $extension = 'jpg';

    /**
     * The dimensions to resize the image to.
     *
     * @var int
     */
    protected $size = 250;

    /**
     * Enable CORS from the given origin.
     *
     * @param  string  $origin
     * @return void
     */
    public function enableCORS($origin)
    {
        $allowHeaders = [
            'Origin',
            'X-Requested-With',
            'Content-Range',
            'Content-Disposition',
            'Content-Type'
        ];

        header('Access-Control-Allow-Origin: ' . $origin);
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: ' . implode(', ', $allowHeaders));
    }

    /**
     * Get the full path from the given partial path.
     *
     * @param  string  $path
     * @return string
     */
    protected function getFullPath($path)
    {
        return base_path() . '/' . $path;
    }

    /**
     * Make a new unique filename
     *
     * @return string
     */
    protected function makeFilename()
    {
        return sha1(time() . time()) . ".{$this->extension}";
    }

    /**
     * Get the contents of the file located at the given path.
     *
     * @param  string  $path
     * @return mixed
     */
    protected function getFile($path)
    {
        return Storage::disk('local')->get($path);
    }

    /**
     * Get the size of the file located at the given path.
     *
     * @param  string  $path
     * @return mixed
     */
    protected function getFileSize($path)
    {
        return Storage::disk('local')->size($path);
    }

    /**
     * Construct the data URL for the JSON body
     *
     * @param  string  $mime
     * @param  string  $path
     * @return string
     */
    protected function getDataUrl($mime, $path)
    {
        $base = base64_encode($this->getFile($path));

        return 'data:' . $mime . ';base64,' . $base;
    }

    /**
     * Construct the body of the JSON response.
     *
     * @param  string  $filename
     * @param  string  $mime
     * @param  string  $path
     * @return array
     */
    protected function getJsonBody($filename, $mime, $path)
    {
        return [
            'images' => [
                'filename' => $filename,
                'mime'     => $mime,
                'size'     => $this->getFileSize($path),
                'dataURL'  => $this->getDataUrl($mime, $path)
            ]
        ];
    }

     /**
     * Update the profile image for the given user
     *
     * @param  string  $filename
     * @param  \Helpsmile\User  $user
     * @return boolean
     */
    protected function updateProfileForUser($filename, User $user)
    {
        $filepath = $this->directory . '/' . $user->profile;
        if($user->profile && Storage::disk('local')->exists($filepath)){
            Storage::disk('local')->delete($filepath);
        }
        
        $user->profile = $filename;
        return $user->save();
    }

    /**
     * Handle the file upload. Returns the response body on success, or false
     * on failure.
     *
     * @param  \Symfony\Component\HttpFoundation\File\UploadedFile  $file
     * @return array|bool
     */
    public function handle(UploadedFile $file,User $user)
    {
        $mime     = $file->getMimeType();
        $filename = $this->makeFilename();
        $relativePath = $this->directory . '/' . $filename;
        $path     = $this->getFullPath($relativePath);

        $success = Image::make($file->getRealPath())
                        ->resize($this->size, $this->size)
                        ->save($path);

        if (!$success) {
            return false;
        }

        $this->updateProfileForUser($filename,$user);
        return $this->getJsonBody($filename, $mime, $relativePath);
    }
}
